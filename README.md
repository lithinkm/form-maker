The project is intended for creating dynamic forms from admin side for public users and storing the user data. 

Steps required for installation after downloading repository

Step 1 (optional): 
php artisan composer:update

Step 2 : 
php artisan migrate

Step 3: php artisan db:seed --class=AdminsTableSeeder

Step 4: Goto **form-maker\database\seeders\AdminsTableSeeder.php** file for user credentials

**Home URL : http://localhost/form-maker/home

Admin URL : http://localhost/form-maker/admin**

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

