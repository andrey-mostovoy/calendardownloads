FROM phusion/baseimage:0.9.16

MAINTAINER Andrey Mostovoy <stalk.4.me@gmail.com>

ADD ./build /build

RUN /build/base.sh && \
    /build/php.sh && \
    /build/nginx.sh && \
    /build/debug.sh && \
    /build/services.sh && \
    /build/configs.sh && \
    /build/env.sh && \
    /build/ssh.sh && \
    /build/xdebug.sh && \
    /build/logs.sh && \
    /build/cleanup.sh && \
    chown www-data:www-data -R /var/www

EXPOSE 80 22
