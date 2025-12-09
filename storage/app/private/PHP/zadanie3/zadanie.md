# Zadanie 3: Funkcje Matematyczne

## Wstęp
Funkcje to podstawowe klocki, z których budujemy programy. Pozwalają zamknąć kawałek logiki w nazwę i używać go wielokrotnie. W tym zadaniu stworzysz "kalkulator" oparty o funkcje, ucząc się przy tym, jak przekazywać dane do funkcji (argumenty) i jak odbierać wyniki (return).

## Cel zadania
Stworzenie funkcji do czterech podstawowych działań matematycznych i wyświetlenie wyników ich działania.

## Uruchomienie Serwera
```bash
php -S localhost:8000
```

## Kroki do wykonania

### 1. Definicja funkcji (index.php)
W pliku `index.php` (w sekcji PHP) zdefiniuj cztery funkcje: `dodaj`, `odejmij`, `pomnoz`, `podziel`. Każda powinna przyjmować dwa argumenty (`$a`, `$b`) i zwracać wynik działania.

**Wskazówki:**
*   **Definiowanie funkcji:**
    *   *Przykład (kontekst tekstowy):*
    ```php
    function powitanie($imie) {
        return "Cześć, " . $imie . "!";
    }
    ```
*   **Zwracanie wartości (`return`):** Funkcja nie powinna wyświetlać wyniku (`echo`), tylko go zwracać.
    *   *Przykład (zwracanie liczby):*
    ```php
    function kwadrat($liczba) {
        return $liczba * $liczba;
    }
    ```

> [!IMPORTANT]
> **Commit 1**: Definicje funkcji matematycznych.

### 2. Wywołanie i Wyświetlanie
Poniżej definicji funkcji, napisz kod, który ich użyje. Wywołaj każdą funkcję z przykładowymi liczbami.

**Wskazówki:**
*   **Wyświetlanie w HTML:**
    *   Możesz łączyć PHP z HTMLem, używając `echo`.
    ```php
    Witaj, <?php echo $imie; ?>!
    ```
    *   Możesz też używać skróconego zapisu:
    ```php
    Witaj, <?= $imie ?>!
    ```

> [!IMPORTANT]
> **Commit 2**: Wyświetlenie wyników działań.

## Git Help

```bash
git config user.name "Twoje Imie"
git config user.email "twoj.email@example.com"
```

Po każdym kroku:
```bash
git add .
git commit -m "Zadanie 3: Punkt X wykonany"
```
