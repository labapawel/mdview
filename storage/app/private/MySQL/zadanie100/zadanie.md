# Zadanie 100: Relacje 1:1 w MySQL - Pracownicy i Sprzęt

## Wstęp
W bazach danych relacja **Jeden do Jednego (1:1)** występuje rzadziej niż 1:N, ale jest kluczowa dla bezpieczeństwa i porządku.
Przykład: Jeden pracownik może mieć tylko jeden służbowy laptop, a jeden laptop może należeć do tylko jednego pracownika.
W tym zadaniu zaprojektujesz taką strukturę, wymusisz ją ograniczeniami (Constraints) i przetestujesz odporność na błędne dane.

## Część 1: Projektowanie Struktury (DDL)

### Zadanie 1: Baza Danych
Utwórz nową bazę `FirmaIT` i wejdź do niej.
```sql
CREATE DATABASE FirmaIT;
USE FirmaIT;
```

### Zadanie 2: Tabela Pracownicy
Stwórz tabelę nadrzędną (Parent).
```sql
CREATE TABLE Pracownicy (
    id INT AUTO_INCREMENT PRIMARY KEY,
    imie VARCHAR(50) NOT NULL,
    nazwisko VARCHAR(50) NOT NULL,
    stanowisko VARCHAR(50),
    data_zatrudnienia DATE
);
```

### Zadanie 3: Tabela Laptopy (Child)
To tutaj dzieje się magia relacji.
```sql
CREATE TABLE Laptopy (
    id INT AUTO_INCREMENT PRIMARY KEY,
    model VARCHAR(100),
    numer_seryjny VARCHAR(50) UNIQUE,
    ram_gb INT,
    pracownik_id INT
);
```

### Zadanie 4: Wymuszenie Relacji 1:1 (UNIQUE)
Jeśli `pracownik_id` nie będzie unikalny, to wielu pracowników mogłoby mieć ten sam laptop (błąd) lub jeden pracownik wiele laptopów (relacja 1:N). Zmień to!
```sql
ALTER TABLE Laptopy ADD CONSTRAINT unique_pracownik UNIQUE (pracownik_id);
```
*To jest klucz do relacji 1:1 po stronie dziecka.*

### Zadanie 5: Klucz Obcy (Foreign Key)
Powiąż tabele. Użyj `ON DELETE CASCADE` (lub `SET NULL`), aby zachować porządek. Tutaj użyjemy `SET NULL` - gdy pracownik odejdzie, laptop zostaje w firmie (bez właściciela).
*Uwaga: Wcześniej musisz upewnić się, że kolumna pozwala na NULL.*
```sql
ALTER TABLE Laptopy ADD CONSTRAINT fk_pracownik
FOREIGN KEY (pracownik_id) REFERENCES Pracownicy(id)
ON DELETE SET NULL;
```

> [!IMPORTANT]
> **Commit 1**: Struktura bazy 1:1.

---

## Część 2: Wprowadzanie Danych i Testy Integralności (DML)

### Zadanie 6: Pracownicy
Dodaj trzech pracowników.
```sql
INSERT INTO Pracownicy (imie, nazwisko, stanowisko) VALUES 
('Jan', 'Kowalski', 'Ochrona'),
('Anna', 'Nowak', 'DevOps'),
('Piotr', 'Wiśniewski', 'HR');
```

### Zadanie 7: Laptopy (Poprawne)
Daj sprzęt Janowi i Annie.
```sql
INSERT INTO Laptopy (model, numer_seryjny, ram_gb, pracownik_id) VALUES
('Dell XPS', 'SN123', 16, 1),
('MacBook Air', 'SN456', 8, 2);
```

### Zadanie 8: Naruszenie Unikalności (Błąd 1:1)
Spróbuj dać DRUGI laptop Janowi (ID 1).
```sql
-- To powinno zwrócić błąd "Duplicate entry '1' for key 'unique_pracownik'"
INSERT INTO Laptopy (model, numer_seryjny, pracownik_id) VALUES ('HP Omen', 'SN999', 1);
```

