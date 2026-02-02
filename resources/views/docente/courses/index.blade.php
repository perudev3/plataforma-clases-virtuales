@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h4>Mis Cursos</h4>
        <a href="{{ route('docente.courses.create') }}" class="btn btn-primary">
            Crear curso
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            @if($courses->count())
                <table class="table">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Tipo</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($courses as $course)
                            <tr>
                                <td>{{ $course->title }}</td>
                                <td>
                                    {{ $course->is_paid ? 'De pago' : 'Gratis' }}
                                </td>
                                <td>{{ ucfirst($course->status) }}</td>
                                <td>
                                    <a href="{{ route('docente.syllabus.index', $course->id) }}"
                                        class="btn btn-sm btn-outline-primary">
                                        Gestionar Sílabo
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-muted">Aún no has creado cursos.</p>
            @endif
        </div>
    </div>
</div>
@endsection
