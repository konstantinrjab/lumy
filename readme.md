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

###Docker compose
```shell script
DOCKER_USER=$(id -u):$(id -g) docker-compose -f ".\docker\dev\docker-compose.yml" up -d --build
DOCKER_USER=$(id -u):$(id -g) docker-compose -f ".\docker\dev\docker-compose.yml" down
```

####Certbot certificate renewal
docker run -it --rm --name certbot -v "prod_lum_certs:/etc/letsencrypt" -v "prod_lum_certs_data:/var/www/certbot" certbot/certbot:v0.30.0 certonly --webroot --webroot-path /var/www/certbot --email krforgames@gmail.com -d lumy.photo -d backend.lumy.photo
