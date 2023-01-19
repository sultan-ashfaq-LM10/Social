<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>
<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status">
</a><a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework">
<img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Söcial

Söcial is an ongoing project for enhancing my technical proficiency and fine-tune my skill set.

The project is a Single Page Application, and utilizes the following technology stack:

- PHP 8.1
- Laravel 9 as the Backend framework
  - Sanctum For API authentication
- Vue 2 as the Frontend framework
  - Vuex for state management
  - Vue Router for SPA routing
  - Buefy, a UI component library built with Bulma

**Currently, the project features include**:
- User authentication and registration
- Basic Home Feed functionality
- The ability to create posts with varying visibility options (Public, Private, Everyone)
- Posts with "Everyone" visibility displayed on the Home Feed
- An authenticated user's profile section with the ability to create posts and manage friends
- Friends management functionality including accepting/removing friends, canceling/sending friend requests, and managing pending friend requests.
- A search functionality that allows users to search for other users by name

**Planned updates include:**:
- A profile detail section that displays user's information
- Public profile functionality
- Post and comment likes
- Phpunit tests for API routes
- Seeders for generating dummy social media data

More updates will be added as soon as the Future updates are done.
I will be actively updating readme file to reflect the changes in the project.

**How to setup this project in your local environment:**

The project is set up using Laravel Valet as the server and DBngin as the local MySQL database.
The environment settings can be found in the env.example file.
Your setup process may vary depending on your chosen environment and server.
The README file will be actively updated to reflect any changes to the project.

**Once you have the environment setup, Run the following commands:**

```
composer install
php artisan migrate
npm install
npm run dev
php artisan optimize
```
