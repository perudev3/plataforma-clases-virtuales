<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $courses = Course::orderBy('id', 'asc')->get();

        // Filtrarlos por tipo
        $cursos = $courses->where('programa', 'curso')->get();
        $especializaciones = $courses->where('programa', 'especializacion')->get();
        $diplomados = $courses->where('programa', 'diplomado')->get();

        return view('home', compact('cursos', 'especializaciones','diplomados'));
    }
}
