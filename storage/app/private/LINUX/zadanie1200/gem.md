Przygotowanie i teoria
Analiza zasobów pamięci: Przed utworzeniem dysku sprawdź dostępną pamięć RAM w systemie. Użyj polecenia free -h. Omów, dlaczego nie możemy przydzielić całej pamięci na dysk (potrzeby systemu operacyjnego).

Przygotowanie punktu montowania: Utwórz katalog, który posłuży jako "wejście" do naszego dysku RAM. Komenda: sudo mkdir /mnt/ramdisk

Teoria: tmpfs vs ramfs: Krótko omów różnicę.

ramfs: Rośnie dynamicznie, nie ma limitu (może zawiesić system), nie jest swapowalny.

tmpfs: Ma ustalony limit wielkości, może korzystać ze SWAP-u (bezpieczniejszy). Domyślny w nowoczesnych Linuxach.

Część 1: Tworzenie RAM Dysku (tmpfs)
Montowanie podstawowe (tmpfs): Zamontuj 512MB pamięci RAM jako dysk w utworzonym katalogu. Komenda: sudo mount -t tmpfs -o size=512M tmpfs /mnt/ramdisk

Weryfikacja montowania: Sprawdź, czy dysk jest widoczny w systemie plików i czy ma poprawny rozmiar. Komenda: df -h | grep ramdisk

Nadawanie uprawnień: Domyślnie tylko root może pisać w tym katalogu. Nadaj pełne uprawnienia, aby zwykły użytkownik mógł przeprowadzać testy. Komenda: sudo chmod 777 /mnt/ramdisk

Test zapisu (Tworzenie pliku): Wejdź do katalogu i utwórz prosty plik tekstowy. Sprawdź, czy istnieje. Komenda: cd /mnt/ramdisk && echo "Test RAMu" > test.txt

Część 2: Testy wydajności (Benchmarking)
Benchmark zapisu sekwencyjnego (Write Speed): Użyj narzędzia dd, aby zapisać plik 1GB zerami. Komenda: dd if=/dev/zero of=/mnt/ramdisk/testfile bs=1M count=400 status=progress (dostosuj count do rozmiaru dysku, np. 400MB dla dysku 512MB). Zanotuj wynik: MB/s lub GB/s.

Benchmark odczytu sekwencyjnego (Read Speed): Odczytaj utworzony plik do /dev/null (aby pominąć wąskie gardło dysku systemowego). Komenda: dd if=/mnt/ramdisk/testfile of=/dev/null bs=1M status=progress Uwaga: Pierwszy odczyt może być nieco wolniejszy, kolejne mogą trafić do cache systemu (jeszcze szybsze).

Porównanie z dyskiem fizycznym: Wykonaj ten sam test zapisu (pkt 8) w katalogu domowym (na dysku SSD/HDD). Analiza: Porównaj wyniki. RAMDisk powinien byc rzędu 5-10x szybszy od SSD NVMe i 50-100x szybszy od HDD.

Czas dostępu (Latency): Dla zaawansowanych: użyj narzędzia ioping (jeśli dostępne), aby sprawdzić opóźnienia na /mnt/ramdisk w porównaniu do partycji root /.

Część 3: Zarządzanie i limity
Zapełnienie dysku (Test limitu): Spróbuj zapisać plik większy niż zadeklarowany rozmiar (np. 600MB na dysku 512MB). Obserwacja: System zwróci błąd "No space left on device". W przypadku tmpfs system jest bezpieczny.

Zmiana rozmiaru "w locie" (Remount): Zwiększ rozmiar zamontowanego dysku bez odmontowywania go (np. do 1GB). Komenda: sudo mount -o remount,size=1G /mnt/ramdisk Weryfikacja: df -h /mnt/ramdisk

Ulotność danych (Volatility): Stwórz ważny plik na RAM Dysku. Odmontuj dysk (sudo umount /mnt/ramdisk) i zamontuj go ponownie. Wniosek: Plik zniknął. To kluczowa cecha – RAM traci zawartość po odcięciu zasilania lub odmontowaniu.

Część 4: Typ ramfs i automatyzacja
Eksperyment z ramfs (Ostrożnie!): Odmontuj obecny dysk. Zamontuj nowy jako typ ramfs. Komenda: sudo mount -t ramfs ramfs /mnt/ramdisk Sprawdzenie: df -h (Zwróć uwagę, że ramfs często nie pokazuje zajętego miejsca lub pokazuje rozmiar 0 – zachowuje się inaczej niż tmpfs).

Niebezpieczeństwo ramfs: Wyjaśnij studentom, że w ramfs można pisać do wyczerpania fizycznej pamięci RAM, co spowoduje zawieszenie systemu (OOM Killer). Nie wykonuj tego testu na produkcji!

Automatyzacja w /etc/fstab: Dodaj wpis do pliku /etc/fstab, aby RAM Dysk tworzył się automatycznie przy starcie systemu. Wpis: tmpfs /mnt/ramdisk tmpfs defaults,size=512M 0 0

Zastosowanie praktyczne 1: Kompilacja: Skopiuj mały projekt (np. prosty program w C) na RAM Dysk i tam go skompiluj. To częsta praktyka programistów, aby przyspieszyć budowanie dużych projektów.

Zastosowanie praktyczne 2: Cache przeglądarki/Logi: Omów, jak przekierowanie cache przeglądarki lub często zapisywanych logów na RAM Dysk oszczędza cykle zapisu dysków SSD (wydłuża ich żywotność).

Sprzątanie (Cleanup): Usuń wpis z /etc/fstab, odmontuj dysk i usuń katalog /mnt/ramdisk, aby przywrócić system do stanu pierwotnego.