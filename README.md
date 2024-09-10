# Simple Laravel API Demo

# Getting Started with create Laravel project

This project was bootstrapped with [create Laravel project](https://laravel.com/docs/11.x/installation#creating-a-laravel-project)

## Feature

### Tech stack

- PHP 8.2
- Laravel 11
- Composer v2
- SQlite

### Topic

This project is a REST API demo includes Laravel's job queues, database operations and event handling. 

## Setup

In the project directory, you can run:

### `composer install`

To install project dependency packages

Then run:
### `php artisan migrate` 
To init the database schema

Then run:
### `php artisan serve` 
to run the app in the development mode.

Finally, please run:

### `php artisan queue:work`
To launch the queue server.

## Test

After setup, you can test project by sending POST request to [http://localhost:8000/api/submissions] (http://localhost:8000/api/submissions) with the following JSON input to check the result

```
{
    "name": "demo",
    "email": "demo@example.com",
    "message": "demo message"
}
```

## Unit test

In the project directory, you can run:

### `php artisan test`

To run unit test