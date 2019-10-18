docker run --rm --interactive --tty --volume ${PWD}:/app composer install --ignore-platform-reqs --no-scripts

docker exec lum_php php artisan migrate:fresh --seed

docker run --rm --interactive --tty --volume ${PWD}:/app composer dump-autoload
