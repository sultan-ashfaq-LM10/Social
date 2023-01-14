<?php

namespace App\Http\Controllers\Api;

use App\Enums\Posts\PostTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ProfilePostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(User $user)
    {
        try {
            // if user has a accpetedFriends relationship -- then view public and everyone
            // if user has no friend relatioship -- then view everyone

            $posts = Post::query()
                ->whereIn('type', [PostTypeEnum::PUBLIC->value, PostTypeEnum::EVERYONE->value])
                ->where('user_id', '=', request()->get('user_id'))
                ->latest()
                ->get();
            return response()->json(PostResource::collection($posts));
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }
}
