# Zadanie 1000: Zarządzanie archiwizacją i kompresją

## Wstęp
Jako administrator Linuxa będziesz codziennie pracować z archiwami - czy to wykonując backupy, przenosząc logi, czy instalując oprogramowanie ze źródeł.
W tym laboratorium wykonasz 20 praktycznych ćwiczeń, które przeprowadzą Cię od podstaw `gzip` aż po zaawansowane potoki w `tar`.

## Przygotowanie Środowiska
Zanim zaczniesz, musimy wygenerować dane. Kompresja pustych plików nie ma sensu - potrzebujemy "mięsa".

```bash
mkdir lab_kompresja
cd lab_kompresja
# Generujemy duży plik tekstowy (ok. 10MB) z losowymi danymi, ale tekstowymi (base64)
dd if=/dev/urandom bs=1M count=10 | base64 > dane1.txt
# Kopiujemy drugi plik, żeby mieć co porównywać
cp dane1.txt dane2.txt
# Generujemy plik binarny (trudniejszy do kompresji)
dd if=/dev/urandom of=plik.bin bs=1M count=5
```

---

## Część 1: Podstawy Kompresji (Pojedyncze Pliki)

### Zadanie 1: Podstawy Gzip
Skompresuj pierwszy plik używając standardowego narzędzia `gzip`.
```bash
gzip dane1.txt
```
*Sprawdź wynik poleceniem `ls -lh`. Zwróć uwagę na zmianę rozszerzenia na `.gz`.*

### Zadanie 2: Dekompresja
Przywróć plik do postaci pierwotnej.
```bash
gunzip dane1.txt.gz
# lub: gzip -d dane1.txt.gz
```

### Zadanie 3: Gzip vs Bzip2
Porównajmy algorytmy.
1. Skompresuj `dane1.txt` gzipem i zapisz rozmiar.
2. Rozpakuj go.
3. Skompresuj `dane1.txt` używając `bzip2`.
```bash
bzip2 dane1.txt
```
*Porównaj rozmiar `dane1.txt.bz2` z wcześniejszym `.gz`. Bzip2 zazwyczaj kompresuje mocniej, ale wolniej.*

### Zadanie 4: Najwyższa Kompresja (XZ)
Użyjmy "króla kompresji" - `xz`.
```bash
xz dane2.txt
```
*Porównaj `dane2.txt.xz` z resztą. XZ jest standardem np. przy jądrze Linuxa.*

### Zadanie 5: Czytanie bez dekompresji
Nie musisz rozpakowywać pliku, by zobaczyć co w nim jest. Wyświetl pierwsze 5 linii skompresowanego pliku:
```bash
bzcat dane1.txt.bz2 | head -n 5
# lub dla gzip: zcat plik.gz
# lub czytanie: bzless dane1.txt.bz2
```

> [!IMPORTANT]
> **Commit 1**: Wykonanie ćwiczeń z podstaw kompresji.

---

## Część 2: Archiwizacja z TAR

Samo `gzip` kompresuje tylko *jeden* plik. Aby spakować katalog, musimy najpierw stworzyć archiwum ("skleić pliki taśmą"), a dopiero potem je skompresować. Do tego służy `tar` (Tape ARchive).

### Zadanie 6: "Goły" Tarball
Spakuj wszystkie pliki w obecnym katalogu do jednego pliku `.tar` (bez kompresji).
```bash
tar -cvf archiwum.tar *
```
*Flagi: `c` (create), `v` (verbose - gadatliwy), `f` (file - nazwa pliku wynikowego).*
*Sprawdź rozmiar. Powinien być sumą plików + nagłówków.*

### Zadanie 7: Standard Gzip (tar.gz)
Stwórz najpopularniejszy format w Internecie - `.tar.gz`. Dodajemy flagę `z`.
```bash
tar -czvf paczka.tar.gz *
```

### Zadanie 8: Standard Bzip2 (tar.bz2)
Stwórz archiwum `.tar.bz2`. Dodajemy flagę `j`.
```bash
tar -cjvf paczka.tar.bz2 *
```

