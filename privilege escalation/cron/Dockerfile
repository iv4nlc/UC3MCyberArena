FROM ubuntu:latest

RUN apt-get update && apt-get install -y \
    openssh-server \
    nano \
    cron

RUN mkdir /var/run/sshd
RUN service cron start
EXPOSE 22
CMD service cron start && /usr/sbin/sshd -D
