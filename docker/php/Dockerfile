FROM php:8.1.18-fpm-bullseye

RUN apt-get clean && apt-get update && apt-get -y upgrade && \
   	apt-get install -y \
    gettext \
    locales \
    libzip-dev \
    libpng-dev  \
    libjpeg-dev \
    libbz2-dev \
    libicu-dev \
    libxml2-dev \
    libffi-dev \
    libssl-dev \
    libedit-dev \
    libxslt1-dev \
    unzip \
    git \
    openssh-client \
    --no-install-recommends \
    && rm -Rf /var/lib/apt/lists/*

RUN sed -i 's/# es_ES.UTF-8 UTF-8/es_ES.UTF-8 UTF-8/g' /etc/locale.gen
RUN locale-gen

RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql \
    && docker-php-ext-install zip && docker-php-ext-enable zip \
    && docker-php-ext-install gd && docker-php-ext-enable gd \
    && docker-php-ext-install gettext && docker-php-ext-enable gettext \
    && docker-php-ext-install pdo && docker-php-ext-enable pdo \
    && docker-php-ext-install bcmath && docker-php-ext-enable bcmath \
    && docker-php-ext-install bz2 && docker-php-ext-enable bz2 \
    && docker-php-ext-install calendar && docker-php-ext-enable calendar \
    && docker-php-ext-install dom && docker-php-ext-enable dom \
    && docker-php-ext-install exif && docker-php-ext-enable exif \
    && docker-php-ext-install ftp && docker-php-ext-enable ftp \
    && docker-php-ext-install intl && docker-php-ext-enable intl \
    && docker-php-ext-install fileinfo && docker-php-ext-enable fileinfo \
    && docker-php-ext-install simplexml && docker-php-ext-enable simplexml \
    && docker-php-ext-install xsl && docker-php-ext-enable xsl \
    && docker-php-ext-install posix && docker-php-ext-enable posix \
    && docker-php-ext-install pcntl && docker-php-ext-enable pcntl \
    && pecl install xdebug && docker-php-ext-enable xdebug \
    && pecl install mongodb && docker-php-ext-enable mongodb \
    && docker-php-ext-install soap && docker-php-ext-enable soap

RUN ln -snf /usr/local/bin/php /usr/bin/php8.1

CMD ["php-fpm"]