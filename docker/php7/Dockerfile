FROM php:7.1-fpm

### Install some requirements
RUN apt-get update && apt-get install -y git zlib1g-dev libmcrypt-dev supervisor openssh-server \
    --no-install-recommends \
    && mkdir -p /var/log/supervisor \
    && mkdir -p /var/run/sshd \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install bcmath mbstring opcache pcntl zip mcrypt pdo pdo_mysql mysqli

RUN apt-get update && apt-get install -y libicu-dev \
    --no-install-recommends

RUN docker-php-ext-install intl

RUN docker-php-ext-install exif

RUN apt-get update && apt-get install -y libpng-dev \
    --no-install-recommends
RUN docker-php-ext-install gd

#Add composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN compose --version

# Set timezone
RUN rm /etc/localtime
RUN ln -s /usr/share/zoneinfo/Europe/Paris /etc/localtime
RUN "date"

# install xdebug
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug
RUN echo "error_reporting = E_ALL" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "display_startup_errors = On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "display_errors = On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.remote_enable=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.remote_connect_back=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.idekey=\"PHPSTORM\"" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.remote_port=9001" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.cli_color=1\nxdebug.remote_autostart=1\nxdebug.remote_connect_back=1" > /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini


#COPY supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

COPY php.ini /tmp/php.ini_extension
RUN cat /tmp/php.ini_extension >> /usr/local/etc/php/php.ini \
    && rm /tmp/php.ini_extension

#COPY php-fpm.conf /usr/local/etc/php-fpm.conf

RUN usermod -u 1000 www-data

# SSH configuration to connect on development environment with the interpreter
#RUN echo 'root:Minh@jSunn@' | chpasswd
#RUN sed -i 's/PermitRootLogin without-password/PermitRootLogin yes/' /etc/ssh/sshd_config \
#    && sed 's@session\s*required\s*pam_loginuid.so@session optional pam_loginuid.so@g' -i /etc/pam.d/sshd
#RUN echo "export VISIBLE=now" >> /etc/profile

#CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]

RUN echo 'alias sf="php app/console"' >> ~/.bashrc
RUN echo 'alias sf3="php bin/console"' >> ~/.bashrc

WORKDIR /var/www/

# Make ssh dir
RUN mkdir /root/.ssh/
