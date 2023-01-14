<?php

namespace App\Actions\CommentLikes;

use App\Models\Like;

class UpdateCommentLikeAction
{
    public static function execute(
        array $data,
        Like $like
    ): bool {
        return $like->update($data);
    }
}
