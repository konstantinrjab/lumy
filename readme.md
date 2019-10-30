###Composer
```shell script
docker run --rm --interactive --tty --volume ${PWD}:/app composer install --ignore-platform-reqs --no-scripts
docker run --rm --interactive --tty --volume ${PWD}:/app composer dump-autoload
```

###Migrate
```shell script
docker exec lum_php php artisan migrate:fresh --seed
```

###Cache clear
```shell script
docker exec lum_php bash -c "php artisan cache:clear && php artisan route:cache && php artisan config:clear"
```
123
