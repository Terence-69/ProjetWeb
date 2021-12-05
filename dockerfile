FROM php:apache-buster

COPY docker/000-default.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

RUN mkdir /var/www/meteo
ADD ./ /var/www/meteo
COPY base.sql /var/www/meteo/base.sql
COPY composer.json /var/www/meteo/composer.json
COPY composer.lock /var/www/meteo/composer.lock
RUN chown -R www-data:www-data /var/www/meteo
WORKDIR /var/www/meteo

RUN apt update
RUN apt install unzip
RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN apt install -y mariadb-server
RUN service mysql start && mysql -e "CREATE DATABASE Meteo;" && mysql -e "CREATE USER 'meteo'@'127.0.0.1' IDENTIFIED BY 'meteo';" && mysql -e "GRANT ALL PRIVILEGES ON Meteo.* TO 'meteo'@'127.0.0.1';" && mysql -D Meteo < base.sql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer update
RUN composer install
RUN composer dump-autoload

RUN service mysql start

ENTRYPOINT service mysql start && tail -f /dev/null