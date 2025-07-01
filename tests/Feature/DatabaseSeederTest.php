<?php

use App\Models\Course;
use App\Models\Video;
use App\Models\User;
use Illuminate\Support\Facades\App;


it('add given courses', function () {

    //Arrange
    $this->assertDatabaseCount(Course::class, 0);

    //Act
    $this->artisan('db:seed');

    //Assert

    $this->assertDatabaseCount(Course::class, 3);
    $this->assertDatabaseHas(Course::class, [
        'title' => 'Laravel for Beginners',
    ]);
    $this->assertDatabaseHas(Course::class, [
        'title' => 'Advanced Laravel',
    ]);
    $this->assertDatabaseHas(Course::class, [
        'title' => 'TDD The Laravel Way',
    ]);
});


it('add given course only once', function () {

    $this->artisan('db:seed');
    $this->artisan('db:seed');

    $this->assertDatabaseCount(Course::class, 3);
});

it('adds given videos', function () {
    //Arrange
    $this->assertDatabaseCount(Video::class, 0);

    //Act
    $this->artisan('db:seed');

    //Assert

    $laravelForBeginnersCourse = Course::where('title', 'Laravel for Beginners')->firstOrFail();
    $advancedLaravelCourse = Course::where('title', 'Advanced Laravel')->firstOrFail();
    $tddTheLaravelWayCourse = Course::where('title', 'TDD The Laravel Way')->firstOrFail();

    expect($laravelForBeginnersCourse)->videos->toHaveCount(1);
    expect($advancedLaravelCourse)->videos->toHaveCount(1);
    expect($tddTheLaravelWayCourse)->videos->toHaveCount(1);

    $this->assertDatabaseCount(Video::class, 3);



    //    $this->assertDatabaseHas(Course::class, [
    //        'title' => 'Laravel for Beginners',
    //    ]);
    //    $this->assertDatabaseHas(Course::class, [
    //        'title' => 'Advanced Laravel',
    //    ]);
    //    $this->assertDatabaseHas(Course::class, [
    //        'title' => 'TDD The Laravel Way',
    //    ]);
});

it('add given videos only once', function () {
    $this->artisan('db:seed');
    $this->artisan('db:seed');

    $this->assertDatabaseCount(Video::class, 3);
});


it('adds local test user', function () {
    App::partialMock()->shouldReceive('environment')->andReturn('local');
    $this->assertDatabaseCount(User::class, 0);


    $this->artisan('db:seed');


    $this->assertDatabaseCount(User::class, 1);
});

it('does not add test user for prod', function () {
    
    App::partialMock()->shouldReceive('environment')->andReturn('production');
    // Arrange
    $this->assertDatabaseCount(User::class, 0);
    // $this->artisan('db:seed --env=production');
    $this->artisan('db:seed');
    $this->assertDatabaseCount(User::class,0);
});


