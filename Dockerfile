# Usamos PHP 8.4 en su versión FPM (FastCGI Process Manager)
FROM php:8.4-fpm

# Instalamos dependencias del sistema y extensiones de PHP necesarias para Laravel y MariaDB
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl

# Limpiamos caché para que el contenedor sea ligero
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalamos las extensiones de PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Instalamos Composer (El gestor de paquetes de PHP)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configuramos el directorio de trabajo
WORKDIR /var/www/html