<?php


use App\Models\User;
use Laravolt\Avatar\Facade;

if (!function_exists('generate_avatar')) {
    function generate_avatar(User $user)
    {
        return Facade::create($user->name)->toBase64();
    }
}
