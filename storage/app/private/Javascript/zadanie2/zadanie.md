# Zadanie 2: Modyfikacja Zmiennych i Operatory

## Wstęp
W poprzednim zadaniu stworzyliśmy nasze pierwsze "pudełka" na dane. Ale programowanie to nie tylko przechowywanie informacji – to przede wszystkim **działanie** na nich. Zmienne w JavaScript (szczególnie te zadeklarowane przez `let`) "żyją" i zmieniają się w trakcie działania programu. Licznik punktów rośnie, życie postaci spada, a imiona się łączą.

## Opis z Przykładami

Aby modyfikować zmienne, używamy **operatorów**. Oto najważniejsze z nich:

### 1. Operatory Matematyczne
Działają tak, jak na lekcji matematyki.
```javascript
let wynik = 10;
wynik = wynik + 5; // Dodawanie, wynik: 15
wynik = wynik - 2; // Odejmowanie, wynik: 13
wynik = wynik * 2; // Mnożenie, wynik: 26
wynik = wynik / 2; // Dzielenie, wynik: 13
```

### 2. Skrócone zapisy
Programiści lubią pisać mniej kodu.
```javascript
let punkty = 100;
punkty += 10; // To samo co: punkty = punkty + 10; (Wynik: 110)
punkty -= 50; // To samo co: punkty = punkty - 50; (Wynik: 60)
punkty++;     // Inkrementacja: zwiększ o 1 (Wynik: 61)
punkty--;     // Dekrementacja: zmniejsz o 1 (Wynik: 60)
```

### 3. Łączenie tekstów (Konkatenacja)
Operator `+` działa też na napisach!
```javascript
let imie = "Jan";
let nazwisko = "Kowalski";
let pelneImie = imie + " " + nazwisko; // Wynik: "Jan Kowalski"
// Uwaga na spację w środku!
```

## Opis Kodu
- Kiedy używamy `=` (operator przypisania), komputer najpierw oblicza to, co jest po **prawej** stronie, a potem wrzuca wynik do zmiennej po **lewej**.
- `x = x + 1` czytamy: "nowy x to stary x plus jeden".

## Debugowanie
Częstym problemem jest dziwne zachowanie operatora `+`, gdy mieszamy liczby z tekstem. JavaScript próbuje być miły i zamienia liczbę na tekst, co prowadzi do niespodzianek.

**Przykład Błędu:**
```javascript
let cena = "20"; // To jest tekst (String), bo jest w cudzysłowie!
let podatek = 5;   // To jest liczba (Number)
let suma = cena + podatek; 
console.log(suma); 
// Oczekujemy: 25
// Rzeczywistość: "205" (Tekst "20" sklejony z "5")
```

**Jak naprawić?**
Upewnij się, że pracujesz na odpowiednich typach danych. Zmienne liczbowe nie powinny mieć cudzysłowów.
Możesz sprawdzić typ zmiennej wpisując `typeof nazwaZmiennej`.

## Twoje Zadanie (Motivation)
Twoja postać wyrusza w podróż! Zdobywa doświadczenie, traci energię i zbiera złote monety. Musisz obsłużyć te zmiany w kodzie. To podstawa mechaniki każdej gry RPG. Zobacz, jak Twoje decyzje wpływają na stan bohatera.

### Polecenia do wykonania:
1.  Stwórz lub wyczyść plik `script.js`.
2.  Zadeklaruj zmienną `let exp` (doświadczenie) i ustaw ją na `0`.
3.  Zadeklaruj zmienną `let gold` (złoto) i ustaw na `50`.
    > [!IMPORTANT]
    > **Commit 1**: Inicjalizacja zmiennych exp i gold.

4.  Twoja postać zabiła potwora! Zwiększ `exp` o `150` (użyj `+=`).
5.  Znalazłeś skrzynię! Zwiększ `gold` o `100`.
    > [!IMPORTANT]
    > **Commit 2**: Aktualizacja stanu po walce i znalezieniu skarbu.

6.  Kupiłeś miksturę. Zmniejsz `gold` o `25` (użyj `-=`).
7.  Postać awansowała! Zwiększ `exp` o `1` używając inkrementacji (`++`).
    > [!IMPORTANT]
    > **Commit 3**: Zakupy i awans postaci.

8.  Wyświetl w konsoli podsumowanie: "Bohater ma [exp] punktów doświadczenia i [gold] złota.".
9.  **Eksperyment:** Spróbuj dodać liczbę do tekstu (np. `let tekst = "Wynik: " + 5 + 5;`) i zobacz co wyjdzie. (Podpowiedź: wynik może Cię zaskoczyć – "Wynik: 55").
    > [!IMPORTANT]
    > **Commit 4**: Wyświetlenie podsumowania i eksperymenty.

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
    git commit -m "Zadanie 2: Punkt X wykonany"
    ```
    (Gdzie X to numer punktu, np. "Commit 1: Inicjalizacja").

# Warunek Zaliczenia
Poprawne wykonanie obliczeń i wyświetlenie końcowego stanu zmiennych w konsoli bez błędów typu.
