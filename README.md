## Installation:
### 1. install web server
```
$ sudo apt update
$ sudo apt install nginx
$ sudo systemctl start nginx
$ sudo systemctl enable nginx
```
### 2. install php
```
$ sudo apt install php php-fpm php-apcu php-curl php-cli php-pgsql php-gd php-mcrypt php-mbstring php-fdomdocument php-intl unzip
```
### 3. install database
```
$ sudo apt install postgresql libpq5 postgresql-9.5 postgresql-client-9.5 postgresql-client-common postgresql-contrib
$ sudo -i -u postgres
$ psql
# CREATE USER newuser WITH PASSWORD 'somepassword';
# CREATE DATABASE "my-db";
# GRANT ALL ON DATABASE "my-db" TO newuser;
# \q
$ exit
```
### 4. install git
```
$ sudo apt install git
```
### 5. install composer
```
$ cd ~
$ curl -sS https://getcomposer.org/installer -o composer-setup.php
$ sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer
```
### 6. Install supervisor
```
$ sudo apt-get install supervisor
```

## Set up:
### 1. clone repository
```
$ cd /var/www/html
$ git clone https://github.com/esskaz/supertrack.git .
```
### 2. download dependencies
```
$ composer install
```
### 3. create enviroment file
```
$ cp .env.example .env
```
### 5. generate application key
```
$ php artisan key:generate
```
### 6. in .env set application parameters, database connection (credentials on step 3 of installation), smtp and sms gateway configurations.
```
APP_NAME=Laravel
APP_ENV=prod # set to prod when in production
APP_KEY= # key should be generated on step 5
APP_DEBUG=false # set to false in production
APP_URL=http://localhost

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=my-db
DB_USERNAME=newuser
DB_PASSWORD=somepassword

MAIL_DRIVER=smtp
MAIL_HOST=
MAIL_PORT=25
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=
MAIL_FROM_NAME="${APP_NAME}"

SMS_SENDER=
SMS_LOGIN=
SMS_PASSWORD=

```
### 7. run database migrations
```
$ php artisan migrate
```
### 8. configure web server
```
$ sudo nano /etc/nginx/sites-available/default
```
File should looke like this

```
server {
    listen 80;
    server_name example.com;
    root /var/www/html/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-XSS-Protection "1; mode=block";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

Restart web server
```
sudo systemctl restart nginx
```
### 9. run queue worker
Create file /etc/supervisor/conf.d/laravel-worker.conf
```
[program:laravel-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/html/artisan queue:work database --sleep=3 --tries=3
autostart=true
autorestart=true
user=ess
numprocs=8
redirect_stderr=true
stdout_logfile=/var/www/html/storage/logs/worker.log
stopwaitsecs=3600
```
Run worker process
```
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start laravel-worker:*
```
