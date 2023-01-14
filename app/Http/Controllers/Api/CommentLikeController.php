<?php

namespace App\Http\Controllers\Api;

use App\Actions\CommentLikes\DeleteCommentLikeAction;
use App\Actions\CommentLikes\StoreCommentLikeAction;
use App\Actions\CommentLikes\UpdateCommentLikeAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostLike\StoreUpdateLikeRequest;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Http\Request;

class CommentLikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Comment $comment)
    {
        try {
            return response()->json($comment->likes);
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
    public function store(StoreUpdateLikeRequest $request, Comment $comment)
    {
        try {
            return response()->json(
                StoreCommentLikeAction::execute(
                    $request->validated(),
                    $comment,
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
    public function update(StoreUpdateLikeRequest $request, Comment $comment, Like $like)
    {
        try {
            return response()->json(
                UpdateCommentLikeAction::execute($request->validated(), $like)
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
    public function destroy(Comment $comment, Like $like)
    {
        try {
            return response()->json(DeleteCommentLikeAction::execute($like));
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }
}
