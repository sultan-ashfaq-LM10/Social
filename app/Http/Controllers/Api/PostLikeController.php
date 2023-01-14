<?php

namespace App\Http\Controllers\Api;

use App\Actions\PostLikes\DeletePostLikeAction;
use App\Actions\PostLikes\StorePostLikeAction;
use App\Actions\PostLikes\UpdatePostLikeAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostLike\StoreUpdateLikeRequest;
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
    public function store(StoreUpdateLikeRequest $request, Post $post)
    {
        try {
            return response()->json(
                StorePostLikeAction::execute(
                    $request->validated(),
                    $post,
                    auth()->user()
                )
            );
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(StoreUpdateLikeRequest $request, Post $post, Like $like)
    {
        try {
            return response()->json(
                UpdatePostLikeAction::execute($request->validated(), $like)
            );
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Post $post, Like $like)
    {
        try {
            return response()->json(DeletePostLikeAction::execute($like));
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }
}
