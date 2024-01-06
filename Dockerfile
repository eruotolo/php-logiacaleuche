FROM php:7.4.33-fpm-alpine

# Actualizar el sistema e instalar dependencias necesarias
RUN apk update && apk add --no-cache \
    $PHPIZE_DEPS \
    mariadb-dev \
    && docker-php-ext-install mysqli

# Set the working directory
WORKDIR /var/www/html

# Expose the port
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]