## About Tutoring site
Tutoring site is a web application which allow user to book a tutoring session online or register to be a tutor

## Requirement
php 7.4 or above
MySQL

## How to run Tutoring site

Because this web application is built upon Laraval, basically you should be able to run php artisan commands to get started

1. set up your MySQL database and configuring database setting in .env file under root folder
    For example:
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=tutor_site
        DB_USERNAME=root
        DB_PASSWORD=
2. run `php artisan migrate` from commandline under root folder to migrate database

3. run `php artisan serve`, then you will be able to see the demo of this web application from localhost:8000
