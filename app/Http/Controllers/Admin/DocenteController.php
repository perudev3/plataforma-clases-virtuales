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
        $request->validate([
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users',
            'whatsapp' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'whatsapp' => $request->whatsapp,
            'role' => 'teacher',
        ]);

        return redirect()->route('docentes.index')
            ->with('success', 'Docente creado correctamente');
    }
}
