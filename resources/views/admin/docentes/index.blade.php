@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h4>Docentes</h4>
        <a href="{{ route('docentes.create') }}" class="btn btn-primary btn-sm">
            + Nuevo Docente
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>WhatsApp</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($docentes as $docente)
                        <tr>
                            <td>{{ $docente->name }} {{ $docente->lastname }}</td>
                            <td>{{ $docente->email }}</td>
                            <td>{{ $docente->whatsapp }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
