# Short Link

Simple API for short link creation.

## Run for develop

```bash
docker-compose -f docker-compose.local.yml up -d
docker-compose -f docker-compose.local.yml exec --user=short-link workspace bash
php artisan migrate
```

Application will run on 8888 port.

## Tests

```bash
docker-compose -f docker-compose.testing.yml up -d
docker-compose -f docker-compose.testing.yml exec --user=short-link workspace bash
APP_ENV=testing php artisan migrate
vendor/bin/phpunit
```
