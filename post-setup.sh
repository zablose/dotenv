#!/usr/bin/env bash

set -e

bin=/usr/local/bin

. "${bin}/exit-if-root"
. "${bin}/exit-if-locked"
. "${bin}/functions.sh"

dir_web=${ZDI_DIR_WEB}
user=${ZDI_USER_NAME}

user_home=/home/${user}
user_bin=${user_home}/bin
composer=${user_bin}/composer
log=/var/log/zdi-post-setup-php-fpm.log

. "${user_bin}/functions.sh"

{
    show_info 'Php-fpm post setup.'

    cd "${dir_web}"
    ${composer} install
    php -d zend_extension=xdebug.so -d xdebug.mode=coverage vendor/bin/phpunit

    show_success "Php-fpm post setup complete. Log file '${log}'."

} 2>&1 | sudo tee ${log}
