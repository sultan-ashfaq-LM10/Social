<?php

namespace App\Actions\CommentLikes;

use App\Models\Like;

class DeleteCommentLikeAction
{
    public static function execute(Like $like): bool|null
    {
        return $like->delete();
    }
}
