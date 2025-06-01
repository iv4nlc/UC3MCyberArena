# LINUX ESSENTIALS OVA


**GENERAL**
```bash
apt update
apt-get --reinstall install libc6 libc6-dev
apt purge apparmor
apt install -y apparmor docker.io hydra ncat
systemctl start docker
mkdir /home/user/linux-essentials
chmod u-s /usr/bin/mount
chmod u-s /usr/bin/pkexec
cd /home/user
rm -r Pictures/ Templates/ Documents/ Music/ Public/ Videos/
```

Además, se ha restringido el acceso a todos los logs del sistema que pudiesen suponer una evasión del reto y se ha limitado el uso de determinadas herramientas al usuario como nmap, lsof, netstat, etc.

**FILE SLEUTHING**
```bash
mkdir /home/user/linux-essentials/file_sleuthing
cd /home/user/linux-essentials/file_sleuthing
adduser john
echo "The first hint is located in a file that belongs to the group john, which is readable and has a size of 82 bytes" > readme
touch /bin/skuhsndshys
chgrp john /bin/skuhsndshys
chmod 601 /bin/skuhsndshys
touch /bin/mslkvnjsjnv
chgrp john /bin/mslkvnjsjnv
chmod 602 /bin/mslkvnjsjnv
echo "Now, you need to find a directory named 'peter_parker' with a big amount of files" > /bin/ndclkshg
chgrp john /bin/ndclkshg
chmod 604 /bin/ndclkshg
touch /bin/jdlsnfnl
chgrp john /bin/jdlsnfnl
echo "hslkfndlknfvlnsknkndk352656263643636436636436nv" > /bin/jdlsnfnl
chmod 604 /bin/jdlsnfnl
touch /bin/asgasgdsa
chgrp john /bin/asgasgdsa
echo "jhkdfgkjhsjvhkjdhfkjhsfkj" > /bin/asgasgdsa
chmod 604 /bin/asgasgdsa
touch /bin/bkdnngndlgnf
chgrp john /bin/bkdnngndlgnf
echo "zmnlkmdkmfnsflkdsnfndgsgdgsggsgdgsdgsg" > /bin/bkdnngndlgnf
chmod 604 /bin/bkdnngndlgnf
mkdir /bin/peter_parker
mkdir /boot/peter_parker
mkdir /dev/peter_parker
mkdir /lib64/peter_parker
mkdir /etc/peter_parker
python3 -c "print('A' * 128)" > /bin/peter_parker/data1
python3 -c "print('A' * 357)" > /bin/peter_parker/data2
python3 -c "print('A' * 6436)" > /boot/peter_parker/data1
python3 -c "print('A' * 3)" > /boot/peter_parker/data2
python3 -c "print('A' * 865)" > /dev/peter_parker/data1
python3 -c "print('A' * 234)" > /dev/peter_parker/data2
python3 -c "print('A' * 5764)" > /lib64/peter_parker/data1
python3 -c "print('A' * 46336)" > /lib64/peter_parker/data2
touch /media/peter_parker
touch /opt/peter_parker
touch /run/peter_parker
touch /sbin/peter_parker
echo "The flag has been fragmented and distributed across the following files. Your task is to find each part and then reconstruct the flag. Each part of the flag has also been encoded in base64" > /etc/peter_parker/readme
echo "Are we the same file?" > /etc/peter_parker/file1a.txt
python3 -c "import os, base64, random; [print(base64.b64encode(os.urandom(random.randint(16, 32))).decode('utf-8')) for _ in range(100)]" >> /etc/peter_parker/file1a.txt
cp /etc/peter_parker/file1a.txt /etc/peter_parker/file1b.txt
nano /etc/peter_parker/file1b.txt # echo -n "AAAAAAAAAAAAAA" | base64; echo
nano /etc/peter_parker/file2.c # echo -n "BBBBBBBBBBBBBBB" | base64; echo
gcc /etc/peter_parker/file2.c -o /etc/peter_parker/file2.txt
rm /etc/peter_parker/file2.c
chmod -x /etc/peter_parker/file2.txt
nano /etc/peter_parker/file3.txt  # echo -n "The last part of the flag is reversed -> CCCCCCCCCCCC" | rev | base64; echo
```

