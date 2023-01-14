<?php

namespace App\Http\Controllers\Api;

use App\Enums\Posts\PostTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class UserPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke()
    {
        try {
            $posts = Post::query()
                ->where('user_id', '=', auth()->id())
                ->latest()
                ->get();
            return response()->json(PostResource::collection($posts));
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }
}
