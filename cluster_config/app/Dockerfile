FROM ubuntu:15.04

VOLUME /var/www/src

RUN apt-get update
RUN apt-get install -y nginx php5-common php5-cli php5-fpm php5-mcrypt php5-mysql php5-apcu php5-gd \
                       php5-imagick php5-curl php5-intl

ADD nginx.conf /etc/nginx/
ADD sf.src.conf /etc/nginx/sites-available/
ADD plain.src.conf /etc/nginx/sites-available/
ADD src.ini /etc/php5/fpm/conf.d/
ADD src.ini /etc/php5/cli/conf.d/
ADD pool.conf /etc/php5/fpm/pool.d/

RUN ln -s /etc/nginx/sites-available/sf.src.conf /etc/nginx/sites-enabled/sf
RUN ln -s /etc/nginx/sites-available/plain.src.conf /etc/nginx/sites-enabled/plain
RUN rm /etc/nginx/sites-enabled/default
RUN usermod -u 1000 www-data

CMD ["nginx"]

EXPOSE 80
EXPOSE 443