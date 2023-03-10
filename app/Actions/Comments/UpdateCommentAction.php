<?php

namespace App\Actions\Comments;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

class UpdateCommentAction
{
    public function handle(
        array $data,
        Comment $comment
    ): bool {
        return $comment->update($data);
    }
}
