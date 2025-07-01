<?php

use App\Models\Course;
use App\Models\User;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('has courses', function () {
    $user = User::factory()
        ->has(Course::factory()->released()->count(2), 'purchasedCourses')
        ->create();

    expect($user->purchasedCourses)->toHaveCount(2)->each->toBeInstanceOf(Course::class);

});

it('has a videos', function () {
    $user = User::factory()
        ->has(Video::factory()->count(2), 'watchedVideos')
        ->create();
    expect($user->watchedVideos)->toHaveCount(2)->each->toBeInstanceOf(Video::class);
});
