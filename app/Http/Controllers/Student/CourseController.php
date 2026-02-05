<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function myCourses()
    {
        $courses = auth()->user()->courses()->latest()->get();

        return view('student.courses.index', compact('courses'));
    }
}
