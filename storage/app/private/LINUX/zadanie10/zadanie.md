# Zadanie 10: Zarządzanie Użytkownikami w Ubuntu

## Wstęp
W tym zadaniu nauczysz się zarządzać "mieszkańcami" Twojego systemu Linux. Ubuntu/Debian oferuje specyficzne, przyjazne narzędzia (`adduser`), ale warto znać też te uniwersalne (`useradd`).
Przećwiczysz 20 scenariuszy: od prostego dodania konta, przez nadanie uprawnień sudo, aż po zabezpieczanie haseł i czyszczenie systemu.

## Część 1: Tworzenie kont (Dwie metody)

### Zadanie 1: Metoda Ubuntu (adduser)
Stwórz użytkownika `nowicjusz` w sposób "ładny".
```bash
sudo adduser nowicjusz
```
*System zapyta o hasło i dane. Wypełnij je (lub wciśnij Enter).*

### Zadanie 2: Metoda Uniwersalna (useradd)
Stwórz użytkownika `systemowy` w sposób "surowy".
```bash
sudo useradd -m -s /bin/bash systemowy
```
*Bez flagi `-m` (home) i `-s` (shell), konto byłoby ledwo używalne.*

### Zadanie 3: Ustawianie hasła
`systemowy` nie ma hasła, więc nie może się zalogować. Napraw to.
```bash
sudo passwd systemowy
```

### Zadanie 4: Analiza /etc/passwd
Zobacz różnice w pliku konfiguracyjnym.
```bash
tail -n 2 /etc/passwd
```
*Zwróć uwagę na UID (User ID) oraz ścieżki do powłoki.*

### Zadanie 5: Przełączanie kont (su)
Zaloguj się jako `nowicjusz`.
```bash
su - nowicjusz
# Wyjście: exit
```
*Myślnik `-` jest kluczowy! Ładuje zmienne środowiskowe użytkownika.*

> [!IMPORTANT]
> **Commit 1**: Opanowanie twożenia kont.

---

## Część 2: Grupy i Sudo

### Zadanie 6: Nadanie uprawnień Administratora
Niech `nowicjusz` też rządzi. Dodaj go do grupy `sudo`.
```bash
sudo usermod -aG sudo nowicjusz
# Lub po "ubuntowemu": sudo adduser nowicjusz sudo
```

### Zadanie 7: Tworzenie Grupy
Stwórz dział IT.
```bash
sudo groupadd it_support
```

### Zadanie 8: Masowe przypisywanie
Dodaj `systemowy` do działu IT.
```bash
sudo usermod -aG it_support systemowy
```
*Flaga `-a` (append) jest krytyczna. Bez niej usunąłbyś go z innych grup!*

### Zadanie 9: Sprawdzanie (id)
Gdzie należy `nowicjusz`?
```bash
id nowicjusz
```

### Zadanie 10: Usuwanie z grupy
`systemowy` wyleciał z działu IT.
```bash
sudo gpasswd -d systemowy it_support
```

> [!IMPORTANT]
> **Commit 2**: Zarządzanie grupami.

---

## Część 3: Bezpieczeństwo i Ważność Konta

### Zadanie 11: Wymuszenie zmiany hasła
Zmuś `nowicjusz` do zmiany hasła przy logowaniu.
```bash
sudo chage -d 0 nowicjusz
```

### Zadanie 12: Data ważności konta
Konto `systemowy` ma wygasnąć z końcem roku.
```bash
sudo usermod -e 2024-12-31 systemowy
```

### Zadanie 13: Polityka haseł (90 dni)
Hasło `nowicjusz` ma być ważne max 90 dni.
```bash
sudo chage -M 90 nowicjusz
```

### Zadanie 14: Ostrzeżenie
Ostrzegaj 7 dni przed wygaśnięciem.
```bash
sudo chage -W 7 nowicjusz
```
*Sprawdź wszystko: `sudo chage -l nowicjusz`*

### Zadanie 15: Blokada (Urlop)
Zablokuj (Lock) konto `systemowy`.
```bash
sudo usermod -L systemowy
# Aby odblokować: sudo usermod -U systemowy
```

> [!IMPORTANT]
> **Commit 3**: Polityka haseł.

---

## Część 4: Sprzątanie (Styl Ubuntu)

### Zadanie 16: Backup Home
Zanim usuniesz, spakuj dane.
```bash
sudo tar -czvf nowicjusz_backup.tar.gz /home/nowicjusz
```

### Zadanie 17: Userdel (Standard)
Usuń `systemowy` (zostawiając jego pliki w /home).
```bash
sudo userdel systemowy
```

### Zadanie 18: Deluser (Ubuntu style)
Usuń `nowicjusz` CAŁKOWICIE (razem z katalogiem domowym).
```bash
sudo deluser --remove-home nowicjusz
```
*To polecenie ubuntu jest "czystsze" niż `userdel -r`.*

### Zadanie 19: Usuwanie grupy
Grupa IT już niepotrzebna.
```bash
sudo groupdel it_support
```

### Zadanie 20: Weryfikacja końcowa
Sprawdź, czy nikt nie został w `/etc/passwd`.
```bash
grepE "nowicjusz|systemowy" /etc/passwd
```
*(Powinno być pusto)*

> [!IMPORTANT]
> **Commit 4**: Usuwanie i sprzątanie.

## Git Help
```bash
git add .
git commit -m "Linux Zadanie 10: User Management"
```
