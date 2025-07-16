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
        $imageURL = 'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?w=1000&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OHx8dXJsfGVufDB8fDB8fHww';
        return [
            'heading' => fake()->realText('50'),
            'content' => fake()->realText(500),
            'section_image' => $imageURL
        ];
    }
}
