<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CourseEnrollmentMail;

class EnrollmentController extends Controller
{
    public function enroll(Request $request, Course $course)
    {
        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | Validar rol
        |--------------------------------------------------------------------------
        */
        if ($user->role !== 'student') {
            abort(403, 'No autorizado.');
        }

        /*
        |--------------------------------------------------------------------------
        | Evitar duplicados
        |--------------------------------------------------------------------------
        */
        $alreadyEnrolled = $user->courses()
            ->where('course_id', $course->id)
            ->exists();

        if ($alreadyEnrolled) {
            return back()->with('info', 'Ya est¨¢s inscrito en este curso');
        }

        /*
        |--------------------------------------------------------------------------
        | Determinar estado de pago
        |--------------------------------------------------------------------------
        */
        $paymentStatus = $course->is_paid ? 'paid' : 'free';

        /*
        |--------------------------------------------------------------------------
        | Registrar inscripci¨®n
        |--------------------------------------------------------------------------
        */
        $user->courses()->attach($course->id, [
            'enrolled_at'   => now(),
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        
        /*
        |--------------------------------------------------------------------------
        | Enviar Email
        |--------------------------------------------------------------------------
        */
        Mail::to($user->email)
        ->send(new CourseEnrollmentMail($user, $course));


        /*
        |--------------------------------------------------------------------------
        | Respuesta
        |--------------------------------------------------------------------------
        */
        return redirect()
            ->route('alumno.mis-courses')
            ->with('success', 'Te inscribiste correctamente al curso');
    }

    public function myCourses()
    {
        $courses = auth()->user()->courses()->latest()->get();

        return view('student.courses.index', compact('courses'));
    }
}
