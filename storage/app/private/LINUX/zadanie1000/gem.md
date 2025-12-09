Scenariusz lekcji: Zarządzanie archiwizacją i kompresją w systemie Linux
Poniżej znajduje się lista 20 praktycznych ćwiczeń (zadań), które można zrealizować podczas laboratoriów. Zadania są ułożone od podstawowych do zaawansowanych, obejmując najpopularniejsze narzędzia: tar, gzip, bzip2, xz oraz zip.

Przygotowanie środowiska
Zanim studenci zaczną, poproś ich o wygenerowanie danych testowych, aby różnice w kompresji były widoczne.

Polecenie wstępne: Utwórz katalog lab_kompresja i wygeneruj w nim kilka dużych plików tekstowych oraz binarnych (używając np. dd lub kopiując logi systemowe).

Część 1: Podstawy kompresji pojedynczych plików
Podstawy Gzip: Skompresuj jeden z dużych plików tekstowych używając gzip. Sprawdź, jak zmieniło się rozszerzenie pliku oraz jego rozmiar (używając ls -lh).

Dekompresja Gzip: Przywróć plik do postaci pierwotnej używając polecenia gunzip lub gzip -d. Zwróć uwagę, że plik skompresowany znika po dekompresji.

Porównanie algorytmów (Gzip vs Bzip2): Skompresuj ten sam plik najpierw gzip, zanotuj rozmiar, zdekompresuj, a następnie skompresuj bzip2. Porównaj, który algorytm dał lepszy stopień kompresji.

Najwyższa kompresja (XZ): Użyj narzędzia xz na dużym pliku. Porównaj czas trwania operacji oraz wynikowy rozmiar pliku z poprzednimi metodami. Zwróć uwagę na kompromis między czasem procesora a rozmiarem wynikowym.

Czytanie bez dekompresji: Użyj poleceń zcat, zless lub bzless, aby podejrzeć zawartość skompresowanego pliku tekstowego bez jego trwałego rozpakowywania na dysk.

Część 2: Archiwizacja z tar (Tape ARchive)
Tworzenie "gołego" archiwum (tarball): Użyj polecenia tar -cvf, aby spakować cały katalog z plikami do jednego pliku .tar (bez kompresji). Sprawdź, czy rozmiar archiwum jest sumą rozmiarów plików.

Archiwizacja z kompresją Gzip: Stwórz archiwum .tar.gz (lub .tgz) używając flagi -z (czyli tar -czvf). Jest to najpopularniejszy format w świecie Linuxa.

Archiwizacja z kompresją Bzip2: Stwórz archiwum .tar.bz2 używając flagi -j. Porównaj wielkość z wersją .tar.gz.

Archiwizacja z kompresją XZ: Stwórz archiwum .tar.xz używając flagi -J (duże J). Zwróć uwagę na czas wykonania.

Podgląd zawartości archiwum: Wylistuj pliki znajdujące się wewnątrz archiwum .tar.gz bez rozpakowywania go, używając flagi -t (np. tar -tf archiwum.tar.gz).

Część 3: Rozpakowywanie i zarządzanie
Ekstrakcja całości: Rozpakuj archiwum .tar.gz używając flagi -x (np. tar -xvf). Zwróć uwagę na to, gdzie trafiają pliki (bieżący katalog).

Ekstrakcja do konkretnej lokalizacji: Rozpakuj archiwum do nowo utworzonego katalogu /tmp/test_extract używając flagi -C (np. tar -xvf plik.tar.gz -C /tmp/test_extract).

Wyciąganie pojedynczego pliku: Z dużego archiwum zawierającego wiele plików, wyodrębnij tylko jeden konkretny plik, podając jego ścieżkę po nazwie archiwum.

Format Zip (Interoperacyjność): Skompresuj pliki używając polecenia zip i rozpakuj unzip. Omów krótko, dlaczego ten format jest preferowany przy wymianie plików z systemem Windows.

Archiwizacja z hasłem: Stwórz archiwum zip zabezpieczone hasłem (flaga -e). Spróbuj podejrzeć jego zawartość i rozpakować je, aby przetestować monit o hasło.

Część 4: Scenariusze zaawansowane i administratora
Łączenie strumieni (Piping): Zamiast tworzyć plik tymczasowy, użyj potoków (|). Przykład: tar cvf - katalog/ | gzip > katalog.tar.gz. Wyjaśnij ideę przekazywania strumienia danych.

Dzielenie archiwum (Split): Stwórz ogromne archiwum, a następnie użyj narzędzia split, aby podzielić je na części po np. 50MB (przydatne przy wysyłaniu mailem lub ograniczeniach FAT32). Następnie scal je z powrotem (cat).

Backup przyrostowy (Incremental): Użyj polecenia find w połączeniu z tar, aby zarchiwizować tylko pliki zmodyfikowane w ciągu ostatnich 24 godzin (np. find . -mtime -1 -exec tar ...).

Zachowanie uprawnień: Wykonaj archiwizację plików systemowych (np. z /etc) jako root z flagą -p (preserve permissions), a następnie rozpakuj jako zwykły użytkownik i sprawdź błędy lub zmiany we właścicielach plików.

Benchmarking (Test wydajności): Użyj polecenia time przed komendą kompresji (np. time tar -czvf ...), aby zmierzyć realny czas (real/user/sys) pakowania dużego zbioru danych dla różnych algorytmów.