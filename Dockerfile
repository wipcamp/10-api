FROM php:7.2.1-fpm-alpine3.7

WORKDIR /app
COPY . /app

RUN docker-php-ext-install pdo pdo_mysql && \
    chmod 777 ./start.sh && \
    chmod 777 ./writeENV.sh && \
    chmod 777 -R /app/storage && \
    chmod 777 -R /app/bootstrap/cache

ENV DB_PASSWORD=
ENV APP_KEY=

EXPOSE 9000

ENTRYPOINT [ "/bin/sh" ]

CMD ["/app/start.sh"]