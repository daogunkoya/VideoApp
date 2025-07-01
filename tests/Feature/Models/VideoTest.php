<?php

use App\Models\Course;
use App\Models\Video;
use App\Models\User;

it('it belongs to a  course', function () {

    $video = Video::factory()
        ->has(Course::factory())
        ->create();

    expect($video->course)->toBeInstanceOf(Course::class);
});

it('gives back readable  video duration', function () {

    $video = Video::factory()->create();

    // $this->assertEquals($video->duration_in_minutes, $video->readableDuration());

    expect($video->duration_in_minutes.'mins')->toEqual($video->getReadableDuration());
});

it('tells if current user has not already watched the video', function () {

    $video = Video::factory()->create();
    // $user = User::factory()->create();

    loginAsUser();

   // expect($video->alreadyWatchedByCurrentUser())->toBeTrue(); //$video->alreadyWatchedByCurrentUser

    // $user->watchedVideos()->attach($video);

    expect($video->alreadyWatchedByCurrentUser())->toBeFalse();
});

it('tells if current user has  already watched the video', function () {

   
     $user = User::factory()
     ->has(Video::factory()->count(1), 'watchedVideos')
     ->create();

    loginAsUser($user);

   // expect($video->alreadyWatchedByCurrentUser())->toBeTrue(); //$video->alreadyWatchedByCurrentUser

    // $user->watchedVideos()->attach($video);

    expect($user->watchedVideos()->first()->alreadyWatchedByCurrentUser())->toBeTrue();
});

