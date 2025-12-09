# Zadanie: Tworzenie i Wykorzystanie Funkcji Matematycznych w PHP

**Cel:** Stwórz zestaw funkcji PHP do wykonywania podstawowych operacji matematycznych, a następnie wyświetl wyniki ich działania na stronie WWW.

**Motywacja:** Zrozumienie, jak definiować i wywoływać funkcje w PHP, przekazywać do nich argumenty oraz zwracać wartości, jest kluczowe dla pisania modularnego i reużywalnego kodu. Ten projekt nauczy Cię również, jak dynamicznie generować treści HTML na podstawie wyników funkcji, co jest podstawą interaktywnych aplikacji webowych.

**Elementy do stworzenia:**

1.  **Plik `index.php` (lub inny plik, który będzie zawierał definicje funkcji i logikę wyświetlania):**
    *   Ten plik będzie zawierał zarówno definicje funkcji PHP, jak i kod HTML do prezentacji wyników.

**Kroki do wykonania:**

1.  **Definicja funkcji matematycznych:**
    *   **Funkcja `dodaj($a, $b)`:** Zdefiniuj funkcję, która przyjmuje dwie liczby jako argumenty i zwraca ich sumę.
        *   _Opowiedz o składni definiowania funkcji w PHP (`function nazwaFunkcji(argumenty) { ... }`) i o tym, jak zwracać wartość (`return`)._
        *   _Przykład użycia `return` w innym kontekście: `function czyParzysta($liczba) { return $liczba % 2 == 0; }`_
    *   **Funkcja `odejmij($a, $b)`:** Zdefiniuj funkcję, która przyjmuje dwie liczby i zwraca ich różnicę.
    *   **Funkcja `pomnoz($a, $b)`:** Zdefiniuj funkcję, która przyjmuje dwie liczby i zwraca ich iloczyn.
    *   **Funkcja `podziel($a, $b)`:** Zdefiniuj funkcję, która przyjmuje dwie liczby i zwraca ich iloraz.
        *   _W tej funkcji dodaj warunek sprawdzający, czy dzielnik (`$b`) nie jest zerem. Jeśli jest, funkcja powinna zwrócić specjalną wartość (np. `null` lub `false`) lub komunikat o błędzie, zamiast próbować dzielić przez zero._
        *   _Opowiedz o instrukcjach warunkowych (`if/else`) w PHP. Przykład: `if ($wiek < 18) { echo "Niepełnoletni"; } else { echo "Pełnoletni"; }`_

2.  **Wywołanie funkcji i wyświetlenie wyników na stronie WWW:**
    *   W pliku `index.php`, poza definicjami funkcji, wywołaj każdą z utworzonych funkcji z różnymi zestawami argumentów (np. `dodaj(10, 5)`, `odejmij(20, 7)`, `pomnoz(4, 6)`, `podziel(10, 2)` oraz `podziel(8, 0)`).
    *   Wyświetl wyniki tych operacji na stronie WWW, używając prostego HTML do ich sformatowania (np. w paragrafach `<p>` lub listach `<ul>`).
    *   _Opowiedz o tym, jak wstawiać zmienne i wyniki funkcji do kodu HTML w PHP (`echo $zmienna;` lub `<?= $zmienna ?>`)._
    *   _Przykład użycia `echo` do wyświetlania tekstu: `echo "Witaj, świecie!";`_

3.  **Obsługa wyników funkcji `podziel`:**
    *   Po wywołaniu funkcji `podziel`, sprawdź zwróconą wartość. Jeśli funkcja zwróciła wartość wskazującą na błąd (np. `null` lub `false`), wyświetl odpowiedni komunikat dla użytkownika (np. "Błąd: Nie można dzielić przez zero."). W przeciwnym razie wyświetl wynik dzielenia.

**Warunkiem zaliczenia:**
Wymagaj, by zadania były commitowane co 1 punkt. Jeżeli jest problem z commitem, napisz przykład, jak ustawić użytkownika i emaila w konsoli Git, oraz jak zrobić commit.

**Uruchomienie serwera lokalnego:**
dodaj informacje jak uruchomić serwer lokalny
php -S localhost:8000