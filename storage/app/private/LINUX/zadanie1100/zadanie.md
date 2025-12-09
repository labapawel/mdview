# Zadanie 1100: Zdalne Kopiowanie i Synchronizacja (SCP & Rsync)

## Wstęp
Jako administrator nie pracujesz w izolacji. Musisz przenosić dane między serwerami, wdrażać aplikacje i robić backupy.
W tym laboratorium opanujesz dwa kluczowe narzędzia: `scp` (Secure Copy) do prostych transferów oraz potężny `rsync` do synchronizacji i backupów.

## Przygotowanie Środowiska (Setup)
**Ważne:** To zadanie wymaga dwóch maszyn (lub VM/kontenerów) z dostępem SSH. Jeśli pracujesz sam, możesz łączyć się do `localhost`, ale lepiej użyć dwóch terminali/maszyn.

1.  **Sprawdź IP:** Użyj `ip a`, aby poznać adres zdalnej maszyny (dalej oznaczanej jako `REMOTE_IP`).
2.  **SSH:** Upewnij się, że możesz się zalogować: `ssh user@REMOTE_IP`.
3.  **Dane:** Na maszynie źródłowej wygeneruj dane:
    ```bash
    mkdir -p lab_transfer/dane
    cd lab_transfer
    # Tworzymy duży plik (100MB) do testów prędkości
    dd if=/dev/urandom of=dane/bigfile.dat bs=1M count=100
    # Kilka mniejszych plików
    touch dane/plik{1..5}.txt
    ```

---

## Część 1: SCP (Secure Copy) - Szybkie Kopiowanie

### Zadanie 1: Wysyłanie (Push)
Wyślij plik `dane/bigfile.dat` na serwer zdalny.
```bash
scp dane/bigfile.dat user@REMOTE_IP:/home/user/
```
*Składnia: `scp CO GDZIE`.*

### Zadanie 2: Pobieranie (Pull)
Pobierz ten sam plik z serwera, ale zapisz go jako `bigfile_back.dat`.
```bash
scp user@REMOTE_IP:/home/user/bigfile.dat ./bigfile_back.dat
```

### Zadanie 3: Kopiowanie Katalogu (-r)
Spróbuj wysłać katalog `dane`. Zobaczysz błąd. Użyj flagi `-r` (recursive).
```bash
scp -r dane user@REMOTE_IP:/tmp/
```

### Zadanie 4: Zachowanie Atrybutów (-p)
SCP domyślnie zmienia datę modyfikacji na "teraz". Aby zachować oryginał, użyj `-p` (preserve).
```bash
scp -p dane/plik1.txt user@REMOTE_IP:/tmp/
```

### Zadanie 5: Debugowanie (-v)
Jeśli połączenie wisi, użyj `-v` (verbose), by widzieć komunikaty SSH.
```bash
scp -v dane/plik1.txt user@REMOTE_IP:/tmp/
```

> [!IMPORTANT]
> **Commit 1**: Opanowanie SCP.

---

## Część 2: Rsync - Wstęp do Synchronizacji

`rsync` jest mądrzejszy niż `scp`. Przesyła tylko różnice (delta transfer).

### Zadanie 6: Pierwsze starcie (-a)
Skopiuj katalog `dane` używając rsync.
```bash
rsync -av dane user@REMOTE_IP:/tmp/rsync_test
```
*Flaga `-a` (archive) to "szwajcarski scyzoryk" - włącza rekurencję i zachowuje uprawnienia.*

### Zadanie 7: Pułapka "Trailing Slash"
To najważniejsza rzecz w rsync!
*   `rsync -a dane cel/` -> stworzy `cel/dane/...`
*   `rsync -a dane/ cel/` -> stworzy `cel/...` (zawartość katalogu)
Przetestuj obie wersje.

### Zadanie 8: Delta Transfer
Uruchom komendę z Zadania 6 ponownie.
Zauważ, że skończy się natychmiast. Rsync nic nie wysłał, bo pliki są identyczne. To oszczędza łącze!

