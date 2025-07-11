# Booking System

A simple booking system built with Laravel.

## Requirements
- PHP >= 8.0
- Composer
- MySQL or other supported database

## Setup
1. Clone the repository:
   ```bash
   git clone <repo-url>
   cd booking-system
   ```
2. Install dependencies:
   ```bash
   composer install
   ```
3. Copy the example environment file and edit as needed:
   ```bash
   cp .env.example .env
   ```
4. Generate application key:
   ```bash
   php artisan key:generate
   ```
5. Set up your database credentials in `.env`.
6. Run migrations:
   ```bash
   php artisan migrate
   ```
7. (Optional) Seed the database:
   ```bash
   php artisan db:seed
   ```

## Running Tests
To run all tests:
```bash
php artisan test
```

## API Documentation
After starting the local server (`php artisan serve`), open:
```
http://localhost:8000/api/documentation
```
This page provides interactive Swagger (OpenAPI) documentation for all API endpoints.

## License
MIT
