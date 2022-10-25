<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Comment;
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
         \App\Models\User::factory(4)->create();
         \App\Models\Post::factory(15)->create();
         Comment::factory(90)->create();

         \App\Models\User::factory()->create([
             'name' => 'Andrew Gas',
             'email' => 'ah@example.com',
         ]);
    }
}
