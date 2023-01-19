<?php

namespace App\Actions\CommentLikes;

use App\Models\Comment;
use App\Models\Like;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

class StoreCommentLikeAction
{
    public function handle(
        Comment $comment,
        User|Authenticatable $user
    ): bool {
        $like = new Like();
        $like->liked = 1; //TODO: remove liked column
        $like->user()->associate($user);
        $comment->likes()->save($like);

        return true;
    }
}
