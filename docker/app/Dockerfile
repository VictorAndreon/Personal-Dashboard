FROM php:8.2-fpm

# Dependências do sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    libpq-dev \
    libzip-dev \
    && rm -rf /var/lib/apt/lists/*

# Extensões PHP
RUN docker-php-ext-install \
    pdo \
    pdo_pgsql \
    bcmath \
    zip

# Node.js
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm \
    && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Usuário não-root
RUN groupadd -g 1000 laravel \
    && useradd -u 1000 -ms /bin/bash -g laravel laravel

WORKDIR /var/www

# Copiar entrypoint COMO ROOT
COPY docker/app/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Permissões do projeto
RUN chown -R laravel:laravel /var/www

# Troca para usuário não-root
USER laravel

ENTRYPOINT ["entrypoint.sh"]
CMD ["php-fpm"]
