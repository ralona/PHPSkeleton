FROM php:8.1 as php

RUN apt update \
    && apt-get install -y git zlib1g-dev zip libzip-dev \
    && docker-php-ext-install pdo_mysql  \
    && docker-php-ext-install zip

RUN  curl -sS https://get.symfony.com/cli/installer | bash \
    && mv /root/.symfony/bin/symfony /usr/local/bin/symfony