<?php

namespace App\Actions\PostLikes;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

class UpdatePostLikeAction
{
    public static function execute(
        array $data,
        Like $like
    ): bool {
        return $like->update($data);
    }
}
