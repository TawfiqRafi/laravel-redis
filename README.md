<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
    <a href="https://github.com/TawfiqRafi/laravel-redis/actions"><img src="https://github.com/TawfiqRafi/laravel-redis/workflows/tests/badge.svg" alt="Build Status"></a>
    <a href="https://packagist.org/packages/tawfiqrafi/laravel-redis"><img src="https://img.shields.io/packagist/dt/tawfiqrafi/laravel-redis" alt="Total Downloads"></a>
    <a href="https://packagist.org/packages/tawfiqrafi/laravel-redis"><img src="https://img.shields.io/packagist/v/tawfiqrafi/laravel-redis" alt="Latest Stable Version"></a>
    <a href="https://packagist.org/packages/tawfiqrafi/laravel-redis"><img src="https://img.shields.io/packagist/l/tawfiqrafi/laravel-redis" alt="License"></a>
</p>

# Laravel Redis Project

This Laravel project integrates Predis for Redis functionality. Follow the steps below to set up and run the project.

## Getting Started

1. **Clone the Repository**

    ```bash
    git clone https://github.com/TawfiqRafi/laravel-redis.git
    cd laravel-redis
    ```

2. **Install Dependencies and Predis**

    ```bash
    composer require predis/predis
    ```

3. **Set up Environment Variables**

    - Create a copy of the `.env.example` file and name it `.env`.
    - Configure your database settings in the `.env` file.

4. **Create Person Table**

    ```bash
    php artisan migrate
    ```

5. **Import Database from `test_data.sql`**

    Ensure you have a database created and configured in your `.env` file. Then import the database using:

    ```bash
    php artisan db:seed --class=TestDataSeeder
    ```

    Alternatively, if you have a `test_data.sql` file, you can directly import it:

    ```bash
    mysql -u your-database-username -p your-database-name < test_data.sql
    ```

6. **Run the Project**

    ```bash
    php artisan serve
    ```

    Your Laravel application should now be accessible at [http://localhost:8000](http://localhost:8000).

## Contributing

Thank you for considering contributing to the Laravel Redis project! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

Please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct) to ensure a welcoming community.

## Security Vulnerabilities

If you discover a security vulnerability within Laravel Redis, please send an email to [rafi.6amtech@gmail.com](mailto:rafi.6amtech@gmail.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel Redis Project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
