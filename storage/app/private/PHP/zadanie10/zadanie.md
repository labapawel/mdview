# Zadanie 10: Ciasteczka (Cookies) w PHP

## Wstęp
W świecie HTTP serwer jest "zapominalski". Nie pamięta, czy użytkownik, który właśnie wchodzi na podstronę "Kontakt", to ten sam, który przed chwilą był na "Stronie głównej". Aby rozwiązać ten problem, używamy **Cookies** (Ciasteczek). Są to małe pliki tekstowe zapisywane na komputerze użytkownika przez przeglądarkę na polecenie serwera.

W PHP obsługa ciasteczek jest bardzo prosta i pozwala nam "zapamiętać" użytkownika, np. jego preferencje, stan koszyka czy liczbę wizyt.

## Opis z Przykładami

### 1. Ustawianie ciasteczka (`setcookie`)
Aby wysłać ciasteczko, używamy funkcji `setcookie()`.
**Ważne:** Funkcja ta musi być wywołana **zanim** wyślemy jakikolwiek kod HTML (nawet spację!) do przeglądarki.

```php
<?php
// setcookie(nazwa, wartość, czas_wygasniecia);
// Ciasteczko wygaśnie za 1 godzinę (3600 sekund)
setcookie("uzytkownik", "Marek", time() + 3600);
?>
```

### 2. Odczyt ciasteczka (`$_COOKIE`)
PHP automatycznie pobiera ciasteczka wysłane przez przeglądarkę i umieszcza je w superglobalnej tablicy `$_COOKIE`.

```php
<?php
if(isset($_COOKIE["uzytkownik"])) {
    echo "Witaj ponownie, " . $_COOKIE["uzytkownik"] . "!";
} else {
    echo "Witaj nieznajomy!";
}
?>
```

### 3. Modyfikacja i usuwanie
Aby zmienić wartość, po prostu ustawiamy ciasteczko jeszcze raz z tą samą nazwą.
Aby usunąć, ustawiamy czas wygaśnięcia w przeszłości.

```php
// Usuwanie ciasteczka
setcookie("uzytkownik", "", time() - 3600);
```

## Opis Kodu i Logika Licznika
Chcemy policzyć, ile razy użytkownik odwiedził stronę.
Algorytm:
1.  Sprawdź, czy ciasteczko `licznik` istnieje (`isset`).
2.  Jeśli **TAK**: Pobierz jego wartość, zwiększ o 1 i zapisz ponownie.
3.  Jeśli **NIE**: To pierwsza wizyta. Ustaw ciasteczko `licznik` na wartość 1.

## Debugowanie
Najczęstsze problemy:
1.  **"Headers already sent"**: Próbujesz ustawić cookie po wysłaniu HTML.
    *   *Błąd:* `<html><?php setcookie(...) ?>`
    *   *Poprawnie:* `<?php setcookie(...) ?><html>`
2.  **Ciasteczko nie działa od razu**: Po ustawieniu `setcookie`, wartość w `$_COOKIE` będzie dostępna dopiero przy **następnym odświeżeniu** strony.

## Twoje Zadanie (Motivation)
Twoim zadaniem jest stworzenie "Cyfrowego Odźwiernego". Ma on witać nowych gości specjalnym komunikatem, a stałych bywalców rozpoznawać i liczyć ich wizyty. To kluczowa mechanika np. w panelach logowania czy sklepach internetowych (historia oglądanych produktów).

### Polecenia do wykonania:
Stwórz plik `index.php` (lub inny plik `.php`, który uruchomisz na serwerze lokalnym np. XAMPP).

1.  Zastosuj logikę licznika odwiedzin na samym początku pliku PHP.
2.  Pobierz aktualną ilość odwiedzin z ciasteczka (jeśli istnieje).
3.  Jeśli to **pierwsza wizyta** (ciasteczko nie istnieje):
    -   Ustaw ciasteczko `wizyty` na wartość `1`.
    -   Przygotuj zmienną z komunikatem: "Witaj! To Twoja pierwsza wizyta na naszej stronie.".
4.  Jeśli to **kolejna wizyta** (ciasteczko istnieje):
    -   Pobierz wartość, zwiększ ją o 1.
    -   Zaktualizuj ciasteczko nową wartością.
    -   Przygotuj zmienną z komunikatem: "Miło Cię widzieć ponownie! Odwiedziłeś nas już [X] razy.".
5.  W sekcji HTML (poniżej kodu PHP) wyświetl ten komunikat w ładnym nagłówku `<h1>`.
6.  Odśwież stronę kilka razy (F5), aby zobaczyć czy licznik rośnie.
7.  **Zadanie dodatkowe:** Dodaj przycisk lub link "Resetuj licznik", który po kliknięciu usunie ciasteczko (ustawi czas na przeszłość) i zacznie liczenie od nowa.

# Warunek Zaliczenia
Poprawnie działający skrypt, który rozróżnia pierwszą wizytę od kolejnych i zlicza odwiedziny.
