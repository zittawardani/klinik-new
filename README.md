## Overview

## Table of Contents

-   [Requirements](#requirements)
-   [Installation](#installation)
-   [Folder Structure](#folder-structure)
-   [Key Directories](#key-directories)
-   [ERD](#erd)

## Requirements

-   PHP >= 8.0
-   Composer
-   MySQL or PostgreSQL database
-   Node.js & npm (for frontend asset compilation)

## Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/zittawardani/klinik-new.git
    ```
2. Navigate to the project directory:
    ```bash
    cd klinik-new
    ```
3. Install PHP dependencies using Composer:
    ```bash
    composer install
    ```
4. Install JavaScript dependencies:
    ```bash
    npm install
    ```
5. Copy .env.example to .env and configure your environment variables:
    ```bash
    cp .env.example .env
    ```
6. Generate the application key:
    ```bash
    php artisan key:generate
    ```
7. Run database migrations:
    ```bash
    php artisan migrate
    ```
8. Run the development server:
    ```bash
    php artisan serve
    ```

## Folder Structure

    ├── app
    │   ├── Http
    │   ├── Models
    │   ├── Providers
    │   └── View
    ├── bootstrap
    ├── config
    ├── database
    │   ├── factories
    │   ├── migrations
    │   └── seeders
    ├── public
    ├── resources
    │   ├── css
    │   ├── js
    │   ├── lang
    │   └── views
    ├── routes
    ├── storage
    ├── tests
    └── vendor

## Key Directories

-   app/: This directory contains the core application code such as controllers, models, and middleware.

    -   app/Http/Controllers/: Contains all the controllers which handle requests and responses.
    -   app/Models/: Contains the application's Eloquent models, which interact with the database.
    -   app/Http/Requests/: Custom request validation rules are stored here.
    -   app/Services/: Business logic or service classes to separate logic from controllers.

-   routes/: This folder contains route definition files.
    -   web.php: Defines routes that are handled via HTTP web requests (browser).
    -   api.php: Defines routes that are handled by API requests.
-   resources/views/: This directory contains Blade templates for rendering views.
-   database/: Contains migrations, factories, and seeders used to manage and populate your database.
    -   migrations/: Each file represents a database migration, used to create, modify, or delete tables and columns.
    -   seeders/: Used to populate the database with initial data or test data.
-   public/: Contains publicly accessible files such as images, CSS, and JavaScript.
-   storage/: Stores logs, cache, and user-uploaded files.
-   config/: Contains configuration files for services such as databases, mail, and cache.

-   tests/: This directory contains test files for unit, feature, and integration testing.

## ERD

![ERD](https://github.com/user-attachments/assets/0f83ad86-d376-4ac4-8929-42f5fd1f9c26)
