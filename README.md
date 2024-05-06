Project: Laraveltest

Description:
Implement a banking system with two types of users: Individual and Business. The system should
support deposit and withdrawal operations for both types of users.

Prerequisites:
- PHP >= 8.1
- Composer (https://getcomposer.org/)
- MySQL or any other compatible database

Installation:
1. Clone the repository:
   git clone https://github.com/nayemislam99/coding-test.git

2. Navigate to the project directory:
   cd coding-test

3. Install composer dependencies:
   composer install

4. Create a `.env` file by copying the `.env.example` file:
   cp .env.example .env

5. Generate an application key:
   php artisan key:generate

6. Set up your database in the `.env` file:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bankinfo
DB_USERNAME=root
DB_PASSWORD=

7. Run migrations to create database tables:
   php artisan migrate

8. Seed the database with initial data (if available):
php artisan db:seed --class=TransactionSeed
php artisan db:seed --class=UserSeeder

user name: admin@gmail.com
password: password

9. php artisan serve
