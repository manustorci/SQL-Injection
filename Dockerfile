FROM php:7.4-apache

# Installa le dipendenze necessarie
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev

# Installa l'estensione mysqli
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Abilita mod_rewrite per Apache
RUN a2enmod rewrite