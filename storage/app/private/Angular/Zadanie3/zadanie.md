# Zadanie 3: Nawigacja w Aplikacji (Routing)

## Wstęp
Angular to framework do **SPA** (Single Page Application). Oznacza to, że technicznie jest tylko jedna strona (`index.html`), ale dla użytkownika wygląda to jak wiele różnych podstron (Strona Główna, O nas, Kontakt).
Za imitowanie tego procesu odpowiada **Router**. Zamiast przeładowywać całą stronę (jak tradycyjne strony PHP/HTML), Router podmienia tylko zawartość wyznaczonego "okna".

## Cel zadania
Stworzenie prostej strony firmowej z nawigacją zawierającą dwie podstrony: "Strona Główna" i "O Nas".

## Część Teoretyczna
1.  **Routes (Ścieżki):** Lista reguł mówiąca: "jeśli w pasku adresu jest `/kontakt`, pokaż `KontaktComponent`".
2.  **Router Outlet:** "Dziura" w szablonie (tag `<router-outlet>`), w której Angular będzie wyświetlał aktualny komponent.
3.  **Router Link:** Zamiast `href="..."` używamy `routerLink="..."`. Dlaczego? Bo `href` przeładowuje stronę (zabija aplikację i uruchamia od nowa), a `routerLink` tylko każe Routerowi podmienić widok.

## Część Praktyczna

### Krok 1: Generowanie Komponentów
Potrzebujemy widoków, między którymi będziemy się przełączać. Wygeneruj dwa komponenty:
*   `home` (Strona startowa)
*   `about` (O nas)

> [!IMPORTANT]
> **Commit 1**: Wygenerowanie komponentów home i about.

### Krok 2: Konfiguracja Ścieżek
Otwórz plik `app.routes.ts`. Znajdziesz tam pustą tablicę `routes`.
Musisz zdefiniować obiekty, które łączą `path` (adres) z `component` (klasą komponentu).

**Przykład konfiguracji (nie gotowiec, dostosuj nazwy!):**
```typescript
import { KomponentA } from './sciezka/do/A';
import { KomponentB } from './sciezka/do/B';

export const routes: Routes = [
  { path: '', component: KomponentA },       // Pusty adres (Strona główna)
  { path: 'strona-b', component: KomponentB } // adres /strona-b
];
```
Zadanie: Skonfiguruj tak, aby pusty adres prowadził do `HomeComponent`, a adres `o-nas` do `AboutComponent`.

> [!IMPORTANT]
> **Commit 2**: Konfiguracja routingu w app.routes.ts.

### Krok 3: Router Outlet
Teraz aplikacja "umie" rozpoznawać adresy, ale nie wie, GDZIE wyświetlić te komponenty.
Otwórz `app.component.html`.
Usuń wszystko (lub większość) i wstaw w odpowiednim miejscu:
```html
<router-outlet></router-outlet>
```
To jest to magiczne okno. Wszystko co jest POZA nim (np. nagłówek, stopka), będzie widoczne zawsze. To co W NIM - będzie się zmieniać.

> [!IMPORTANT]
> **Commit 3**: Dodanie router-outlet.

### Krok 4: Nawigacja (Menu)
Stwórz menu nawigacyjne w `app.component.html` (nad outletem), aby użytkownik mógł klikać.
Pamiętaj: używaj `routerLink`.

**Przykład:**
```html
<nav>
  <a routerLink="/">Start</a> |
  <a routerLink="/strona-b">Idź do B</a>
</nav>
```

Uruchom aplikację i sprawdź, czy klikanie zmienia treść pod menu BEZ mrugnięcia całej strony.

> [!IMPORTANT]
> **Commit 4**: Dodanie menu nawigacyjnego.

### Krok 5: Challenge (404)
Co jeśli użytkownik wpisze w adresie `/bzdura`?
Stwórz komponent `NotFound`.
Dodaj na końcu listy `routes` specjalną ścieżkę z "dziką kartą" `**`, która wyłapuje wszystkie nieznane adresy.
```typescript
{ path: '**', component: NotFoundComponent }
```
**Ważne:** Ta reguła musi być OSTATNIA w tablicy. Angular sprawdza reguły od góry do dołu.

> [!IMPORTANT]
> **Commit 5**: Obsługa błędnych adresów (strona 404).

## Git Help

```bash
git config user.name "Twoje Imie"
git config user.email "twoj.email@example.com"
```

Po każdym kroku:
```bash
git add .
git commit -m "Angular Zadanie 3: Punkt X wykonany"
```
