# WriteOn

WriteOn is a Laravel-based web application for an online book shop. It allows customers to browse a collection of books, add them to their cart, and checkout. The application also includes an admin panel that provides an interface for managing the book inventory and orders.

## Features

- User authentication and authorization using Laravel's built-in authentication system.
- Admin panel for managing books and orders.
- Filtering and sorting of books by category, author, and title.

## Installation

To install the application, you need to have Composer and Node.js installed on your system. Then, follow these steps:

- Clone the repository: `git clone https://github.com/1337yeeee/WriteOn.git`
- Navigate to the project directory: `cd WriteOn`
- Install PHP dependencies: `composer install`
- Install JavaScript dependencies: `npm install`
- Copy the .env.example file to .env: `cp .env.example .env`
- Set up your database in the .env file
- Run database migrations: `php artisan migrate`
- Run database seeder: `php artisan db:seed`
- Start the development server: `php artisan serve`
- Visit the application in your browser at `http://localhost:8000`

## Usage

After installing the application, you can use it to browse the collection of books, add them to your cart, and checkout using secure payment methods. To access the admin panel, log in using the credentials provided during installation. From the admin panel, you can manage the book inventory, users, and orders.
Credits

WriteOn was created by Anatoly Maksimov. It uses the following open-source libraries and frameworks:

- <a href="https://laravel.com/">Laravel</a>
- <a href="https://jquery.com/">jQuery</a>
