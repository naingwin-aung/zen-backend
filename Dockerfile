# ==========================================
# STAGE 1: Base PHP Environment
# ==========================================
FROM php:8.3-fpm-alpine AS php-base

WORKDIR /var/www

# Install essential runtime utilities
RUN apk add --no-cache \
    busybox-suid \
    shadow \
    bash \
    curl \
    git \
    unzip

# Use mlocati's installer for faster and clean extension management
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions \
    pdo \
    pdo_pgsql \
    pgsql \
    zip \
    gd \
    bcmath \
    opcache \
    intl \
    pcntl \
    sockets \
    redis

# Configure OPCache for production performance
RUN { \
    echo 'opcache.memory_consumption=128'; \
    echo 'opcache.interned_strings_buffer=8'; \
    echo 'opcache.max_accelerated_files=10000'; \
    echo 'opcache.revalidate_freq=0'; \
    echo 'opcache.fast_shutdown=1'; \
    echo 'opcache.enable_cli=1'; \
    } > /usr/local/etc/php/conf.d/opcache-recommended.ini

# Configure www-data user shell & cron permissions securely
RUN usermod -s /bin/bash www-data \
    && mkdir -p /etc/crontabs \
    && echo "* * * * * [ -f /var/www/.cronenv ] && . /var/www/.cronenv; cd /var/www && php artisan schedule:run >> /dev/null 2>&1" > /etc/crontabs/www-data

# ==========================================
# STAGE 2: Composer Builder (PHP Dependencies)
# ==========================================
FROM composer:2.7 AS composer-builder
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --no-plugins --no-scripts --prefer-dist --optimize-autoloader

# ==========================================
# STAGE 3: Node Builder (Vite/Tailwind Assets)
# ==========================================
FROM node:20-alpine AS asset-builder
WORKDIR /app
COPY package*.json vite.config.js ./
COPY resources/ ./resources/
COPY public/ ./public/
# Build production assets (using npm install as package-lock.json might not be present)
RUN npm install && npm run build

# ==========================================
# STAGE 4: Final Production Image
# ==========================================
FROM php-base AS production

# Copy source code files
COPY . .

# Copy production vendor dependencies
COPY --from=composer-builder /app/vendor/ ./vendor/

# Copy compiled public assets
COPY --from=asset-builder /app/public/build/ ./public/build/

# Set proper ownership and permissions
RUN mkdir -p storage bootstrap/cache \
    && chown -R www-data:www-data /var/www \
    && chmod -R 775 storage bootstrap/cache

# Cache Laravel configuration/routes/views at build-time (ignoring DB errors)
RUN php artisan config:clear || true \
    && php artisan route:cache || true \
    && php artisan view:cache || true

# Set Entrypoint and Default Command
RUN chmod +x /var/www/docker/entrypoint.sh
ENTRYPOINT ["/var/www/docker/entrypoint.sh"]
CMD ["php-fpm"]
