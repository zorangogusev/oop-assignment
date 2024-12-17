FROM ubuntu:24.04

# Update Ubuntu OS and install required packages
RUN apt-get update && apt-get -y upgrade && apt-get -y install \
    apache2 \
    curl \
    lynx \
    git \
    zip \
    unzip \
    rsync \
    nano \
    ssh \
    supervisor \
    lsb-release \
    ca-certificates \
    apt-transport-https \
    software-properties-common \
    wget \
    gnupg && \
    rm -rf /var/lib/apt/lists/*

# Install PHP 8.3 and related packages
RUN apt-get update && apt-get -y install \
    php8.3 \
    libapache2-mod-php8.3 \
    php8.3-mysql \
    php8.3-curl \
    php8.3-xdebug \
    php8.3-zip \
    php8.3-mbstring \
    php8.3-xml \
    php8.3-gd \
    php8.3-memcache \
    php8.3-intl \
    php-pear \
    php8.3-dev \
    php8.3-redis \
    php8.3-sqlite3 \
    php8.3-bcmath && \
    rm -rf /var/lib/apt/lists/*

# Enable Apache mods
RUN a2enmod php8.3
RUN a2enmod rewrite

# Install Redis PHP extension
RUN pecl install redis && \
    echo "extension=redis.so" > /etc/php/8.3/apache2/conf.d/30-redis.ini && \
    echo "extension=redis.so" > /etc/php/8.3/cli/conf.d/30-redis.ini

# Copy Xdebug configuration based on the detected PHP version
COPY .docker/dev/20-xdebug.ini /etc/php/8.3/mods-available/xdebug.ini

# Update PHP.ini settings
RUN sed -i "s/short_open_tag = Off/short_open_tag = On/" /etc/php/*/apache2/php.ini && \
    sed -i "s/error_reporting = .*$/error_reporting = E_ERROR | E_WARNING | E_PARSE/" /etc/php/*/apache2/php.ini

## Install nvm
#RUN curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.1/install.sh | bash
## Source nvm script to make it available in the shell
#SHELL ["/bin/bash", "-c"]
## Install node.js v20.12.0 and npm
#RUN source ~/.nvm/nvm.sh && \
#    nvm install 20.12.0 && \
#    nvm use 20.12.0

# Set Apache environment variables
ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/log/apache2
ENV APACHE_LOCK_DIR /var/lock/apache2
ENV APACHE_PID_FILE /var/run/apache2.pid

# Copy Apache site configuration
COPY .docker/dev/oop_assignment.test.conf /etc/apache2/sites-available/oop_assignment.test.conf
RUN a2ensite oop_assignment.test.conf

# Expose ports
EXPOSE 80
EXPOSE 22

# Configure SSH
#RUN mkdir /var/run/sshd
RUN sed -i 's/PermitRootLogin prohibit-password/PermitRootLogin yes/' /etc/ssh/sshd_config
RUN sed -i 's/#PermitRootLogin yes/PermitRootLogin yes/' /etc/ssh/sshd_config
RUN echo "root:zoran" | chpasswd

# Configure Supervisor
RUN mkdir -p /var/log/supervisor
COPY .docker/dev/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Set project-specific environment variables
ENV XDEBUG_CONFIG "idekey=PHPSTORM"

# Start Supervisor
CMD ["/usr/bin/supervisord"]
