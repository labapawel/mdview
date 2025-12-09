# Zadanie 103: Księga Gości - Formularz i Zapis Danych

## Wstęp
Interakcja z użytkownikiem to serce internetu. W tym zadaniu stworzysz prostą "Księgę Gości". Nauczysz się odbierać dane z formularza HTML, bezpiecznie dopisywać je do pliku na serwerze i – co bardzo ważne – zapobiegać ponownemu wysłaniu formularza przy odświeżeniu strony (problem "Confirm Form Resubmission").

## Cel zadania
Stworzenie strony z formularzem, który po wysłaniu dopisuje wiadomość do pliku `wiadomosci.txt` i wyświetla listę wszystkich wpisów.

## Wymagania techniczne
1.  **Metoda przesyłania**: `POST`.
2.  **Zapis**: Tryb `append` (dopisywanie na koniec pliku).
3.  **Wzorzec PRG**: Post-Redirect-Get (przekierowanie po zapisie).

## Uruchomienie Serwera
Aby przetestować to zadanie, najlepiej uruchomić wbudowany serwer PHP w folderze z plikami:
```bash
php -S localhost:800
```
Następnie otwórz w przeglądarce: `http://localhost:800`.
*Wybrano port 800, upewnij się, że masz uprawnienia administratora, jeśli porty poniżej 1024 są zablokowane.*

## Kroki do wykonania

### 1. Przygotowanie Pliku Danych
Stwórz pusty plik `wiadomosci.txt` w tym samym folderze. Upewnij się, że serwer będzie mógł do niego pisać.

> [!IMPORTANT]
> **Commit 1**: Utworzenie pliku wiadomosci.txt.

### 2. Formularz HTML (index.php)
Stwórz plik `index.php`. Zbuduj w nim standardową strukturę HTML.
Stwórz formularz (`<form>`), który spełnia następujące warunki:
*   Wysyła dane do tego samego pliku.
*   Używa metody `POST`.
*   Zawiera pole tekstowe (pamiętaj o atrybucie `name`, np. `name="tresc"`).
*   Zawiera przycisk do wysyłania.

> [!IMPORTANT]
> **Commit 2**: Stworzenie formularza HTML.

### 3. Obsługa POST i Zapis
Na samym początku pliku `index.php` (przed `<!DOCTYPE html>`) otwórz znacznik PHP. Musisz zaprogramować logikę odbioru danych.

**Wykorzystane Funkcje (Przykłady w innym kontekście):**

1.  **Sprawdzanie metody żądania**:
    *   *Przykład:* Sprawdzamy, czy ktoś chce usunąć dane metodą DELETE:
    ```php
    if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
        echo "Usuwanie...";
    }
    ```
    *   *W zadaniu:* Sprawdź, czy metoda to `'POST'`.

2.  **Odbieranie danych**:
    *   *Przykład:* Pobranie wieku z formularza:
    ```php
    $wiek = $_POST['wiek_uzytkownika'];
    ```

3.  **Dopisywanie do pliku**:
    *   *Przykład:* Zapisywanie logów systemowych (kto i kiedy się logował):
    ```php
    $log = "Login użytkownika o: " . date("H:i") . "\n";
    file_put_contents('system.log', $log, FILE_APPEND);
    ```
    *   *W zadaniu:* Zapisz zmienną z treścią wiadomości do pliku `wiadomosci.txt` (użyj `FILE_APPEND`).

4.  **Przekierowanie (Redirect)**:
    *   *Przykład:* Przekierowanie niepowołanego użytkownika do strony logowania:
    ```php
    header("Location: login.php");
    exit();
    ```
    *   *W zadaniu:* Przekieruj użytkownika do `index.php` po udanym zapisie.

> [!IMPORTANT]
> **Commit 3**: Obsługa formularza i zapis do pliku.

### 4. Wyświetlanie Wiadomości
Pod formularzem w sekcji HTML, napisz kod PHP, który wyświetli zawartość pliku.

**Wykorzystane Funkcje (Przykłady w innym kontekście):**

1.  **Odczyt całej zawartości pliku**:
    *   *Przykład:* Wczytanie konfiguracji ze pliku tekstowego:
    ```php
    $config_data = file_get_contents('settings.conf');
    ```

2.  **Sprawdzanie istnienia pliku**:
    *   *Przykład:* Sprawdzenie czy użytkownik ma awatar:
    ```php
    if (file_exists('avatar.jpg')) {
        echo "Mamy awatar!";
    }
    ```

> [!IMPORTANT]
> **Commit 4**: Wyświetlenie zapisanych wiadomości.

### 5. Stylowanie (Opcjonalnie)
Dodaj trochę CSS, aby to wyglądało jak prawdziwa księga gości.

> [!IMPORTANT]
> **Commit 5**: Dodanie stylów CSS.

## Git Help - Jak commitować?

Pamiętaj o regularnym zapisywaniu postępów.

1.  **Konfiguracja (tylko dla tego projektu):**
    W terminalu wpisz:
    ```bash
    git config user.name "Twoje Imie"
    git config user.email "twoj.email@example.com"
    ```

2.  **Robienie Commita:**
    Po każdym kroku:
    ```bash
    git add .
    git commit -m "Zadanie 103: Punkt X wykonany"
    ```
