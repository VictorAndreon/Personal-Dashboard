# 0. Imagem base
FROM php:8.2-fpm

# 1. Instalar dependências do sistema e do Postgres
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpq-dev

# 2. Instalar Node.js e NPM
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# 3. Instalar extensão do PHP para Postgres
RUN docker-php-ext-install pdo pdo_pgsql

# 4. Instalar Composer (copiando da imagem oficial)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. Definir diretório de trabalho
WORKDIR /var/www