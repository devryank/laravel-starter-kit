<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Introduction
Laravel 8 starter kit with some package that provide you to build website more faster. 

## Include
- <a href="https://laravel-livewire.com/">Laravel Livewire 2.0</a>
- <a href="https://github.com/nascent-africa/jetstrap">Jetstrap 2.2</a>
- <a href="https://laratrust.santigarcor.me/">Laratrust 6.3</a>
- <a href="https://github.com/tabuna/breadcrumbs">Tabuna Breadcrumbs 2.3</a>
- <a href="https://github.com/puikinsh/concept">Concept Dashboard</a>


## Installation
Run these command from your terminal 
```
git clone https://github.com/devryank/laravel-starter-kit
```
- rename ``.env.example`` to ``.env``
- setting your env
- Composer command
```
composer install
composer dump-autoload
```
- Artisan command
```
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
```

## Demo Credentials
### Superadmin
email : superadmin@app.test

password : password

### Admin
email : admin@app.test

password : password

### User
email : user@app.test

password : password

## Setting Permission
You can see setting for permission in ``config/laratrust-seeder.php``

Superadmin :
- Roles
  - Create
  - Read
  - Update
  - Delete
- Permissions
  - Create
  - Read
  - Update
  - Delete
- Users
  - Create
  - Read
  - Update
  - Delete

Admin :
- Users
  - Read (all users)
  - Update (own profile)

User :
- Users 
  - Read (own profile)
  - Update (own profile)

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).