<?php

namespace App\Actions\Friends;

use App\Enums\Friends\FriendStatusEnum;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\DB;

class FriendUpdateAction
{
    /**
     * @param array $data {type: int}
     * @return void
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function handle(
        array $data,
        User|Authenticatable $user,
        int $friendId): bool
    {
        $result =  match (FriendStatusEnum::from($data['type'])->name) {
            'ACCEPTED' => DB::table('friends')
                ->where('user_id', '=', $friendId)
                ->where('friend_id', '=', $user->id)
                ->update(['status' => $data['type']]),
            'REJECTED' => FriendDeleteAction::execute($user->id, $friendId),
            default => false
        };

        return $result;
    }
}
