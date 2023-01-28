FROM    php:7.2-apache
RUN     usermod -u 1000 www-data \
    &&  groupmod -g 1000 www-data \
    &&  a2enmod rewrite 
RUN  pecl install xdebug-2.6.0 \
    &&  apt-get update -y 
RUN apt-get install -y zlib1g-dev 
RUN docker-php-ext-enable xdebug \
    &&  docker-php-ext-install pdo_mysql mysqli mbstring zip 
RUN apt-get clean
COPY    docker-php-ext-xdebug.ini /usr/local/etc/php/conf.d/

# --追加
RUN apt-get -y install locales && \
    localedef -f UTF-8 -i ja_JP ja_JP.UTF-8
ENV LANG ja_JP.UTF-8
ENV LANGUAGE ja_JP:ja
ENV LC_ALL ja_JP.UTF-8
ENV TZ JST-9
ENV TERM xterm

RUN apt-get install -y git
RUN apt-get install xxd
RUN apt-get install sudo
RUN apt-get install -y vim
#RUN apt-get install -y mariadb-client
# --
