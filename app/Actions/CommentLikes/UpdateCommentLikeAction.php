<?php

namespace App\Actions\CommentLikes;

use App\Models\Like;

class UpdateCommentLikeAction
{
    public function handle(
        array $data,
        Like $like
    ): bool {
        return $like->update($data);
    }
}
