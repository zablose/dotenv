#!/usr/bin/env bash

set -e

cd ${DAMP_WEB_DIR}
php /home/${DAMP_USER_NAME}/bin/composer update

php vendor/bin/phpunit
