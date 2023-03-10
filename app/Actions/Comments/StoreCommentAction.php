<?php

namespace App\Actions\Comments;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

class StoreCommentAction
{
    public function handle(
        array $data,
        Post $post,
        User|Authenticatable $user
    ): Comment {
        $comment = new Comment($data);
        $comment->user()->associate($user);
        $comment->post()->associate($post);
        $comment->save();
        return $comment;
    }
}
