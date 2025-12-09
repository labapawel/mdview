# Zadanie 101: System Logowania i Bezpieczeństwo

## Wstęp
W tym zadaniu zbudujesz fundamenty bezpieczeństwa aplikacji webowych: system logowania i rejestracji. Nauczysz się, jak łączyć PHP z bazą danych MySQL, jak bezpiecznie przechowywać hasła użytkowników (nigdy jawnym tekstem!) oraz jak wykorzystać mechanizm sesji do zapamiętywania zalogowanego użytkownika pomiędzy przeładowaniami strony. To kluczowe skillsy dla każdego back-end developera.

## Cel zadania
Stworzenie prostej aplikacji z chronionym panelem, do którego dostęp mają tylko zalogowani użytkownicy.

## Wymagania techniczne
1.  **Baza danych**: Tabela `users` z kolumnami `id`, `username`, `password` (hash).
2.  **Bezpieczeństwo**: Hasła muszą być hashowane (np. funkcją `password_hash`).
3.  **Mechanizm**: Użycie zmiennej superglobalnej `$_SESSION`.

## Kroki do wykonania

### 1. Przygotowanie Bazy Danych
Stwórz bazę danych (np. `kurs_php`) i tabelę `users`.
```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```
Dodaj ręcznie jednego użytkownika testowego (pamiętaj, że hasło w bazie musi być hashem! Możesz wygenerować hash np. w PHP funkcją `password_hash('tajnehaslo', PASSWORD_DEFAULT)` i wkleić go do bazy w phpMyAdmin, lub napisać krótki skrypt rejestracji).

> [!IMPORTANT]
> **Commit 1**: Stworzenie struktury bazy danych (zapisz zapytania SQL w pliku np. `db.sql`).

### 2. Połączenie z Bazą Danych
Stwórz plik `db.php`, który będzie łączył się z Twoją bazą danych (użyj `PDO` lub `mysqli`).
```php
<?php
$host = 'localhost';
$db   = 'kurs_php';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Błąd połączenia: " . $e->getMessage());
}
?>
```

> [!IMPORTANT]
> **Commit 2**: Utworzenie pliku połączenia z bazą.

### 3. Formularz Logowania
Stwórz plik `index.php` (lub `login.php`). Powinien zawierać prosty formularz HTML z polami `login` i `password`.

```html
<form action="login.php" method="POST">
    <label>Login: <input type="text" name="login"></label>
    <label>Hasło: <input type="password" name="password"></label>
    <button type="submit">Zaloguj</button>
</form>
```

> [!IMPORTANT]
> **Commit 3**: Stworzenie formularza logowania HTML.

### 4. Logika Logowania (Weryfikacja)
W pliku obsługującym formularz (np. `login.php`):
1.  Odbierz dane z `$_POST`.
2.  Pobierz z bazy użytkownika o podanym loginie.
3.  Sprawdź poprawność hasła używając `password_verify($haslo_z_formularza, $hash_z_bazy)`.
4.  Jeśli OK:
    *   Rozpocznij sesję: `session_start()`.
    *   Zapisz ID lub login usera do sesji: `$_SESSION['user_id'] = $user['id']`.
    *   Przekieruj do panelu: `header('Location: dashboard.php')`.
5.  Jeśli BŁĄD: Wyświetl komunikat "Błędny login lub hasło".

> [!IMPORTANT]
> **Commit 4**: Implementacja logiki weryfikacji użytkownika.

### 5. Panel Użytkownika (Ochrona Zasobów)
Stwórz plik `dashboard.php`. Na samym początku tego pliku musisz sprawdzić, czy użytkownik jest zalogowany.
```php
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php'); // Brak sesji? Wypad do logowania!
    exit();
}
?>
<h1>Witaj w tajnym panelu!</h1>
<p>Jesteś zalogowany.</p>
<a href="logout.php">Wyloguj się</a>
```

> [!IMPORTANT]
> **Commit 5**: Stworzenie chronionej strony dashboard.

### 6. Wylogowanie
Stwórz `logout.php`, który niszczy sesję i przekierowuje do logowania.
```php
<?php
session_start();
session_unset();
session_destroy();
header('Location: index.php');
```

> [!IMPORTANT]
> **Commit 6**: Implementacja wylogowania.

## Git Help - Jak commitować?

Pamiętaj o regularnym zapisywaniu postępów (commitowaniu).

1.  **Konfiguracja (jeśli robisz to pierwszy raz):**
    Otwórz terminal w folderze projektu i wpisz (podstawiając swoje dane):
    ```bash
    git config --global user.name "Twoje Imie"
    git config --global user.email "twoj.email@example.com"
    ```

2.  **Robienie Commita:**
    Po wykonaniu każdego punktu z listy wyżej, wpisz w terminalu:
    ```bash
    git add .
    git commit -m "Zadanie 101: Punkt X wykonany"
    ```
    (Gdzie X to numer punktu, np. "Commit 1: Stworzenie bazy").
