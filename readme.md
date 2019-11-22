###Composer
```shell script
docker run --rm --interactive --tty --volume ${PWD}:/app composer install --ignore-platform-reqs --no-scripts
docker run --rm --interactive --tty --volume ${PWD}:/app composer dump-autoload -o
```

###Migrate
```shell script
docker exec lum_php php artisan migrate:fresh --seed
```

###Cache clear
```shell script
docker exec lum_php bash -c "php artisan cache:clear && php artisan route:cache && php artisan config:clear && php artisan view:clear"
```


docker-compose -f ".\docker\dev\docker-compose.yml" up -d --build
docker-compose -f ".\docker\dev\docker-compose.yml" down

docker-compose -f ".\docker\prod\docker-compose-prod.yml" up -d --build
