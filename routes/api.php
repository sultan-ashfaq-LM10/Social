<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users/details', [\App\Http\Controllers\Api\UserController::class, 'userInfo']);
//    Route::apiResource('/users', \App\Http\Controllers\Api\UserController::class);

    Route::apiResource('posts', \App\Http\Controllers\Api\PostController::class);

    Route::get('/home/posts', \App\Http\Controllers\Api\HomePostController::class);
    Route::get('/profile/posts', \App\Http\Controllers\Api\UserPostController::class);
    Route::get('/profile/{user}/posts', \App\Http\Controllers\Api\ProfileUserPostController::class);

    Route::apiResource('posts.comments', \App\Http\Controllers\Api\CommentController::class);
    Route::apiResource('posts.likes', \App\Http\Controllers\Api\PostLikeController::class);
    Route::apiResource('comments.likes', \App\Http\Controllers\Api\CommentLikeController::class);

    Route::apiResource('/search/users', \App\Http\Controllers\Api\UserSearchController::class);

    /** Profile Friend Routes */
    Route::prefix('/profile')->group(function (){
        Route::apiResource('/friends', \App\Http\Controllers\Api\ProfileFriendController::class);
//        Route::apiResource('{user}/friends', \App\Http\Controllers\Api\ProfileFriendController::class);
    });
});




