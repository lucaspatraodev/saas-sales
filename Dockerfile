FROM php:8.3-fpm-alpine

# Update package list first (required when using --no-cache)
RUN apk update

# Install all dependencies at once (build-time and runtime)
RUN apk add --no-cache \
    nginx \
    supervisor \
    git \
    curl \
    zip \
    unzip \
    netcat-openbsd \
    nodejs \
    npm \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    mariadb-dev \
    libxml2-dev \
    oniguruma-dev \
    libzip-dev

# Configure and install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install \
        pdo \
        pdo_mysql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . /var/www/html

# Install PHP dependencies and build assets
RUN composer install --no-interaction && \
    npm install && \
    npm run build

# Copy Docker configuration files
RUN mkdir -p /etc/nginx/conf.d
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/php-fpm.conf /usr/local/etc/php-fpm.d/www.conf
COPY docker/supervisord.conf /etc/supervisord.conf
COPY docker/entrypoint.sh /start.sh
RUN chmod +x /start.sh

EXPOSE 80 9000
ENTRYPOINT ["/start.sh"]
