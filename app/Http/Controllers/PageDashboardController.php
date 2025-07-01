<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageDashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $purchasedCourses = auth()->user()->purchasedCourses()->get();

        return view('dashboard', [
            'purchasedCourses' => $purchasedCourses,
        ]);
    }
}
