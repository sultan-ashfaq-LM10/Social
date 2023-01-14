<?php

namespace App\Http\Controllers\Api;

use App\Actions\Friends\FriendAcceptAction;
use App\Actions\Friends\FriendRejectAction;
use App\Actions\Friends\FriendStoreAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Friend\StoreFriendRequest;
use App\Http\Requests\Friend\UpdateFriendRequest;
use App\Http\Resources\FriendResource;
use App\Models\User;

class FriendController extends Controller
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
            $user = auth()->user();
            return response()->json(
                FriendResource::collection($user->acceptedFriends->merge($user->acceptedFriendsTo))
            );
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

    public function friends(User $user)
    {
        try {
            return response()->json(
                FriendResource::collection($user->friends)
            );
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

    /**
     * Get accepted friends only.
     *
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function acceptedFriends(User $user)
    {
        try {
            return response()->json(
                FriendResource::collection($user->acceptedFriends)
            );
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

    /**
     * Get pending friends only.
     *
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function pendingFriends(User $user)
    {
        try {
            return response()->json(
                FriendResource::collection($user->pendingFriends)
            );
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

    /**
     * Store a newly created resource in storage.
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
     * Accept friend request.
     *
     * @param UpdateFriendRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function accept(UpdateFriendRequest $request)
    {
        try {
            return response()->json(
                FriendAcceptAction::execute($request->validated()['friend_id'])
            );
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

    /**
     * Reject Friend Request.
     *
     * @param UpdateFriendRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function reject(UpdateFriendRequest $request)
    {
        try {
            return response()->json(
                FriendRejectAction::execute($request->validated()['friend_id'])
            );
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }
}
