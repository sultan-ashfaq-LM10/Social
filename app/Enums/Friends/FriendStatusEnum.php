<?php

namespace App\Enums\Friends;

enum FriendStatusEnum: int
{
    case PENDING = 0;
    case ACCEPTED = 1;
    case BLOCKED = 2;
}
