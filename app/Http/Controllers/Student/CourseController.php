<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Course;
use App\Course_user;
use App\lesson_user;
use App\Syllabus;
use Illuminate\Http\Request;

class CourseController extends Controller
{

    public function index(Request $request)
    {
        $query = \App\Course::query();

        // Filtro por búsqueda
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filtro por tipo
        if ($request->programa) {
            $query->where('programa', $request->programa);
        }

        $courses = $query->latest()->paginate(12);

        return view('student.courses.explore', compact('courses'));
    }

    public function myCourses()
    {
        $courses = auth()->user()->courses()->latest()->get();
        return view('student.courses.index', compact('courses'));
    }

    public function progress(Course $course, Request $request)
    {
        $user = auth()->user();

        // Verificar inscripción
        abort_unless(
            $user->courses()->where('course_id', $course->id)->exists(),
            403
        );

        $isPaid = $course->isPaidBy($user);

        // Obtener todas las lecciones ordenadas
        $lessons = $course->syllabus()->orderBy('order')->get();

        if ($lessons->isEmpty()) {
            return view('student.courses.ProgressCourse', [
                'course'          => $course,
                'syllabus'        => $lessons,
                'currentLesson'   => null,
                'prevLesson'      => null,
                'nextLesson'      => null,
                'completedCount'  => 0,
                'totalCount'      => 0,
                'progressPercent' => 0,
            ]);
        }

        // Determinar lección actual
        $currentLesson = $lessons->firstWhere('id', $request->lesson) ?? $lessons->first();

        // 🚨 BLOQUEO REAL
        if (!$course->canAccessLesson($user, $currentLesson)) {
            return redirect()
                ->route('alumno.courses.checkout', $course->id)
                ->with('error', 'Debes realizar el pago para desbloquear el resto del curso.');
        }

        $currentIndex = $lessons->search(fn($l) => $l->id === $currentLesson->id);

        $completedIds    = $user->completedLessons()->pluck('syllabus_id');
        $completedCount  = $completedIds->intersect($lessons->pluck('id'))->count();
        $totalCount      = $lessons->count();
        $progressPercent = $totalCount ? round(($completedCount / $totalCount) * 100) : 0;

        return view('student.courses.ProgressCourse', [
            'course'          => $course,
            'syllabus'        => $lessons,
            'currentLesson'   => $currentLesson,
            'prevLesson'      => $lessons[$currentIndex - 1] ?? null,
            'nextLesson'      => $lessons[$currentIndex + 1] ?? null,
            'completedCount'  => $completedCount,
            'totalCount'      => $totalCount,
            'progressPercent' => $progressPercent,
        ]);
    }

    public function completeLesson(Course $course, Syllabus $lesson)
    {
        // Verifica que la lección pertenece al curso
        abort_unless($lesson->course_id === $course->id, 403);

        auth()->user()->completedLessons()->syncWithoutDetaching([$lesson->id]);

        return redirect()->route('courses.progress', [
            'course' => $course->id,
            'lesson' => $lesson->id,
        ])->with('success', '¡Clase marcada como completada!');
    }
}
