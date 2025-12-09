# Zadanie 101.1: System Logowania z Rolami

## Wstęp
Każda poważna aplikacja potrzebuje wiedzieć, KTO z niej korzysta. W tym zadaniu zbudujesz fundamenty bezpieczeństwa: system logowania oparty o bazę danych.
Nauczysz się, dlaczego **nigdy** nie wolno trzymać haseł jawnym tekstem i jak używać ról (np. Administrator może więcej niż Zwykły Użytkownik).

## Cel Zadania
Stworzenie formularza logowania, weryfikacja danych z bazą SQLite/MySQL, obsługa sesji oraz wyświetlanie różnej treści w zależności od roli użytkownika (`admin`/`user`).

## Uruchomienie Serwera
```bash
php -S localhost:8000
```

## Kroki do wykonania

### 1. Baza Danych (Setup)
Musimy gdzieś trzymać użytkowników. Stwórz tabelę `users`.
Jeśli używasz SQLite (najprościej), stwórz plik `setup.php` i uruchom go raz.

**Struktura tabeli:**
*   `id` (INTEGER AUTO_INCREMENT PRIMARY KEY)
*   `username` (TEXT/VARCHAR)
*   `password` (TEXT/VARCHAR - tu będzie hash!)
*   `role` (TEXT/VARCHAR - np. 'admin', 'user')

> [!IMPORTANT]
> **Commit 1**: Skrypt tworzący tabelę użytkowników.

### 2. Rejestracja (Haszowanie)
Nie możemy wpisać haseł "z palca" do bazy, bo muszą być zahaszowane.
Stwórz prosty skrypt `register.php` (lub zrób to w `setup.php`), który doda dwóch użytkowników:
1.  Admina (hasło: `tajne`, rola: `admin`)
2.  Usera (hasło: `user123`, rola: `user`)

**Wskazówka:**
Użyj funkcji `password_hash($haslo, PASSWORD_DEFAULT)` do wygenerowania bezpiecznego ciągu znaków.

```php
// Przykład użycia:
$hash = password_hash("tajnehaslo", PASSWORD_DEFAULT);
// $hash wygląda np. tak: $2y$10$.vGA1O9wmRjrwAVXD98...
```

> [!IMPORTANT]
> **Commit 2**: Dodanie użytkowników z zahaszowanymi hasłami.

### 3. Formularz Logowania
Stwórz `index.php` (lub `login.php`). Powinien zawierać prosty formularz HTML (metoda POST) z polami `login` i `password`.

> [!IMPORTANT]
> **Commit 3**: Widok formularza logowania.

### 4. Weryfikacja Logowania
W pliku odbierającym dane (np. `login.php`):
1.  Połącz się z bazą danych (użyj PDO).
2.  Znajdź użytkownika po `username`.
3.  Jeśli użytkownik istnieje, sprawdź hasło funkcją `password_verify($wpisane_haslo, $hash_z_bazy)`.
4.  Jeśli hasło OK -> Rozpocznij sesję (`session_start()`) i zapisz w niej dane (np. `$_SESSION['user_id']`, `$_SESSION['role']`).

**Wskazówka (PDO):**
```php
$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$login]);
$user = $stmt->fetch();
```

> [!IMPORTANT]
> **Commit 4**: Logika logowania i start sesji.

### 5. Strona z Uprawnieniami (Panel)
Stwórz plik `panel.php` (lub obsłuż to w `index.php` po zalogowaniu).
Na samej górze zawsze dawaj `session_start()`.

**Logika:**
*   Jeśli w sesji nie ma usera -> przekieruj do logowania (`header('Location: login.php')`).
*   Wyświetl powitanie: "Cześć, [login]!".
*   **Sprawdź rolę:**
    *   Jeśli `$_SESSION['role'] == 'admin'`, wyświetl tajny przycisk lub napis "Jesteś Szefem".
    *   W przeciwnym wypadku wyświetl standardową treść.

> [!IMPORTANT]
> **Commit 5**: Panel dostępny tylko po zalogowaniu z obsługą ról.

### 6. Wylogowanie
Stwórz `logout.php`. Musi:
1.  Rozpocząć sesję (by mieć do niej dostęp).
2.  Zniszczyć sesję (`session_destroy()`).
3.  Przekierować do strony logowania.

> [!IMPORTANT]
> **Commit 6**: Mechanizm wylogowania.

## Git Help

```bash
git config user.name "Twoje Imie"
git config user.email "twoj.email@example.com"
```

Po każdym kroku:
```bash
git add .
git commit -m "Zadanie 101.1: Punkt X wykonany"
```
