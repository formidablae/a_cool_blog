<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $users = [];
        $posts = [];
        //$comments = [];

        /**
         * Create users
         */
        for ($i = 0; $i < 10; $i++) {
            $users[] = User::factory()->create();
        }

        /**
         * Create posts
         */
        for ($i = 0; $i < count($users); $i++) {
            for ($j = 0; $j < 10; $j++) {
                $posts[] = Post::factory()->create([
                    'user_id' => $users[$i]->id,
                ]);
            }
        }

        /**
         * Create comments
         */
        for ($i = 0; $i < count($users); $i++) {
            for ($j = 0; $j < 5; $j++) {
                $post = $posts[array_rand($posts)];
                Comment::factory()->create([
                    'user_id' => $users[$i]->id,
                    'post_id' => $post->id
                ]);
            }
        }
    }
}
