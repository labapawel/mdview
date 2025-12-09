# Zadanie 4: Wyróżnianie Aktywnej Podstrony

## Wstęp
Dobra nawigacja to taka, która mówi użytkownikowi: "Jesteś tutaj". W tradycyjnych stronach dodawaliśmy ręcznie klasę `active` do odpowiedniego linku. W Angularze robi to za nas dyrektywa `routerLinkActive`.

## Cel zadania
Stworzenie menu nawigacyjnego (Dashboard), które podświetla się w zależności od wybranej podstrony.

## Część Teoretyczna
*   **routerLinkActive:** Dyrektywa Angulara, którą nakładamy na element z `routerLink`. Jeśli adres URL pasuje do tego linku, Angular automatycznie doda do elementu podaną klasę CSS (np. `active` lub `selected`).
*   **Problem Strony Głównej:** Główny adres `/` jest "prefixem" każdego innego adresu (np. `/kontakt` też zaczyna się od `/`). Dlatego link do strony głównej często świeci się cały czas.
*   **routerLinkActiveOptions:** Obiekt konfiguracyjny, którym możemy wymusić "dokładne dopasowanie" (`exact: true`), aby rozwiązać powyższy problem.

## Część Praktyczna

### Krok 1: Przygotowanie Podstron
Wygeneruj 3 komponenty, aby mieć gdzie klikać:
*   `dashboard` (jako strona główna)
*   `ustawienia`
*   `profil`

Skonfiguruj Routing w `app.routes.ts`:
*   `''` -> Dashboard
*   `'settings'` -> Ustawienia
*   `'profile'` -> Profil

> [!IMPORTANT]
> **Commit 1**: Komponenty i konfiguracja routingu.

### Krok 2: Menu i Style
W `app.component.html` stwórz proste menu.
Dodaj też w `app.component.scss` styl dla klasy `.aktywny`.
```css
.aktywny {
    font-weight: bold;
    color: red;
    text-decoration: underline;
}
```

> [!IMPORTANT]
> **Commit 2**: Przygotowanie HTML i CSS menu.

### Krok 3: Podpinanie Klasy (routerLinkActive)
Zmodyfikuj linki w menu, dodając do nich `routerLinkActive`.
Chcemy, aby Angular dodawał klasę `aktywny`, gdy link jest wybrany.

**Przykład:**
```html
<a routerLink="/profil" routerLinkActive="aktywny">Profil</a>
```
Zrób to dla wszystkich linków. Przetestuj. Zauważysz pewien błąd przy stronie głównej.

> [!IMPORTANT]
> **Commit 3**: Zastosowanie routerLinkActive.

### Krok 4: Naprawa Strony Głównej
Link do strony głównej (`/`) prawdopodobnie świeci się zawsze. Dzieje się tak, ponieważ każdy adres zawiera w sobie `/` (pusty ciąg znaków na początku).
Musimy powiedzieć Angularowi: "Podświetl ten link TYLKO wtedy, gdy adres jest DOKŁADNIE pusty, a nie gdy tylko się od niego zaczyna".

Użyj `[routerLinkActiveOptions]`:
```html
<a routerLink="/" 
   routerLinkActive="aktywny" 
   [routerLinkActiveOptions]="{exact: true}">
   Dashboard
</a>
```
Sprawdź teraz. Powinno działać idealnie.

> [!IMPORTANT]
> **Commit 4**: Naprawa linku głównego (exact: true).

## Git Help

```bash
git config user.name "Twoje Imie"
git config user.email "twoj.email@example.com"
```

Po każdym kroku:
```bash
git add .
git commit -m "Angular Zadanie 4: Punkt X wykonany"
```
