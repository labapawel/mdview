# Zadanie 1: Wprowadzenie do Git

## Cel Zadania
Twoim celem jest przygotowanie środowiska pracy oraz wykonanie pierwszego "zapisu" (commita) w systemie kontroli wersji.

## Część 1: Instalacja

Sprawdź, czy masz zainstalowanego Gita.
W terminalu wpisz:
```bash
git --version
```

Jeśli nie masz Gita, zainstaluj go zgodnie z Twoim systemem:

*   **Windows:**
    Pobierz instalator z [git-scm.com/download/win](https://git-scm.com/download/win) i klikaj "Next" (domyślne ustawienia są OK).
*   **macOS:**
    W terminalu wpisz:
    ```bash
    brew install git
    ```
    (Lub pobierz instalator ze strony git-scm.com).
*   **Linux (Ubuntu/Debian):**
    ```bash
    sudo apt update
    sudo apt install git
    ```
*   **Linux (Fedora):**
    ```bash
    sudo dnf install git
    ```

## Część 2: Konfiguracja

Zanim cokolwiek zrobisz, musisz się przedstawić. Git musi wiedzieć, kto wprowadza zmiany.

Wpisz w terminalu (podstawiając swoje dane):
```bash
git config --global user.name "Jan Kowalski"
git config --global user.email "jan@example.com"
```
*Opcja `--global` sprawi, że te ustawienia będą domyślne dla wszystkich Twoich projektów na tym komputerze.*

## Część 3: Tworzenie Repozytorium (Init)

Stwórzmy nowy "projekt", w którym będziemy ćwiczyć.

1.  Stwórz nowy folder i wejdź do niego:
    ```bash
    mkdir moj-pierwszy-projekt
    cd moj-pierwszy-projekt
    ```
2.  Zainicjuj Gita:
    ```bash
    git init
    ```
    *Komenda ta tworzy ukryty folder `.git`, w którym Git trzyma całą swoją bazę danych.*

## Część 4: Twój Pierwszy Commit (Add & Commit)

W Gicie zapisywanie zmian jest dwuetapowe.
1.  **Add (Staging):** Wybierasz pliki, które chcesz zapisać (wrzucasz je na "scenę").
2.  **Commit:** Robisz "zdjęcie" (snapshot) tych plików i zapisujesz w historii.

Wykonaj następujące kroki:

1.  Stwórz plik tekstowy:
    ```bash
    echo "Witaj Gicie" > powitanie.txt
    ```
2.  Sprawdź status (zobaczysz plik na czerwono - "Untracked"):
    ```bash
    git status
    ```
3.  Dodaj plik do śledzenia (wrzuć na scenę):
    ```bash
    git add powitanie.txt
    ```
4.  Zrób commit (zapisz zmiany):
    ```bash
    git commit -m "Mój pierwszy commit: dodanie powitania"
    ```
    *Flaga `-m` pozwala wpisać wiadomość od razu w cudzysłowie.*

## Część 5: Historia (Log)

Sprawdź, czy Twój commit został zapisany.
```bash
git log
```
Powinieneś zobaczyć wpis ze swoim autorem, datą i treścią wiadomości.

---
**Gratulacje!** Właśnie stałeś się użytkownikiem systemu kontroli wersji.
