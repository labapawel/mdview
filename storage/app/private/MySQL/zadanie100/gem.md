Cel zadania: Zrozumienie mechanizmu relacji 1:1, wymuszania unikalności na kluczu obcym oraz praktyczne wykorzystanie złączeń (JOIN).

Część 1: Projektowanie struktury bazy danych (DDL)
Utworzenie bazy danych: Napisz polecenie tworzące nową bazę danych o nazwie FirmaIT i ustaw ją jako aktywną (USE).

Tabela Pracownicy (Strona nadrzędna): Zaprojektuj tabelę Pracownicy. Powinna zawierać:

id (liczba całkowita, klucz główny, autoinkrementacja).

imie (tekst, wymagane).

nazwisko (tekst, wymagane).

stanowisko (tekst, np. Junior, Senior).

data_zatrudnienia (data).

Tabela Laptopy (Strona podrzędna): Zaprojektuj tabelę Laptopy. Powinna zawierać:

id (klucz główny).

model (tekst, np. 'Dell XPS').

numer_seryjny (tekst, unikalny w skali tabeli).

ram_gb (liczba całkowita).

pracownik_id (klucz obcy).

Kluczowa zasada relacji 1:1 (CONSTRAINT): W definicji tabeli Laptopy dodaj ograniczenie UNIQUE na kolumnę pracownik_id. Wyjaśnienie: To właśnie ten krok zmienia relację z 1:N na 1:1 (jeden pracownik może mieć przypisany tylko jeden laptop).

Definicja Klucza Obcego (Foreign Key): W tabeli Laptopy powiąż kolumnę pracownik_id z kolumną id w tabeli Pracownicy. Dodaj instrukcję ON DELETE CASCADE (gdy pracownik zostanie zwolniony/usunięty, rekord laptopa również znika lub traci przypisanie - w tym przypadku usuwamy przypisanie laptopa).

Część 2: Wprowadzanie danych (DML) i testy integralności
Wstawianie pracowników: Dodaj do tabeli Pracownicy 3 rekordy (np. Jan Kowalski, Anna Nowak, Piotr Wiśniewski).

Wstawianie laptopów (Poprawne): Przypisz laptopy dla Jana (ID 1) i Anny (ID 2). Użyj INSERT INTO.

Test unikalności (Błąd logiczny): Spróbuj przypisać drugi laptop dla pracownika o ID 1 (Jana). Oczekiwany rezultat: Baza danych musi zwrócić błąd Duplicate entry, ponieważ pracownik_id jest unikalny.

Test integralności referencyjnej: Spróbuj przypisać laptop dla nieistniejącego pracownika (np. ID 999). Oczekiwany rezultat: Błąd klucza obcego (Cannot add or update a child row).

Pracownik bez sprzętu: Zostaw Piotra (ID 3) bez przypisanego laptopa. Jest to dozwolone w relacji 1:1 (relacja opcjonalna po jednej stronie).

Część 3: Odpytywanie danych (DQL)
Podstawowy przegląd (INNER JOIN): Napisz zapytanie wyświetlające imię, nazwisko pracownika oraz model jego laptopa. Wyświetl tylko tych, którzy mają sprzęt.

Raport pełny (LEFT JOIN): Napisz zapytanie wyświetlające wszystkich pracowników, również tych bez laptopa. W miejscu braku sprzętu powinien pojawić się NULL.

Filtrowanie (WHERE): Znajdź pracownika, który posiada laptopa o pamięci RAM większej lub równej 16GB. Wyświetl nazwisko i model.

Wyszukiwanie po numerze seryjnym: Znajdź właściciela konkretnego laptopa, znając jego numer_seryjny.

Aliasy i czytelność: Zmodyfikuj zapytanie z punktu 11, używając aliasów tabel (np. p dla Pracownicy, l dla Laptopy) oraz złącz imię i nazwisko w jedną kolumnę Pracownik (funkcja CONCAT).

Część 4: Modyfikacja i zarządzanie
Aktualizacja danych (UPDATE): Anna Nowak dostała awans i nowy sprzęt. Zmień model jej laptopa (wyszukując go po jej ID) na 'MacBook Pro'.

Przeniesienie sprzętu (Zmiana właściciela): Zwolnij laptopa przypisanego do Jana (ustaw pracownik_id na NULL w tabeli Laptopy dla jego rekordu) lub przepisz go na Piotra.

Usuwanie danych (DELETE z kaskadą): Usuń użytkownika Jan Kowalski z tabeli Pracownicy. Analiza: Sprawdź, co stało się z rekordem w tabeli Laptopy (zależnie od ustawienia ON DELETE w punkcie 5 – jeśli dałeś CASCADE, laptop zniknie; jeśli nie dałeś, zapytanie może zostać zablokowane).

Agregacja (COUNT): Policz, ilu pracowników posiada przypisane laptopy, a ilu nie posiada (wykorzystaj COUNT i LEFT JOIN).

Sprzątanie (DROP): Napisz polecenie usuwające obie tabele (pamiętaj o kolejności usuwania ze względu na klucze obce) oraz całą bazę danych.

Przykładowy Prompt dla AI (do wklejenia):
Jeśli chcesz, aby AI wykonało to zadanie za Ciebie (wygenerowało kod SQL), możesz użyć poniższego polecenia:

"Jesteś ekspertem MySQL. Wygeneruj kompletny kod SQL (DDL i DML) realizujący poniższe zadanie w 20 punktach. Temat: Relacja 1:1 między tabelami Pracownicy i Laptopy.

Utwórz bazę FirmaIT.

Stwórz tabelę Pracownicy (id, imie, nazwisko, data_zatrudnienia).

Stwórz tabelę Laptopy (id, model, serial_no, pracownik_id).

Ważne: Zastosuj UNIQUE na pracownik_id w tabeli Laptopy, aby wymusić relację 1:1.

Ustaw klucz obcy z ON DELETE SET NULL.

Wstaw 3 pracowników.

Przypisz laptopy dwóm pracownikom.

Pokaż (w komentarzu), jak wyglądałoby błędne zapytanie próbujące dodać drugi laptop temu samemu pracownikowi. 9-15. Wygeneruj zapytania SELECT pokazujące: złączenia (INNER/LEFT), filtrowanie, sortowanie. 16-20. Pokaż operacje UPDATE (zmiana laptopa), DELETE (usunięcie pracownika) i sprawdzenie wyników.