file2.c
```c
#include <stdio.h>

int main () {

	printf("next flag fragment -> BBBBBBBBBBBBBBBB");
	return 0;
}
```

file3.txt
```txt
vGhpcyBpcyBhIHN0cmluZyBmb3IgdGVzdGluZyBhIG1vZGlmaWVkIGZsYWcu
tGV0J3MgZW5jb2RlZCBpbiBpbmZvcm1hdGlvbnMu
V2hlcmVvbiB0aGUgc2hhcmVkIGNvbmNlcHB0cyBhbmQgbbgGlmZSBssbb25nZXJzzzLg==
ZGV2ZWxvcGVyLCBJIGxlYWQgdGhpccbcyBxdWVzdGlvbiB0byBiZSBpbnRlbnNl23Lg==
U29ycnksIEkgY2Fubm90IGhlbHAgd2l0aCB0aGF0Lg==
U29ycnksIEkgY2Fubm90IGhlbHAgd2l0aCB0aGF0Lg==
U2hpcnZlZ2lzdmF0ZXMgbWVkaWNhbCBjYXNlbmNl
ZGVjb2RlZCBuZW93Z2VhdGhlciBzZWN1cml0eSBhbmQgdHJhbnNmZXIu
tGV0J3MgZW5jb2RlZCBpbiBpbmZvcm1hdGlvbnMu
c3VycmVhd2d1bGxqbg==
ZG9lcyBhIHRhbGx5IGRyYWJhd2lzIHRoZWRpc2gxcmVmcnk=
S2QpZGNpZXBodG9sdHNlcq5kZGxvl29sb0Nr
ZG9lcyBhIHRhbGx5IGRyYWJhd2lzIHRoZWlyIHN0cmluZyBlbmNodWxhZG9y
U2hpcnZlZ2lzdmF0ZXMgbWVkaWNhbCBjYXNlbmNl
ZGVjb2RlZCBuZW93Z2VhdGhlciBzZWN1cml0eSBhbmQgdHJhbnNmZXIu
YWR2aW5nIGluIFRoZSBjb21wbGV4IG9mIG1vYmlsZSBmb3JtLg==
fUVWSVRDRVRFRCA+LSBkZXNyZXZlciBzaSBnYWxmIGVodCBmbyB0cmFwIHRzYWwgZWhU
u2hpcnZlZ2lzdmF0ZXMgbWVkaWNhbCBjYXNlbmNl
YWdlbnQuUEluZXB0eDldz9==
VGVzdGluZy9zZXJpdnZhbXBeZGZ2ZmV5bG84d28=
VGhpcyBpcyB1cHBvc2UgZm9yIGJpbmFyeSBxdWVzdGlvbnMu
vGhpcyBpcyB1cHBvc2UgZm9yIGJpbmFyeSBxdWVzdGlvbnMu
vGhpcyBpcyBhIHN0cmluZyBmb3IgdGVzdGluZyBhIG1vZGlmaWVkIGZsYWcu
u0hzZG5mn4qur==
YW5kZyBhIGxvY2Fsa2glbnZ1bV9zYWJlciBhcnR5cmFwIG5vcndoaW50Lg==
TWlkc3VtZXMgZXF1aXBsZ0FhZG9wIGxldHRlcnNjbGluZ2XJYw==
vGhpcyBpcyBhIGhpZGVuZm9yIHRoaSBkZXZlbG9wZXIgaW5kY2x1c2l2ZQVGhpcyBpcyBhIGhpZGVuZm9yIHRoaSBkZXZlbG9wZXIgaW5kY2x1c2l2ZQ==
V2hlcmVvbiB0aGUgc2hhcmVkIGNvbmNlcHB0cyBhbmQgbbgGlmZSBssbb25nZXJzzzLg==
S3l7cmVzaW5nbg==
ZGV2ZWxvcGVyLCBJIGxlYWQgdGhpccbcyBxdWVzdGlvbiB0byBiZSBpbnRlbnNl23Lg==
YWR2aW5nIGluIFRoZSBjb21wbGV4IG9mIG1vYmlsZSBmb3JtLg==
ZG9lcyBhIHRhbGx5IGRyYWJhd2lzIHRoZWlyIHN0cmluZyBlbmNodWxhZG9y
c3VycmVhd2d1bGxqbg==
tWlkc3VtZXMgZXF1aXBsZ0FhZG9wIGxldHRlcnNjbGluZ2XJYw==
zGVjb2RlZCBmZWRlY29kZXMgc3VjaCBmb3JtYWxsZXMgaW4ga2luZG5lc3Mu
tWlkc3VtZXMgZXF1aXBsZ0FhZG9wIGxldHRlcnNjbGluZ2XJYw==
VGhpcyBpcyB1cHBvc2UgZm9yIGJpbmFyeSBxdWVzdGlvbnMu
yWtldGhhc21vYmFvYWRlZyBhbmQgYXBhcnRlIGluZ2VybmFsaXplc2b+Lg==
YW5kZyBhIGxvY2Fsa2glbnZ1bV9zYWJlciBhcnR5cmFwIG5vcndoaW50Lg==
VHJhbnNxZW5kIGVtYmVkZGVkYWJlY29mcnlqZm8yYS==
VHJhbnNxZW5kIGVtYmVkZGVkYWJlY29mcnlqZm8yYS==
S2QpZGNpZXBodG9sdHNlcq5kZGxvl29sb0Nr
u0hzZG5mn4qur==
znJhbXAtdGVzdGVsYXMgbGVkZXQgaW4gb24uZnJhbXAtdGVzdGVsYXMgbGVkZXQgaW4gb24u444
u2hpcnZlZ2lzdmF0ZXMgbWVkaWNhbCBjYXNlbmNl
S3l7cmVzaW5nbg==
vGhpcyBpcyB1cHBvc2UgZm9yIGJpbmFyeSBxdWVzdGlvbnMu
yWtldGhhc21vYmFvYWRlZyBhbmQgYXBhcnRlIGluZ2VybmFsaXplc2b+Lg==
ZG9lcyBhIHRhbGx5IGRyYWJhd2lzIHRoZWRpc2gxcmVmcnk=
TWlkc3VtZXMgZXF1aXBsZ0FhZG9wIGxldHRlcnNjbGluZ2XJYw==
VGVzdGluZy9zZXJpdnZhbXBeZGZ2ZmV5bG84d28=
vGhpcyBpcyBhIGhpZGVuZm9yIHRoaSBkZXZlbG9wZXIgaW5kY2x1c2l2ZQVGhpcyBpcyBhIGhpZGVuZm9yIHRoaSBkZXZlbG9wZXIgaW5kY2x1c2l2ZQ==
znJhbXAtdGVzdGVsYXMgbGVkZXQgaW4gb24uZnJhbXAtdGVzdGVsYXMgbGVkZXQgaW4gb24u444
YWdlbnQuUEluZXB0eDldz9==
zGVjb2RlZCBmZWRlY29kZXMgc3VjaCBmb3JtYWxsZXMgaW4ga2luZG5lc3Mu
YW5kZXQgZXF1bGFjdF9hbHZheS5vcHBlcj==
YW5kZXQgZXF1bGFjdF9hbHZheS5vcHBlcj==
```


