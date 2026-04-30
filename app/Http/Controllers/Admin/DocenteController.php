<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class DocenteController extends Controller
{
    public function index()
    {
        $docentes = User::where('role', 'teacher')->get();
        return view('admin.docentes.index', compact('docentes'));
    }

    public function create()
    {
        return view('admin.docentes.create');
    }

    public function store(Request $request)
    {

        $photoPath = null;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('docentes', 'public');
        }
        
        User::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'whatsapp' => $request->whatsapp,
            'photo' => $photoPath,
            'academic_level' => $request->academic_level,
            'role' => 'teacher',
        ]);

        return redirect()->route('docentes.index')
            ->with('success', 'Docente creado correctamente');
    }
}
