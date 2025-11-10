<?php

namespace App\Http\Controllers;

use App\Models\Course;

class HomeController extends Controller
{
    public function __invoke()
    {
        $featuredCourses = Course::where('featured', true)->take(4)->get();
        return view('home', compact('featuredCourses'));
    }
}
