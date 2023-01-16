<?php

namespace App\Actions\Posts;

use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

class StorePostAction
{
    public static function execute(
        array $data,
        User|Authenticatable $user
    ): Post {
        $post = new Post($data);
        $post->user()->associate($user);
        return tap($post)->save();
    }
}
