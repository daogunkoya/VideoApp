<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Video>
 */
class VideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'course_id' => Course::factory(),
            'title' => fake()->sentence(),
            'slug' => fake()->unique()->slug(),
            'description' => fake()->paragraph(),
            'duration_in_minutes' => fake()->randomNumber(3),
            'vimeo_id' => fake()->uuid(),
        ];
    }
}
