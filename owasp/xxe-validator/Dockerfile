FROM php:7.4-apache

RUN apt-get update && apt-get install -y libxml2-dev

RUN docker-php-ext-install xml

EXPOSE 80
CMD ["apache2-foreground"]
