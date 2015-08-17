# PHP docker development env
FROM        ubuntu:15.04

# basic env fix
ENV         TERM xterm

# install packages
RUN         apt-get update && apt-get dist-upgrade -y
RUN         apt-get install -y htop nano curl acl \
            nginx php5-common php5-cli php5-fpm php5-mcrypt php5-mysql php5-apcu php5-gd php5-imagick php5-curl php5-intl

RUN         curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer
RUN         curl -LsS http://symfony.com/installer -o /usr/local/bin/symfony && chmod a+x /usr/local/bin/symfony

# configure services
ADD         development_tools/cluster_config/app/nginx.conf /etc/nginx/
ADD         development_tools/cluster_config/app/src.conf /etc/nginx/sites-available/
ADD         development_tools/cluster_config/app/src.ini /etc/php5/fpm/conf.d/
ADD         development_tools/cluster_config/app/src.ini /etc/php5/cli/conf.d/
ADD         development_tools/cluster_config/app/pool.conf /etc/php5/fpm/pool.d/

RUN         ln -s /etc/nginx/sites-available/src.conf /etc/nginx/sites-enabled/src
RUN         rm /etc/nginx/sites-enabled/default

ADD         . /var/www

RUN         cd /var/www/framework && app/console --env=prod cache:warmup
RUN         cd /var/www/framework && app/console --env=prod assets:install
RUN         cd /var/www/framework && chmod -R 777 app/cache && chmod -R 777 app/logs

# mount
VOLUME      /var/www
WORKDIR     /var/www

EXPOSE      80

CMD         service php5-fpm restart && nginx