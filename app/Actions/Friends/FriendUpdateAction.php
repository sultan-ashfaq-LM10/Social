<?php

namespace App\Actions\Friends;

use App\Enums\Friends\FriendStatusEnum;
use Illuminate\Support\Facades\DB;

class FriendUpdateAction
{
    /**
     * @param array $data {friend_id: int, type: int}
     * @return void
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public static function execute(array $data, int $friendId): bool
    {
        return DB::table('friends')
            ->where('id', '=', $friendId)
            ->update(['status' => FriendStatusEnum::from($data['type'])->value]);
    }
}
