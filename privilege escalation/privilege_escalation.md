# PRIVILEGE ESCALATION

**GENERAL**
```bash
apt update
apt purge apparmor
apt install -y apparmor docker.io
systemctl start docker
nano /home/user/readme
chattr +i /home/user/readme
chmod u-s /usr/bin/mount
chmod u-s /usr/bin/pkexec
cd /home/user
rm -r Pictures/ Templates/ Documents/ Music/ Public/ Videos/
cd /opt
nano Dockerfile
mkdir cron
nano cron/Dockerfile
docker build -t ubuntu-ssh .
docker build -t cron-ubuntu-ssh cron/
docker run -dit --restart always -p 30000:22 --name sudoers ubuntu-ssh
docker run -dit --restart always -p 30001:22 --name suid ubuntu-ssh
docker run -dit --restart always -p 30002:22 --name capabilities ubuntu-ssh
docker run -dit --restart always -p 30003:22 --name cron cron-ubuntu-ssh
docker run -dit --restart always -p 30004:22 --name path-hijacking ubuntu-ssh
docker run -dit --restart always -p 30005:22 --name python-library-hijacking ubuntu-ssh
```

Además, se ha restringido el acceso a todos los logs del sistema que pudiesen suponer una evasión del reto y se ha limitado el uso de determinadas herramientas al usuario.

readme
```txt
To complete the privilege escalation levels, Docker will be used. To connect to the different containers via SSH, you will need to use the credentials guess:guess (user guess and password guess) and escalate your privileges until you reach the user with the flag.

Here are the ports:
- SUDOERS: 30000
- SUID: 30001
- CAPABILITIES: 30002
- CRON: 30003
- PATH HIJACKING: 30004
- PYTHON LIBRARY HIJACKING: 30005
```


**SUDOERS**
```bash
docker exec -it sudoers bash
apt install -y sudo nmap
chmod u-s /usr/bin/mount
adduser guess
adduser anacleto
adduser leocadio
adduser froilan
visudo
guess ALL=(anacleto) NOPASSWD: /usr/bin/awk
anacleto ALL=(leocadio) NOPASSWD: /usr/bin/nmap
leocadio ALL=(froilan) NOPASSWD: /usr/bin/nano
echo "XXXXXXXXXXXXXXXXXX" > /home/froilan/flag.txt
chown root /home/froilan/
```


**SUID**
```bash
docker exec -it suid bash
apt install -y sudo php
chmod u-s /usr/bin/mount
adduser guess
chown root /home/guess
echo "XXXXXXXXXXXXXXXXXXXXX" > /home/guess/flag.txt
chmod o-r /home/guess/flag.txt
chmod u+s /usr/bin/php8.3
```


**CAPABILITIES**
```bash
docker exec -it capabilities bash
apt install -y libcap2-bin tcpdump net-tools python3
chmod u-s /usr/bin/mount
adduser guess
setcap cap_setuid+ep /usr/bin/python3.12
chown root /home/guess
echo "XXXXXXXXXXXXXXXXXXX" > /home/guess/flag.txt
chmod o-r /home/guess/flag.txt
```


**CRON**
```bash
docker exec -it cron bash
chmod u-s /usr/bin/mount
adduser guess
chown root /home/guess
echo "XXXXXXXXXXXXXXXXXXXXX" > /home/guess/flag.txt
chmod o-r /home/guess/flag.txt
crontab -e            # * * * * * /bin/bash /bin/script.sh
nano /bin/script.sh
#!/bin/bash
#whoami > /tmp/output.txt
chmod +x /bin/script.sh
chmod o+w /bin/script.sh
```


**PATH HIJACKING**
```bash
docker exec -it path-hijacking bash
apt install -y gcc
chmod u-s /usr/bin/mount
adduser guess
chown root /home/guess
echo "XXXXXXXXXXXXXXXXXXXXXXX" > /home/guess/flag.txt
chmod o-r /home/guess/flag.txt
nano /home/guess/test.c
gcc /home/guess/test.c -o /home/guess/test
chmod u+s /home/guess/test
rm /home/guess/test.c 
```

test.c
```c
#include <stdio.h>

void introduction() {
    printf("\n*** Learning the difference between relative (whoami) and absolute paths (/usr/bin/whoami) ***");
}

int main() {
    
    setuid(0);
    system("/usr/bin/whoami");
    system("whoami");
    printf("\n");
    return 0;
}
```


**PYTHON LIBRARY HIJACKING**
```bash
docker exec -it python-library-hijacking bash
apt install -y sudo locate
chmod u-s /usr/bin/mount
adduser guess
adduser epifanio
chown root /home/guess
chown root /home/epifanio
echo "XXXXXXXXXXXXXXXXXXXXXXX" > /home/epifanio/flag.txt
echo "Check /tmp" > /home/guess/readme
nano /tmp/hash.py
visudo # guess ALL=(epifanio) NOPASSWD: /usr/bin/python3 /tmp/hash.py
updatedb
```

hash.py
```python
import hashlib

if __name__ == '__main__':
	text = "Hello world!"
	print(hashlib.md5(text.encode()).hexdigest())
```