#!/bin/bash

if [ $(phpenv version-name) != "hhvm" ]; then
    pecl channel-update pecl.php.net

    if [ $(phpenv version-name) = "7.0" ]; then
        echo "yes" | pecl install apcu-5.1.2
        pecl install apcu_bc
    else
        echo "yes" | pecl install apcu-4.0.10
    fi

    phpenv config-add tests/conf/apcu.ini
fi

composer self-update && composer install
