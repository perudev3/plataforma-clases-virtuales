<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $students = User::where('role', 'student')
            ->when($search, function ($q) use ($search) {
                $q->where(function ($q2) use ($search) {
                    $q2->where('name', 'like', "%$search%")
                       ->orWhere('lastname', 'like', "%$search%")
                       ->orWhere('email', 'like', "%$search%")
                       ->orWhere('dni', 'like', "%$search%");
                });
            })
            ->withCount('courses')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.students.index', compact('students', 'search'));
    }

    public function show(User $student)
    {
        abort_if($student->role !== 'student', 404);

        $enrollments = $student->courses()->withPivot(['enrolled_at', 'is_paid'])->get();

        return view('admin.students.show', compact('student', 'enrollments'));
    }

    public function destroy(User $student)
    {
        abort_if($student->role !== 'student', 403);

        $student->courses()->detach();
        $student->delete();

        return redirect()->route('admin.students.index')
            ->with('success', 'Estudiante eliminado correctamente.');
    }

    public function togglePaid(Request $request, User $student, $courseId)
    {
        abort_if($student->role !== 'student', 403);

        $isPaid = $request->input('is_paid', 0);

        $student->courses()->updateExistingPivot($courseId, [
            'is_paid' => $isPaid,
        ]);

        return back()->with('success', 'Estado de pago actualizado.');
    }
}