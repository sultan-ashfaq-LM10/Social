<?php

namespace App\Actions\Friends;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

class FriendStoreAction
{
    public static function execute(
        int $userId,
        User|Authenticatable $user
    ): bool {
        $user->friends()->attach($userId);
        return true;
    }
}
