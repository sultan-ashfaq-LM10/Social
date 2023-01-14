<?php

namespace App\Http\Controllers\Api;

use App\Actions\Comments\DeleteCommentAction;
use App\Actions\Comments\StoreCommentAction;
use App\Actions\Comments\UpdateCommentAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\StoreUpdateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    public function index(Post $post)
    {
        try {
            return response()->json(
                CommentResource::collection($post->comments)
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
    public function store(StoreUpdateCommentRequest $request, Post $post)
    {
        try {
            return response()->json(StoreCommentAction::execute($request->validated(), $post, auth()->user()));
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreUpdateCommentRequest $request
     * @param Comment $comment
     * @return JsonResponse
     */
    public function update(StoreUpdateCommentRequest $request, Comment $comment)
    {
        try {
            return response()->json(
                UpdateCommentAction::execute($request->validated(), $comment)
            );
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Comment $comment
     * @return JsonResponse
     */
    public function destroy(Comment $comment)
    {
        try {
            return response()->json(DeleteCommentAction::execute($comment));
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }
}
