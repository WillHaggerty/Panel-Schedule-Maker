# Panel-Schedule-Maker
Make panel schedules for electrical panels

Based on the Laravel framework.

Requirements:

-- Apache w/PHP & MySQL/MariaDB

-- Allow the use of .htaccess in "public". You may also need to add "Options FollowSymLinks" to the apache config for your directory.

To install:

-- Clone the MASTER branch using "git clone https://github.com/WillHaggerty/Panel-Schedule-Maker.git" to a folder that is not being served by a webserver (ie: /var/www, not /var/www/html).

-- Ensure that the "storage" directory is writable by the server.

-- After cloning, run "composer install". This will install the dependencies for laravel.

-- Then rename ".env.example" to ".env" and open the file to input your SQL DB creds. You should also set your APP_URL at this time.

-- Then run "php artisan key:generate".

-- Then run "php artisan migrate", this will setup the database.
