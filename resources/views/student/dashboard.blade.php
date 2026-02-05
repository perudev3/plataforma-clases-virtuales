@extends('layouts.app')

@section('content')
<div class="container">

    <h3 class="mb-4" style="color:#0B2C4D;font-weight:700;">
        Panel del Docente
    </h3>

    <div class="row">

        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title">Mis Cursos</h5>
                    <p class="card-text">
                        Administra los cursos que dictas.
                    </p>
                    <a href="{{ route('docente.courses.index') }}"
                       class="btn btn-primary btn-block">
                        Ver cursos
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title">Crear Curso</h5>
                    <p class="card-text">
                        Publica un nuevo curso o diplomado.
                    </p>
                    <a href="{{ route('docente.courses.create') }}"
                       class="btn btn-outline-primary btn-block">
                        Crear curso
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title">Mi Perfil</h5>
                    <p class="card-text">
                        Información profesional del docente.
                    </p>
                    <button class="btn btn-secondary btn-block" disabled>
                        Próximamente
                    </button>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
