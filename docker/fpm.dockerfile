FROM php:8.1-fpm

COPY composer /usr/local/bin

RUN apt -yqq update
RUN apt -yqq install libxml2-dev
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install xml
RUN apt-get install -y libxslt1-dev
RUN docker-php-ext-install xsl
RUN pecl install xdebug\
    && docker-php-ext-enable xdebug

RUN apt-get update

# Install Postgre PDO
RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

WORKDIR /var/www/developstoday_test.com

ARG DOCKER_BASE_IMAGE=ftp

