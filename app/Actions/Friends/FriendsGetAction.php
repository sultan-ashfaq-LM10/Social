<?php

namespace App\Actions\Friends;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Collection;

class FriendsGetAction
{
    public static function execute(User|Authenticatable $user): bool|Collection
    {
        if (!request()->has('type')) {
            return false;
        }
        return match (request()->get('type')) {
            'accepted' => $user->friendsAccepted->merge($user->friendsAcceptedTo),
            'pending' => $user->friendsPending,
            'request' => $user->friendsPendingTo,
            default    => new Collection(),
        };
    }
}
