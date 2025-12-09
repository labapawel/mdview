# Zadanie 1: Zmienne i Stałe w JavaScript

## Wstęp
W świecie programowania wszystko kręci się wokół danych. Aby móc z nimi pracować – przechowywać je, modyfikować i wyświetlać – potrzebujemy **zmiennych**. Wyobraź sobie zmienne jako podpisane pudełka, w których możesz trzymać różne rzeczy: liczby, teksty, czy bardziej skomplikowane dane.

## Opis z Przykładami

W nowoczesnym JavaScript mamy trzy sposoby na zadeklarowanie "pudełka":

### 1. `let`
To standardowy sposób tworzenia zmiennej, której wartość może się zmieniać w czasie.
```javascript
let imie = "Marek";
console.log(imie); // Wypisze: Marek
imie = "Anna";     // Możemy zmienić zawartość
console.log(imie); // Wypisze: Anna
```

### 2. `const` (Stała)
Używamy, gdy wiemy, że wartość **nigdy** nie powinna się zmienić (np. liczba PI, adres serwera, ID użytkownika).
```javascript
const rokUrodzenia = 1990;
console.log(rokUrodzenia);
// rokUrodzenia = 1991; // BŁĄD! Nie można zmienić stałej.
```

### 3. `var`
Stary sposób deklaracji. Obecnie rzadziej używany, ale warto go znać. Ma nieco inne zasady widoczności (hoisting) niż `let` i `const`.
```javascript
var wiek = 30;
```

## Opis Kodu
W powyższych przykładach:
- Słowo kluczowe (`let`, `const`) mówi komputerowi: "rezerwuję miejsce w pamięci".
- Nazwa (`imie`, `rokUrodzenia`) to etykieta, dzięki której odnosimy się do tego miejsca.
- Znak równości `=` to **operator przypisania** – wkłada wartość po prawej stronie do zmiennej po lewej.

## Debugowanie
Najczęstszym błędem na początku jest próba nadpisania zmiennej `const`.

**Przykład Błędu:**
```javascript
const kolor = "Czerwony";
kolor = "Niebieski"; // Uncaught TypeError: Assignment to constant variable.
```

**Jak naprawić?**
Jeśli zmienna musi zmieniać wartość, zmień `const` na `let`. Jeśli nie powinna, sprawdź, dlaczego próbujesz ją nadpisać!

## Twoje Zadanie (Motivation)
Jesteś kreatorem nowego wirtualnego świata! Aby ten świat ożył, musisz zdefiniować jego podstawowe parametry. Stwórz postać, określ jej cechy i otoczenie. To Ty decydujesz o nazwach i wartościach – niech Twoja wyobraźnia pracuje! Pamiętaj, że każdy programista zaczynał od `hello world` i definicji zmiennych.

### Polecenia do wykonania:
1.  Stwórz plik `script.js` (lub wykonaj w konsoli przeglądarki).
2.  Zadeklaruj zmienną `let` o nazwie `imiePostaci` i przypisz jej wymyślone imię.
    > [!IMPORTANT]
    > **Commit 1**: Inicjalizacja pliku i imienia postaci.

3.  Zadeklaruj stałą `const` o nazwie `maxZycie` i ustaw na `100`.
    > [!IMPORTANT]
    > **Commit 2**: Dodanie stałej maxZycie.

4.  Zadeklaruj zmienną `wiek` i przypisz jej dowolną liczbę.
    > [!IMPORTANT]
    > **Commit 3**: Dodanie zmiennej wiek.

5.  Użyj `console.log`, aby wypisać zdanie w formacie: "Postać [imie] ma [wiek] lat i [maxZycie] punktów życia.".
    > [!IMPORTANT]
    > **Commit 4**: Wyświetlenie statystyk w konsoli.

6.  Spróbuj zmienić wartość `maxZycie` i zobacz błąd w konsoli (F12 w przeglądarce).
7.  Spróbuj zmienić `wiek` na inną wartość i wypisz ponownie.
    > [!IMPORTANT]
    > **Commit 5**: Zmiana wieku postaci.

## Git Help - Jak commitować?

Pamiętaj o regularnym zapisywaniu postępów (commitowaniu).

1.  **Konfiguracja (jeśli robisz to pierwszy raz):**
    Otwórz terminal w folderze projektu i wpisz (podstawiając swoje dane):
    ```bash
    git config --global user.name "Twoje Imie"
    git config --global user.email "twoj.email@example.com"
    ```

2.  **Robienie Commita:**
    Po wykonaniu każdego punktu z listy wyżej, wpisz w terminalu:
    ```bash
    git add .
    git commit -m "Zadanie 1: Punkt X wykonany"
    ```
    (Gdzie X to numer punktu, np. "Commit 1: Inicjalizacja").

# Warunek Zaliczenia
Wykonanie wszystkich zadań z tego pliku i zrozumienie różnicy między `let` i `const`.
