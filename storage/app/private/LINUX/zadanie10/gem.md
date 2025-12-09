Oto scenariusz lekcji dostosowany specyficznie do dystrybucji Ubuntu (i pochodnych Debianowych). W tym środowisku mamy do dyspozycji zarówno narzędzia niskopoziomowe (uniwersalne dla Linuxa), jak i wysokopoziomowe skrypty (specyficzne dla Debiana/Ubuntu), które są bardziej przyjazne dla użytkownika ("user-friendly").

Scenariusz lekcji: Zarządzanie użytkownikami w Ubuntu (User & Group Management)
Scenariusz obejmuje 20 punktów ćwiczeniowych. Specyfika Ubuntu: Zwracamy uwagę na różnicę między useradd a adduser oraz zarządzanie grupą sudo.

Część 1: Tworzenie kont (High-level vs Low-level)
Tworzenie metodą "Ubuntu" (adduser): Użyj dedykowanego dla Ubuntu polecenia adduser. Utwórz użytkownika nowicjusz. Komenda: sudo adduser nowicjusz Obserwacja: Zwróć uwagę, że system automatycznie pyta o hasło, tworzy katalog domowy i pyta o dane personalne (Imię, nr pokoju itp.). Jest to zalecana metoda w Ubuntu.

Tworzenie metodą uniwersalną (useradd): Utwórz użytkownika systemowy używając standardowego polecenia. Komenda: sudo useradd -m -s /bin/bash systemowy Różnica: Musisz ręcznie dodać flagę -m (katalog domowy) i -s (powłoka), inaczej konto będzie "ułomne". Konto nie ma też ustawionego hasła.

Ustawianie hasła (passwd): Użytkownik systemowy jest zablokowany (brak hasła). Napraw to. Komenda: sudo passwd systemowy

Weryfikacja w /etc/passwd: Sprawdź, jak oba konta zostały zapisane w systemie. Komenda: tail -n 2 /etc/passwd Analiza: Porównaj ID użytkowników (UID). W Ubuntu zwykli użytkownicy zaczynają się zazwyczaj od UID 1000.

Przełączanie użytkowników (su vs login): Przetestuj logowanie na nowe konto. Komenda: su - nowicjusz Ważne: Wyjaśnij myślnik -. Oznacza on "zaloguj i załaduj zmienne środowiskowe użytkownika". Bez myślnika zostaniesz w katalogu poprzedniego użytkownika.

Część 2: Grupy i uprawnienia administracyjne
Nadawanie uprawnień administratora (Grupa sudo): W Ubuntu nie używamy konta root bezpośrednio. Aby nowicjusz mógł używać sudo, dodaj go do grupy sudo. Komenda: sudo usermod -aG sudo nowicjusz (lub specyficzne dla Ubuntu: sudo adduser nowicjusz sudo).

Tworzenie nowej grupy roboczej: Stwórz grupę dla działu IT. Komenda: sudo groupadd it_support

Masowe dodawanie do grup: Przypisz użytkownika systemowy do grupy it_support. Komenda: sudo usermod -aG it_support systemowy Uwaga: Podkreśl znaczenie flagi -a (append). Jej brak nadpisałby wszystkie inne grupy użytkownika!

Sprawdzanie przynależności (id): Wyświetl grupy, do których należy nowicjusz. Komenda: id nowicjusz

Zarządzanie członkami grupy (gpasswd): Usuń użytkownika systemowy z grupy it_support bez usuwania samego konta. Komenda: sudo gpasswd -d systemowy it_support

Część 3: Czas ważności i bezpieczeństwo (Password Aging)
Wymuszenie zmiany hasła: Ze względów bezpieczeństwa wymuś na użytkowniku nowicjusz, aby przy najbliższym logowaniu musiał zmienić hasło. Komenda: sudo chage -d 0 nowicjusz

Ustawienie daty wygaśnięcia konta: Ustaw datę ważności konta systemowy na koniec bieżącego roku. Po tej dacie konto zostanie zablokowane. Komenda: sudo usermod -e 2024-12-31 systemowy (dostosuj rok).

Polityka haseł (Max days): Skonfiguruj konto nowicjusz tak, aby hasło było ważne tylko przez 90 dni. Komenda: sudo chage -M 90 nowicjusz

Ostrzeżenie przed wygaśnięciem: System ma ostrzegać użytkownika 7 dni przed wygaśnięciem hasła. Komenda: sudo chage -W 7 nowicjusz

Blokowanie konta (Lock): Pracownik idzie na urlop. Zablokuj tymczasowo konto systemowy. Komenda: sudo usermod -L systemowy (dodaje ! w pliku /etc/shadow).

Odblokowanie konta (Unlock): Pracownik wrócił. Przywróć dostęp. Komenda: sudo usermod -U systemowy

Część 4: Sprzątanie (Usuwanie kont w stylu Ubuntu)
Backup danych przed usunięciem: Zanim usuniesz konto, zrób kopię jego katalogu domowego. Komenda: sudo tar -czvf /backup/nowicjusz_home.tar.gz /home/nowicjusz

Usuwanie standardowe (userdel): Usuń użytkownika systemowy, ale zachowaj jego katalog domowy (np. do analizy przez przełożonego). Komenda: sudo userdel systemowy

Całkowite usuwanie w stylu Debian/Ubuntu (deluser): Użyj narzędzia deluser z opcją usuwania plików domowych, aby całkowicie wyczyścić system z użytkownika nowicjusz. Komenda: sudo deluser --remove-home nowicjusz Info: To polecenie jest często bezpieczniejsze i bardziej "gadatliwe" niż userdel -r.

Czyszczenie grup: Usuń grupę it_support, która nie jest już potrzebna. Komenda: sudo groupdel it_support