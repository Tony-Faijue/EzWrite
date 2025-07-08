<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BlogSection>
 */
class BlogSectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'blog_id' => 1,
            'heading' => fake()->realText('50'),
            'content' => fake()->realText(500),
            'position' => random_int(0, 5),
        ];
    }
}
