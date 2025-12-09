# Zadanie 1: Zmienne i Operacje w PHP

## Wstęp
PHP (Hypertext Preprocessor) to język stworzony do działania po stronie serwera i generowania stron internetowych. Jego siła leży w tym, że może swobodnie mieszać się z kodem HTML.

W PHP wszystko zaczyna się od dolara (`$`). To znak rozpoznawczy zmiennych w tym języku. W przeciwieństwie do JavaScript, nie musimy deklarować typu zmiennej (czy to liczba, czy tekst) – PHP domyśli się sam.

## Opis z Przykładami

### 1. Tworzenie zmiennych i wyświetlanie (`echo`)
Kod PHP umieszczamy pomiędzy znacznikami `<?php` i `?>`.

```php
<?php
$imie = "Ala";      // Tekst (string)
$wiek = 25;         // Liczba całkowita (integer)
$cena = 19.99;      // Liczba zmiennoprzecinkowa (float)

// Wyświetlanie na stronie
echo "Cześć, mam na imię $imie."; 
// Zauważ: zmienne w cudzysłowach "" są automatycznie zamieniane na ich wartość!
?>
```

### 2. Operacje Matematyczne
Działają standardowo:
```php
<?php
$a = 10;
$b = 5;
$suma = $a + $b; // 15
$iloczyn = $a * $b; // 50
?>
```

### 3. Łączenie tekstów (Kropka `.`)
W JavaScript używaliśmy plusa `+`, w PHP używamy kropki `.`.
```php
<?php
$czesc1 = "Witaj";
$czesc2 = "Świecie";
$calosc = $czesc1 . " " . $czesc2; // "Witaj Świecie"
?>
```

### 4. PHP wewnątrz HTML
To najczęstsze zastosowanie PHP.
```html
<div class="user-profile">
    <h1>Profil użytkownika: <?php echo $imie; ?></h1>
    <p>Wiek: <?php echo $wiek; ?> lat</p>
</div>
```

## Opis Kodu
- Każda instrukcja w PHP **musi** kończyć się średnikiem `;`. Jego brak to najczęstszy błąd!
- Znacznik `<?php ... ?>` mówi serwerowi: "tu jest kod do wykonania, nie wyświetlaj go jako tekst, tylko zrób to, co każę, i wstaw tu wynik".

## Debugowanie
Jeśli zrobisz błąd w PHP, strona często po prostu "znika" lub wyświetla "HTTP ERROR 500".
Aby zobaczyć błędy, upewnij się, że masz włączone raportowanie błędów w konfiguracji lub dodaj na początku pliku:
```php
error_reporting(E_ALL);
ini_set('display_errors', 1);
```

Częsty błąd:
```php
$imie = "Jan" // Brak średnika!
echo $imie;
// Parse error: syntax error, unexpected token "echo"...
```

## Twoje Zadanie (Motivation)
Jesteś właścicielem kantoru wymiany walut "Złoty Grosz". Musisz stworzyć prostą stronę, która wyświetli aktualny kurs, obliczy ile klient dostanie za określoną kwotę i ładnie to zaprezentuje. Pamiętaj, pieniądze lubią precyzję, a klienci lubią czytelne informacje!

### Polecenia do wykonania:
Stwórz plik `index.php` (uruchom go na serwerze lokalnym, np. XAMPP/WAMP w folderze `htdocs`).

1.  Na początku pliku otwórz znacznik PHP.
2.  Zadeklaruj zmienną `$waluta` z wartością "EURO".
3.  Zadeklaruj zmienną `$kurs` z wartością `4.35`.
4.  Zadeklaruj zmienną `$ile_wymieniam` z wartością `100`.
5.  Oblicz wynik mnożenia `$ile_wymieniam` * `$kurs` i zapisz w zmiennej `$wynik`.
6.  Zamknij znacznik PHP i napisz strukturę HTML (sekcja `<body>`).
7.  Wewnątrz `<body>` stwórz nagłówek `<h1>`, który wyświetli: "Kantor wymiany: [WALUTA]".
8.  Stwórz paragraf `<p>`, który wyświetli zdanie: "Za [ILE] [WALUTA] otrzymasz: [WYNIK] PLN.".
9.  **Dla chętnych:** Oblicz prowizję kantoru (np. 2% od wyniku) i odejmij ją od kwoty końcowej.

# Warunek Zaliczenia
Poprawne wyświetlenie strony HTML z dynamicznie wstawionymi wartościami obliczonymi przez PHP.
