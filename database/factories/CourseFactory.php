<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'slug' => fake()->slug(),
            'tagline' => fake()->sentence(),
            'image_name' => 'image.png',
            'learnings' => [
                fake()->sentence(),
                fake()->sentence(),
            ],
        ];
    }

    public function released(?Carbon $date = null): self
    {
        return $this->state(fn (array $attributes) => [
            'released_at' => $date ?? now(),
        ]);
    }
}
