#!/bin/sh
mkdir -p deps
(cd deps; curl -sS https://getcomposer.org/installer | php)
php deps/composer.phar create-project slim/slim-skeleton api
