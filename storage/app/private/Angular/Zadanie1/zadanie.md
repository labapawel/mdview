# Zadanie 1: Wprowadzenie do Angulara

## Wstęp
Angular to potężny framework od Google do tworzenia dynamicznych aplikacji internetowych (SPA - Single Page Application). W tym zadaniu przygotujesz środowisko pracy i poznasz kluczowe pojęcia teoretyczne niezbędne do dalszej nauki.

## Część Teoretyczna

### 1. CSS vs SCSS
Standardowy **CSS** (Cascading Style Sheets) to język stylów, który wszyscy znamy. **SCSS** (Sassy CSS) to preprocesor, który rozszerza możliwości CSS.
*   **Zagnieżdżanie (Nesting):** W SCSS możesz pisać style wewnątrz stylów, co lepiej oddaje strukturę HTML.
*   **Zmienne:** Możesz zdefiniować np. `$primary-color: #333;` i używać go wszędzie.
*   **Mixins:** Funkcje generujące fragmenty CSS.
Ostatecznie przeglądarka i tak czyta CSS – SCSS jest kompilowany do CSS przed uruchomieniem.

### 2. Client-Side Rendering (CSR) vs Server-Side Rendering (SSR)
*   **CSR (Angular domyślny):** Przeglądarka pobiera pusty plik HTML i duży plik JavaScript. To JavaScript "buduje" całą stronę na oczach użytkownika.
    *   *Zalety:* Szybka interakcja po załadowaniu.
    *   *Wady:* Wolniejszy pierwszy start, trudniejsze (dawniej) indeksowanie przez Google.
*   **SSR (Angular Universal/SSR):** Serwer generuje gotowy HTML i wysyła go do przeglądarki.
    *   *Zalety:* Szybsze wyświetlenie treści, lepsze SEO.
    *   *Wady:* Większe obciążenie serwera.

### 3. Elementy Angulara
*   **Component (Komponent):** Podstawowa cegiełka. Składa się z widoku (HTML), stylów (SCSS) i logiki (TypeScript). Np. `HeaderComponent`, `FooterComponent`.
*   **Service (Serwis):** Klasa zawierająca logikę biznesową i komunikację z serwerem (API). Służy do współdzielenia danych między komponentami.
*   **Module (Moduł):** Kontener grupujący powiązane komponenty, serwisy i rury. Główny to `AppModule`. (W nowym Angularze >17 często używa się "Standalone Components" bez modułów).
*   **Pipe (Rura):** Narzędzie do formatowania danych w widoku, np. zamiana daty na czytelny format (`{{ data | date }}`) lub wielkie litery (`{{ text | uppercase }}`).
*   **Injector (Wstrzykiwacz):** Mechanizm Dependency Injection (DI). Angular sam "wstrzykuje" potrzebne serwisy do komponentów, nie musisz tworzyć ich ręcznie przez `new Service()`.
*   **Router:** Zarządza nawigacją. Podmienia komponenty w widoku w zależności od adresu URL, bez przeładowania strony.

## Część Praktyczna: Instalacja

### Krok 1: Instalacja Node.js
Upewnij się, że masz zainstalowane Node.js (wersja LTS). Sprawdź w terminalu:
```bash
node -v
npm -v
```

> [!IMPORTANT]
> **Commit 1**: Sprawdzenie wersji Node.js (zrób zrzut ekranu lub po prostu commituj pusty plik tekstowy `env.txt` z wersją).

### Krok 2: Instalacja Angular CLI
Zainstaluj narzędzie wiersza poleceń Angulara globalnie:
```bash
npm install -g @angular/cli
```

### Krok 3: Nowy Projekt
Stwórz nowy projekt w folderze zadania.
```bash
ng new zadanie1 --style=scss --ssr=false
```
*   `--style=scss`: Wybieramy SCSS zamiast CSS.
*   `--ssr=false`: Na start prostszy CSR.

Wejdź do folderu:
```bash
cd zadanie1
```

> [!IMPORTANT]
> **Commit 2**: Inicjalizacja pustego projektu Angular.

### Krok 4: Uruchomienie
Uruchom serwer deweloperski:
```bash
ng serve
```
Otwórz przeglądarkę na `http://localhost:4200`. Powinieneś zobaczyć stronę startową Angulara.

> [!IMPORTANT]
> **Commit 3**: Uruchomienie projektu (potwierdzenie działania).

## Git Help

```bash
git config user.name "Twoje Imie"
git config user.email "twoj.email@example.com"
```

Po każdym kroku:
```bash
git add .
git commit -m "Angular Zadanie 1: Punkt X wykonany"
```
