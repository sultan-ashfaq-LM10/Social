<?php

namespace App\Http\Controllers\Api;

use App\Enums\Friends\FriendStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserSearchController extends Controller
{
    /**
     * Search for users
     * For simplicity sake, return users who are not friends or has pending friend request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function index()
    {
        try {
            $name = request()->get('query') ?? '';
            if ($name === '') {
                return response()->json(collect());
            }

            ////TODO: Try this code block and if faster, use this!
//            $users = User::where('name', 'like', "{$name}%")
//                ->leftJoin('friends', function($join) use($authUserId) {
//                    $join->on('users.id', '=', 'friends.user_id')
//                        ->where('friends.friend_id', '=', $authUserId);
//                })
//                ->orOn('users.id', '=', 'friends.friend_id')
//                ->where('friends.user_id', '=', $authUserId)
//                ->select('users.*', 'friends.user_id', 'friends.status')
//                ->get();
//
//            $results = $users->map(function($user) {
//                return [
//                    'user' => new UserResource($user),
//                    'friendRelationship' => $user->user_id ?
//                        ['user_id' => $user->user_id, 'status' => FriendStatusEnum::from($user->status)->name] : null
//                ];

            $userQuery = User::query()
                ->where('name', 'like', "{$name}%");

            $authUserId = auth()->id();
            $results = [];
            foreach ($userQuery->get() as $user) {

                $friendId = $user->id;
                $friendRelationshipExists = DB::table('friends')
                    ->where(function ($query) use($authUserId, $friendId) {
                        $query->where('user_id', '=', $authUserId)
                            ->where('friend_id', '=', $friendId);
                    })
                    ->orWhere(function ($query) use($authUserId, $friendId) {
                        $query->where('user_id', '=', $friendId)
                            ->where('friend_id', '=', $authUserId);
                    })
                    ->select('user_id', 'status')
                    ->first();
                $results[] = [
                    'user' => new UserResource($user),
                    'friendRelationship' => $friendRelationshipExists ?
                        ['user_id' => $friendRelationshipExists->user_id,
                        'status'  => FriendStatusEnum::from($friendRelationshipExists->status)->name] : null
                ];
            }

            return response()->json(
                $results
            );

            return response()->json(
                UserResource::collection($userQuery->get())
            );
        }
        catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }
}
