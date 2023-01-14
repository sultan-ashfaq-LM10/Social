<?php

namespace App\Actions\PostLikes;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

class StorePostLikeAction
{
    public static function execute(
        array $data,
        Post $post,
        User|Authenticatable $user
    ): bool {
        $like = new Like($data);
        $like->user()->associate($user);
        $post->likes()->save($like);

        return true;
    }
}
