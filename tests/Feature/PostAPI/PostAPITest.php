<?php

namespace Tests\Feature\PostAPI;

use App\Enums\Posts\PostTypeEnum;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Carbon\Traits\Date;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class PostAPITest extends TestCase
{
    // create setup function for db transactions and db rollback.
    protected function setUp(): void
    {
        parent::setUp();
        DB::beginTransaction();
    }
    // create setdown function for db transactions and db rollback.
    protected function tearDown(): void
    {
        DB::rollBack();
        parent::tearDown();
    }

    public function test_sanctum_user_can_create_a_new_public_post_and_can_view_the_post()
    {
        // create a new user
        $user = User::factory()->create();
        $payload = [
            'content' => 'This is a post!',
            'type' => PostTypeEnum::PUBLIC->value,
        ];
        // create a new post using api route
        $response = $this->actingAs($user, 'sanctum')->postJson('/api/posts', [
            'payload' => $payload
        ]);
        $response->assertStatus(200);
        $post = $response->json();

        // assert that the user can view the post
        $this->actingAs($user, 'sanctum')
            ->getJson('/api/posts/' . $post['id'])
            ->assertOk()
            ->assertJson([
                'id' => $post['id'],
                'content' => $post['content'],
                'type' => PostTypeEnum::PUBLIC->name,
                'updated_at' => Carbon::parse($post['updated_at'])->format('j M y \a\t H:i'),
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'avatar' => $user->avatar,
                ]
            ]);
    }

    public function test_sanctum_user_can_update_their_own_post()
    {
        // create a new user
        $user = User::factory()->create();
        // create a new post
        $post = Post::factory()->create([
            'user_id' => $user->id,
            'type' => PostTypeEnum::PUBLIC->value,
            'content' => 'This is a new Post!'
        ]);
        // update the post
        $response = $this->actingAs($user, 'sanctum')->putJson('/api/posts/' . $post->id, [
            'payload' => [
                'content' => 'This is an updated post!',
                'type' => PostTypeEnum::PUBLIC->value,
            ]
        ]);
        // assert that the post was updated
        $response->assertStatus(200);

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'user_id' => $user->id,
            'type' => PostTypeEnum::PUBLIC->value,
            'content' => 'This is an updated post!',
        ]);
    }

    public function test_sanctum_user_cannot_update_other_user_post()
    {
        // create a new user
        $user = User::factory()->create();
        // create a new post
        $post = Post::factory()->create([
            'user_id' => $user->id,
            'type' => PostTypeEnum::PUBLIC->value,
            'content' => 'This is a new Post!'
        ]);
        // create a new user
        $user2 = User::factory()->create();
        // update the post
        $response = $this->actingAs($user2, 'sanctum')->putJson('/api/posts/' . $post->id, [
            'payload' => [
                'content' => 'This is an updated post!',
                'type' => PostTypeEnum::PUBLIC->value,
            ]
        ]);
        // assert that the post was updated
        $response->assertStatus(403);
    }

    public function test_sanctum_user_can_create_a_new_private_post_and_can_access_the_post()
    {
        // create a new user
        $user = User::factory()->create();
        $payload = [
            'content' => 'This is a post!',
            'type' => PostTypeEnum::PRIVATE->value,
        ];

        // create a new post using api route
        $response = $this->actingAs($user, 'sanctum')->postJson('/api/posts', [
            'payload' => $payload
        ]);
        $response->assertStatus(200);
        $post = $response->json();

        // assert that the user can view the post
        $this->actingAs($user, 'sanctum')
            ->get('/api/posts/' . $post['id'])
            ->assertStatus(200);
    }



    public function test_sanctum_user_cannot_view_someone_elses_private_post()
    {
        // create a new user
        $user = User::factory()->create();
        $payload = [
            'content' => 'This is a post!',
            'type' => PostTypeEnum::PRIVATE->value,
        ];

        // create a new post using api route
        $response = $this->actingAs($user, 'sanctum')->postJson('/api/posts', [
            'payload' => $payload
        ]);
        $response->assertStatus(200);
        $post = $response->json();

        // create a new user
        $user2 = User::factory()->create();
        // assert that the user cannot view the post
        $this->actingAs($user2, 'sanctum')
            ->get('/api/posts/' . $post['id'])
            ->assertStatus(403);
    }

    // test sanctum user can delete a post using api route
    public function test_sanctum_user_can_delete_a_post()
    {
        // create a new user
        $user = User::factory()->create();
        // create a new post
        $post = Post::factory()->create([
            'user_id' => $user->id,
            'type' => PostTypeEnum::PUBLIC->value
        ]);
        // delete the post
        $response = $this->actingAs($user, 'sanctum')->deleteJson('/api/posts/' . $post->id);
        // assert that the post was deleted
        $response->assertStatus(200);
        // assert post is not in the database
        $this->assertDatabaseMissing('posts', [
            'id' => $post->id,
            'user_id' => $user->id,
        ]);
    }

    // test sanctum user cannot delete a post that does not belong to them
    public function test_sanctum_user_cannot_delete_a_post_that_does_not_belong_to_them()
    {
        // create a new user
        $user = User::factory()->create();
        // create a new post
        $post = Post::factory()->create([
            'user_id' => $user->id,
            'type' => PostTypeEnum::PUBLIC->value
        ]);
        // create a new user
        $user2 = User::factory()->create();
        // delete the post
        $response = $this->actingAs($user2, 'sanctum')->deleteJson('/api/posts/' . $post->id);
        // assert that the post was not deleted
        $response->assertStatus(403);
        // assert post is still in database
        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'user_id' => $user->id,
        ]);
    }
}
