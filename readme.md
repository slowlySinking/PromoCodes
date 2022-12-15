1. create and fill `.env` file
2. run `composer install`
3. run `docker-compose up -d`
4. go to docker container `docker container exec -it php bash`
5. create tables: run `php src/console/migrateTables.php`
6. generate promo codes: run `php src/console/generatePromocodes.php`
7. run php build-in server `php -S 0.0.0.0:8008`
