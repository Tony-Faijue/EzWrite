<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\BlogSection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Assing each blog random number of blogsections
        Blog::all()->each(function (Blog $blog) {
            BlogSection::factory()->count(rand(1, 5))->create(['blog_id' => $blog->id]);
        });
    }
}
