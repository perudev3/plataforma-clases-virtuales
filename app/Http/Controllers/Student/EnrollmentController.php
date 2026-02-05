<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Course;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function enroll(Course $course)
    {
        $user = auth()->user();

        // Evitar duplicados
        if (!$user->courses()->where('course_id', $course->id)->exists()) {
            $user->courses()->attach($course->id, [
                'enrolled_at' => now()
            ]);
        }

        return back()->with('success', 'Te inscribiste correctamente');
    }

    public function myCourses()
    {
        $courses = auth()->user()->courses()->latest()->get();

        return view('student.courses.index', compact('courses'));
    }
}
