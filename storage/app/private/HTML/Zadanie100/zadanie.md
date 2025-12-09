# Zadanie 100: Nowoczesna Wizytówka Online (Card UI)

## Wstęp
Wizytówka to klasyk. Ale w wersji cyfrowej może mieć hover efekty, własne fonty i chmurę tagów.
W tym zadaniu stworzysz "Kartę Profilową" - jeden z najczęstszych elementów interfejsu (UI) w internecie.
Nauczysz się świętego Graala CSS: **idealnego centrowania** za pomocą Flexboxa.

## Część 1: Struktura i Narzędzia

### Zadanie 1: Organizacja Plików
Stwórz folder `moj-projekt`. W środku:
*   `index.html`
*   folder `css`, a w nim `style.css`
*   folder `img` (pobierz jakieś zdjęcie profilowe, np. z `unsplash.com` lub `thispersondoesnotexist.com` i nazwij je `profil.jpg`).

### Zadanie 2: Szkielet HTML5
W `index.html` wygeneruj strukturę `!`.
*   Ustaw język: `<html lang="pl">`.
*   Dodaj w `<head>` meta tag viewport (kluczowy dla telefonów):
    ```html
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    ```

### Zadanie 3: Import Fontów (Google Fonts)
Standardowe czcionki (Arial, Times) są nudne.
1. Wejdź na [fonts.google.com](https://fonts.google.com).
2. Wyszukaj np. "Poppins" lub "Montserrat".
3. Wybierz style (np. Regular 400, Bold 700).
4. Skopiuj link `<link href="...">` i wklej go do sekcji `<head>` w swoim HTML.

### Zadanie 4: Podpięcie CSS
Połącz pliki.
```html
<link rel="stylesheet" href="css/style.css">
```

### Zadanie 5: Semantyczna Struktura
Wewnątrz `<body>` zbuduj układ:
```html
<main class="container">
    <div class="card">
        <img src="img/profil.jpg" alt="Zdjęcie profilowe">
        <div class="card-content">
            <h1>Twoje Imię</h1>
            <p>Junior Web Developer</p>
            <div class="social-links">
                <a href="#" class="btn">GitHub</a>
                <a href="#" class="btn">LinkedIn</a>
            </div>
        </div>
    </div>
</main>
```

> [!IMPORTANT]
> **Commit 1**: Struktura HTML i pliki.

---

## Część 2: CSS Layout (Flexbox)

### Zadanie 6: Reset CSS
W `style.css` zacznij od resetu, by przeglądarki nie dodawały swoich marginesów.
```css
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
```

### Zadanie 7: Tło i Font
Ustaw style dla `body`. To tutaj zdefiniujemy font dla całej strony.
```css
body {
    font-family: 'Poppins', sans-serif; /* wstaw nazwę swojego fontu */
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh; /* Pełna wysokość ekranu */
}
```

### Zadanie 8: Centrowanie (Magia Flexboxa)
To najważniejszy moment. Wyśrodkuj kartę idealnie na środku ekranu.
```css
.container {
    display: flex;
    justify-content: center; /* Poziomo */
    align-items: center;     /* Pionowo */
    min-height: 100vh;       /* Musi mieć wysokość ekranu, żeby było co centrować */
}
```

### Zadanie 9: Wygląd Karty
Stylujemy biały prostokąt.
```css
.card {
    background: white;
    width: 350px;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0, 0.2); /* Cień nadaje głębi */
    overflow: hidden; /* Żeby zdjęcie nie wystawało poza zaokrąglenie */
    text-align: center; /* Wyśrodkowanie tekstu wewnątrz */
}
```

### Zadanie 10: Padding
Dodaj oddech wewnątrz karty.
```css
.card-content {
    padding: 20px;
}
```

> [!IMPORTANT]
> **Commit 2**: Layout i karta.

---

## Część 3: Detale i Grafika

### Zadanie 11: Okrągłe Zdjęcie
Zróbmy z kwadratowego zdjęcia kółko.
```css
.card img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover; /* Żeby nie spłaszczyło twarzy */
    margin-top: 20px;
    border: 5px solid white; /* Opcjonalna ramka */
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}
```

### Zadanie 12: Nagłówek
```css
.card h1 {
    font-size: 1.8rem;
    margin-top: 10px;
    color: #333;
}
```

### Zadanie 13: Opis
```css
.card p {
    color: #666;
    margin-bottom: 20px;
    font-size: 0.9rem;
}
```

### Zadanie 14: Przyciski (Linki jako guziki)
Linki domyślnie są podkreślone i niebieskie. Zmieńmy to.
```css
.btn {
    text-decoration: none;
    display: inline-block;
    padding: 10px 20px;
    margin: 5px;
    background-color: #333;
    color: white;
    border-radius: 50px; /* "Pill shape" */
    font-weight: bold;
    transition: 0.3s; /* Płynna animacja */
}
```

### Zadanie 15: Kolory przycisków
Możesz nadać im różne kolory, np. GitHub czarny, LinkedIn niebieski (używając dodatkowych klas lub nth-child), ale na start wystarczy jeden spójny styl.

> [!IMPORTANT]
> **Commit 3**: Stylowanie detali.

---

## Część 4: Interakcja i Responsywność

### Zadanie 16: Hover Effect (Unoszenie)
Niech przycisk reaguje na najechanie myszką.
```css
.btn:hover {
    background-color: #555;
    transform: translateY(-3px); /* Unieś o 3 piksele */
}
```

### Zadanie 17: Responsywność (Media Query)
Na bardzo małych telefonach (poniżej 400px szerokości) karta może być za szeroka.
```css
@media (max-width: 400px) {
    .card {
        width: 90%; /* Zamiast 350px, zajmij 90% ekranu */
    }
}
```

### Zadanie 18: Weryfikacja HTML
Otwórz stronę w przeglądarce. Zmień rozmiar okna. Sprawdź, czy wszystko jest czytelne.

### Zadanie 19: Sprzątanie kodu
Upewnij się, że wcięcia są poprawne, a w CSS nie ma zbędnych powtórzeń.

### Zadanie 20: Publikacja (Opcjonalnie)
Taki plik możesz wrzucić na GitHub Pages, jako swoje pierwsze portfolio!

> [!IMPORTANT]
> **Commit 4**: Efekty i RWD.

## Git Help
```bash
git add .
git commit -m "HTML Zadanie 100: Wizytowka"
```