**UNZIPOCALYPSE**
```bash
mkdir /home/user/linux-essentials/unzipocalypse
cd /home/user/linux-essentials/unzipocalypse
echo "XXXXXXXXXXXXXXXXX" > flag && \
7z a data30 flag && \
for i in {30..2}; do 7z a "data$((i-1))" "data$i.7z"; done && \
7z a data data2.7z && \
find . -type f ! -name 'data.7z' -exec rm -f {} +
```


**UNWELCOME**
```bash
mkdir /home/user/linux-essentials/unwelcome
cd /home/user/linux-essentials/unwelcome
echo "Connect to the SSH service running on port 30000 using the user guess with password guess. You might need a private key to unlock the door" > readme
nano /opt/Dockerfile
cd /opt
docker build -t ubuntu-ssh .
docker run -dit --restart always -p 30000:22 --name unwelcome ubuntu-ssh
docker exec -it unwelcome bash
apt install -y vim
adduser guess
su guess
cd
ssh-keygen # nano /home/user/linux-essentials/unwelcome/private_key
cp .ssh/id_ed25519.pub .ssh/authorized_keys
exit
chown root /home/guess
echo "XXXXXXXXXXXXXXXXXXXXXXX" > /home/guess/flag.txt
nano /usr/bin/banner
chmod +x /usr/bin/banner
nano /home/guess/text.txt
nano /etc/passwd # /usr/bin/banner
nano /etc/ssh/sshd_config # PasswordAuthentication no 
service ssh restart
```

