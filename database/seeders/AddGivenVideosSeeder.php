<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Video;
use App\Models\Course;
use Illuminate\Support\Str;

class AddGivenVideosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       if($this->isDataAlreadyGiven()) {
           return;
       }

       $laravelForBeginnersCourse = Course::where('title', 'Laravel for Beginners')->firstOrFail();
       $advancedLaravelCourse = Course::where('title', 'Advanced Laravel')->firstOrFail();
       $tddTheLaravelWayCourse = Course::where('title', 'TDD The Laravel Way')->firstOrFail();

       Video::insert([
           [
                'course_id' => $laravelForBeginnersCourse->id,
                'slug' => Str::of('Laravel for Beginners')->slug(),
                'title' => 'Laravel for Beginners',
                'description' => ' A video course for beginners',
                'vimeo_id' => '1234',
                'duration_in_minutes' => 4
           ],
           [
                'course_id' => $advancedLaravelCourse->id,
                'slug' => Str::of('Advanced Laravel')->slug(),
                'title' => 'Advanced Laravel',
                'description' => ' A video course for advanced Laravel',
                'vimeo_id' => '1234',
                'duration_in_minutes' => 10
           ],
           [
                'course_id' => $tddTheLaravelWayCourse->id,
                'slug' => Str::of('TDD The Laravel Way')->slug(),
                'title' => 'TDD The Laravel Way',
                'description' => ' A video course for TDD',
                'vimeo_id' => '1234',
                'duration_in_minutes' => 10
           ]
           ]);
    }

    private function isDataAlreadyGiven():bool
    {
        return Video::where('title', 'Laravel for Beginners')->count() === 1
        && Video::where('title', 'Advanced Laravel')->count() === 1
        && Video::where('title', 'TDD The Laravel Way')->count() === 1;
    }
}
