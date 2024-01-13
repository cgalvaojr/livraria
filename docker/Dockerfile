FROM php:8.2-fpm-alpine

WORKDIR /var/www/html

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && sync

#xDebug
RUN apk add --update --no-cache --virtual .phpize-deps $PHPIZE_DEPS linux-headers && pecl install xdebug;

RUN apk update && apk add --no-cache \
      supervisor \
      zip \
      wget \
      curl \
      unzip \
      bash \
      zsh \
      vim \
    && install-php-extensions \
      gd \
      redis \
      amqp \
      pdo_pgsql \
      zip \
      sockets \
      opcache \
      pcntl

#Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && ln -s $(composer config --global home) /root/composer
ENV PATH=$PATH:/root/composer/vendor/bin COMPOSER_ALLOW_SUPERUSER=1

ADD entrypoint.sh /
RUN chmod 777 /entrypoint.sh

CMD ["/entrypoint.sh"]