@extends('layouts.app')

@section('content')
<div class="container">

    <h3 class="mb-4" style="color:#0B2C4D;font-weight:700;">
        Panel Administrador
    </h3>

    <div class="row">

        {{-- Docentes --}}
        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title">Docentes</h5>
                    <p class="card-text">
                        Crear y administrar docentes.
                    </p>
                    <a href="{{ route('docentes.index') }}"
                       class="btn btn-primary btn-block">
                        Gestionar
                    </a>
                </div>
            </div>
        </div>

        {{-- Cursos --}}
        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title">Cursos</h5>
                    <p class="card-text">
                        Crear y administrar cursos.
                    </p>
                    <a href="{{ route('courses.index') }}"
                       class="btn btn-outline-primary btn-block">
                        Ver cursos
                    </a>
                    <a href="{{ route('courses.create') }}"
                       class="btn btn-primary btn-block mt-2">
                        Crear curso
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
