# Zadanie 1: Wprowadzenie do gita



### 2. Podstawowe operacje na branchach

Po zainstalowaniu Git, możesz zacząć korzystać z jego funkcji, w tym z zarządzania branchami. Brancze pozwalają na równoległą pracę nad różnymi funkcjami lub poprawkami.

*   **Wyświetlanie branchy:**
    ```bash
    git branch
    ```
*   **Tworzenie nowego brancha:**
    ```bash
    git branch nowa-funkcja
    ```
*   **Przełączanie się na inny branch:**
    ```bash
    git checkout nowa-funkcja
    ```
*   **Tworzenie i przełączanie (skrót):**
    ```bash
    git checkout -b inna-funkcja
    ```
*   **Łączenie branchy (merge):**
    Najpierw przełącz się na branch docelowy (np. `main` lub `master`), a następnie połącz z nim swój branch.
    ```bash
    git checkout main
    git merge nowa-funkcja
    ```
*   **Usuwanie brancha:**
    ```bash
    git branch -d nowa-funkcja
    ```
    ```
*   **Linux (Fedora):**
    ```bash
    sudo dnf install git
    ```

Po instalacji możesz sprawdzić wersję Git, aby upewnić się, że instalacja przebiegła pomyślnie:
```bash
git --version
```

### 2. Konfiguracja użytkownika i adresu e-mail

Zanim zaczniesz tworzyć commity, musisz skonfigurować swoją nazwę użytkownika i adres e-mail. Te informacje będą widoczne w historii commitów.

```bash
git config --global user.name "Twoje Imię i Nazwisko"
git config --global user.email "twoj.email@example.com"
```
Opcja `--global` oznacza, że te ustawienia będą obowiązywać dla wszystkich twoich repozytoriów na tym komputerze. Jeśli chcesz ustawić je tylko dla konkretnego repozytorium, pomiń `--global` i wykonaj te komendy w katalogu repozytorium.

### 3. Tworzenie nowego repozytorium Git

Istnieją dwie główne metody tworzenia repozytorium:

#### a) Inicjalizacja nowego repozytorium w istniejącym katalogu

Jeśli masz już katalog z plikami projektu, możesz go przekształcić w repozytorium Git. Przejdź do tego katalogu w terminalu i wykonaj:

```bash
cd /sciezka/do/twojego/projektu
git init
```
Spowoduje to utworzenie ukrytego katalogu `.git`, który będzie przechowywał całą historię i konfigurację repozytorium.

#### b) Klonowanie istniejącego repozytorium

Jeśli chcesz pracować nad projektem, który już istnieje na zdalnym serwerze (np. GitHub, GitLab, Bitbucket), możesz go sklonować:

```bash
git clone <adres_URL_repozytorium>
```
Na przykład:
```bash
git clone https://github.com/nazwa_uzytkownika/nazwa_repozytorium.git
```
Spowoduje to pobranie całej historii projektu i utworzenie lokalnej kopii repozytorium.

### 4. Podstawowe operacje w repozytorium

Po utworzeniu lub sklonowaniu repozytorium możesz zacząć dodawać pliki, śledzić zmiany i tworzyć commity.

*   **Sprawdzenie statusu:**
    ```bash
    git status
    ```
    Pokazuje, które pliki zostały zmienione, które są gotowe do commita (staged) i które nie są śledzone.

*   **Dodawanie plików do śledzenia (staging):**
    ```bash
    git add nazwa_pliku.txt
    ```
    Aby dodać wszystkie zmienione pliki:
    ```bash
    git add .
    ```

*   **Tworzenie commita (zapisywanie zmian):**
    ```bash
    git commit -m "Opis zmian w tym commicie"
    ```
    Wiadomość commita powinna być krótka i opisowa.

*   **Przeglądanie historii commitów:**
    ```bash
    git log
    ```

### 5. Operacje na branchach

Branche (gałęzie) pozwalają na rozwijanie nowych funkcjonalności lub naprawianie błędów w izolacji od głównej linii rozwoju projektu.

*   **Wyświetlanie istniejących branchy:**
    ```bash
    git branch
    ```
    Pokazuje listę lokalnych branchy. Gwiazdka (*) wskazuje aktualnie aktywny branch.

*   **Tworzenie nowego brancha:**
    ```bash
    git branch nazwa_nowego_brancha
    ```
    Tworzy nowy branch, ale nie przełącza się na niego.

*   **Przełączanie się na inny branch:**
    ```bash
    git checkout nazwa_brancha
    ```
    Lub (od Git 2.23):
    ```bash
    git switch nazwa_brancha
    ```

*   **Tworzenie i przełączanie się na nowy branch (w jednej komendzie):**
    ```bash
    git checkout -b nazwa_nowego_brancha
    ```
    Lub (od Git 2.23):
    ```bash
    git switch -c nazwa_nowego_brancha
    ```

*   **Łączenie branchy (merge):**
    Przejdź na branch, do którego chcesz włączyć zmiany (np. `main` lub `master`), a następnie wykonaj:
    ```bash
    git checkout main
    git merge nazwa_brancha_do_polaczenia
    ```
    Spowoduje to włączenie zmian z `nazwa_brancha_do_polaczenia` do `main`.

*   **Usuwanie brancha:**
    ```bash
    git branch -d nazwa_brancha
    ```
    Opcja `-d` (delete) usunie branch tylko wtedy, gdy został już w pełni połączony. Aby wymusić usunięcie niepołączonego brancha, użyj `-D`.
