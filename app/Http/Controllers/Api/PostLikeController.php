<?php

namespace App\Http\Controllers\Api;

use App\Actions\PostLikes\DeletePostLikeAction;
use App\Actions\PostLikes\StorePostLikeAction;
use App\Actions\PostLikes\UpdatePostLikeAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostLike\StoreUpdateLikeRequest;
use App\Http\Resources\PostResource;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class PostLikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Post $post)
    {
        try {
            return response()->json($post->likes);
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
    public function store(Request $request, Post $post, StorePostLikeAction $storePostLikeAction)
    {
        try {
            return response()->json(
                new PostResource(
                    $storePostLikeAction->handle($post, auth()->user())
                )
            );
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }
}