### Zadanie 9: Standard XZ (tar.xz)
Stwórz archiwum `.tar.xz`. Dodajemy flagę `J` (duże J!).
```bash
tar -cJvf paczka.tar.xz *
```

### Zadanie 10: Podgląd zawartości
Zobacz, co jest w środku archiwum bez rozpakowywania. Flaga `t` (list).
```bash
tar -tf paczka.tar.gz
```

> [!IMPORTANT]
> **Commit 2**: Wykonanie ćwiczeń z archiwizacji tar.

---

## Część 3: Rozpakowywanie i ZIP

### Zadanie 11: Ekstrakcja całości
Rozpakuj archiwum `.tar.gz`. Flaga `x` (extract).
```bash
mkdir test_extract
cd test_extract
tar -xvf ../paczka.tar.gz
```

### Zadanie 12: Ekstrakcja do lokalizacji (-C)
Nie musisz kopiować archiwum, by rozpakować je gdzieś indziej.
```bash
mkdir /tmp/moje_rozpakowane
tar -xvf ../paczka.tar.gz -C /tmp/moje_rozpakowane
```

### Zadanie 13: Wyciąganie jednego pliku
Wyciągnij tylko `plik.bin` z całego archiwum.
```bash
tar -xvf ../paczka.tar.gz plik.bin
```

### Zadanie 14: Format ZIP (Windows)
Jeśli wysyłasz pliki koledze z Windowsem, użyj `zip`.
```bash
zip windowsowa_paczka.zip *
unzip windowsowa_paczka.zip -d folder_wynikowy
```

### Zadanie 15: Zip z hasłem
Zabezpiecz ważne dane.
```bash
zip -e tajne.zip dane1.txt.bz2
```
*System zapyta o hasło. Przy próbie `unzip`, trzeba je podać.*

> [!IMPORTANT]
> **Commit 3**: Wykonanie ćwiczeń z ekstrakcji i zip.

---

## Część 4: Scenariusze Zaawansowane (Admin Level)

### Zadanie 16: Piping (Potoki)
Linuxowcy rzadko tworzą pliki pośrednie. Możemy przekazać wyjście `tar` bezpośrednio do `gzip` (choć flaga `-z` robi to za nas, warto znać mechanizm).
```bash
tar cvf - * | gzip > manualnie_skompresowane.tar.gz
```
*Znak `-` oznacza "standardowe wyjście".*

### Zadanie 17: Dzielenie archiwum (Split)
Masz pendrive sformatowany w FAT32 (max plik 4GB) lub limit maila 25MB? Podziel archiwum.
```bash
# Dzielimy na kawałki po 5MB
split -b 5M paczka.tar.gz part_
# Powstaną pliki part_aa, part_ab, part_ac...

# Scalanie z powrotem
cat part_* > scalona_paczka.tar.gz
```

### Zadanie 18: Backup przyrostowy (Find + Tar)
Spakuj TYLKO pliki zmodyfikowane w ciągu ostatnich 24h.
```bash
find . -mtime -1 -exec tar -rvf backup_dzienny.tar {} \;
```
*Uwaga: Flaga `r` (append) w tar nie działa z kompresją w locie.*

### Zadanie 19: Zachowanie uprawnień (-p)
Kluczowe przy backupie systemu.
```bash
# (Jako root lub sudo)
sudo tar -cvpf etc_backup.tar /etc
```
*Flaga `p` (preserve permissions) zapamiętuje właścicieli i chmody.*

### Zadanie 20: Benchmark (Time)
Co jest szybsze? Zmierz to.
```bash
time tar -czvf /dev/null *
time tar -cjvf /dev/null *
```
*Wysyłamy do `/dev/null`, bo interesuje nas tylko czas kompresji, a nie zapis na dysku.*

> [!IMPORTANT]
> **Commit 4**: Scenariusze zaawansowane.

## Git Help
```bash
git add .
git commit -m "Linux Zadanie 1000: Komplet"
```
