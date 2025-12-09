Część 1: Instalacja i weryfikacja usługi
Aktualizacja i instalacja: Na maszynie "Serwer" zaktualizuj repozytoria i zainstaluj pakiet serwera OpenSSH. Komenda: sudo apt update && sudo apt install openssh-server

Weryfikacja statusu usługi: Sprawdź, czy usługa działa poprawnie i nasłuchuje na porcie (domyślnie 22). Komenda: sudo systemctl status ssh (oczekiwany status: Active: active (running)).

Pierwsze połączenie (Testowe): Z maszyny "Klient" spróbuj połączyć się z serwerem, używając loginu i hasła. Komenda: ssh user@ip_serwera Cel: Potwierdzenie, że sieć działa, a firewall nie blokuje portu 22.

Analiza konfiguracji domyślnej: Otwórz główny plik konfiguracyjny na serwerze. Komenda: sudo nano /etc/ssh/sshd_config Zadanie: Przejrzyj opcje, ale na razie nic nie zmieniaj. Wyjdź skrótem Ctrl+X.

Część 2: Generowanie kluczy i logowanie bezhasłowe (Key-based Authentication)
Generowanie pary kluczy (Na Kliencie!): Na maszynie, z której się łączysz, wygeneruj parę kluczy (prywatny i publiczny). Komenda: ssh-keygen -t rsa -b 4096 (lub nowszy ssh-keygen -t ed25519). Działanie: Zaakceptuj domyślną lokalizację (~/.ssh/id_rsa) i opcjonalnie ustaw hasło (passphrase) dla dodatkowego bezpieczeństwa klucza.


Shutterstock
Kopiowanie klucza na serwer: Prześlij klucz publiczny na serwer w bezpieczny sposób. Komenda: ssh-copy-id user@ip_serwera Efekt: Twój klucz publiczny zostanie dopisany do pliku ~/.ssh/authorized_keys na serwerze.

Test logowania kluczem: Spróbuj połączyć się ponownie. System nie powinien pytać o hasło użytkownika (chyba że ustawiłeś hasło na klucz w pkt 5). Komenda: ssh user@ip_serwera

Wyłączenie logowania hasłem (Hardening): Edytuj plik konfiguracyjny na serwerze (/etc/ssh/sshd_config), aby zmusić użytkowników do używania kluczy. Znajdź i zmień linię: Zmiana: PasswordAuthentication no

Restart usługi: Każda zmiana w konfiguracji wymaga restartu demona SSH. Komenda: sudo systemctl restart ssh

Weryfikacja blokady hasła: Spróbuj zalogować się z innej maszyny (która nie ma klucza) lub wymuś brak klucza flagą. Komenda: ssh -o PubkeyAuthentication=no user@ip_serwera Oczekiwany wynik: Błąd "Permission denied (publickey)".

Część 3: Kontrola dostępu (Users & Groups)
Przygotowanie użytkowników testowych: Na serwerze utwórz dwóch nowych użytkowników: tester_ok oraz tester_zly. Komenda: sudo useradd -m -s /bin/bash tester_ok (i analogicznie dla drugiego), ustaw im hasła (passwd).

Biała lista użytkowników (AllowUsers): Skonfiguruj SSH tak, aby tylko Twój główny użytkownik i tester_ok mogli się zalogować. W /etc/ssh/sshd_config dodaj na końcu: Wpis: AllowUsers twoj_login tester_ok

Test białej listy: Spróbuj zalogować się jako tester_zly. Powinieneś zostać odrzucony, nawet jeśli podasz poprawne hasło (uwaga: jeśli w pkt 8 wyłączyłeś hasła, musisz na chwilę włączyć je z powrotem lub dodać klucze dla testerów, aby sprawdzić ten mechanizm).

Czarna lista użytkowników (DenyUsers): Usuń wpis AllowUsers. Teraz zablokuj konkretnie jednego użytkownika. Wpis: DenyUsers tester_zly Zasada: Deny ma zazwyczaj pierwszeństwo, ale bezpieczniej jest stosować Allow (whitelist), bo domyślnie blokuje wszystko inne.

Tworzenie grupy SSH: Utwórz grupę ssh_access i dodaj do niej wybranych użytkowników. Komenda: sudo groupadd ssh_access oraz sudo usermod -aG ssh_access tester_ok.

Biała lista grup (AllowGroups): Zamiast wymieniać użytkowników po przecinku, zezwól na dostęp tylko członkom grupy. Wpis w configu: AllowGroups ssh_access Restart: sudo systemctl restart ssh.

Część 4: Dodatkowe zabezpieczenia i monitoring
Blokada konta root: To absolutna podstawa bezpieczeństwa. Upewnij się, że root nie może się logować bezpośrednio przez SSH. Wpis w configu: PermitRootLogin no

Zmiana domyślnego portu: Zmień port z 22 na np. 2222, aby uniknąć automatycznych botów skanujących sieć. Wpis w configu: Port 2222 Uwaga: Przy następnym łączeniu musisz użyć flagi -p: ssh -p 2222 user@ip.

Monitoring logów (Kto się dobija?): Sprawdź logi systemowe, aby zobaczyć udane i nieudane próby logowania. Komenda: sudo grep "sshd" /var/log/auth.log (lub journalctl -u ssh).

Odłączanie bezczynnych sesji: Skonfiguruj serwer tak, aby rozłączał użytkowników, którzy odeszli od komputera (idle timeout). Wpis w configu: ClientAliveInterval 300 (sprawdzaj co 300 sekund) ClientAliveCountMax 0 (jeśli nie odpowie, rozłącz natychmiast).