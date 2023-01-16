<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class UserFriendTest extends TestCase
{
    // test user can send a friend request
    public function test_user_can_send_a_friend_request()
    {
        // create a new user
        $user = User::factory()->create();
        // create a new user
        $friend = User::factory()->create();

        // add user as a friend
        $user->friends()->attach($friend->id);

        // assert that the friend request was sent
        $this->assertDatabaseHas('friends', [
            'user_id' => $user->id,
            'friend_id' => $friend->id,
            'status' => 0
        ]);
    }

    // test user can accept a friend request
    public function test_user_can_accept_a_friend_request()
    {
        // create a new user
        $user = User::factory()->create();
        // create a new friend
        $friend = User::factory()->create();

        // send a friend request using friends table
        $user->friends()->attach($friend->id);

        // accept the friend request
        $user->friends()->updateExistingPivot($friend->id, ['status' => 1]);

        // assert that the friend request was accepted
        $this->assertDatabaseHas('friends', [
            'user_id' => $user->id,
            'friend_id' => $friend->id,
            'status' => 1
        ]);
    }

    // test user can delete a friend request
    public function test_user_can_delete_a_friend_request()
    {
        // create a new user
        $user = User::factory()->create();
        // create a new friend
        $friend = User::factory()->create();

        // send a friend request using friends table
        $user->friends()->attach($friend->id);

        // delete the friend request
        $user->friends()->detach($friend->id);

        // assert that the friend request was deleted
        $this->assertDatabaseMissing('friends', [
            'user_id' => $user->id,
            'friend_id' => $friend->id,
            'status' => 0
        ]);
    }

    // test user can delete a friend
    public function test_user_can_delete_a_friend()
    {
        // create a new user
        $user = User::factory()->create();
        // create a new friend
        $friend = User::factory()->create();

        // send a friend request using friends table
        $user->friends()->attach($friend->id);

        // accept the friend request
        $user->friends()->updateExistingPivot($friend->id, ['status' => 1]);

        // delete the friend
        $user->friends()->detach($friend->id);

        // assert that the friend was deleted
        $this->assertDatabaseMissing('friends', [
            'user_id' => $user->id,
            'friend_id' => $friend->id,
            'status' => 1
        ]);
    }

    // test user can block a friend
    public function test_user_can_block_a_friend()
    {
        // create a new user
        $user = User::factory()->create();
        // create a new friend
        $friend = User::factory()->create();

        // send a friend request using friends table
        $user->friends()->attach($friend->id);

        // block the friend
        $user->friends()->updateExistingPivot($friend->id, ['status' => 2]);

        // assert that the friend was blocked
        $this->assertDatabaseHas('friends', [
            'user_id' => $user->id,
            'friend_id' => $friend->id,
            'status' => 2
        ]);
    }
}
