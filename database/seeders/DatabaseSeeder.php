<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Gallery;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\Concerns\Has;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => "Admin",
            'email' => "admin@gmail.com",
            'email_verified_at' => now(),
            'password' => Hash::make('asdffdsa'),
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'name' => "Kyaing",
            'email' => "kyaing@gmail.com",
            'email_verified_at' => now(),
            'password' => Hash::make('asdffdsa'),
            'remember_token' => Str::random(10),
        ]);


         \App\Models\User::factory(20)->create();
         Post::factory(200)->create();
         Comment::factory(300)->create();
         Gallery::factory(500)->create();

    }
}
