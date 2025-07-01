<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;
use Illuminate\Support\Str;

class AddGivenCoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        if ($this->isDataAlreadyGiven()) {
            return;
        }
        
        Course::create([
            'slug' => Str::of('Laravel for Beginners')->slug(),
            'title' => 'Laravel for Beginners',
            'tagline' => 'Make your first Laravel app',
            'description' => ' A video course for beginners',
            'learnings' => ['test', 'test'],
            'image_name' => 'laravel-for-beginners.jpg',
            'learnings' => [
                'How to start with Laravel',
                'How to create a Laravel app',
                'How to create a Laravel app',
            ],
            'released_at' => now(),
        ]);

        Course::create([
            'slug' => Str::of('Advanced Laravel')->slug(),
            'title' => 'Advanced Laravel',
            'tagline' => 'Make your first Laravel app',
            'description' => ' A video course for advanced Laravel',
            'learnings' => ['test', 'test'],
            'image_name' => 'laravel-for-beginners.jpg',
            'learnings' => [
                'How to start with Laravel',
                'How to create a Laravel app',
                'How to create a Laravel app',
            ],
            'released_at' => now(),
        ]);


        Course::create([
            'slug' => Str::of('TDD The Laravel Way')->slug(),
            'title' => 'TDD The Laravel Way',
            'tagline' => 'Make your first Laravel app',
            'description' => ' A video course for advanced Laravel',
            'learnings' => ['test', 'test'],
            'image_name' => 'laravel-for-beginners.jpg',
            'learnings' => [
                'How to start with Laravel',
                'How to create a Laravel app',
                'How to create a Laravel app',
            ],
            'released_at' => now(),
        ]);
    }


    private function isDataAlreadyGiven():bool
    {
        return Course::where('title', 'Laravel for Beginners')->exists()
        && Course::where('title', 'Advanced Laravel')->exists()
        && Course::where('title', 'TDD The Laravel Way')->exists();
    }   

}
