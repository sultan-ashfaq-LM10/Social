<?php

namespace App\Actions\PostLikes;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

class StorePostLikeAction
{
    public function handle(
        Post $post,
        User|Authenticatable $user
    ): Post {
        // Check if the user has already liked the post, if so, remove the like
        $likeQuery = $post->likes()->where('user_id', $user->id);
        if (!$likeQuery->exists()) {
            $like = new Like();
            $like->user()->associate($user);
            $post->likes()->save($like);
        } else {
            $likeQuery->delete();
        }

        // if you are return the post without the PostResource,
        // then you have to use tap($post)->refresh()->load('likes') to update the likes
        return tap($post)->refresh();
    }
}
