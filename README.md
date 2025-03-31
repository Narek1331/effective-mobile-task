
# Task Management API

This is a Task Management API built with Laravel. It allows users to manage tasks with basic CRUD operations: Create, Read, Update, and Delete tasks.

## Features

- Create tasks with a title, description, and status.
- Retrieve a list of all tasks or view a single task.
- Update an existing task's details.
- Delete a task.
- Swagger documentation for the API.

## Requirements

- PHP 8.3 or higher
- Composer
- Laravel 12.x
- MySQL or SQLite database

## Installation

Follow these steps to get the project up and running locally:

### 1. Clone the Repository

Clone the repository to your local machine using Git:

```bash
git clone https://github.com/your-username/task-management-api.git
cd task-management-api
```

### 2. Install Dependencies

Install the required dependencies using Composer:

```bash
composer install
```

### 3. Set Up Environment

Copy the `.env.example` file to `.env`:

```bash
cp .env.example .env
```

Edit the `.env` file to configure your database and other settings. For example, to use MySQL:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_management
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate Application Key

Generate the application key for your Laravel project:

```bash
php artisan key:generate
```

### 5. Run Migrations

Run the migrations to set up the database:

```bash
php artisan migrate
```

### 6. (Optional) Seed Database

If you want to populate your database with sample data, run the following command:

```bash
php artisan db:seed
```

### 7. Install Swagger (Optional)

To generate API documentation using Swagger, install the `l5-swagger` package:

```bash
composer require "darkaonline/l5-swagger"
```

Publish the Swagger configuration:

```bash
php artisan vendor:publish --provider="L5Swagger\L5SwaggerServiceProvider"
```

Run the Swagger generator:

```bash
php artisan l5-swagger:generate
```

### 8. Start the Laravel Development Server

Start the local development server using:

```bash
php artisan serve
```

By default, the server will be available at `http://localhost:8000`.

### 9. Access the API Documentation

Once the server is running, you can access the Swagger API documentation at:

```
http://localhost/api/documentation
```

## API Endpoints

- **GET /api/tasks** – Get all tasks
- **POST /api/tasks** – Create a new task
- **GET /api/tasks/{id}** – Get a specific task by ID
- **PUT /api/tasks/{id}** – Update a task by ID
- **DELETE /api/tasks/{id}** – Delete a task by ID

## Example Requests

### Create Task (POST /api/tasks)

```bash
curl -X POST http://localhost/api/tasks     -H "Content-Type: application/json"     -d '{"title": "New Task", "description": "Description of the task", "status": false}'
```

### Update Task (PUT /api/tasks/{id})

```bash
curl -X PUT http://localhost/api/tasks/1     -H "Content-Type: application/json"     -d '{"title": "Updated Task", "description": "Updated description", "status": true}'
```

### Delete Task (DELETE /api/tasks/{id})

```bash
curl -X DELETE http://localhost/api/tasks/1
```

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
