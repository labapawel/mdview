# role
# Zadanie: Licznik Odwiedzin Strony

**Cel:** Stwórz prosty licznik odwiedzin strony, który będzie wyświetlał, ile razy dana strona została odwiedzona. Każde odświeżenie strony powinno zwiększać wartość licznika o jeden.

**Motywacja:** Zrozumienie, jak śledzić interakcje użytkowników z Twoją stroną, jest kluczową umiejętnością w tworzeniu dynamicznych aplikacji webowych. Ten projekt pozwoli Ci praktycznie zastosować wiedzę o operacjach na plikach oraz podstawach dynamicznego generowania treści, co jest fundamentem każdej interaktywnej strony internetowej. Nauczysz się, jak przechowywać i aktualizować dane poza sesją użytkownika, co jest podstawą dla bardziej zaawansowanych funkcji, takich jak statystyki czy systemy logowania.

**Elementy do stworzenia:**

1.  **Plik `index.php` (lub inny plik strony, na której ma być licznik):**
    *   Ten plik będzie odpowiedzialny za wyświetlanie treści strony oraz licznika.
    *   Na początku pliku PHP zaimplementuj logikę do odczytu, inkrementacji i zapisu wartości licznika.

2.  **Plik do przechowywania licznika (np. `licznik.txt`):**
    *   Utwórz prosty plik tekstowy, w którym będzie przechowywana aktualna liczba odwiedzin. Na początku powinien zawierać `0`.
    *   Upewnij się, że serwer ma uprawnienia do zapisu do tego pliku.

**Kroki do wykonania:**

1.  **Odczyt wartości:** Przy każdym załadowaniu strony, odczytaj aktualną wartość licznika z pliku `licznik.txt`.
2.  **Inkrementacja:** Zwiększ odczytaną wartość o 1.
3.  **Zapis wartości:** Zapisz nową wartość z powrotem do pliku `licznik.txt`, nadpisując starą.
4.  **Wyświetlanie:** Wyświetl zaktualizowaną wartość licznika na stronie w widocznym miejscu (np. "Ta strona została odwiedzona X razy.").
5.  **Obsługa błędów (opcjonalnie, ale zalecane):** Rozważ, co się stanie, jeśli plik `licznik.txt` nie istnieje lub jest pusty. Zadbaj o to, aby licznik startował od 0 w takich przypadkach.

Zadanie budujemy system logowania do strony oparty o sesje,  uczen powinien stworzyć stronę www, którą połączy z bazą danych, w której będzie tabela user z hasłem szyfrowanym za pomocą password lub sha1, oraz zrobic formularz logowania, który będzie wysyłał dane do strony logowania, gdzie będzie sprawdzac czy login i haslo jest poprawne,
6. **dodaj css by strona ładnie wyglądała**
dodaj i podepnij plik css by strona ładnie wyglądała


dodaj opis zadania, który zmotywuje ucznia do wykonania zadania, opisz elementy strony www, które powinien stworzyć uczennik, oraz jak powinien wyglądać strona www.

# Warunkiem zaliczenia
wymagaj by zadania były commitowane co 1 punkt, jeżeli jest problem z commitem napisz przykłąd jak ustawić usera i emaila w konsoli git, oraz jak zrobic commit
