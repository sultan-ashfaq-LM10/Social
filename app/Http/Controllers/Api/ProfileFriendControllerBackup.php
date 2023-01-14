<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FriendResource;
use App\Models\User;

class ProfileFriendControllerBackup extends Controller
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

    /**
     * Get accepted friends only.
     *
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function accepted()
    {
        try {
            return response()->json(
                FriendResource::collection(auth()->user()->acceptedFriends)
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
    public function pending()
    {
        try {
            return response()->json(
                FriendResource::collection(auth()->user()->pendingFriends)
            );
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }
}
