FROM ubuntu:latest

RUN apt-get update && apt-get install -y \
    openssh-server \
    nano

RUN mkdir /var/run/sshd
EXPOSE 22
CMD /usr/sbin/sshd -D