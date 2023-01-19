<?php

namespace App\Actions\Comments;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

class DeleteCommentAction
{
    public function handle(Comment $comment): bool|null
    {
        return $comment->delete();
    }
}
