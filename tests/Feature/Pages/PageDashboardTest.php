
<?php
use App\Models\Course;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Sequence;

it('can not be accessed by guest', function () {
    $this->get(route('page.dashboard'))->assertRedirect(route('login'));
});

it('list purchased courses', function () {
    $user = User::factory()
        ->has(Course::factory()
            ->released()
            ->count(2)
            ->state(new Sequence(
                ['title' => 'test'],
                ['title' => 'test2']
            )
            ), 'purchasedCourses')
        ->create();

    $this->actingAs($user);
    $this->get(route('page.dashboard'))
        ->assertOk()
        ->assertSee('test')
        ->assertSee('test2');
});

it('does not list other courses', function () {
    $user = User::factory()->create();
    $course = Course::factory()->create();

    $this->actingAs($user);
    $this->get(route('page.dashboard'))
        ->assertOk()
        ->assertDontSee($course->title);

});

it('shows latest purchased course first', function () {
    $user = User::factory()->create();
    $firstPurchasedCourse = Course::factory()->released(Carbon::now())->create();
    $secondPurchasedCourse = Course::factory()->released(Carbon::now()->subDays(1))->create();

    $user->purchasedCourses()->attach($firstPurchasedCourse, ['created_at' => Carbon::now()]);
    $user->purchasedCourses()->attach($secondPurchasedCourse, ['created_at' => Carbon::now()->subDays(1)]);

    $this->actingAs($user);
    $this->get(route('page.dashboard'))
        ->assertOk()
        ->assertSeeTextInOrder([
            $firstPurchasedCourse->title,
            $secondPurchasedCourse->title]);

});

it('includes link to product videos', function () {
    $user = User::factory()
        ->has(Course::factory(), 'purchasedCourses')
        ->create();

    loginAsUser($user);

    test()->get(route('page.dashboard'))
        ->assertOk()
        ->assertSeeText('Watch Videos')
        ->assertSee(route('pages.course-videos', $user->purchasedCourses->first()));
});

it('includes logout if logged in', function () {
    loginAsUser();
    $this->get(route('page.dashboard'))
        ->assertOk()
        ->assertSeeText('Logout');
});
