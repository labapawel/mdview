# Zadanie 1: Zmienne i Operacje (Aplikacja Konsolowa)

## Wstęp
Zanim zaczniemy budować skomplikowane systemy, musimy zrozumieć podstawy: jak komputer zapamiętuje dane.
W tym zadaniu stworzysz prostą aplikację konsolową (czyli taki program uruchamiany w czarnym okienku z tekstem), w której zadeklarujesz zmienne opisujące Ciebie i każesz komputerowi wykonać na nich proste obliczenia.

## Cel Zadania
Nauczysz się:
1.  Tworzyć projekt konsolowy w .NET (`dotnet new console`).
2.  Obsługiwać typy danych: `string` (napis), `int` (liczba całkowita), `double` (ułamek), `bool` (prawda/fałsz).
3.  Wyświetlać dane na ekranie (`Console.WriteLine`).

## Przygotowanie Projektu
1.  Otwórz terminal w folderze zadania (`cHash/zadanie1`).
2.  Stwórz nowy projekt konsolowy:
    ```bash
    dotnet new console -o ProjektZadanie1
    ```
3.  Wejdź do folderu:
    ```bash
    cd ProjektZadanie1
    ```
4.  Uruchom "Pusty" projekt (wyświetli "Hello, World!"):
    ```bash
    dotnet run
    ```

## Część Praktyczna

### Krok 1: Edycja Program.cs
Otwórz plik `Program.cs`.
W nowym .NET zobaczysz tam prawdopodobnie tylko jedną linijkę: `Console.WriteLine("Hello, World!");`.
To są tzw. "Top-level statements" - nie musisz już pisać `class Program` ani `static void Main`.

Usuń wszystko z tego pliku. Zaczynamy od zera.

> [!IMPORTANT]
> **Commit 1**: Wyczyszczenie pliku Program.cs.

### Krok 2: Deklaracja Zmiennych
Wpisz następujący kod (podstawiając swoje dane):

```csharp
// Deklaracja zmiennych
string imie = "Marek";
int wiek = 30;
double wzrost = 1.82; // Używamy kropki, nie przecinka!
bool czyProgramista = true;
```

**Wyjaśnienie:**
*   `string`: ciąg znaków (musi być w cudzysłowie `""`).
*   `int`: liczba całkowita.
*   `double`: liczba zmiennoprzecinkowa.
*   `bool`: wartość logiczna (`true` lub `false`).

> [!IMPORTANT]
> **Commit 2**: Zadeklarowanie zmiennych.

### Krok 3: Operacje na Zmiennych
Komputer jest świetnym kalkulatorem. Niech coś policzy.

```csharp
// Obliczenia
int rokUrodzenia = 2024 - wiek;
string powitanie = "Cześć " + imie + "!";
```

> [!IMPORTANT]
> **Commit 3**: Wykonanie prostych obliczeń.

### Krok 4: Wyświetlanie w Konsoli
Teraz czas pokazać wyniki użytkownikowi. Użyjemy `Console.WriteLine`.
Najwygodniejszym sposobem łączenia tekstu ze zmiennymi jest **interpolacja stringów** - stawiamy znak `$` przed cudzysłowem, a zmienne wpisujemy w klamrach `{}`.

```csharp
// Wyświetlanie
Console.WriteLine(powitanie);
Console.WriteLine($"Masz {wiek} lat, więc urodziłeś się w {rokUrodzenia} roku.");
Console.WriteLine($"Twój wzrost to {wzrost}m.");
Console.WriteLine($"Czy jesteś programistą? {czyProgramista}");
```

Zapisz plik i uruchom program w terminalu:
```bash
dotnet run
```

> [!IMPORTANT]
> **Commit 4**: Wyświetlenie wyników.

## Debugowanie (Co może pójść nie tak?)
*   **CS1002 ; expected**: Najczęstszy błąd. Zapomniałeś średnika na końcu linii. Każda instrukcja w C# MUSI kończyć się `;`.
*   **Błąd w obliczeniach?**: Upewnij się, że nie próbujesz odejmować tekstu od liczby (np. `"2024" - wiek` to błąd).
*   **Przecinek w liczbie?**: W kodzie piszemy `1.5` (kropka). W konsoli przy wyświetlaniu może pojawić się przecinek (zależnie od języka systemu), ale w kodzie zawsze kropka.

## Git Help

```bash
git config user.name "Twoje Imie"
git config user.email "twoj.email@example.com"
```

Po każdym kroku:
```bash
git add .
git commit -m "C# Zadanie 1: Punkt X wykonany"
```
