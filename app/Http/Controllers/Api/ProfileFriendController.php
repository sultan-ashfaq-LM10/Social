<?php

namespace App\Http\Controllers\Api;

use App\Actions\Friends\FriendDeleteAction;
use App\Actions\Friends\FriendsGetAction;
use App\Actions\Friends\FriendStoreAction;
use App\Actions\Friends\FriendUpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Friend\StoreFriendRequest;
use App\Http\Requests\Friend\UpdateFriendRequest;
use App\Http\Resources\FriendResource;
use App\Models\User;

class ProfileFriendController extends Controller
{
    /**
     * Get all friends (accepted and pending)
     *
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(FriendsGetAction $friendsGetAction)
    {
        try {
            return response()->json(
                FriendResource::collection($friendsGetAction->handle(auth()->user()))
            );
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

    /**
     * Store user in friend list.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreFriendRequest $request, FriendStoreAction $friendStoreAction)
    {
        try {
            return response()->json(
                $friendStoreAction->handle($request->validated()['user_id'], auth()->user())
            );
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

    /**
     * Update friend request (accept|reject).
     *
     * @param UpdateFriendRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function update(UpdateFriendRequest $request, $friendId, FriendUpdateAction $friendUpdateAction)
    {
        try {
            return response()->json(
                $friendUpdateAction->handle($request->validated(), auth()->user(), $friendId)
            );
        }
        catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

    /**
     * Delete a friend by $id.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($friendId, FriendDeleteAction $friendDeleteAction)
    {
        try {
            return response()->json($friendDeleteAction->handle(auth()->id(), $friendId));
        }
        catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }
}
