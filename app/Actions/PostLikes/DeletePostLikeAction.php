<?php

namespace App\Actions\PostLikes;

use App\Models\Like;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

class DeletePostLikeAction
{
    public static function execute(Like $like): bool|null
    {
        return $like->delete();
    }
}
