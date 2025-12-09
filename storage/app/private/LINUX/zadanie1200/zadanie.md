# Zadanie 1200: RAM Dysk – Pamięć jako Magazyn

## Wstęp
Pamięć RAM jest setki razy szybsza od najszybszych dysków SSD. W Linuksie możemy wydzielić część RAM-u i udawać, że jest to zwykły dysk twardy.
Ten mechanizm jest idealny do:
*   Kompilacji dużych projektów (błyskawiczny dostęp do tysięcy małych plików).
*   Cache'owania stron WWW.
*   Przechowywania danych tymczasowych, które mogą zniknąć po restarcie.

## Przygotowanie
1.  **Sprawdź zasoby:** Zobacz, ile masz wolnej pamięci.
    ```bash
    free -h
    ```
2.  **Stwórz punkt montowania:**
    ```bash
    sudo mkdir /mnt/ramdisk
    ```

---

## Część 1: Tworzenie RAM Dysku (tmpfs)

W nowoczesnych Linuksach używamy `tmpfs`. Jest bezpieczny – zajmuje tylko tyle RAMu, ile faktycznie potrzebują pliki (do ustalonego limitu).

### Zadanie 1: Montowanie
Zamontuj 512MB pamięci RAM jako dysk.
```bash
sudo mount -t tmpfs -o size=512M tmpfs /mnt/ramdisk
```
*   `-t tmpfs`: Typ systemu plików.
*   `-o size=512M`: Opcja limitu rozmiaru.

### Zadanie 2: Weryfikacja
Sprawdź, czy dysk istnieje i jak go widzi system.
```bash
df -h | grep ramdisk
```

### Zadanie 3: Uprawnienia
System plików w RAM należy domyślnie do roota (bo on go zamontował). Dajmy dostęp wszystkim, byś mógł tam pisać jako zwykły user.
```bash
sudo chmod 777 /mnt/ramdisk
```
Teraz wejdź tam i stwórz plik:
```bash
cd /mnt/ramdisk
echo "Mój ultra szybki plik" > test.txt
ls -l
```

> [!IMPORTANT]
> **Commit 1**: Utworzenie i zamontowanie RAM Dysku.

---

## Część 2: Testy Wydajności (Speed Test)

Porównajmy RAM z Twoim dyskiem twardym. Użyjemy `dd` do zapisu zer.

### Zadanie 4: Zapis (Write Speed)
Zapisujemy 400MB danych.
```bash
dd if=/dev/zero of=/mnt/ramdisk/speedtest bs=1M count=400 status=progress
```
*Zanotuj prędkość (np. 4.5 GB/s).*

### Zadanie 5: Odczyt (Read Speed)
Czytamy ten plik do "czarnej dziury" (/dev/null), żeby nie ograniczał nas dysk docelowy.
```bash
dd if=/mnt/ramdisk/speedtest of=/dev/null bs=1M status=progress
```
*Uwaga: Linux jest sprytny. Jeśli zrobisz to drugi raz od razu, wynik będzie kosmiczny, bo plik już jest w cache systemu.*

### Zadanie 6: Porównanie z Dyskiem
Wykonaj ten sam test zapisu w swoim katalogu domowym (na dysku fizycznym).
```bash
cd ~
dd if=/dev/zero of=dyskowy_test bs=1M count=400 status=progress
# Pamiętaj, żeby to potem usunąć!
rm dyskowy_test
```
*Wnioski: RAMDysk powinien być znacznie szybszy.*

> [!IMPORTANT]
> **Commit 2**: Testy wydajności.

---

## Część 3: Zarządzanie i Limity

### Zadanie 7: Przekroczenie limitu
Dysk ma limit 512MB. Spróbuj zapisać 600MB.
```bash
dd if=/dev/zero of=/mnt/ramdisk/toobig bs=1M count=600
```
Powinieneś dostać błąd: `No space left on device`. Mimo że masz w komputerze np. 16GB RAMu, `tmpfs` pilnuje ustawionego limitu.

### Zadanie 8: Zmiana rozmiaru "w locie"
Potrzebujesz więcej miejsca? Możesz zmienić rozmiar bez odmontowywania!
```bash
sudo mount -o remount,size=1G /mnt/ramdisk
df -h /mnt/ramdisk
```

### Zadanie 9: Ulotność (Volatility)
To najważniejsza lekcja.
1. Upewnij się, że masz pliki w `/mnt/ramdisk`.
2. Odmontuj dysk.
   ```bash
   cd ~  # musisz wyjść z katalogu, żeby go odmontować!
   sudo umount /mnt/ramdisk
   ```
3. Zamontuj go ponownie (albo po prostu wejdź do katalogu).
   ```bash
   ls -l /mnt/ramdisk
   ```
   *Pusto! Dane w RAM znikają po odmontowaniu lub restarcie komputera.*

> [!IMPORTANT]
> **Commit 3**: Zarządzanie limitem i remount.

---

## Część 4: Automatyzacja (fstab)

Jeśli chcesz mieć RAM Dysk zawsze po starcie systemu, musisz dodać go do `/etc/fstab`.

### Zadanie 10: Edycja fstab
**Ostrożnie! Błąd w fstab może uniemożliwić start systemu.**

1. Otwórz plik (jako root):
   ```bash
   sudo nano /etc/fstab
   ```
2. Dodaj na końcu linię:
   ```text
   tmpfs   /mnt/ramdisk    tmpfs   defaults,size=512M   0 0
   ```
3. Zapisz i przetestuj (bez restartu):
   ```bash
   sudo mount -a
   df -h | grep ramdisk
   ```
   *Jeśli `mount -a` nie zwróci błędu, jest OK.*

### Zadanie 11: Sprzątanie (Cleanup)
Ponieważ to laboratorium, nie zostawiajmy śmieci.
1. Usuń dodaną linię z `/etc/fstab`.
2. Odmontuj dysk: `sudo umount /mnt/ramdisk`.
3. Usuń katalog: `sudo rmdir /mnt/ramdisk`.

> [!IMPORTANT]
> **Commit 4**: Konfiguracja fstab.

## Git Help
```bash
git add .
git commit -m "Linux Zadanie 1200: RAM Dysk"
```
