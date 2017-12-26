FROM ubuntu:16.04

ENV LC_ALL=C.UTF-8 \
    TERM=xterm \
    DEBIAN_FRONTEND=noninteractive

ADD configs/supervisor.app.conf /etc/supervisor/conf.d/app.conf
ADD configs/nginx.conf /etc/nginx/conf.d/nginx.conf

RUN apt-get update -y \
    && apt-get install -y software-properties-common \
    python3-software-properties \
    python-software-properties \
    git \
    wget \
    acl

RUN add-apt-repository "deb http://archive.ubuntu.com/ubuntu $(lsb_release -sc) main universe"

ADD https://dl.yarnpkg.com/debian/pubkey.gpg /tmp/yarn-pubkey.gpg

RUN apt-key add /tmp/yarn-pubkey.gpg && rm /tmp/yarn-pubkey.gpg
RUN echo "deb http://dl.yarnpkg.com/debian/ stable main" > /etc/apt/sources.list.d/yarn.list

RUN wget https://phar.phpunit.de/phpunit.phar && chmod +x phpunit.phar && mv phpunit.phar /usr/local/bin/phpunit

RUN add-apt-repository -y ppa:ondrej/php \
    && apt-get update -y \
    && apt-get install -y \
        apt-transport-https \
        iputils-ping \
        netbase \
        curl \
        unzip \
        yarn \

        nginx \
        supervisor \

        php7.1-cli \
        php7.1-fpm \
        php7.1-intl \
        php7.1-iconv \
        php7.1-json \
        php7.1-mysql \
        php7.1-mbstring \
        php7.1-xml \
        php7.1-curl \
        php7.1-dom \
        php7.1-gd \
        php7.1-xdebug \

    && echo "xdebug.idekey=PHPSTORM" >> /etc/php/7.1/mods-available/xdebug.ini \
    && echo "xdebug.remote_enable=1" >> /etc/php/7.1/mods-available/xdebug.ini \
    && echo "xdebug.remote_host=172.18.0.1" >> /etc/php/7.1/mods-available/xdebug.ini \
    && chown root: /etc/supervisor/conf.d/app.conf && chown 644 /etc/supervisor/conf.d/app.conf \
    && mkdir -p /var/run/php && mkdir -p /var/log/php-fpm \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && chmod +x /cache.sh

ENV NPM_CONFIG_LOGLEVEL info
ENV NODE_VERSION 7.10.1

RUN groupadd --gid 1000 node \
  && useradd --uid 1000 --gid node --shell /bin/bash --create-home node

# gpg keys listed at https://github.com/nodejs/node#release-team
RUN set -ex \
  && for key in \
    9554F04D7259F04124DE6B476D5A82AC7E37093B \
    94AE36675C464D64BAFA68DD7434390BDBE9B9C5 \
    FD3A5288F042B6850C66B31F09FE44734EB7990E \
    71DCFD284A79C3B38668286BC97EC7A07EDE3FC1 \
    DD8F2338BAE7501E3DD5AC78C273792F7D83545D \
    B9AE9905FFD7803F25714661B63B535A4C206CA9 \
    C4F0DFFF4E8C1A8236409D08E73BC641CC11F4C8 \
    56730D5401028683275BD23C23EFEFE93C4CFFFE \
  ; do \
    gpg --keyserver pgp.mit.edu --recv-keys "$key" || \
    gpg --keyserver keyserver.pgp.com --recv-keys "$key" || \
    gpg --keyserver ha.pool.sks-keyservers.net --recv-keys "$key" ; \
  done

RUN curl -SLO "https://nodejs.org/dist/v$NODE_VERSION/node-v$NODE_VERSION-linux-x64.tar.xz" \
  && curl -SLO --compressed "https://nodejs.org/dist/v$NODE_VERSION/SHASUMS256.txt.asc" \
  && gpg --batch --decrypt --output SHASUMS256.txt SHASUMS256.txt.asc \
  && grep " node-v$NODE_VERSION-linux-x64.tar.xz\$" SHASUMS256.txt | sha256sum -c - \
  && tar -xJf "node-v$NODE_VERSION-linux-x64.tar.xz" -C /usr/local --strip-components=1 \
  && rm "node-v$NODE_VERSION-linux-x64.tar.xz" SHASUMS256.txt.asc SHASUMS256.txt \
  && ln -s /usr/local/bin/node /usr/local/bin/nodejs

CMD ["sh", "/cache.sh"]

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/supervisord.conf", "--nodaemon"]