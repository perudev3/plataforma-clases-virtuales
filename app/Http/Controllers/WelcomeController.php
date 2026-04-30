<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\User;
use App\Review;

class WelcomeController extends Controller
{
    public function index(){
        $courses = Course::orderBy('id', 'asc')->get();

        // Filtrarlos por tipo
        $cursos = $courses->where('programa', 'curso');
        $especializaciones = $courses->where('programa', 'especializacion');
        $diplomados = $courses->where('programa', 'diplomado');
        $docentes = User::where('role', 'teacher')->get();

        $featuredCourses = Course::where('is_featured', true)
                            ->where('status', true)
                            ->latest()
                            ->take(6)
                            ->get();


        return view('welcome', compact('cursos', 'especializaciones','diplomados', 'featuredCourses', 'docentes'));
    }

 public function show(Course $course)
{
    $course->load(['teachers', 'syllabus', 'reviews.user']);

    $averageRating = round($course->reviews()->avg('rating'), 1);
    $totalReviews = $course->reviews()->count();

    $userRating = null;

    if (auth()->check()) {
        $userRating = $course->reviews()
            ->where('user_id', auth()->id())
            ->first();
    }

    return view('detailCourse', compact(
        'course',
        'averageRating',
        'totalReviews',
        'userRating'
    ));
}

    public function storeStart(Request $request, $courseId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5'
        ]);

        \App\Review::updateOrCreate(
            [
                'course_id' => $courseId,
                'user_id' => auth()->id()
            ],
            [
                'rating' => $request->rating,
                'comment' => $request->comment
            ]
        );

        return back()->with('success', 'Calificación guardada');
    }
}
