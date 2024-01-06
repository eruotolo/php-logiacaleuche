# Para crear los archivos php.ini

1 - docker-compose ps // esto me devuelve las imagenes que estan corriendo
2 - docker cp nombre-imagen-php:/usr/local/etc/php ./php
3 - desde la configuración de la imagen del php, llamamos al ini:
    - ./php/php.ini:/usr/local/etc/php/php.ini:ro