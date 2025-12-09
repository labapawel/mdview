# Zadanie 3: Operacje na Tekście (String)

## Wstęp
Komputery świetnie liczą, ale my, ludzie, komunikujemy się słowami. W JavaScript tekst przechowujemy w zmiennych typu **String**. Umiejętność manipulowania tekstem – łączenie, wycinanie, zamiana znaków – jest kluczowa przy tworzeniu interfejsów, walidacji formularzy czy przetwarzaniu danych użytkowników.

## Opis z Przykładami

Oto co możesz robić z tekstem:

### 1. Długość tekstu (`.length`)
Każdy String ma właściwość `length`, która mówi, ile ma znaków.
```javascript
let wiadomosc = "Cześć!";
console.log(wiadomosc.length); // Wynik: 6
```

### 2. Dostęp do znaków (`[]` lub `.charAt()`)
Możesz sprawdzić, jaka litera stoi na danej pozycji. **Uwaga: Liczymy od zera!**
```javascript
let slowo = "Kot";
console.log(slowo[0]); // Wynik: "K"
console.log(slowo[1]); // Wynik: "o"
```

### 3. Zmiana wielkości liter
```javascript
let krzyk = "halo";
console.log(krzyk.toUpperCase()); // "HALO"
console.log("CISZA".toLowerCase()); // "cisza"
```

### 4. Wycinanie fragmentów (`.slice()`)
Możesz wyciąć kawałek tekstu.
```javascript
// .slice(start, koniec) - koniec nie jest włączany do wyniku
let data = "2023-12-06";
let rok = data.slice(0, 4); // "2023"
let miesiac = data.slice(5, 7); // "12"
```

### 5. Zamiana treści (`.replace()`)
```javascript
let zdanie = "Lubię psy.";
let noweZdanie = zdanie.replace("psy", "koty"); // "Lubię koty."
```

## Opis Kodu
Pamiętaj, że **Stringi w JavaScript są niezmienne (immutable)**.
Metody takie jak `toUpperCase()` czy `slice()` **nie zmieniają** oryginalnego tekstu! One zwracają **nowy** tekst, który musisz przypisać do zmiennej, jeśli chcesz go zachować.

```javascript
let tekst = "mały";
tekst.toUpperCase(); // Nic się nie stało ze zmienną 'tekst'!
console.log(tekst); // Nadal "mały"

tekst = tekst.toUpperCase(); // Teraz nadpisaliśmy zmienną 'tekst' nową wartością
console.log(tekst); // "MAŁY"
```

## Debugowanie
Najczęstszy błąd? Zapomnienie o nawiasach `()` przy wywoływaniu metod.

**Przykład Błędu:**
```javascript
let imie = "adam";
console.log(imie.toUpperCase); 
// Wynik: [Function: toUpperCase] (wypisuje kod funkcji zamiast jej wyniku)
```

**Jak naprawić?**
Dodaj nawiasy: `imie.toUpperCase()`.

## Twoje Zadanie (Motivation)
Twoja postać wchodzi do Zapomnianej Biblioteki. Znajduje tam magiczny zwój, ale tekst jest zaszyfrowany! Musisz napisać skrypt, który odczyta wiadomość, sformatuje ją poprawnie i wydobędzie ukryte informacje. Od Twoich umiejętności zależy, czy poznasz sekret!

### Polecenia do wykonania:
1.  Stwórz zmienną `let encryptedMessage` o treści: `"   XDnIeBzPiEcZeNsTwO   "`. (Zauważ spacje na początku i końcu).
2.  Usuń zbędne spacje z początku i końca (użyj metody `.trim()`). Zapisz wynik do nowej zmiennej `cleanedMessage`.
3.  Zmień wielkość liter w `cleanedMessage` na same małe litery.
4.  Wiadomość zaczyna się od "xd" - to jakiś kod błędu, usuń pierwsze 2 znaki (użyj `.slice()`).
5.  Zamień słowo "niebezpieczenstwo" na "przygoda" (użyj `.replace()`).
6.  Wyświetl ostateczną wiadomość w konsoli wielkimi literami.
7.  Sprawdź długość ostatecznej wiadomości.

# Warunek Zaliczenia
Poprawne odczytanie i przekształcenie "ukrytej" wiadomości w konsoli.
