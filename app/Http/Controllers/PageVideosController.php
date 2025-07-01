<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Video;
use Illuminate\Http\Request;

class PageVideosController extends Controller
{
    public function __invoke(Request $request, Course $course, ?Video $video = null)
    {

        $video = $video ?? $course->videos()->orderByDesc('id')->first();

        return view('pages.course-videos', [
            'video' => $video,
            'course' => $course,
        ]);
    }
}
