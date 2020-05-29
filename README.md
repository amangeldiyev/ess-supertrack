## Instructions

Installation:
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

Set up:
### 1. clone repository
```
$ cd /var/www/html
$ git clone https://github.com/esskaz/ess-supertrack.git .
```
### 2. download dependecies
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
### 6. in the .env file, add database information to allow connection to the database (credentials on step 3 of installation)
```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=my-db
DB_USERNAME=newuser
DB_PASSWORD=somepassword
```
### 7. run database migrattions
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