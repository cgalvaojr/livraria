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
      nodejs \
      npm \
    && install-php-extensions \
      gd \
      redis \
      amqp \
      pdo_pgsql \
      zip \
      sockets \
      opcache \
      pcntl \
      exif

#Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && ln -s $(composer config --global home) /root/composer
ENV PATH=$PATH:/root/composer/vendor/bin COMPOSER_ALLOW_SUPERUSER=1

COPY . .

RUN composer install

RUN php artisan migrate

# nvm environment variables
ENV NVM_DIR /usr/local/nvm
ENV NODE_VERSION 4.4.7

ENV NVM_VERSION lts
ENV NODE_VERSION v7.5.0
ENV NVM_DIR /usr/local/nvm
RUN mkdir $NVM_DIR
RUN curl -o- https://raw.githubusercontent.com/creationix/nvm/v0.39.1/install.sh | bash

ENV NODE_PATH $NVM_DIR/v$NODE_VERSION/lib/node_modules
ENV PATH $NVM_DIR/versions/node/v$NODE_VERSION/bin:$PATH

RUN echo "source $NVM_DIR/nvm.sh && \
    nvm install $NODE_VERSION && \
    nvm alias default $NODE_VERSION && \
    nvm use default" | bash

RUN npm install
#    && npm run dev

ADD docker/entrypoint.sh /

RUN chmod +x /entrypoint.sh

CMD ["/entrypoint.sh"]