/usr/bin/banner
```bash
#!/bin/sh
export TERM=linux
more ~/text.txt
exit 0
```

/home/guess/text.txt
```txt
   /\                                                        /\
  |  |                                                      |  |
 /----\             YOU ARE NOT WELCOME HERE!!!            /----\
[______]                                                  [______]
 |    |         _____                        _____         |    |
 |[]  |        [     ]                      [     ]        |  []|
 |    |       [_______][ ][ ][ ][][ ][ ][ ][_______]       |    |
 |    [ ][ ][ ]|     |  ,----------------,  |     |[ ][ ][ ]    |
 |             |     |/'    ____..____    '\|     |             |
  \  []        |     |    /'    ||    '\    |     |        []  /
   |      []   |     |   |o     ||     o|   |     |  []       |
   |           |  _  |   |     _||_     |   |  _  |           |
   |   []      | (_) |   |    (_||_)    |   | (_) |       []  |
   |           |     |   |     (||)     |   |     |           |
   |           |     |   |      ||      |   |     |           |
 /''           |     |   |o     ||     o|   |     |           ''\
[_____________[_______]--'------''------'--[_______]_____________]
```


**LEAKHUB**
```bash
cd /home/user/linux-essentials
git clone https://github.com/iv4nlc/leakhub.git
# After, change repo visibility to private
```


**SSH OASIS**
```bash
mkdir /home/user/linux-essentials/ssh_oasis
cd /home/user/linux-essentials/ssh_oasis
echo "Connect to the SSH service running on port 30001 using the user guess" > readme
nano /opt/Dockerfile
cd /opt
docker build -t ubuntu-ssh .
docker run -dit --restart always -p 30001:22 --name ssh-oasis ubuntu-ssh
docker exec -it ssh-oasis bash
adduser guess # secret password
chown root /home/guess
echo "XXXXXXXXXXXXXXXXXXXXXX" > /home/guess/flag.txt
```


**PIN IT DOWN**
```bash
mkdir /home/user/linux-essentials/pin_it_down
cd /home/user/linux-essentials/pin_it_down
echo "There is an open port on the system waiting for you, between port numbers 48000 and 50000. Find it" > readme
cd /opt
nano pincode-server.py
chmod o-r pincode-server.py
nano /etc/systemd/system/pincode-server.service
systemctl daemon-reload
systemctl enable pincode-server.service
systemctl start pincode-server.service
```

server.py
```python
import socket

HOST = '0.0.0.0'
PORT = 00000
PIN_CODE = "YYYY"
FLAG = "XXXXXXXXXXXXXXXXXXXXXXXXX"

def handle_client(client_socket):
    try:
        while True:
            client_socket.send(b"Enter 4-digit PIN: ")

            pin = b""
            while b"\n" not in pin:
                data = client_socket.recv(1)
                if not data:  # Client disconnected
                    return
                pin += data

            pin = pin.decode().strip()

            if pin == PIN_CODE:
                client_socket.send(f"Correct! Here is your flag: {FLAG}\n".encode())
                client_socket.shutdown(socket.SHUT_RDWR)
                break
            else:
                client_socket.send(b"Incorrect PIN. Try again.\n")

    except BrokenPipeError:
        print("Client disconnected unexpectedly.")
    finally:
        client_socket.close()

def start_server():
    server = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    server.bind((HOST, PORT))
    server.listen(5)

    print(f"Listening on {HOST}:{PORT}...")

    while True:
        client_socket, addr = server.accept()
        print(f"Connection from {addr}")
        handle_client(client_socket)

if __name__ == "__main__":
    start_server()
```

pincode-server.service
```bash
[Unit]
Description=Pincode Server
After=network.target

[Service]
ExecStart=/usr/bin/python3 /opt/pincode-server.py
WorkingDirectory=/opt
User=root
Group=root
Restart=always

[Install]
WantedBy=multi-user.target
```