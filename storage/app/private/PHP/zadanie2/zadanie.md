# Zadanie 2: Funkcje w PHP i Obliczenia Geometryczne

## Wstęp
Pisanie kodu to sztuka, ale nikt nie lubi pisać tego samego dwa razy. Jeśli masz fragment kodu, który oblicza coś ważnego (np. podatek lub pole figury), warto zamknąć go w **funkcji**. Funkcja to taki mały podprogram: dajesz mu dane wejściowe (argumenty), on robi swoje czary i "wypluwa" wynik (return).

## Opis z Przykładami

### 1. Tworzenie Funkcji (`function`)
```php
<?php
// Definicja funkcji
function powitanie($kogo) {
    return "Cześć, " . $kogo . "!";
}

// Użycie funkcji
$tekst = powitanie("Ania"); 
echo $tekst; // Wyświetli: Cześć, Ania!
?>
```

### 2. Funkcje Matematyczne
PHP ma wbudowane mnóstwo funkcji, np. `pi()` zwraca liczbę PI.

```php
<?php
function poleKola($promien) {
    // Wzór: PI * r^2
    $wynik = pi() * $promien * $promien;
    return $wynik;
}

echo poleKola(3); // Obliczy pole dla promienia 3
?>
```

### 3. Argumenty domyślne
Możemy ustalić wartość domyślną, jeśli użytkownik zapomni podać argument.
```php
function mnozenie($liczba, $mnoznik = 2) {
    return $liczba * $mnoznik;
}
echo mnozenie(10); // 20 (użyło domyślnego 2)
echo mnozenie(10, 3); // 30
```

## Opis Kodu
- `return` jest kluczowe! Bez niego funkcja coś obliczy, ale "zachowa to dla siebie". Jeśli chcesz użyć wyniku w dalszej części kodu (np. wyświetlić go), funkcja musi go zwrócić.
- Zmienne wewnątrz funkcji są **lokalne**. Zmienna `$wynik` z funkcji `poleKola` nie istnieje poza nią!

## Debugowanie
Co jeśli funkcja nie działa?
1. Sprawdź, czy przekazujesz argumenty w dobrej kolejności.
2. Upewnij się, że używasz `return` (chyba że funkcja ma tylko wyświetlać `echo`).
3. Nazwy funkcji w PHP nie zależą od wielkości liter (`POLEKOLA()` to to samo co `poleKola()`), ale dla porządku stosujemy jedną konwencję (zazwyczaj camelCase).

## Twoje Zadanie (Motivation)
Jesteś Głównym Architektem Królewskim! Król planuje budowę nowego zamku i ogrodów. Twoim zadaniem jest stworzenie narzędzia (strony), które błyskawicznie obliczy powierzchnię poszczególnych działek. Król nie lubi czekać na matematyków z liczydłami – chce widzieć wyniki na ekranie!

### Polecenia do wykonania:
Stwórz plik `geometria.php`.

1.  Zdefiniuj funkcję `poleKwadratu($bok)`, która zwraca pole ($a * a$).
2.  Zdefiniuj funkcję `poleProstokata($a, $b)`, która zwraca pole ($a * b$).
3.  Zdefiniuj funkcję `poleTrojkata($a, $h)`, która zwraca pole ($0.5 * a * h$).
4.  W sekcji HTML stwórz nagłówek "Kalkulator Królewskiego Architekta".
5.  Zadeklaruj przykładowe zmienne dla wymiarów:
    - `$bok_dziedzinca = 50;`
    - `$dlugosc_sali = 20; $szerokosc_sali = 15;`
    - `$podstawa_wiezy = 10; $wysokosc_wiezy = 30;`
6.  Wyświetl wyniki w czytelnej liście `<ul>`:
    - "Powierzchnia Dziedzińca (kwadrat): [WYNIK]" (użyj funkcji `poleKwadratu`).
    - "Powierzchnia Sali Tronowej (prostokąt): [WYNIK]" (użyj funkcji `poleProstokata`).
    - "Powierzchnia Dachu Wieży (trójkąt): [WYNIK]" (użyj funkcji `poleTrojkata`).
7.  **Dla chętnych:** Dodaj funkcję `poleKola($r)` i oblicz powierzchnię okrągłej fontanny o promieniu 4 metry. Wynik zaokrąglij do 2 miejsc po przecinku używając funkcji wbudowanej `round($liczba, 2)`.

# Warunek Zaliczenia
Stworzenie działających funkcji i poprawne wyświetlenie obliczonych powierzchni na stronie HTML.
