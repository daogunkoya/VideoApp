<?php

use App\Models\Course;
use App\Models\User;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('it gives back successful response for homepage', function () {
    // expect(true)->toBeTrue();
    $this->get(route('pages.home'))->assertStatus(200);
});

it('gives back successful response for course detail page ', function () {

    $course = Course::factory()->released()->create();

    $this->get(route('pages.course-detail', $course))->assertOk();
});

it('gives back successful response for dashboard page', function () {

    $user = User::factory()->create();

    $this->actingAs($user);

    $this->get(route('page.dashboard'))->assertOk();

});

it('does not find JetStream registration page', function () {
    // Arrange
    // Assert
    // Act
    $this->get('register')->assertNotFound();
});

it('gives back successful response for course videos page', function () {

    $course = Course::factory()
        ->has(Video::factory()->count(3))
        ->released()->create();

    // act & assert
    loginAsUser();

    $this->get(route('pages.course-videos', $course))
        ->assertOk();
});
