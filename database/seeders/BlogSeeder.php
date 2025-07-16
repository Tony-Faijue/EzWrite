<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Assigns all users each a number of blogs
        User::all()->each(function (User $user) {
            Blog::factory()->count(15)->create(["user_id" => $user->id]);
        });
    }
}
