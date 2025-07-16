
> ### Laravel api codebase containing (auth) that adheres to the spec and API.

This repo is functionality complete — PRs and issues welcome!

----------

# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/10.x/installation)

Alternative installation is possible without local dependencies relying on [Docker](#docker). 

Clone the repository

    git clone git@github.com:ramsmunoz/tasks-app.git

Switch to the repo folder

    cd tasks-app

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Create Fonts folder for Temporal files needed by DomPDF
    
    mkdir -p storage/fonts

Generate a new application key

    php artisan key:generate


Install mysql latest version and create a database for this project and assign a user with grant permissions

Add database connection info to .env and clear the config

    php artisan config:clear

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Run the database seed

    php artisan db:seed

Start the local development server or config laravel valet new site

    php artisan serve

You can now access the server at http://localhost:8000

**TL;DR command list**

    git clone git@github.com:ramsmunoz/tasks-app.git
    cd tasks-app
    composer install
    cp .env.example .env
    php artisan key:generate
    // All mysql install and config stuff
    php artisan config:clear
    php artisan migrate
    php artisan serve
    
**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php artisan serve

## Database seeding

**Populate the database with seed data with relationships which includes users, articles, comments, tags, favorites and follows. This can help you to quickly start testing the api or couple a frontend and start using it with ready content.**

Run the database seeder and check access on your database and you're done

    php artisan db:seed

***Note*** : It's recommended to have a clean database before seeding. You can refresh your migrations at any point to clean the database by running the following command

    php artisan migrate:refresh
    
## Docker

To install with [Docker](https://www.docker.com), run following commands: (After mysql install and config for tasks-app)

```
git clone git@github.com:ramsmunoz/tasks-app.git
cd tasks-app
// Put mysql config and set DB_HOST=host.docker.internal on env file
cp .env.example .env
// Start docker on your system
docker build -t tasks-app .
// Run and navigate to http://localhost on your browser
docker run -dp 80:80 tasks-app
// Enter to bash console of running container
docker ps
// Copy container id and run
docker exec -it <myContainerId> bash
```

The api can be accessed at [http://localhost/api](http://localhost/api).

For Windows development [option 2](https://github.com/ARGHZ/docker-laravel-8) may help. WSL2 is mandatory for this set up. It was forked from [here](https://github.com/supermavster/docker-laravel-8).

## API Specification

This application uses jwt auth with bearer token, you can test it with postman or alternative software

----------

## Folders

- `app` - Contains all the Eloquent models
- `app/Http/Controllers/Api` - Contains all the api controllers
- `config` - Contains all the application configuration files
- `database/migrations` - Contains all the database migrations
- `database/seeds` - Contains the database seeder
- `routes` - Contains all the api routes defined in api.php file

## Environment variables

- `.env` - Environment variables can be set in this file

***Note*** : You can quickly set the database information and other variables in this file and have the application fully working.

----------

# Testing API

Run the laravel development server

    php artisan serve

The api can now be accessed at

    http://localhost:8000/api

Request headers

| **Required** 	| **Key**              	| **Value**            	|
|----------	|------------------	|------------------	|
| Yes      	| Content-Type     	| application/json 	|
| Yes      	| X-Requested-With 	| XMLHttpRequest   	|
| Optional 	| Authorization    	| Token {JWT}      	|

Refer the [api specification](#api-specification) for more info.

----------

# Cross-Origin Resource Sharing (CORS)
 
This applications has CORS enabled by default on all API endpoints. The default configuration allows requests from `http://localhost:3000` and `http://localhost:4200` to help speed up your frontend testing. The CORS allowed origins can be changed by setting them in the config file. Please check the following sources to learn more about CORS.
 
- https://developer.mozilla.org/en-US/docs/Web/HTTP/Access_control_CORS
- https://en.wikipedia.org/wiki/Cross-origin_resource_sharing
- https://www.w3.org/TR/cors
