<?php

use App\Models\Course;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('shows course details', function () {

    $course = Course::factory()->released()->create(['image_name' => 'test.jpg']);

    $this->get(route('pages.course-detail', $course))
        ->assertOk()
        ->assertSee($course->title)
        ->assertSee($course->tagline)
        ->assertSee(asset("images/$course->image_name"))
        ->assertSee($course->learnings[0])
        ->assertSee($course->learnings[1]);

    // $this->get(route('course-detail', $course))->assertSee($course->title);
});

it('test does not show unreleased course', function () {

    $course = Course::factory()->create();

    $this->get(route('pages.course-detail', $course))->assertNotFound();
});

it('shows course video count', function () {

    $course = Course::factory()
        ->has(Video::factory()->count(3))
        ->released()->create();
    // $video = Video::factory()->count(3)->create(['course_id' => $course->id]);

    $this->get(route('pages.course-detail', $course))
        ->assertOk()
        ->assertSee($course->videos()->count());
});
