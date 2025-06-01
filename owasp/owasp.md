2centweb - http://CTF_IP:30000

```bash
docker-compose build
docker-compose up -d
docker exec -it 2centweb-xxe-validator bash
echo "XXXXXXXXXXXXXXX" > /flag.txt
docker exec -it 2centweb-php bash
composer install
composer require mongodb/mongodb
composer require firebase/php-jwt
crontab -e # * * * * * /usr/bin/reset.sh
nano /usr/bin/reset.sh # rm /tmp/reviews.txt
chmod +x /usr/bin/reset.sh
```

init.sql

```bash
docker exec -it 2centweb-db-mongo mongo -u root -p rootpassword --authenticationDatabase admin
use mongol;
db.users.insertOne({
    username: "admin",
    password: "XXXXXXXXXXXXXXXXXXXXX"
});
```