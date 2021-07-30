<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Exercise Description
Create a single page application that uses the database provided (SQLite 3) to list and
categorize country phone numbers.
Phone numbers should be categorized by country, state (valid or not valid), country code and
number.
The page should render a list of all phone numbers available in the DB. It should be possible to
filter by country and state. Pagination is an extra.

## Installation Guide

1. Clone the repo.
2. Change the working directory to project directory using `cd phone-numbers-categorization`.
3. Execute the following command `Composer install` to install dependencies.
4. Copy `database/sample.db` to `database/database.sqlite` using the following command `sudo cp database/sample.db database/database.sqlite`.
5. Copy `.env.example` to `.env` and change `DB_DATABASE` to sqlite database absolute path `database/database.sqlite`.
6. Run php server using `php artisan serve`.
7. Run `npm install && npm run dev`.
8. Navigate to `http://127.0.0.1:8000/` on the browser.

## Important Note

I already cache the mapped phone number records to save processing time for subsequent requests on retrieved customers from database.
In case of maintaining the application and adding add/update/delete operations or even changing regex, we should flush the cache for key `mapped-phone-numbers`.

## Integration Testing

You can run the test cases to ensure everything is working properly using the following command `php artisan test`.
