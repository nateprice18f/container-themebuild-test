FROM composer:latest AS composer-builder

ARG BUID=1000
ARG BGID=1000
ARG BUILD_ENV
ENV BUILD_ENV ${BUILD_ENV:-none}

COPY --chown=www-data:www-data composer.json /var/www/composer.json
COPY --chown=www-data:www-data composer.lock /var/www/composer.lock
COPY --chown=www-data:www-data patches /var/www/patches

# pulled from composer.json installer-paths
RUN mkdir -p /var/www \
    && mkdir -p /var/www/vendor \
    && mkdir -p /var/www/web \
    && mkdir -p /var/www/web/core \
    && mkdir -p /var/www/web/libraries \
    && mkdir -p /var/www/web/modules \
    && mkdir -p /var/www/web/modules/contrib \
    && mkdir -p /var/www/web/modules/custom \
    && mkdir -p /var/www/web/profiles \
    && mkdir -p /var/www/web/profiles/contrib \
    && mkdir -p /var/www/web/profiles/custom \
    && mkdir -p /var/www/web/themes \
    && mkdir -p /var/www/web/themes/contrib \
    && mkdir -p /var/www/web/themes/custom \
    && mkdir -p /var/www/drush \
    && mkdir -p /var/www/drush/Commands \
    && mkdir -p /var/www/drush/Commands/contrib \
    && chown www-data:www-data /var/www \
    && chown www-data:www-data /var/www/vendor \
    && chown www-data:www-data /var/www/web \
    && chown www-data:www-data /var/www/web/core \
    && chown www-data:www-data /var/www/web/libraries \
    && chown www-data:www-data /var/www/web/modules \
    && chown www-data:www-data /var/www/web/modules/contrib \
    && chown www-data:www-data /var/www/web/modules/custom \
    && chown www-data:www-data /var/www/web/profiles \
    && chown www-data:www-data /var/www/web/profiles/contrib \
    && chown www-data:www-data /var/www/web/profiles/custom \
    && chown www-data:www-data /var/www/web/themes \
    && chown www-data:www-data /var/www/web/themes/contrib \
    && chown www-data:www-data /var/www/web/themes/custom \
    && chown www-data:www-data /var/www/drush \
    && chown www-data:www-data /var/www/drush/Commands \
    && chown www-data:www-data /var/www/drush/Commands/contrib

USER www-data

RUN composer -n config --global allow-plugins true \
    && composer global require --dev drupal/coder php-parallel-lint/php-parallel-lint monolog/monolog\
    && COMPOSER_DIR=$(composer -n config --global home) && echo $COMPOSER_DIR \
    && $COMPOSER_DIR/vendor/bin/phpcs --config-set installed_paths $COMPOSER_DIR/vendor/drupal/coder/coder_sniffer,$COMPOSER_DIR/vendor/sirbrillig/phpcs-variable-analysis,$COMPOSER_DIR/vendor/slevomat/coding-standard
RUN COMPOSER_MEMORY_LIMIT=-1 composer install --ignore-platform-reqs --no-interaction --optimize-autoloader \
    && chown www-data:www-data /var/www/composer.json /var/www/composer.lock
WORKDIR /var/www
