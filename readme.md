## CRUD (Create Read Update Delete) in a Laravel 5 App

**CRUD (Create Read Update Delete) in a Laravel 5 App** is a tutorial application (in french [there](http://blog.erlem.fr/programmation/developpement-web/framework/33-laravel/193-laravel-5-construire-une-application-crud)).

In this tutorial, we’re going to build and run a simple CRUD application from scratch using Laravel 5.

## Laravel PHP Framework

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, queueing, and caching.

Laravel is accessible, yet powerful, providing powerful tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

## Official Documentation Laval

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

## Tutorial

French tutorial [Laravel 5 - Construire une application CRUD](http://blog.erlem.fr/programmation/developpement-web/framework/33-laravel/193-laravel-5-construire-une-application-crud).

## Installation

- `git clone https://github.com/erlem/tasks-laravel5.git tasks`
- `cd tasks`
- `composer install`
- `mv .env.example .env` rename .env.example
- `php artisan key:generate`
- Connect to a MySQL database `mysql -u root -p`
- Create a MySQL database ``CREATE DATABASE `local.tasks`;``
- Exit `exit;`
- Inform .env (DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD=root)
- `php artisan migrate --seed` to create and populate tables
- `chmod 777 -R storage/` change the folder permissions

## Include

- [Bootstrap](http://getbootstrap.com/) for CSS and jQuery plugins

## Features

- Home page
- Lists Tasks
- Create tasks
- Read tasks
- Update tasks
- Delete tasks

## Packages included

- illuminate/html
- barryvdh/laravel-debugbar

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)