<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    public function index()
    {
        return view('student.profile');
    }

   public function update(Request $request)
{
    
    $user = auth()->user();

    $request->validate([
        'email' => 'required|email',
        'photo' => 'nullable|image'
    ]);

    $user->email = $request->email;

    if ($request->hasFile('photo')) {

        // eliminar foto anterior
        if ($user->photo) {
            $oldPath = public_path('storage/' . $user->photo);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }
        }

        $file = $request->file('photo');
        $name = time() . '_' . $file->getClientOriginalName();

        $destination = public_path('storage/profile');

        if (!File::exists($destination)) {
            File::makeDirectory($destination, 0755, true);
        }

        $file->move($destination, $name);

        // IMPORTANTE: solo guardas "profile/archivo.jpg"
        $user->photo = 'profile/' . $name;
    }

    $user->save();

    return back()
        ->with('success', 'Perfil actualizado correctamente')
        ->with('tab', 'foto');
}
}