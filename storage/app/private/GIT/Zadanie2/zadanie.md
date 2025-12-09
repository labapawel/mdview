# Zadanie 2: Praca na Gałęziach (Branches)

## Wstęp
Wyobraź sobie, że piszesz książkę. Twoja główna wersja to `main`. Nagle wpadasz na pomysł alternatywnego zakończenia, ale nie chcesz niszczyć tego, co już masz. Kopiujesz więc plik i piszesz w kopii.
W Gicie nazywa się to **Branch** (Gałąź). Możesz pracować równolegle nad kilkoma wersjami projektu, a potem łączyć je w całość.

## Cel Zadania
Nauczysz się zarządzać cyklem życia gałęzi: tworzenie -> edycja -> scalanie -> usuwanie.

## Część 1: Tworzenie i Przełączanie

1.  Upewnij się, że jesteś w swoim repozytorium z poprzedniego zadania.
2.  Sprawdź, na jakim jesteś branchu:
    ```bash
    git branch
    ```
    *Gwiazdka (*) pokazuje aktywną gałąź (zazwyczaj `master` lub `main`).*
3.  Stwórz nową gałąź o nazwie `nowa-funkcja`:
    ```bash
    git branch nowa-funkcja
    ```
4.  Przełącz się na nią:
    ```bash
    git checkout nowa-funkcja
    ```
    *(Od teraz wszystkie Twoje zmiany będą zapisywane TYLKO na tej gałęzi).*

## Część 2: Praca w Izolacji

1.  Stwórz nowy plik `funkcja.txt` i wpisz tam cokolwiek.
2.  Zrób commit:
    ```bash
    git add .
    git commit -m "Dodanie nowej funkcji"
    ```
3.  Wróć teraz na główną gałąź:
    ```bash
    git checkout master
    ```
    *(Wpisz `master` lub `main`, zależnie co masz).*
4.  Spójrz do folderu. Plik `funkcja.txt` zniknął! To magia Gita - przywrócił stan projektu z głównej gałęzi, gdzie tego pliku jeszcze nie ma.

## Część 3: Scalanie (Merge)

Skoro funkcja jest gotowa, połączmy ją z głównym projektem.

1.  Będąc na głównej gałęzi (`master`/`main`), wpisz:
    ```bash
    git merge nowa-funkcja
    ```
2.  Spójrz do folderu. Plik `funkcja.txt` pojawił się z powrotem. Zmiany z `nowa-funkcja` zostały wchłonięte.

## Część 4: Sprzątanie

Gałąź `nowa-funkcja` nie jest już potrzebna (została scalona). Usuń ją, by zachować porządek.

```bash
git branch -d nowa-funkcja
```

---
**Podsumowanie komend:**
*   `git branch` - lista gałęzi
*   `git checkout -b nazwa` - stwórz i przełącz (skrót)
*   `git merge nazwa` - scal gałąź `nazwa` z obecną
*   `git branch -d nazwa` - usuń gałąź
