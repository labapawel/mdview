# Zadanie 100: Twoja Lista Zadań (ToDo List)

## Wstęp
Każdy programista wcześniej czy później pisze swoją listę zadań. To klasyczny projekt, który łączy w sobie wszystko, co najważniejsze w tworzeniu aplikacji webowych: interakcję z użytkownikiem (formularz), dynamiczne zmiany na stronie (DOM) oraz trwałe zapisywanie danych (LocalStorage). Dziś zbudujesz narzędzie, które naprawdę działa i zapamiętuje Twoje plany nawet po odświeżeniu strony!

## Opis z Przykładami

### 1. Pobieranie elementów z formularza
Aby wiedzieć, co użytkownik wpisał, musimy "złapać" pole tekstowe i formularz.
```javascript
const formularz = document.querySelector('#myForm');
const input = document.querySelector('#myInput');

formularz.addEventListener('submit', function(event) {
    event.preventDefault(); // Zatrzymuje przeładowanie strony!
    console.log(input.value); // Wypisuje to, co wpisano
});
```

### 2. Tworzenie elementów DOM
Nie piszemy zadań w HTML na sztywno. Tworzymy je w locie!
```javascript
const lista = document.querySelector('#myList');
const nowyElement = document.createElement('li'); // Tworzy <li>
nowyElement.innerText = "Kupić mleko";
lista.append(nowyElement); // Dodaje do <ul>
```

### 3. LocalStorage - Pamięć przeglądarki
LocalStorage to taki mały schowek w przeglądarce, który przechowuje tylko tekst.
```javascript
// Zapisywanie
localStorage.setItem('imie', 'Marek');

// Odczytywanie
const imie = localStorage.getItem('imie');

// Tablice w LocalStorage (JSON)
const zadania = ['Mleko', 'Chleb'];
localStorage.setItem('zadania', JSON.stringify(zadania)); // Zamiana tablicy na tekst

const odczytane = JSON.parse(localStorage.getItem('zadania')); // Zamiana tekstu na tablicę
```

## Opis Kodu
- **`event.preventDefault()`**: Kluczowe przy formularzach. Domyślnie formularz wysyła dane na serwer i przeładowuje stronę. My tego nie chcemy w aplikacji typu SPA (Single Page Application).
- **`JSON.stringify()` / `JSON.parse()`**: LocalStorage przyjmuje tylko napisy. Aby zapisać tablicę obiektów, musimy ją "spłaszczyć" do napisu (stringify), a przy odczycie "napompować" z powrotem do tablicy (parse).

## Debugowanie
- **Dane znikają po odświeżeniu?** Sprawdź, czy na pewno używasz `localStorage.setItem` po dodaniu zadania i `localStorage.getItem` przy ładowaniu strony.
- **`[object Object]` w LocalStorage?** Zapomniałeś o `JSON.stringify`!
- **Błędy w konsoli przy `null`?** `getItem` zwraca `null`, jeśli klucz nie istnieje. Warto zabezpieczyć się: `JSON.parse(localStorage.getItem('zadania')) || []`.

## Twoje Zadanie (Motivation)
Twoja pamięć bywa ulotna, ale Twój kod nie musi taki być. Stwórz aplikację, która będzie Twoim osobistym asystentem. Lista zakupów, pomysły na prezenty, cele na nowy rok – wszystko w jednym miejscu, dostępne zawsze, gdy otworzysz przeglądarkę. Poczuj moc trwałych danych!

### Polecenia do wykonania:
Stwórz pliki `index.html` i `script.js`.

1.  **HTML**: Stwórz formularz z polem tekstowym (`input`) i przyciskiem "Dodaj". Pod spodem dodaj pustą listę `<ul>` o id `todoList`.
2.  **JS - Dodawanie**:
    - Obsłuż zdarzenie `submit` formularza.
    - Pobierz tekst z inputa. Jeśli jest pusty, wyświetl `alert("Wpisz zadanie!")`.
    - Stwórz funkcję `dodajZadanieDoDOM(tekst)`, która tworzy `li`, dodaje mu tekst i przycisk "Usuń", a następnie wrzuca do listy `ul`.
3.  **JS - Usuwanie**:
    - Do każdego `li` dodaj przycisk usuwania.
    - Obsłuż kliknięcie (możesz dodać `addEventListener` do przycisku przy tworzeniu). Po kliknięciu usuń element z DOM (`element.remove()`).
4.  **JS - Zapisywanie (LocalStorage)**:
    - Stwórz tablicę `todos`.
    - Przy każdym dodaniu zadania, dodaj je też do tablicy `todos` i zapisz całą tablicę w `localStorage` (użyj `JSON.stringify`).
    - Przy usuwaniu musisz też usunąć element z tablicy i nadpisać `localStorage`.
5.  **JS - Odczyt**:
    - Na początku skryptu sprawdź, czy w `localStorage` coś jest.
    - Jeśli tak, użyj `JSON.parse` i dla każdego elementu wywołaj funkcję `dodajZadanieDoDOM`, aby odtworzyć listę po odświeżeniu.
6.  **Style (CSS)**: Dodaj proste style, aby lista wyglądała ładnie (np. przekreślanie zrobionych zadań po kliknięciu w tekst - opcjonalnie).

# Warunek Zaliczenia
Aplikacja pozwala dodawać i usuwać zadania, a lista **nie znika** po odświeżeniu strony (F5).
