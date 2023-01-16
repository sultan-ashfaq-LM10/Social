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
//            if ($name === '') {
//                return response()->json(collect());
//            }
            $authUserId = auth()->id();

            $name = trim($name);
            $name = strip_tags($name);
            $name = htmlentities($name, ENT_NOQUOTES);

            //TODO: Raw sql is for performance only, which is crazy fast on huge list of users
            // Convert this to either using bindings or laravel eloquent equivalent
            $users = DB::select("
            SELECT users.*, friend_relationships.user_id, friend_relationships.status
            FROM users
            LEFT JOIN friends AS friend_relationships
            ON (users.id = friend_relationships.friend_id AND friend_relationships.user_id = '$authUserId')
            OR (users.id = friend_relationships.user_id AND friend_relationships.friend_id = '$authUserId')
            WHERE users.name LIKE '$name%'
            ");

            $results = collect($users)->map(function($user) {
                return [
                    'user' => $user,
                    'friendRelationship' => $user->user_id ?
                        ['user_id' => $user->user_id, 'status' => FriendStatusEnum::from($user->status)->name] : null
                ];
            });

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
