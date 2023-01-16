<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>
<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status">
</a><a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework">
<img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Söcial

Söcial is an ongoing project for my learning, improvement and fine-tuning my skill set.

This is a Single Page Application, and current tech stack is:

- Laravel (Backend)
  - Sanctum (For API authentication)
- Vue 2 (Frontend)
  - Vuex (State management Library)
  - Vue Router (SPA)
  - Buefy (Bulma UI component Library)

**Current Features**:
- Login/Register
- Home Feed
  - Create post (Public, Private, Everyone)
  - Show posts with 'Everyone' visibility
- Auth Profile (Auth user only)
  - Create post (Public, Private, Everyone)
  - Show posts
- Friends
  - Accepted Friends
    - Remove friends
  - Pending Friends
    - Cancel request
  - Friend requests
    - Accept/Reject request

**Future Updates**:
- Profile Detail section
- Public profile (all features from auth profile)
- Post and Comment Likes (Frontend--Backend is already implemented)
- Phpunit tests for api routes
- Seeders (Users, Posts, Comments, Likes, etc) for generating a dummy social media data

More updates will be added as soon as the Future updates are doing.
I will be actively updating readme file to reflect the changes in the project.

**How to setup this project in your local environment**:

I used Laravel valet as a server and DBngin as my local mysql database. You can find the env settings in env.example file.
It's up to you, however you want to set it up e.g. using sail, xampp, etc.

Once you have the environment setup:

Run the following commands:

```
composer install
php artisan migrate
npm install
npm run dev
php artisan optimize
```
