<?php

namespace App\Http\Controllers\Docente;

use App\Http\Controllers\Controller;
use App\Course;
use App\Syllabus;
use Illuminate\Http\Request;

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

        return view('docente.syllabus.create', compact('course'));
    }

    public function store(Request $request, Course $course)
    {

        if ($course->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required',
            'type' => 'required|in:video,zoom',
            'video_file' => 'required_if:type,video|mimes:mp4,mov,webm|max:51200',
            'zoom_link' => 'required_if:type,zoom|url',
        ]);

        $videoPath = null;

        if ($request->type === 'video' && $request->hasFile('video_file')) {
            $videoPath = $request->file('video_file')
                ->store('syllabus/videos', 'public');
        }

        Syllabus::create([
            'course_id' => $course->id,
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'video_url' => $videoPath,
            'zoom_link' => $request->zoom_link,
            'order' => 0,
        ]);

        return redirect()
            ->route('docente.syllabus.index', $course)
            ->with('success', 'Tema agregado correctamente');
    }

    private function authorizeTeacher(Course $course)
    {
        if ($course->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para este curso');
        }
    }
}
