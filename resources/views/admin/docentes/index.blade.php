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
            <table class="table table-bordered align-middle">
                <thead class="thead-light">
                    <tr>
                        <th>Foto</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>WhatsApp</th>
                        <th>Nivel Académico</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($docentes as $docente)
                        <tr>
                            <td width="80">
                                @if($docente->photo)
                                    <img src="{{ asset('Laravel/public/storage/' . $docente->photo) }}" 
                                         width="60" 
                                         height="60"
                                         class="rounded-circle"
                                         style="object-fit: cover;">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ $docente->name }}" 
                                         width="60" 
                                         height="60"
                                         class="rounded-circle">
                                @endif
                            </td>

                            <td>
                                <strong>{{ $docente->name }} {{ $docente->lastname }}</strong>
                            </td>

                            <td>{{ $docente->email }}</td>

                            <td>{{ $docente->whatsapp }}</td>

                            <td>
                                {{ $docente->academic_level ?? 'No especificado' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection