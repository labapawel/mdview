# Zadanie 102: Licznik Odwiedzin Strony - Operacje na Plikach

## Wstęp
Większość aplikacji webowych musi gdzieś przechowywać dane. Zazwyczaj używamy do tego baz danych, ale czasami wystarczy prosty plik tekstowy. Umiejętność operowania na plikach (odczyt, zapis, aktualizacja) to fundament pracy każdego programisty backendowego. W tym zadaniu stworzysz "pamięć" dla swojej strony, która przetrwa nawet restart serwera.

## Cel zadania
Stworzenie prostego licznika odwiedzin, który zlicza każde odświeżenie strony i zapisuje wynik w pliku tekstowym.

## Wymagania techniczne
1.  **Plik danych**: `licznik.txt` do przechowywania liczby.
2.  **Skrypt PHP**: `index.php` do obsługi logiki.
3.  **Funkcje plików**: `file_get_contents`, `file_put_contents` (lub `fopen`, `fread`, `fwrite`).

## Kroki do wykonania

### 1. Przygotowanie Pliku Danych
Stwórz pusty plik tekstowy o nazwie `licznik.txt`. Wpisz do niego ręcznie liczbę `0` i zapisz.
To ważne, aby plik istniał, zanim PHP spróbuje go odczytać (choć można też obsłużyć jego brak w kodzie).

> [!IMPORTANT]
> **Commit 1**: Utworzenie pliku licznik.txt.

### 2. Struktura Strony i Odczyt
Stwórz plik `index.php`.
Na początku pliku użyj funkcji `file_get_contents('licznik.txt')`, aby pobrać aktualną wartość licznika do zmiennej.

```php
<?php
$plik = 'licznik.txt';
// Sprawdź czy plik istnieje, jeśli nie - ustaw 0
if (file_exists($plik)) {
    $aktualne_odwiedziny = (int)file_get_contents($plik);
} else {
    $aktualne_odwiedziny = 0;
}
?>
<!-- Tutaj będzie HTML -->
```

> [!IMPORTANT]
> **Commit 2**: Implementacja odczytu danych z pliku.

### 3. Inkrementacja i Zapis
Zaraz po odczytaniu, zwiększ wartość zmiennej o 1.
Następnie zapisz nową wartość do pliku używając `file_put_contents($plik, $now wartosc)`.

```php
<?php
// ... (kod z poprzedniego punktu)
$aktualne_odwiedziny++; // Zwiększamy o 1

file_put_contents($plik, $aktualne_odwiedziny); // Zapisujemy nową wartość
?>
```

> [!IMPORTANT]
> **Commit 3**: Logika zliczania i zapisu do pliku.

### 4. Wyświetlanie
W sekcji HTML (poniżej kodu PHP), wyświetl ładnie sformatowany komunikat.

```html
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Licznik Odwiedzin</title>
</head>
<body>
    <h1>Witamy na naszej stronie!</h1>
    <p>Jesteś naszym <?php echo $aktualne_odwiedziny; ?> gościem.</p>
</body>
</html>
```

> [!IMPORTANT]
> **Commit 4**: Wyświetlenie licznika na stronie.

### 5. Testowanie (Obsługa Błędów)
Spróbuj usunąć plik `licznik.txt` i odśwież stronę.
Jeśli Twój kod zawierał `if (file_exists(...))`, skrypt powinien sam utworzyć plik (dzięki `file_put_contents`) i zacząć od 1. Jeśli nie - popraw kod!

> [!IMPORTANT]
> **Commit 5**: Weryfikacja i obsługa braku pliku.

### 6. Stylowanie (CSS)
Strona bez stylów jest smutna. Dodajmy trochę kolorów!
1. Stwórz plik `style.css`.
2. Dodaj proste reguły, np. wyśrodkuj tekst, zmień czcionkę.
```css
body {
    font-family: sans-serif;
    text-align: center;
    background-color: #f0f0f0;
    margin-top: 50px;
}
h1 { color: #333; }
p { font-size: 1.2em; color: #666; }
```
3. Podepnij plik CSS w sekcji `<head>` pliku `index.php`:
```html
<link rel="stylesheet" href="style.css">
```

> [!IMPORTANT]
> **Commit 6**: Dodanie stylów CSS.

## Git Help - Jak commitować?

Pamiętaj o regularnym zapisywaniu postępów (commitowaniu).

1.  **Konfiguracja (jeśli robisz to pierwszy raz):**
    Otwórz terminal w folderze projektu i wpisz (podstawiając swoje dane):
    ```bash
    git config user.name "Twoje Imie"
    git config user.email "twoj.email@example.com"
    ```

2.  **Robienie Commita:**
    Po wykonaniu każdego punktu z listy wyżej, wpisz w terminalu:
    ```bash
    git add .
    git commit -m "Zadanie 102: Punkt X wykonany"
    ```
    (Gdzie X to numer punktu, np. "Commit 1: Plik licznika").
