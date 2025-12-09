# Zadanie: Prosty Formularz z Zapisem Danych do Pliku

**Cel:** Stwórz prosty formularz HTML, który po wysłaniu metodą POST, dopisze wprowadzone dane na koniec pliku tekstowego na serwerze. Po zapisie danych, strona powinna przekierować użytkownika z powrotem na siebie, ale już metodą GET, aby uniknąć problemów z odświeżaniem formularza.
nie generuj całych rozwiązań, tylko opowiedz o wykożystanych funkcjach, daj rzykłady, i rozbij na kroki
dodaj przykłady jak wykorzystać użyte funkcje, lecz w innym kontekście, by to nie był gotowy kod do wykonania

**Motywacja:** Zrozumienie, jak bezpiecznie przetwarzać dane z formularzy i zapisywać je na serwerze, jest podstawą interaktywnych aplikacji webowych. Ten projekt nauczy Cię obsługi żądań POST, manipulacji plikami na serwerze oraz techniki przekierowań, która jest kluczowa dla utrzymania czystego stanu aplikacji po operacjach zapisu. Jest to fundament dla systemów komentarzy, ksiąg gości czy prostych systemów zbierania danych.

**Elementy do stworzenia:**

1.  **Plik `index.php` (lub inny plik, który będzie obsługiwał formularz):**
    *   Ten plik będzie zawierał zarówno formularz HTML, jak i logikę PHP do jego przetwarzania.
    *   Będzie wyświetlał aktualną zawartość pliku z danymi.

2.  **Plik do przechowywania danych (np. `wiadomosci.txt`):**
    *   Utwórz prosty plik tekstowy, do którego będą dopisywane dane z formularza.
    *   Upewnij się, że serwer ma uprawnienia do zapisu do tego pliku.

**Kroki do wykonania:**

1.  **Formularz HTML:**
    *   W pliku `index.php` stwórz prosty formularz HTML zawierający pole tekstowe (np. `<textarea>`) i przycisk `submit`.
    *   Ustaw atrybut `method="POST"` dla formularza.
    *   Ustaw atrybut `action=""` lub `action="index.php"` tak, aby formularz wysyłał dane do tego samego pliku.

2.  **Obsługa żądania POST (w `index.php`):**
    *   Na początku pliku PHP, sprawdź, czy żądanie zostało wysłane metodą POST (np., `if ($_SERVER['REQUEST_METHOD'] == 'POST')`).
    *   Jeśli tak, pobierz dane z formularza (np., `$_POST['nazwa_pola']`).
    *   Dodaj do pobranych danych znacznik czasu lub datę, aby każda wiadomość była unikalna.

3.  **Zapis danych do pliku:**
    *   Otwórz plik `wiadomosci.txt` w trybie dopisywania (`'a'`).
    *   Zapisz pobrane i przetworzone dane (np., `"Data: " . date("Y-m-d H:i:s") . " - " . $wiadomosc . "\n"`) na koniec pliku.
    *   Zamknij plik.

4.  **Przekierowanie po zapisie:**
    *   Po pomyślnym zapisie danych, użyj funkcji `header("Location: index.php");` oraz `exit();` aby przekierować przeglądarkę z powrotem do strony `index.php` metodą GET. Zapobiegnie to ponownemu wysłaniu danych po odświeżeniu strony.

5.  **Wyświetlanie danych (w `index.php`):**
    *   Poniżej formularza, odczytaj całą zawartość pliku `wiadomosci.txt`.
    *   Wyświetl odczytane dane na stronie, np. w bloku `<pre>` lub w listach, aby były czytelne.

6.  **Obsługa błędów (opcjonalnie, ale zalecane):**
    *   Rozważ, co się stanie, jeśli plik `wiadomosci.txt` nie istnieje lub nie ma do niego uprawnień zapisu. Zadbaj o komunikaty dla użytkownika lub obsługę wyjątków.
    *   Oczyść dane z formularza (`htmlspecialchars`, `strip_tags`) przed zapisem do pliku, aby zapobiec potencjalnym atakom XSS przy wyświetlaniu.

# Warunkiem zaliczenia
Wymagaj, by zadania były commitowane co 1 punkt. Jeżeli jest problem z commitem, napisz przykład, jak ustawić użytkownika i emaila w konsoli Git, oraz jak zrobić commit.

# uruchomienie serwera lokalnego
dodaj informacje jak uruchomić serwer lokalny
php -S localhost:800