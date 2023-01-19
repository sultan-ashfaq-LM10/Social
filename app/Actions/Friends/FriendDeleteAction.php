<?php

namespace App\Actions\Friends;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\DB;

class FriendDeleteAction
{
    public function handle(int $userId, int $friendId): bool
    {
        return DB::table('friends')
            ->where(function ($query) use($userId, $friendId) {
                $query->where('user_id', '=', $userId)
                    ->where('friend_id', '=', $friendId);
            })
            ->orWhere(function ($query) use($userId, $friendId) {
                $query->where('user_id', '=', $friendId)
                    ->where('friend_id', '=', $userId);
            })->delete();
    }
}
