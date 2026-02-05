<?php

namespace App\Http\Controllers\Docente;

use App\Http\Controllers\Controller;
use App\Course;
use App\Syllabus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SyllabusController extends Controller
{
    public function index(Course $course)
    {
        $this->authorizeTeacher($course);

        $syllabus = Syllabus::where('course_id', $course->id)
            ->orderBy('order')
            ->get();

        return view('docente.syllabus.index', compact('course', 'syllabus'));
    }

    public function create(Course $course)
    {   
        $this->authorizeTeacher($course);

        return view('syllabus.create', compact('course'));
        /* return view('docente.syllabus.create', compact('course')); */
    }

    public function store(Request $request, Course $course)
    {
            // 2️⃣ Preparar video
            $videoPath = null;
            if ($request->type === 'video' && $request->hasFile('video_file')) {
                $destination = storage_path('app/public/syllabus/videos');
                if (!file_exists($destination)) {
                    mkdir($destination, 0755, true);
                    Log::info('Carpeta creada: '.$destination);
                } else {
                    Log::info('Carpeta ya existe: '.$destination);
                }

                $videoPath = $request->file('video_file')->store('syllabus/videos', 'public');
                Log::info('Video subido: '.$videoPath);
            } else {
                Log::info('No es video, videoPath = null');
            }

            // 3️⃣ Crear Syllabus
            try {
                $syllabus = Syllabus::create([
                    'course_id' => $course->id,
                    'title' => $request->title,
                    'description' => $request->description,
                    'type' => $request->type,
                    'video_url' => $videoPath,
                    'zoom_link' => $request->zoom_link,
                    'order' => 0,
                ]);

            } catch (\Exception $e) {
                return back()->with('error', 'No se pudo guardar el tema: '.$e->getMessage());
            }

            // 4️⃣ Redirigir con éxito
            return redirect()
                ->route('syllabus.index', ['course' => $course->id])
                ->with('success', 'Tema agregado correctamente');
    }



    private function authorizeTeacher(Course $course)
    {
        if ($course->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para este curso');
        }
    }
}
