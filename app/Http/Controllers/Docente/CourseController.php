<?php

namespace App\Http\Controllers\Docente;

use App\Http\Controllers\Controller;
use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::where('user_id', Auth::id())->get();
        return view('docente.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('docente.courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_paid' => 'required|boolean',
            'price' => 'nullable|required_if:is_paid,1'
        ]);

        Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'is_paid' => $request->is_paid,
            'price' => $request->is_paid ? $request->price : null,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('docente.courses.index')
            ->with('success', 'Curso creado correctamente');
    }
}
