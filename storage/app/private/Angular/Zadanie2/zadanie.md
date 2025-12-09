# Zadanie 2: Twój Pierwszy Komponent

## Wstęp - Co to jest Komponent?
Wyobraź sobie klocki LEGO. Cały zamek to Aplikacja, a pojedynczy klocek (lub okno, drzwi) to Komponent. W Angularze wszystko jest komponentem.
Komponent to **widok** (HTML + SCSS) połączony z **logiką** (TypeScript). Dzięki temu możesz stworzyć np. przycisk raz i używać go w 100 miejscach.

Głównym komponentem strony jest zawsze `AppComponent` (plik `app.component.ts`), ale pisanie wszystkiego w jednym pliku to zły pomysł. Dlatego dzielimy aplikację na mniejsze części.

## Cel zadania
Stworzenie komponentu `Wizytowka`, który wyświetla informacje o osobie (Imię, Nazwisko, Stanowisko) i użycie go trzykrotnie na stronie głównej.

## Część Praktyczna

### Krok 1: Generowanie Komponentu
Nie musisz tworzyć plików ręcznie. CLI zrobi to za Ciebie.
W terminalu (w folderze projektu) wpisz:
```bash
ng generate component wizytowka
```
(*Skrót:* `ng g c wizytowka`)

Angular utworzy folder `wizytowka` z 4 plikami:
*   `.html` (widok)
*   `.scss` (style)
*   `.ts` (logika)
*   `.spec.ts` (testy - na razie ignoruj)

> [!IMPORTANT]
> **Commit 1**: Wygenerowanie komponentu wizytowka.

### Krok 2: Edycja Komponentu
Otwórz plik `wizytowka/wizytowka.component.html`.
Zaprojektuj wygląd wizytówki. Użyj standardowych tagów HTML (`div`, `h3`, `p`), aby wpisać tam przykładowe dane:
*   Imię i Nazwisko
*   Zawód (np. Junior Developer)
*   Krótki opis

Następnie otwórz `wizytowka/wizytowka.component.scss` i dodaj style, aby wyglądało to ładnie (np. obramowanie, cień, padding).

*(Nie kopiuj gotowca - stwórz własny design!)*

> [!IMPORTANT]
> **Commit 2**: Uzupełnienie HTML i SCSS wizytówki.

### Krok 3: Wyświetlenie Komponentu
Jeśli teraz uruchomisz aplikację (`ng serve`), nic nowego nie zobaczysz. Dlaczego? Bo stworzyłeś klocek, ale nie wpiąłeś go do budowli.

1.  Otwórz plik sterujący wizytówką: `wizytowka/wizytowka.component.ts`.
2.  Znajdź pole `selector: 'app-wizytowka'` (lub podobne). To jest nazwa Twojego nowego tagu HTML!
3.  Otwórz główny widok aplikacji: `app.component.html`.
4.  Wstaw tam swój nowy tag:
    ```html
    <h1>Moja Firma</h1>
    <app-wizytowka></app-wizytowka>
    ```

Sprawdź w przeglądarce, czy wizytówka się pojawiła.

> [!IMPORTANT]
> **Commit 3**: Użycie komponentu w App Component.

### Krok 4: Reużywalność (Challenge)
Skopiuj linię `<app-wizytowka></app-wizytowka>` jeszcze dwa razy w `app.component.html`.
Zobacz, jak łatwo powielać elementy. (W przyszłości nauczymy się, jak sprawić, by każda z nich wyświetlała inne dane, ale na razie ciesz się trzema identycznymi klonami).

> [!IMPORTANT]
> **Commit 4**: Trzykrotne użycie wizytówki.

## Git Help

```bash
git config user.name "Twoje Imie"
git config user.email "twoj.email@example.com"
```

Po każdym kroku:
```bash
git add .
git commit -m "Angular Zadanie 2: Punkt X wykonany"
```
