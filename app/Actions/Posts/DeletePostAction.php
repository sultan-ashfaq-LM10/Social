<?php

namespace App\Actions\Posts;

use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

class DeletePostAction
{
    public function handle(Post $post): bool|null
    {
        return $post->delete();
    }
}
