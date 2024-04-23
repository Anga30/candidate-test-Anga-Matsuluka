#!/usr/bin/env bash
ACTION="$1"
ARG1="$2"
ARG2="$3"
ARG3="$4"

cd sugarcrm/laravel

if [[ $ACTION == "migrate" ]]
then
    php artisan migrate
elif [[ $ACTION == "inspire" ]]
then
    php artisan inspire
elif [[ $ACTION == "create-module" ]]
then
    php artisan sugarcrm-modules:make $ARG1
    composer dump-autoload
elif [[ $ACTION == "remove-module" ]]
then
    php artisan sugarcrm-modules:remove $ARG1
    composer dump-autoload
elif [[ $ACTION == "composer" ]]
then
    composer $ARG1 $ARG2 $ARG3
elif [[ $ACTION == "build-modules" ]]
then
    php artisan sugarcrm-modules:build
    php artisan migrate
elif [[ $ACTION == "create-unit-test" ]]
then
    php artisan make:test -u $ARG1
elif [[ $ACTION == "create-feature-test" ]]
then
    php artisan make:test $ARG1
elif [[ $ACTION == "test" ]]
then
    php artisan test $ARG1
elif [[ $ACTION == "seed" ]]
then
    php artisan db:seed $ARG1
elif [[ $ACTION == "create-seeder" ]]
then
    php artisan make:seeder $ARG1
elif [[ $ACTION == "create-migration" ]]
then
    php artisan make:migration $ARG1 --path=database/fixed_migrations/
else
    echo "\033[0;31mLook at you running commands I do not understand!";
fi

