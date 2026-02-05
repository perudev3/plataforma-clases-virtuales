@extends('layouts.app')

@section('content')
    <h3>Mis Cursos</h3>

    <div class="row">
    @foreach($courses as $course)
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body">
                    <h5>{{ $course->title }}</h5>

                    <a href="{{ route('student.courses.show', $course->id) }}"
                    class="btn btn-success">
                    Entrar al curso
                    </a>
                </div>
            </div>
        </div>
    @endforeach
    </div>
@endsection