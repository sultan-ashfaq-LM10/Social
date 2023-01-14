<?php

namespace App\Actions\Friends;

use Illuminate\Support\Facades\DB;

class FriendDeleteAction
{
    public static function execute(int $id): bool
    {
        return DB::table('friends')
            ->where('id', '=', $id)
            ->delete();
    }
}
