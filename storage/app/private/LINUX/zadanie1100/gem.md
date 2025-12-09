Scenariusz lekcji: Zdalne kopiowanie i synchronizacja (SCP & Rsync)
Poniżej znajduje się 20 punktów ćwiczeniowych, podzielonych na bloki tematyczne. Zadania ewoluują od prostego kopiowania do zaawansowanej synchronizacji i backupów.

Przygotowanie środowiska (Setup)
Weryfikacja łączności SSH: Sprawdź adresy IP obu maszyn (ip a). Upewnij się, że serwer SSH działa (systemctl status ssh) i że możesz zalogować się z maszyny A na maszynę B.

Generowanie danych testowych: Na maszynie źródłowej utwórz strukturę katalogów: mkdir -p lab_transfer/dane. W środku utwórz kilka plików tekstowych oraz jeden duży plik (np. 100MB) przy użyciu dd lub fallocate, aby testy prędkości były miarodajne.

Część 1: SCP (Secure Copy) - Szybkie i proste kopiowanie
Podstawowy "Push" (Wysyłanie): Wyślij pojedynczy plik z maszyny lokalnej na zdalną. Komenda: scp lab_transfer/plik.txt user@remote_ip:/home/user/ Cel: Zrozumienie składni źródło -> cel.

Podstawowy "Pull" (Pobieranie): Pobierz plik, który przed chwilą wysłałeś (zmień jego nazwę na zdalnej maszynie lub usuń lokalny), z powrotem na maszynę lokalną. Komenda: scp user@remote_ip:/home/user/plik.txt .

Kopiowanie rekurencyjne (Katalogi): Spróbuj wysłać cały katalog lab_transfer. Zauważ błąd, a następnie użyj flagi -r. Komenda: scp -r lab_transfer user@remote_ip:/tmp/

Zachowanie atrybutów: Sprawdź datę modyfikacji pliku na maszynie zdalnej po skopiowaniu. Zauważ, że zmieniła się na "teraz". Wykonaj kopiowanie ponownie z flagą -p (preserve), aby zachować czasy modyfikacji i uprawnienia.

Debugowanie i wydajność: Użyj flagi -v (verbose), aby zobaczyć proces nawiązywania połączenia i autentykacji. Jest to kluczowe, gdy kopiowanie "wisi" i nie wiemy dlaczego.

Część 2: Rsync - Wstęp do synchronizacji
Pierwsze starcie z Rsync: Skopiuj ten sam katalog co w pkt 5, ale używając rsync. Komenda: rsync -av lab_transfer user@remote_ip:/tmp/test_rsync Wyjaśnienie: Flaga -a (archive) to podstawa – włącza rekurencję i zachowuje większość atrybutów.

Pułapka "Trailing Slash" (Kluczowy punkt!): Wykonaj dwie operacje: a) rsync -a katalog cel/ b) rsync -a katalog/ cel/ Cel: Zrozumienie, że ukośnik na końcu źródła oznacza "zawartość katalogu", a brak ukośnika oznacza "katalog wraz z zawartością".

Delta Transfer (Siła Rsync): Uruchom tę samą komendę rsync dwukrotnie. Za drugim razem zauważ, że operacja wykonuje się natychmiastowo. Rsync nie przesyła plików, które już tam są i są identyczne.

Wizualizacja postępu: Przy przesyłaniu dużego pliku (z pkt 2) dodaj flagę --progress (lub -P). Obserwuj pasek postępu, prędkość transferu i czas do końca.

Kompresja w locie: Użyj flagi -z. Jest ona przydatna przy wolnych łączach i plikach tekstowych (logach), ale może spowolnić transfer w szybkiej sieci LAN przez obciążenie CPU. Porównaj czasy.

Część 3: Rsync - Zaawansowane zarządzanie lustrem (Mirroring)
Usuwanie plików (Pełny Mirror): Usuń plik w katalogu źródłowym. Uruchom rsync. Sprawdź, że na celu plik nadal istnieje. Teraz dodaj flagę --delete. Ostrzeżenie: To niebezpieczna flaga, która usuwa pliki na celu, których nie ma w źródle.

Testowanie na sucho (Dry-run): Zanim użyjesz --delete, zawsze używaj --dry-run (lub -n). Zobacz listę plików, które zostałyby skopiowane lub usunięte, bez faktycznego wykonywania zmian.

Wykluczanie plików (Exclude): Stwórz w katalogu pliki tymczasowe (np. *.tmp lub .git). Wykonaj synchronizację, używając --exclude='*.tmp', aby pominąć te pliki w transferze.

Niestandardowy port SSH: Załóżmy, że SSH na serwerze nasłuchuje na porcie 2222. Komenda: rsync -av -e 'ssh -p 2222' plik user@remote:/cel Cel: Nauczenie się przekazywania opcji do powłoki zdalnej (RSH).

Limitowanie pasma (Bandwidth): Symuluj środowisko produkcyjne, gdzie nie chcesz "zatkać" łącza. Użyj flagi --bwlimit=100 (limit do 100KB/s) i obserwuj spadek prędkości transferu.

Część 4: Scenariusze awaryjne i automatyzacja
Wznawianie zerwanych połączeń: Rozpocznij przesyłanie bardzo dużego pliku. Przerwij je (Ctrl+C). Wznów transfer używając flagi --partial lub -P. Rsync dokończy plik zamiast wysyłać go od nowa.

Backup z wersjonowaniem (Dla ambitnych): Użyj flagi --backup oraz --backup-dir=.... Zmodyfikuj plik w źródle i zrób rsync. Zobacz, że oryginalna wersja pliku na celu nie została nadpisana, lecz przesunięta do katalogu backupu.

Rsync po SSH bez hasła (Klucze RSA/Ed25519): Skonfiguruj logowanie kluczem publicznym (ssh-keygen, ssh-copy-id). Wykonaj rsync bez podawania hasła. Wyjaśnij, że jest to niezbędny krok do wrzucenia komendy rsync do harmonogramu zadań cron (automatyczne backupy nocne).