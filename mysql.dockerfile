FROM mysql:latest

ENV MYSQL_ROOT_PASSWORD=root
ENV MYSQL_DATABASE=promptbook
ENV MYSQL_USER=bit_academy
ENV MYSQL_PASSWORD=bit_academy

COPY init.sql /docker-entrypoint-initdb.d/init.sql

CMD ["mysqld", "--character-set-server=utf8mb4", "--collation-server=utf8mb4_unicode_ci"]
