<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{ 
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name' => 'LTA',
            'email'=>  'lta@gmail.com',
            'password'=>'ltz12345'
        ]);

        App\Feed::create([
            'user_id' => 1,
            'description' => "Hello Guy",
            'image' => 'public/image/default.jpg'
        ]);

        App\Comment::create([
            'user_id' => 1,
            'feed_id' => 1,
            'comment' => "Good Comment"
        ]);

        App\Like::create([
            'user_id' => 1,
            'feed_id' => 1
        ]);
    }
}
