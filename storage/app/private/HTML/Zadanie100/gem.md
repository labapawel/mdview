Scenariusz Zadania: Tworzenie Nowoczesnej Wizytówki Online (HTML + CSS)
Cel: Stworzenie responsywnej karty profilowej (Card UI), wyśrodkowanej na ekranie, zawierającej zdjęcie, opis oraz linki do social mediów.

Część 1: Przygotowanie środowiska i struktura plików
Organizacja folderów: Utwórz folder moj-projekt. Wewnątrz utwórz plik index.html, folder css (z plikiem style.css) oraz folder img na grafiki. To uczy porządku od samego początku.

Szkielet HTML5: W index.html wygeneruj podstawową strukturę (! + Tab w VS Code). Ustaw język dokumentu na pl.

Meta tagi i Responsywność: Upewnij się, że w sekcji <head> znajduje się tag <meta name="viewport" content="width=device-width, initial-scale=1.0">. Wyjaśnij, że jest to kluczowe dla poprawnego wyświetlania na telefonach.

Import czcionek (Google Fonts): Wejdź na Google Fonts, wybierz nowoczesny krój bezszeryfowy (np. Poppins, Montserrat lub Open Sans) i wklej link w sekcji <head>. Unikamy domyślnego Times New Roman.

Podpięcie stylów: Połącz plik HTML z arkuszem stylów za pomocą tagu <link rel="stylesheet" href="css/style.css">.

Część 2: Struktura HTML (Semantyka)
Główny kontener: W <body> stwórz element semantyczny <main class="container">. Będzie to nasze tło obejmujące cały ekran.

Karta profilowa: Wewnątrz main stwórz div o klasie card. To będzie biały prostokąt z treścią.

Sekcja zdjęcia: Wewnątrz card dodaj img. Użyj zdjęcia kwadratowego (może być placeholder z unsplash.com). Pamiętaj o atrybucie alt="Zdjęcie profilowe".

Sekcja treści: Pod zdjęciem dodaj div o klasie card-content. Wewnątrz umieść nagłówek h1 (Imię i Nazwisko) oraz paragraf p z krótkim opisem stanowiska (np. "Junior Web Developer").

Sekcja akcji (Linki/Przyciski): Stwórz div o klasie social-links. Wewnątrz umieść 2-3 znaczniki <a> prowadzące np. do GitHub i LinkedIn. Nadaj im klasę btn.

Część 3: CSS - Reset i Layout (Flexbox)
Reset CSS: W style.css na samym początku użyj selektora uniwersalnego *, aby ustawić box-sizing: border-box oraz wyzerować domyślne margin: 0 i padding: 0.

Stylowanie tła (Body): Dla body ustaw font pobrany z Google, wysokość min-height: 100vh oraz delikatny kolor tła (np. jasnoszary #f0f2f5) lub gradient liniowy.

Centrowanie karty (Flexbox): Dla kontenera .container użyj Flexboxa, aby idealnie wyśrodkować kartę na ekranie: display: flex; justify-content: center; align-items: center;

Wygląd karty (.card): Nadaj karcie nowoczesny wygląd: białe tło, szerokość max-width: 350px, zaokrąglone rogi (border-radius: 15px) i najważniejsze – cień (box-shadow), który nada głębi (np. 0 10px 25px rgba(0,0,0,0.1)).

Wewnętrzny odstęp: Ustaw padding dla karty, aby treść nie dotykała krawędzi.

Część 4: Stylowanie detali i grafiki
Okrągłe zdjęcie: Ostylować img tak, aby było okrągłe. Ustaw width: 120px, height: 120px, border-radius: 50% oraz object-fit: cover (aby zdjęcie się nie spłaszczyło). Wyśrodkuj je (np. margin: 0 auto i display: block).

Typografia: Dla h1 ustaw ciemny kolor tekstu i lekki odstęp od dołu. Dla paragrafu p użyj koloru szarego (np. #666) i zwiększ interlinię (line-height: 1.6) dla lepszej czytelności.

Nowoczesne Przyciski (.btn): Usuń domyślne podkreślenie linków (text-decoration: none). Nadaj im display: inline-block, kolor tła (np. niebieski), kolor tekstu biały, padding (np. 10px 20px) oraz zaokrąglenie (border-radius: 50px).

Interakcja (Hover effects): Dodaj pseudoklasę .btn:hover. Zmień lekko kolor tła lub dodaj transformację transform: translateY(-3px), aby przycisk "unosił się" po najechaniu myszką. Pamiętaj o dodaniu transition: 0.3s do klasy bazowej .btn.

Responsywność (Media Queries) i Finalizacja: Sprawdź, jak karta wygląda na bardzo małym ekranie. Dodaj @media (max-width: 400px), zmniejszając nieco paddingi lub wielkość fontu. Zweryfikuj poprawność kodu.

Prompt do wklejenia AI (Gotowiec dla ucznia/nauczyciela)
Możesz użyć poniższego tekstu jako polecenia dla ChatGPT/Gemini, aby wygenerował wzorcowy kod lub sprawdził pracę ucznia.

"Wciel się w rolę instruktora Web Developmentu. Przygotuj kompletny kod HTML i CSS realizujący projekt 'Nowoczesna Wizytówka Osobista' zgodnie z poniższymi wytycznymi w 20 punktach:

Struktura oparta na semantycznym HTML5 (main, section).

Import czcionki 'Poppins' z Google Fonts.

Reset CSS (box-sizing: border-box, marginesy 0).

Layout oparty na Flexbox (wyśrodkowanie karty na środku ekranu 100vh).

Tło strony: delikatny gradient (np. odcienie fioletu lub błękitu).

Stylistyka karty: Białe tło, mocne zaokrąglenie rogów (20px), miękki i rozmyty cień (box-shadow).

Zdjęcie profilowe: Okrągłe (border-radius: 50%), wyśrodkowane, z delikatnym obramowaniem.

Typografia: Imię (H1) pogrubione, stanowisko (P) szarym kolorem z interlinią.

Przyciski Social Media: Pełna szerokość lub obok siebie, 'płaski' design (flat), zaokrąglone krawędzie (pill shape).

Efekt Hover: Przyciski mają zmieniać kolor i delikatnie unosić się do góry po najechaniu.

Kod ma być responsywny (dobrze wyglądać na mobile).

Proszę o wygenerowanie dwóch oddzielnych bloków kodu (index.html i style.css) oraz krótkiego wyjaśnienia, dlaczego użyliśmy Flexboxa do centrowania."