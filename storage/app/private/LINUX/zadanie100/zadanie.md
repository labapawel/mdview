# Zadanie 100: Bezpieczny Zdalny Dostęp (SSH)

## Wstęp
SSH (Secure Shell) to standard zdalnego zarządzania serwerami Linux. Domyślna konfiguracja jest "wygodna", ale niekoniecznie bezpieczna.
W tym laboratorium zamienisz domyślną instalację w twierdzę, używając kluczy kryptograficznych i restrykcyjnych reguł dostępu.

## Wymagania
Potrzebujesz dwóch maszyn (lub VM):
1.  **Serwer** (tam, gdzie instalujesz usługę).
2.  **Klient** (twój laptop/stacja robocza).

---

## Część 1: Instalacja i Weryfikacja

### Zadanie 1: Instalacja (Serwer)
Zainstaluj serwer OpenSSH.
```bash
sudo apt update && sudo apt install openssh-server
```

### Zadanie 2: Status
Upewnij się, że działa.
```bash
sudo systemctl status ssh
```

### Zadanie 3: Pierwsze połączenie (Klient)
Zaloguj się hasłem, aby sprawdzić sieć.
```bash
ssh user@IP_SERWERA
```

### Zadanie 4: Config
Zobacz, gdzie leży konfiguracja (tylko podgląd).
```bash
sudo nano /etc/ssh/sshd_config
```

> [!IMPORTANT]
> **Commit 1**: SSH zainstalowane i działa.

---

## Część 2: Logowanie Bezhasłowe (Klucze)

Najbezpieczniejsza metoda logowania. Hasło można zgadnąć (Brute Force), klucza 4096-bit nie.

### Zadanie 5: Generowanie Kluczy (Klient)
Na swoim komputerze wygeneruj parę kluczy.
```bash
ssh-keygen -t rsa -b 4096
# Lub nowocześniej: ssh-keygen -t ed25519
```
*Zaakceptuj domyślną lokalizację Enterem.*

### Zadanie 6: Transfer Klucza (Klient)
Wyślij "kłódkę" (klucz publiczny) na serwer.
```bash
ssh-copy-id user@IP_SERWERA
```

### Zadanie 7: Test (Klient)
Zaloguj się ponownie.
```bash
ssh user@IP_SERWERA
```
*Powinno wejść bez pytania o hasło systemowe!*

### Zadanie 8: Wyłączenie haseł (Serwer)
Skoro mamy klucze, wyłączmy logowanie hasłem. To zablokuje ataki słownikowe.
W pliku `/etc/ssh/sshd_config` ustaw:
```text
PasswordAuthentication no
```

### Zadanie 9: Restart
```bash
sudo systemctl restart ssh
```

### Zadanie 10: Weryfikacja (Klient)
Spróbuj wymusić brak klucza, by sprawdzić błąd.
```bash
ssh -o PubkeyAuthentication=no user@IP_SERWERA
```
*Powinien odrzucić połączenie (Permission denied).*

> [!IMPORTANT]
> **Commit 2**: Tylko logowanie kluczami.

---

## Część 3: Kontrola Dostępu (Allow/Deny)

### Zadanie 11: Testerzy
Stwórz na serwerze użytkowników `tester_ok` i `tester_zly` (z hasłami).

### Zadanie 12: Biała Lista (AllowUsers)
Pozwól wchodzić tylko sobie i `tester_ok`.
W `/etc/ssh/sshd_config`:
```text
AllowUsers twoj_user tester_ok
```
*Pamiętaj o restarcie usługi!*

### Zadanie 13: Test
Spróbuj zalogować się jako `tester_zly`. Powinien dostać odmowę.

### Zadanie 14: Grupy SSH
Lepszą praktyką jest sterowanie grupami. Utwórz grupę i dodaj userów.
```bash
sudo groupadd ssh_access
sudo usermod -aG ssh_access tester_ok
```

### Zadanie 15: AllowGroups
Zmień konfigurację na:
```text
AllowGroups ssh_access
```
*Teraz każdy, kogo dodasz do grupy, automatycznie zyska dostęp.*

> [!IMPORTANT]
> **Commit 3**: Kontrola dostępu.

---

## Część 4: Hardening (Utwardzanie)

### Zadanie 16: Blokada Roota
Root nigdy nie powinien logować się zdalnie.
```text
PermitRootLogin no
```

### Zadanie 17: Zmiana Portu
Zmień port 22 na 2222 (security by obscurity, ale ogranicza logi).
```text
Port 2222
```
*Pamiętaj, by otworzyć ten port na firewallu (jeśli używasz ufw: `sudo ufw allow 2222/tcp`).*

### Zadanie 18: Logowanie na nowym porcie
```bash
ssh -p 2222 user@IP_SERWERA
```

### Zadanie 19: Monitoring
Kto próbował się włamać?
```bash
sudo grep "sshd" /var/log/auth.log
# Lub na nowszych systemach:
journalctl -u ssh
```

### Zadanie 20: Timeout
Rozłączaj leniwych administratorów po 5 minutach.
```text
ClientAliveInterval 300
ClientAliveCountMax 0
```

> [!IMPORTANT]
> **Commit 4**: Hardening serwera.

## Git Help
```bash
git add .
git commit -m "Linux Zadanie 100: SSH Security"
```
