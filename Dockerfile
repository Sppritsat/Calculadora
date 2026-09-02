FROM php:8.2-apache

# 1. Instalar dependencias del sistema y el instalador mágico de PHP
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# 2. Darle permisos de ejecución e instalar extensiones de PHP
#    (pdo_mysql + mysqli en vez de oci8, ya que migramos de Oracle a MySQL)
RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions pdo_mysql mysqli sockets

# 3. Habilitar mod_rewrite de Apache
RUN a2enmod rewrite

# 4. Instalar Composer (antes faltaba: sin esto, la librería Ratchet del
#    WebSocket nunca se instalaba y bin/server.php no podía correr)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 5. Instalar Supervisor y unzip (para correr Apache + el servidor WebSocket a la vez;
#    unzip lo necesita Composer para descomprimir los paquetes que descarga)
RUN apt-get update && apt-get install -y supervisor unzip && rm -rf /var/lib/apt/lists/*

# 6. Configurar directorio de trabajo
WORKDIR /var/www/html

# 7. Instalar dependencias de PHP (Ratchet) declaradas en composer.json
COPY composer.json ./
RUN composer install --no-interaction --no-dev --optimize-autoloader

# 8. Copiar la configuración de Supervisor
COPY supervisor.conf /etc/supervisor/conf.d/supervisor.conf

# 9. Arrancar Supervisor, que a su vez levanta Apache y el WebSocket
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisor.conf"]