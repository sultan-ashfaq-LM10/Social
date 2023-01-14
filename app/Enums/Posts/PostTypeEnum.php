<?php

namespace App\Enums\Posts;

enum PostTypeEnum: int
{
    case PUBLIC = 0;
    case PRIVATE = 1;
    case EVERYONE = 2;
}
