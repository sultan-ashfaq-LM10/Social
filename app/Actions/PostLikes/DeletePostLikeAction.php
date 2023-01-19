<?php

namespace App\Actions\PostLikes;

use App\Models\Like;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

class DeletePostLikeAction
{
    public function handle(Like $like): bool|null
    {
        return $like->delete();
    }
}
