<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //Generate Authors in an array
        //Use of the array_map function to generate an array
        $authors = array_map(
            fn() => fake()->name,
            range(1, rand(1, 3))
        );

        $imageURL = 'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?w=1000&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OHx8dXJsfGVufDB8fDB8fHww';

        return [
            'hero_title' => fake()->realText(50),
            'intro' => fake()->realText(250),
            'hero_topics' => fake()->words(3),
            'hero_authors' => $authors,
            'hero_image' => $imageURL,
            'footer_about' => fake()->realText(100),
        ];
    }
}
