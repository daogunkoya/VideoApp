
<?php

use App\Models\Course;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('only return released courses for released scope', function () {

    Course::factory()->released()->create();
    Course::factory()->create();

    // expect(Course::released()->count())->toBe(1);
    expect(Course::released()->get())->toHaveCount(1)
        ->first()->id->toEqual(1);
});

it('tests course has videos', function () {

    $course = Course::factory()->released()->create();
    $video = Video::factory()->count(3)->create([
        'course_id' => $course->id,
    ]);

    expect($course->videos)->toHaveCount(3)->each->toBeInstanceOf(Video::class);
});
