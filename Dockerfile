# !! Atenção: certificar-se de que não há segredos no .env local durante o build !!
# --- Stage 1: Node.js (Assets) ---
FROM node:20-alpine AS node_builder
WORKDIR /app
COPY package*.json ./
RUN npm ci --prefer-offline
COPY . .
RUN npm run build

# --- Stage 2: PHP Base ---
FROM php:8.4-fpm AS php_base

ARG user=laravel
ARG uid=1000

# Dependências do sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libwebp-dev \
    libpq-dev \
    zip \
    unzip \
    supervisor \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Extensões PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install \
    pdo_pgsql \
    pgsql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    sockets \
    zip \
    opcache

# Redis via PECL
RUN pecl channel-update pecl.php.net \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && rm -rf /tmp/pear

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN useradd -G www-data,root -u $uid -d /home/$user $user \
    && mkdir -p /home/$user/.composer && chown -R $user:$user /home/$user

WORKDIR /var/www

# --- Stage 3: Development ---
FROM php_base AS development
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs && npm install -g npm@latest
USER $user

# --- Stage 4: Production ---
FROM php_base AS production

COPY docker/php/production.ini /usr/local/etc/php/conf.d/custom.ini

# 1. Instalação limpa das dependências (Camada de cache)
COPY --chown=$user:$user composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist

# 2. Copia o código
COPY --chown=$user:$user . .
COPY --from=node_builder --chown=$user:$user /app/public/build ./public/build

RUN rm -rf bootstrap/cache/*.php && \
    git config --global --add safe.directory /var/www && \
    composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# 4. Agora rodamos o discovery manualmente, mas com o flag de produção
RUN php artisan package:discover --ansi

# Permissões
RUN chown -R $user:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

USER $user
EXPOSE 9000
CMD ["php-fpm"]
