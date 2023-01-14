<?php

namespace App\Enums\Posts;

enum PostStatusEnum: int
{
    case ACTIVE = 0;
    case DISABLED = 1;
}
