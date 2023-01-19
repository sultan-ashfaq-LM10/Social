<?php

namespace App\Actions\Posts;

use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

class UpdatePostAction
{
    public function handle(
        array $data,
        Post $post
    ): bool {
        $post->update($data);
        return tap($post)->refresh();
    }
}