### Zadanie 9: Nieistniejący Pracownik (Błąd FK)
Spróbuj dać laptopa duchowi (ID 999).
```sql
INSERT INTO Laptopy (model, pracownik_id) VALUES ('Lenovo', 999);
```
*Błąd Foreign Key Constraint.*

### Zadanie 10: Laptop bez właściciela
Dodaj laptopa "rezerwowego" (dla nikogo).
```sql
INSERT INTO Laptopy (model, numer_seryjny, ram_gb, pracownik_id) VALUES
('ThinkPad', 'SN777', 32, NULL);
```
*W relacji 1:1 (opcjonalnej) jest to dozwolone.*

> [!IMPORTANT]
> **Commit 2**: Dane i testy constraints.

---

## Część 3: Odpytywanie Danych (DQL)

### Zadanie 11: Kto ma laptopa? (INNER JOIN)
Wyświetl tylko tych, co mają sprzęt.
```sql
SELECT p.imie, p.nazwisko, l.model 
FROM Pracownicy p 
INNER JOIN Laptopy l ON p.id = l.pracownik_id;
```

### Zadanie 12: Kto ma, a kto nie? (LEFT JOIN)
Pokaż wszystkich. Jeśli nie mają laptopa, wyświetl NULL.
```sql
SELECT p.nazwisko, l.model 
FROM Pracownicy p 
LEFT JOIN Laptopy l ON p.id = l.pracownik_id;
```
*Piotr powinien mieć NULL.*

### Zadanie 13: Filtrowanie Sprzętu
Kto ma conajmniej 16GB RAM?
```sql
SELECT p.nazwisko, l.ram_gb 
FROM Pracownicy p 
JOIN Laptopy l ON p.id = l.pracownik_id 
WHERE l.ram_gb >= 16;
```

### Zadanie 14: Szukanie po Seryjnym
Do kogo należy 'SN123'?
```sql
SELECT CONCAT(p.imie, ' ', p.nazwisko) AS Wlasciciel
FROM Pracownicy p
JOIN Laptopy l ON p.id = l.pracownik_id
WHERE l.numer_seryjny = 'SN123';
```

### Zadanie 15: Laptopy Wolne
Znajdź laptopy, które leżą w magazynie (nie mają przypisanego pracownika).
```sql
SELECT * FROM Laptopy WHERE pracownik_id IS NULL;
```

> [!IMPORTANT]
> **Commit 3**: Zapytania JOIN.

---

## Część 4: Zarządzanie Lojalnością Danych

### Zadanie 16: Zmiana Sprzętu (UPDATE)
Anna (ID 2) wymienia laptopa na 'MacBook Pro'. Znajdź jej stary laptop i zaktualizuj.
```sql
UPDATE Laptopy SET model = 'MacBook Pro' WHERE pracownik_id = 2;
```

### Zadanie 17: Zwolnienie pracownika (DELETE)
Usuń Jana (ID 1).
```sql
DELETE FROM Pracownicy WHERE id = 1;
```

### Zadanie 18: Sprawdzenie Kaskady
Co się stało z laptopem Jana (`SN123`)?
```sql
SELECT * FROM Laptopy WHERE numer_seryjny = 'SN123';
```
*Powinien mieć teraz `pracownik_id = NULL` (dzięki ON DELETE SET NULL).*

### Zadanie 19: Raport Końcowy (COUNT)
Policz zajęte i wolne laptopy.
```sql
SELECT IF(pracownik_id IS NULL, 'Wolny', 'Zajety') AS Status, COUNT(*) 
FROM Laptopy 
GROUP BY Status;
```

### Zadanie 20: Sprzątanie
Usuń wszystko.
```sql
DROP TABLE Laptopy;
DROP TABLE Pracownicy;
DROP DATABASE FirmaIT;
```

> [!IMPORTANT]
> **Commit 4**: Modyfikacje i sprzątanie.

## Git Help
```bash
git add .
git commit -m "MySQL Zadanie 100: Relacja 1-1"
```
