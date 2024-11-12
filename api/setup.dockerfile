FROM php:latest

RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www/html

COPY . /var/www/html

ENV DB_HOST=db
ENV DB_NAME=promptbook
ENV DB_USER=bit_academy
ENV DB_PASS=bit_academy

EXPOSE 8000

CMD ["php", "-S", "0.0.0.0:8000", "src/router.php"]
