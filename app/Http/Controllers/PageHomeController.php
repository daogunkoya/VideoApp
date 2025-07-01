<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class PageHomeController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('pages.home', [
            'courses' => Course::query()->released()->latest('released_at')->get(),
        ]);
    }
}
