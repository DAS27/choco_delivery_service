# Smart-Delivery Backend

This repository contains the delivery service code for the website https://Order.kz/, written in Laravel.

## About

The project is based on Laravel and implements clean architecture principles based on the module architecture. The API uses the JSON:API standard for building APIs in JSON.

## Appendix

This application uses modern software architectural pattern that offers developers a comprehensive set of guidelines, principles, and patterns to organize their code in a highly maintainable and reusable way.

## Prerequisites

Before you begin, ensure you have met the following requirements:

- PHP 8.2
- PostgresSQL

## Installation

To install the project, follow these steps:

1. Clone the repository.
2. Install dependencies with `composer install`.
3. Set up your .env file to match your database settings.
4. Run the migrations with `php artisan migrate --seed`. Note seed is important for create basic entries.
5. Run `php artisan key:generate` to generate encryption keys.
6. Run `php artisan storage:link` to create symlink to storage folder.

## Usage

After installation, you can start the server with `php artisan serve` and access the API endpoints.

## Deployment

To deploy this project you need first fix code formatting and then check for errors. So you need to run 3 commands:

```bash
  make fix
  make check
  make test
```

Last command is for running phpunit tests.

Checking will proceed code audit by following criterias:
- Code sniffer, using Laravel Pint
- PHP Linter for checking syntax errors
- Rector to instantly upgrades and refactors the PHP code of application
- Static analyzer tool phpstan.
- Managing dependencies via deptrac, controlling all layers.
- command `composer audit`
- command `composer validate`
