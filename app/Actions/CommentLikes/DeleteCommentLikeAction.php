<?php

namespace App\Actions\CommentLikes;

use App\Models\Like;

class DeleteCommentLikeAction
{
    public function handle(Like $like): bool|null
    {
        return $like->delete();
    }
}
