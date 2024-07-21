# Task Manager System

## Introduction
You are to create an API for a simplified version of a task management system using Laravel.
The system should allow users to create, update, delete, and list tasks. Additionally, tasks can
be assigned to different users, and each task can have multiple comments. The author of the
task needs to receive a notification through email if it has new comments.

## Getting Started
### Installation
- Clone the repository from GitHub.
- Install dependencies using Composer.
- Configure the environment variables.

# Run migrations
php artisan migrate

# Seed the database
php artisan db:seed

# Run project
php artisan serve

## Postman Collection

You can find the Postman collection for testing the API endpoints [here](https://api.postman.com/collections/1053931-2e9f9a4e-999f-4d24-9e11-fc5c38bcb2ce?access_key=PMAT-01J3B4HFYB5K2ATHG7Y4HK7BKH).

### Authentication

All endpoints require authentication using Sanctum Laravel authentication. Tokens are used in all requests to authenticate users.

## Support
For any questions or assistance, please contact our developer, Hesham Mohamed, at [hesham.mohamed19930@gmail.com](mailto:hesham.mohamed19930@gmail.com).
