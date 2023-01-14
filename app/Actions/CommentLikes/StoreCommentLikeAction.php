<?php

namespace App\Actions\CommentLikes;

use App\Models\Comment;
use App\Models\Like;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

class StoreCommentLikeAction
{
    public static function execute(
        array $data,
        Comment $comment,
        User|Authenticatable $user
    ): bool {
        $like = new Like($data);
        $like->user()->associate($user);
        $comment->likes()->save($like);

        return true;
    }
}
