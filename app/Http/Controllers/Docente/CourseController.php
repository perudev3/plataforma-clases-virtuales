<?php

namespace App\Http\Controllers\Docente;

use App\Http\Controllers\Controller;
use App\Course;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::where('user_id', Auth::id())->get();
        return view('docente.courses.index', compact('courses'));
    }

    public function create()
    {
        $docentes = User::where('role', 'teacher')->orderBy('name')->get();
        return view('docente.courses.create', compact('docentes'));
    }

    public function store(Request $request)
    {
        // IMAGE
        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = time().'_'.$file->getClientOriginalName();
            $destination = public_path('storage/courses');
            if (!File::exists($destination)) File::makeDirectory($destination, 0755, true);
            $file->move($destination, $name);
            $imagePath = 'courses/'.$name;
        }

        // BANNER
        $bannerPath = null;
        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $name = time().'_'.$file->getClientOriginalName();
            $destination = public_path('storage/courses/banners');
            if (!File::exists($destination)) File::makeDirectory($destination, 0755, true);
            $file->move($destination, $name);
            $bannerPath = 'courses/banners/'.$name;
        }

        // CREATE COURSE
        $course = Course::create([
            'title'            => $request->title,
            'subtitle'         => $request->subtitle,           // ★ NUEVO
            'description'      => $request->description,
            'directed_to'      => $request->directed_to,
            'programa'         => $request->programa,
            'start_time'       => $request->start_time,
            'class_days'       => $request->class_days,
            'start_date'       => $request->start_date,
            'duration_weeks'   => $request->duration_weeks,
            'hours'            => $request->hours,
            'modality'         => $request->modality,
            'has_certificate'  => $request->has_certificate,
            'certificate_type' => $request->certificate_type,
            'discount_price'   => $request->discount_price,
            'end_time'         => $request->end_time,
            'is_paid'          => $request->is_paid,
            'price'            => $request->is_paid ? $request->price : null,
            'currency'         => $request->currency,
            'price_display'    => $request->is_paid ? ($request->price_display ?? 'regular') : null, // ★ NUEVO
            'promo_video'      => $request->promo_video,
            'image'            => $imagePath,
            'banner'           => $bannerPath,
            'user_id'          => Auth::id(),
            'status'           => 1,
            'is_featured'      => $request->is_featured,
        ]);

        // SYNC DOCENTES
        if ($request->filled('teacher_ids')) {
            $syncData = [];
            foreach ($request->teacher_ids as $teacherId) {
                $role = $request->input('teacher_role_'.$teacherId, 'colaborador');
                $syncData[$teacherId] = ['role' => $role];
            }
            $course->teachers()->sync($syncData);
        }

        return redirect()
            ->route('courses.index')
            ->with('success', 'Curso creado correctamente ✅');
    }

    public function edit($id)
    {
        $course   = Course::with('teachers')->findOrFail($id);
        $docentes = User::where('role', 'teacher')->orderBy('name')->get();
        return view('docente.courses.edit', compact('course', 'docentes'));
    }

    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $course->title            = $request->title;
        $course->subtitle         = $request->subtitle;         // ★ NUEVO
        $course->programa         = $request->programa;
        $course->description      = $request->description;
        $course->directed_to      = $request->directed_to;
        $course->start_time       = $request->start_time;
        $course->end_time         = $request->end_time;
        $course->duration_weeks   = $request->duration_weeks;
        $course->hours            = $request->hours;
        $course->class_days       = $request->class_days;
        $course->modality         = $request->modality;
        $course->is_paid          = $request->is_paid;
        $course->price            = $request->is_paid ? $request->price : null;
        $course->discount_price   = $request->discount_price;
        $course->currency         = $request->currency;
        $course->price_display    = $request->is_paid ? ($request->price_display ?? 'regular') : null; // ★ NUEVO
        $course->has_certificate  = $request->has_certificate;
        $course->certificate_type = $request->certificate_type;
        $course->promo_video      = $request->promo_video;
        $course->is_featured      = $request->is_featured;

        // IMAGE UPDATE
        if ($request->hasFile('image')) {
            if ($course->image) {
                $old = public_path('storage/'.$course->image);
                if (File::exists($old)) File::delete($old);
            }
            $file = $request->file('image');
            $name = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('storage/courses'), $name);
            $course->image = 'courses/'.$name;
        }

        // BANNER UPDATE
        if ($request->hasFile('banner')) {
            if ($course->banner) {
                $old = public_path('storage/'.$course->banner);
                if (File::exists($old)) File::delete($old);
            }
            $file = $request->file('banner');
            $name = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('storage/courses/banners'), $name);
            $course->banner = 'courses/banners/'.$name;
        }

        $course->save();

        // SYNC DOCENTES
        if ($request->filled('teacher_ids')) {
            $syncData = [];
            foreach ($request->teacher_ids as $teacherId) {
                $role = $request->input('teacher_role_'.$teacherId, 'colaborador');
                $syncData[$teacherId] = ['role' => $role];
            }
            $course->teachers()->sync($syncData);
        } else {
            $course->teachers()->detach();
        }

        return redirect()
            ->route('courses.index')
            ->with('success', 'Curso actualizado correctamente');
    }
}