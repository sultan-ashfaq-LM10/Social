<?php

namespace Database\Seeders;

use App\Enums\Posts\PostTypeEnum;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DummySocialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->count(500)
            ->create();
        $users = User::all();

        $users->each(function ($user) use($users) {
            $post = new Post([
                'Content' => fake()->text(),
                'type' => PostTypeEnum::from(array_rand([0,1,2])),
            ]);
            $post->user()->associate($user)->save();

            $totalComments = rand(2, 10);
             foreach (range(1, $totalComments) as $index) {
                 Comment::create([
                     'post_id' => $post->id,
                     'user_id' => $users->random()->id,
                     'body' => fake()->text(),
                 ]);
             }
             $totalLikes = rand(2, 100);
                foreach (range(1, $totalLikes) as $index) {
                    $like = new Like();
                    $like->user()->associate($users->random());
                    $post->likes()->save($like);
                }

        });

    }
}
