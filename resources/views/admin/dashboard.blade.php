@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 mb-4">
            <h3 class="font-weight-bold text-dark">
                Panel Administrador
            </h3>
            <p class="text-muted">
                Gestión académica ESIPEC
            </p>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5>Docentes</h5>
                    <p class="text-muted">Crear y administrar docentes</p>
                    <a href="{{ route('docentes.index') }}" class="btn btn-primary btn-sm">
                        Gestionar
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
