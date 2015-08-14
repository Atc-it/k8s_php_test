# PHP docker development env
FROM        ubuntu:15.04

# basic env fix
ENV         TERM xterm

# install packages
RUN         apt-get update && apt-get dist-upgrade -y
RUN         apt-get install -y htop nano curl \
            nginx php5-common php5-cli php5-fpm php5-mcrypt php5-mysql php5-apcu php5-gd php5-imagick php5-curl php5-intl

RUN         curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin
RUN         curl -LsS http://symfony.com/installer -o /usr/local/bin/symfony && chmod a+x /usr/local/bin/symfony

# configure services
ADD         nginx.conf /etc/nginx/
ADD         symfony.src.conf /etc/nginx/sites-available/
ADD         plain.src.conf /etc/nginx/sites-available/
ADD         src.ini /etc/php5/fpm/conf.d/
ADD         src.ini /etc/php5/cli/conf.d/
ADD         pool.conf /etc/php5/fpm/pool.d/

RUN         ln -s /etc/nginx/sites-available/symfony.src.conf /etc/nginx/sites-enabled/symfony.src
RUN         ln -s /etc/nginx/sites-available/plain.src.conf /etc/nginx/sites-enabled/plain.src
RUN         rm /etc/nginx/sites-enabled/default

# mount
VOLUME      /var/www
WORKDIR     /var/www

CMD         service php5-fpm start && nginx

EXPOSE      80
EXPOSE      8080
EXPOSE      443