<?php

namespace App\Actions\Posts;

use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

class UpdatePostAction
{
    public static function execute(
        array $data,
        Post $post
    ): bool {
        return $post->update($data);
    }
}
