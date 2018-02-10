FROM php:7.2.1-fpm-alpine3.7

WORKDIR /app
COPY . /app

RUN docker-php-ext-install pdo pdo_mysql mbstring && \
    chmod 777 ./writeENV.sh && \
    chmod 777 -R /app/storage && \
    chmod 777 -R /app/bootstrap/cache

ENV DB_PASSWORD=
ENV APP_KEY=
ENV SENTRY_DSN=

EXPOSE 80

CMD ["sh", "-c", "./writeENV.sh && php artisan serv --port=80 --host=0.0.0.0"]