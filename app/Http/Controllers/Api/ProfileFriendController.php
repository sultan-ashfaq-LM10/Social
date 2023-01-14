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
    public function index()
    {
        try {
            return response()->json(
                FriendResource::collection(FriendsGetAction::execute(auth()->user()))
            );
//            return response()->json(
//                FriendResource::collection($user->acceptedFriends->merge($user->acceptedFriendsTo))
//            );
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
    public function store(StoreFriendRequest $request)
    {
        try {
            return response()->json(
                FriendStoreAction::execute($request->validated()['user_id'], auth()->user())
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
    public function update(UpdateFriendRequest $request, $friendId)
    {
        try {
            return response()->json(FriendUpdateAction::execute($request->validated(), $friendId));
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
    public function destroy($id)
    {
        try {
            return response()->json(FriendDeleteAction::execute($id));
        }
        catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

//    /**
//     * Get accepted friends only.
//     *
//     * @param User $user
//     * @return \Illuminate\Http\JsonResponse
//     */
//    public function accepted()
//    {
//        try {
//            return response()->json(
//                FriendResource::collection(auth()->user()->acceptedFriends)
//            );
//        } catch (\Exception $exception) {
//            return response()->json($exception->getMessage(), 500);
//        }
//    }
//
//    /**
//     * Get pending friends only.
//     *
//     * @param User $user
//     * @return \Illuminate\Http\JsonResponse
//     */
//    public function pending()
//    {
//        try {
//            return response()->json(
//                FriendResource::collection(auth()->user()->pendingFriends)
//            );
//        } catch (\Exception $exception) {
//            return response()->json($exception->getMessage(), 500);
//        }
//    }
}