### Zadanie 9: Wizualizacja Postępu (-P)
Przy dużych plikach chcemy widzieć pasek postępu.
```bash
rsync -avP dane/bigfile.dat user@REMOTE_IP:/tmp/
```
*(Flaga `-P` to skrót od `--progress` i `--partial`).*

### Zadanie 10: Kompresja (-z)
Przydaje się przy wolnym internecie i plikach tekstowych (logi, SQL).
```bash
rsync -avz dane user@REMOTE_IP:/tmp/
```

> [!IMPORTANT]
> **Commit 2**: Podstawy Rsync.

---

## Część 3: Zaawansowany Mirroring

### Zadanie 11: Pełny Mirror (--delete)
Usuń plik lokalnie. Uruchom rsync. Plik zdalnie nadal jest.
Aby zdalna kopia była **identyczna** (usuwała to, czego nie ma u źródła), użyj `--delete`.
```bash
rm dane/plik1.txt
rsync -av --delete dane/ user@REMOTE_IP:/tmp/rsync_test/
```
*Ostrożnie! To kasuje dane!*

### Zadanie 12: Dry Run (-n)
Zanim użyjesz `--delete`, sprawdź co się stanie.
```bash
rsync -av --delete -n dane/ user@REMOTE_IP:/tmp/rsync_test/
```
*(Wymaga przywrócenia pliku z poprzedniego kroku, by coś pokazało).*

### Zadanie 13: Wykluczanie (--exclude)
Nie chcemy kopiować śmieci.
```bash
touch dane/smiec.tmp
rsync -av --exclude='*.tmp' dane/ user@REMOTE_IP:/tmp/rsync_test/
```

### Zadanie 14: Inny Port SSH (-e)
Jeśli SSH działa na porcie 2222:
```bash
rsync -av -e 'ssh -p 2222' dane/ user@REMOTE_IP:/tmp/
```

### Zadanie 15: Limit Pasma (--bwlimit)
Nie "zapychaj" sieci w firmie. Ustaw limit na 100KB/s.
```bash
rsync -avP --bwlimit=100 dane/bigfile.dat user@REMOTE_IP:/tmp/
```

> [!IMPORTANT]
> **Commit 3**: Zaawansowane zarządzanie lustrem.

---

## Część 4: Scenariusze Awaryjne i Automatyzacja

### Zadanie 16: Wznawianie Transferu
Zacznij wysyłać `bigfile.dat`. Przerwij `Ctrl+C` w połowie.
Wznów transfer. Dzięki `-P` (lub `--partial`), rsync dokończy plik zamiast zaczynać od nowa.

### Zadanie 17: Backup z Wersjonowaniem
Zamiast nadpisywać zmieniony plik, przesuń starą wersję do folderu backupu.
```bash
rsync -av --backup --backup-dir=../old_versions dane/ user@REMOTE_IP:/tmp/rsync_test/
```

### Zadanie 18: Klucze SSH (Bez Hasła)
Aby rsync działał w skryptach (cron), nie może pytać o hasło.
```bash
ssh-keygen -t ed25519
ssh-copy-id user@REMOTE_IP
```
*Teraz `rsync` pójdzie bez hasła.*

### Zadanie 19: Różnice w zawartości (-c)
Domyślnie rsync patrzy na datę i rozmiar. Jeśli chcesz sprawdzić sumy kontrolne (wolniejsze, ale pewniejsze):
```bash
rsync -avc dane/ user@REMOTE_IP:/tmp/rsync_test/
```

### Zadanie 20: Kopiowanie lokalne
Rsync świetnie nadaje się też do kopiowania dysk-dysk (zamiast `cp`), bo ma pasek postępu i wznawianie.
```bash
rsync -avP dane/ /mnt/usb_drive/backup/
```

> [!IMPORTANT]
> **Commit 4**: Scenariusze automatyzacji.

## Git Help
```bash
git add .
git commit -m "Linux Zadanie 1100: Kopia i Sync"
```
