<?php

namespace App\Http\Controllers\Api;

use App\Actions\Posts\DeletePostAction;
use App\Actions\Posts\StorePostAction;
use App\Actions\Posts\UpdatePostAction;
use App\Enums\Posts\PostTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreUpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUpdatePostRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreUpdatePostRequest $request)
    {
        try {
            return response()->json(
                new PostResource(
                    StorePostAction::execute(
                        $request->validated(),
                        Auth::user()
                    )
                )
            );
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Post $post)
    {
        $this->authorize('view', $post);
        try {

            return response()->json(
                new PostResource($post)
            );
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreUpdatePostRequest $request
     * @param Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(StoreUpdatePostRequest $request, Post $post)
    {
        $this->authorize('update', $post);
        try {
            return response()->json(
                UpdatePostAction::execute(
                    $request->validated(),
                    $post
                )
            );
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        try {
            return response()->json(
                DeletePostAction::execute($post)
            );
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }
}
