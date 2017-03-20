FROM php:7.0-apache

# --- From https://hub.docker.com/_/wordpress/ (except a2enmod ssl)
# install the PHP extensions we need
RUN set -ex; \
	\
	apt-get update; \
	apt-get install -y \
		libjpeg-dev \
		libpng12-dev \
	; \
	rm -rf /var/lib/apt/lists/*; \
	\
	docker-php-ext-configure gd --with-png-dir=/usr --with-jpeg-dir=/usr; \
	docker-php-ext-install gd mysqli opcache

# set recommended PHP.ini settings
# see https://secure.php.net/manual/en/opcache.installation.php
RUN { \
		echo 'opcache.memory_consumption=128'; \
		echo 'opcache.interned_strings_buffer=8'; \
		echo 'opcache.max_accelerated_files=4000'; \
		echo 'opcache.revalidate_freq=2'; \
		echo 'opcache.fast_shutdown=1'; \
		echo 'opcache.enable_cli=1'; \
	} > /usr/local/etc/php/conf.d/opcache-recommended.ini

RUN a2enmod rewrite expires ssl
# ---

# Create a self signed certificate
# https://wiki.debian.org/Self-Signed_Certificate#STEP_2
RUN mkdir -p /etc/ssl/localcerts; \
    openssl req \
            -new \
            -x509 \
            -days 365 \
            -nodes \
            -subj "/O=WordPress API Example/CN=localhost" \
            -out /etc/ssl/localcerts/apache.pem \
            -keyout /etc/ssl/localcerts/apache.key; \
    chmod 600 /etc/ssl/localcerts/apache*;

# Make the API available as an Apache virtual host
COPY docker/000-default.conf /etc/apache2/sites-available/000-default.conf

# Bundle API source
WORKDIR /var/www
COPY . .
