<?php

use App\Livewire\VideoPlayer;
use App\Models\Course;
use App\Models\Video;

it('cannot be accessed by guest', function () {

    $course = Course::factory()
        ->has(Video::factory()->count(2))
        ->create();

    $this->get(route('pages.course-videos', $course))->assertRedirect(route('login'));
});

it('includes video player', function () {

    $course = Course::factory()
        ->has(Video::factory()->count(1))
        ->create();

    // act && assert
    loginAsUser();

    // dump($course->videos->first()->title);
    // $this->get(route('page.course.videos', $course))

    $this->get(route('pages.course-videos', ['course' => $course, 'video' => $course->videos()->orderByDesc('id')->first()]))
        ->assertOk()
        ->assertSeeText($course->videos->first()->title);

});

It('shows first course video by default', function () {

    $course = Course::factory()
        ->has(Video::factory()->count(2))
        ->create();

    // act && assert
    loginAsUser();
    // $this->get(route('page.course.videos', $course))

    $this->get(route('pages.course-videos', $course))
        ->assertOk()
        ->assertSee($course->videos->first()->title)
        ->assertSeeLivewire(VideoPlayer::class);
});

it('show provided course videos', function () {

    $course = Course::factory()
        ->has(Video::factory()->count(1))
        ->create();

    loginAsUser();

    $this->get(route('pages.course-videos',
        ['course' => $course, 'video' => $course->videos()->orderByDesc('id')->first()]))
        ->assertOk()
        ->assertSee($course->videos->first()->title);
    //  ->assertSee($course->videos->last()->title);

});
