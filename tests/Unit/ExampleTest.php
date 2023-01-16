<?php

namespace Tests\Unit;

use App\Enums\Posts\PostTypeEnum;
use App\Models\Post;
use App\Models\User;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_that_true_is_true()
    {
        $this->assertTrue(true);
    }

    // test user can create a new post with public status
    public function test_user_can_create_a_new_post_with_public_status()
    {
        // create a new user
        $user = User::factory()->create();
        // create a new post
        $post = Post::factory()
            ->state([
                'type' => PostTypeEnum::PUBLIC->value,
            ])
            ->create([
            'user_id' => $user->id
        ]);
        // assert that the post was created
        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'user_id' => $user->id,
            'type'    => PostTypeEnum::PUBLIC->value
        ]);
    }

    // test user can create a new post with private status
    public function test_user_can_create_a_new_post_with_private_status()
    {
        // create a new user
        $user = User::factory()->create();
        // create a new post
        $post = Post::factory()
            ->state([
                'type' => PostTypeEnum::PRIVATE->value,
            ])
            ->create([
            'user_id' => $user->id
        ]);
        // assert that the post was created
        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'user_id' => $user->id,
            'type'    => PostTypeEnum::PRIVATE->value
        ]);
    }

    // test user can create a new post with everyone status
    public function test_user_can_create_a_new_post_with_everyone_status()
    {
        // create a new user
        $user = User::factory()->create();
        // create a new post
        $post = Post::factory()
            ->state([
                'type' => PostTypeEnum::EVERYONE->value,
            ])
            ->create([
                'user_id' => $user->id
            ]);
        // assert that the post was created
        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'user_id' => $user->id,
            'type' => PostTypeEnum::EVERYONE->value
        ]);
    }

    // test user can update a post
    public function test_user_can_update_a_post()
    {
        // create a new user
        $user = User::factory()->create();
        // create a new post
        $post = Post::factory()->create([
            'user_id' => $user->id,
            'type' => PostTypeEnum::PUBLIC->value
        ]);
        // update the post
        $post->update([
            'content' => 'This is a post!'
        ]);
        // assert that the post was updated
        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'content' => 'This is a post!'
        ]);
    }

    // test user can delete a post
    public function test_user_can_delete_a_post()
    {
        // create a new user
        $user = User::factory()->create();
        // create a new post
        $post = Post::factory()->create([
            'user_id' => $user->id,
            'type' => PostTypeEnum::PUBLIC->value
        ]);
        // delete the post
        $post->delete();
        // assert that the post was deleted
        $this->assertDatabaseMissing('posts', [
            'id' => $post->id
        ]);
    }

    // test user can view their own public post
    public function test_user_can_view_their_own_public_post()
    {
        // create a new user
        $user = User::factory()->create();
        // create a new post
        $post = Post::factory()
            ->state([
                'type' => PostTypeEnum::PUBLIC->value,
            ])
            ->create([
                'user_id' => $user->id
            ]);
        // assert that the post was created
        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'user_id' => $user->id,
            'type' => PostTypeEnum::PUBLIC->value
        ]);
        // assert that the user can view the post
        $this->assertTrue($user->can('view', $post));
    }

    // test sanctum user can create a new post with public status using api route
    public function test_sanctum_user_can_create_a_new_post_with_public_status_using_api_route()
    {
        // create a new user
        $user = User::factory()->create();
        $payload = [
            'content' => 'This is a post!',
            'type' => PostTypeEnum::PUBLIC->value
        ];
        // create a new post
        $response = $this->actingAs($user, 'sanctum')->post('/api/posts', [
            'payload' => $payload
        ]);
        // assert that the post was created
        $response->assertStatus(200);
        $response->assertJson([
            'content' => 'This is a post!',
            'type' => PostTypeEnum::PUBLIC->value
        ]);
    }
}
