<?php

namespace App\Http\Controllers\Docente;

use App\Http\Controllers\Controller;
use App\Course;
use App\Syllabus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SyllabusController extends Controller
{

    private function authorizeTeacher(Course $course)
    {
        if ($course->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para este curso');
        }
    }

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

        return view('docente.syllabus.create', compact('course'));
    }

    public function store(Request $request, Course $course)
    {
        // VIDEO
        $videoUrl = null;

        if ($request->type === 'video') {
            $videoUrl = $request->video_url;
        }
        /* if ($request->type === 'video' && $request->hasFile('video_file')) {
            $videoPath = $request->file('video_file')
                ->store('syllabus/videos', 'public');
        } */

        // PDF
        $pdfPath = null;
        if ($request->hasFile('pdf')) {
            $pdfPath = $request->file('pdf')
                ->store('syllabus/pdfs', 'public');
        }

        // GUARDAR
        Syllabus::create([
            'course_id'   => $course->id,
            'title'       => $request->title,
            'description' => $request->description,
            'duration'    => $request->duration,
            'type'        => $request->type,
            'video_url'   => $videoUrl,
            'zoom_link'   => $request->zoom_link,
            'pdf'         => $pdfPath,
            'is_preview'  => $request->is_preview ?? 0,
            'order'       => $request->order ?? 0,
        ]);

        return redirect()
            ->route('syllabus.index', $course)
            ->with('success', 'Tema agregado correctamente');
    }

    public function edit(Course $course, Syllabus $syllabus)
    {
        $this->authorizeTeacher($course);

        if ($syllabus->course_id !== $course->id) {
            abort(404);
        }

        return view('docente.syllabus.edit', compact('course', 'syllabus'));
    }

    public function update(Request $request, Course $course, Syllabus $syllabus)
    {
        $this->authorizeTeacher($course);

        // VIDEO
        $videoUrl = null;

        if ($request->type === 'video') {
            $videoUrl = $request->video_url;
        }

        // PDF
        $pdfPath = $syllabus->pdf;

        if ($request->hasFile('pdf')) {
            $pdfPath = $request->file('pdf')
                ->store('syllabus/pdfs', 'public');
        }

        // UPDATE
        $syllabus->update([
            'title'       => $request->title,
            'description' => $request->description,
            'duration'    => $request->duration,
            'type'        => $request->type,
            'video_url'   => $videoUrl,
            'zoom_link'   => $request->zoom_link,
            'pdf'         => $pdfPath,
            'is_preview'  => $request->is_preview ?? 0,
            'order'       => $request->order ?? 0,
        ]);

        return redirect()
            ->route('syllabus.index', $course)
            ->with('success', 'Tema actualizado correctamente');
    }
}
