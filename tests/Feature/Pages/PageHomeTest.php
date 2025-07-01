<?php

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);
it('shows courses overview ', function () {

    // Arrange
    $firstCourse = Course::factory()->released()->create();
    $secondCourse = Course::factory()->released()->create();
    $thirdCourse = Course::factory()->released()->create();

    // Act
    $this->get('/')->assertSee([
        $firstCourse->title,
        $secondCourse->title,
        $thirdCourse->title,
    ]);

});

it('shows only released courses', function () {
    $firstCourse = Course::factory()->released()->create([
        'released_at' => \Carbon\Carbon::yesterday(),
    ]);

    $secondCourse = Course::factory()->create();

    $this->get('/')
        ->assertSee($firstCourse->title)
        ->assertDontSee($secondCourse->title);

});

it('shows courses by release date', function () {

    $firstCourse = Course::factory()->released()->create([
        'released_at' => \Carbon\Carbon::yesterday(),
    ]);
    $secondCourse = Course::factory()->released()->create([
        'released_at' => \Carbon\Carbon::now(),
    ]);
    $thirdCourse = Course::factory()->released()->create([
        'released_at' => \Carbon\Carbon::tomorrow(),
    ]);
    $this->get('/')
        ->assertSeeInOrder([
            $thirdCourse->title,
            $secondCourse->title,
            $firstCourse->title,
        ]);

});

it('included login if not logged in', function () {
    $this->get(route('pages.home'))
        ->assertOk()
        ->assertSeeText('Login')
        ->assertSee(route('login'));
});

// details of it is in fortify.php
it('inludes logout if logged in', function () {
    loginAsUser();
    $this->get(route('pages.home'))
        ->assertOk()
        ->assertSeeText('Logout');
});
