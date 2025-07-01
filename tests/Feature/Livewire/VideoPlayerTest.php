
<?php

use App\Livewire\VideoPlayer;
use App\Models\Course;
use App\Models\User;
use App\Models\Video;
use Livewire\Livewire;

function createCourseAndVideo(int $videoCount = 1): Course
{
    return Course::factory()
        ->has(Video::factory()->count($videoCount))
        ->create();

}

beforeEach(function () {

    $this->logginAsUser = loginAsUser();

});

it('shows details for a given video', function () {

    $course = createCourseAndVideo();
    $video = $course->videos->first();


    Livewire::test(VideoPlayer::class, ['video' => $video])
        ->assertSee($video->title)
        ->assertSee($video->description)
        ->assertSee($video->getReadableDuration());
});

it('shows given video', function () {

    $course = createCourseAndVideo();

    $video = $course->videos()->orderByDesc('id')->first();



    $framwUrl = 'https://player.vimeo.com/video/'.$video->vimeo_id;

    Livewire::test(VideoPlayer::class, ['video' => $video])
    // ->assertSee('<iframe src="'.$framwUrl.'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>', false);
        ->assertSeeHtml('<iframe src="'.$framwUrl.'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>');

});

it('shows list of course videos', function () {

    $course = createCourseAndVideo(videoCount: 3);



    $video = Video::where('title, $course->videos->first()->title');

    Livewire::test(VideoPlayer::class, ['video' => $course->videos()->orderByDesc('id')->first()])
        ->assertSee($course->videos->first()->title)
        ->assertSee($course->videos->last()->title)
        ->assertSeeHtml([route('pages.course-videos', [$course, $course->videos[1]])]);
});

it('doesnt include the current route for current video', function () {

    $course = createCourseAndVideo();



    Livewire::test(VideoPlayer::class, ['video' => $course->videos()->orderByDesc('id')->first()])
        ->assertDontSee(route('pages.course-videos', $course));
});

it('marks video as completed', function () {

    $user = User::factory()->create();
    $course = Course::factory()
        ->has(Video::factory()->count(1))
        ->create();

    $user->purchasedCourses()->attach($course);

    loginAsUser($user);
    expect($user->watchedVideos)->toHaveCount(0);

    Livewire::test(VideoPlayer::class, ['video' => $course->videos()->orderByDesc('id')->first()])
        ->assertMethodWired('markVideoAsCompleted')
        ->call('markVideoAsCompleted')
        ->assertMethodNotWired('markVideoAsCompleted')
        ->assertMethodWired('markVideoAsNotCompleted');

    $user->refresh();

    expect($user->watchedVideos)->toHaveCount(1)
        // ->and($user->videos
        ->first()->title->toEqual($course->videos->first()->title);
});

it('marks video as not completed', function () {

    $course = createCourseAndVideo(1);

    loginAsUser($this->logginAsUser);

    $this->logginAsUser->purchasedCourses()->attach($course);
    $this->logginAsUser->watchedVideos()->attach($course->videos()->orderByDesc('id')->first());

    expect($this->logginAsUser->watchedVideos)->toHaveCount(1);

    Livewire::test(VideoPlayer::class, ['video' => $course->videos()->orderByDesc('id')->first()])
    ->assertMethodWired('markVideoAsNotCompleted')
    ->call('markVideoAsNotCompleted')
    ->assertMethodWired('markVideoAsCompleted')
    ->assertMethodNotWired('markVideoAsNotCompleted');

    $this->logginAsUser->refresh();

    expect($this->logginAsUser->watchedVideos)->toHaveCount(0);
    // ->and($user->videos
    // ->first()->title->toEqual($course->videos->first()->title);
});
