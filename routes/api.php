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

    Route::apiResource('posts', \App\Http\Controllers\Api\PostController::class);

    Route::get('/home/posts', \App\Http\Controllers\Api\HomePostController::class);
    Route::get('/profile/posts', \App\Http\Controllers\Api\UserPostController::class);
    Route::get('/profile/{user}/posts', \App\Http\Controllers\Api\ProfilePostController::class);

    Route::apiResource('posts.comments', \App\Http\Controllers\Api\CommentController::class);
    Route::apiResource('posts.likes', \App\Http\Controllers\Api\PostLikeController::class);
    Route::apiResource('comments.likes', \App\Http\Controllers\Api\CommentLikeController::class);
    Route::get('/users/details', [\App\Http\Controllers\Api\UserController::class, 'userInfo']); // this is logged in user details

    Route::apiResource('/search/users', \App\Http\Controllers\Api\UserSearchController::class);


    /** Profile Friend Routes */
    Route::prefix('/profile')->group(function (){
        Route::apiResource('/friends', \App\Http\Controllers\Api\ProfileFriendController::class);


        Route::get('/{user}/friends', [\App\Http\Controllers\Api\FriendController::class, 'friends']);
        Route::get('/{user}/friends/accepted', [\App\Http\Controllers\Api\FriendController::class, 'acceptedFriends']);
        Route::get('/{user}/friends/pending', [\App\Http\Controllers\Api\FriendController::class, 'pendingFriends']);
    });

    Route::post('/users/friends', [\App\Http\Controllers\Api\FriendController::class, 'store']);
    Route::post('/users/friends/accept', [\App\Http\Controllers\Api\FriendController::class, 'accept']);
    Route::post('/users/friends/reject', [\App\Http\Controllers\Api\FriendController::class, 'reject']);
});




