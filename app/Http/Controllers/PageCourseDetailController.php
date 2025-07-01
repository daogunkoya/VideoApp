<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PageCourseDetailController extends Controller
{
    public function __invoke(Request $request, Course $course)
    {

        // dd($course->released()->first()->toArray());
        if (! $course->released_at) {
            throw new NotFoundHttpException('Course not found');
        }

        $course->loadCount('videos');

        return view('pages.course-detail', [
            'course' => $course,
        ]);
    }
}
