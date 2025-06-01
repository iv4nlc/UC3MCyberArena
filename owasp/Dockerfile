FROM php:7.4-apache

# Update repositories and install necessary dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libssl-dev \
    libcurl4-openssl-dev \
    pkg-config \
    python3 \
    python3-pip \
    chromium \
    chromium-driver \
    cron \
    nano \
    && pip install --upgrade selenium \
    && rm -rf /var/lib/apt/lists/*

# Install required PHP extensions (PDO and MySQL)
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Install MongoDB extension via PECL
RUN pecl install mongodb && docker-php-ext-enable mongodb

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy your source code into the container
COPY ./www /var/www/html/

# Set the working directory
WORKDIR /var/www/html

# Start the cron service
RUN service cron start

# Ensure cron runs in the background when the container starts
CMD service cron start && apache2-foreground
