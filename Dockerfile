FROM php:8.2-apache

# 1. Instalar dependencias del sistema y el instalador mágico de PHP
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# 2. Darle permisos de ejecución y correrlo
RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions oci8 sockets

# 3. Habilitar mod_rewrite de Apache
RUN a2enmod rewrite

# 4. Configurar directorio de trabajo
WORKDIR /var/www/html