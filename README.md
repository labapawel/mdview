# MDView - Przeglądarka Zadań

Aplikacja do przeglądania i zarządzania zadaniami programistycznymi w formacie Markdown. Umożliwia łatwe nawigowanie po kategoriach, wyszukiwanie oraz podgląd treści zadań.

**Live Demo:** [https://mdview.t24.ovh/](https://mdview.t24.ovh/)

## Wymagania

- PHP 8.1+
- Composer
- Node.js & NPM

## Instalacja

1. **Sklonuj repozytorium:**
   ```bash
   git clone https://github.com/labapawel/mdview.git
   cd mdview
   ```

2. **Zainstaluj zależności PHP:**
   ```bash
   composer install
   ```

3. **Skonfiguruj środowisko:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Zainstaluj zależności frontendowe i zbuduj zasoby:**
   ```bash
   npm install
   npm run build
   ```

5. **Struktura katalogów:**
   Zadania powinny znajdować się w katalogu `storage/app/private`.
   Struktura: `kategoria/nazwa-zadania/zadanie.md` (oraz `zadanie.json`).

6. **Uruchom serwer developerski (opcjonalnie):**
   ```bash
   php artisan serve
   ```

## Opis Funkcjonalności

- **Przeglądanie zadań:** Lista zadań podzielona na kategorie.
- **Wyszukiwanie:** Możliwość szukania po tytule i treści.
- **Podgląd:** Renderowanie plików Markdown z kolorowaniem składni.
- **Pobieranie plików:** Możliwość pobierania załączników (np. plików ZIP).
