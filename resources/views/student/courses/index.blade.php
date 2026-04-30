@extends('layouts.app')

@section('content')
<div class="container py-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="mb-0 fw-bold">🎓 Mis Cursos</h3>
            <small class="text-muted">Accede a todos tus programas académicos activos</small>
        </div>
        <span class="badge bg-primary-subtle text-primary px-3 py-2 fs-6">
            {{ $courses->count() }} curso{{ $courses->count() !== 1 ? 's' : '' }}
        </span>
    </div>

    <!-- LISTADO -->
    @if($courses->count())

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach($courses as $course)
            <div class="col">
                <div class="card border-0 shadow-sm rounded-4 h-100">

                    {{-- Imagen si existe --}}
                    @if($course->image)
                        <img
                            src="{{ asset('Laravel/public/storage/' . $course->image) }}"
                            class="card-img-top rounded-top-4"
                            style="height:160px; object-fit:cover;"
                            alt="{{ $course->title }}">
                    @else
                        <div class="rounded-top-4 bg-primary-subtle d-flex align-items-center
                                    justify-content-center" style="height:160px; font-size:48px;">
                            📚
                        </div>
                    @endif

                    <div class="card-body d-flex flex-column p-4">

                        {{-- Badges de tipo y programa (si existen) --}}
                        <div class="d-flex gap-2 flex-wrap mb-2">
                            @isset($course->programa)
                                <span class="badge bg-primary-subtle text-primary px-2 py-1 text-capitalize">
                                    {{ $course->programa }}
                                </span>
                            @endisset

                            @isset($course->is_paid)
                                @if($course->is_paid)
                                    <span class="badge bg-success-subtle text-success px-2 py-1">De pago</span>
                                @else
                                    <span class="badge bg-secondary-subtle text-secondary px-2 py-1">Gratis</span>
                                @endif
                            @endisset
                        </div>

                        {{-- Título --}}
                        <h5 class="fw-semibold mb-1">{{ $course->title }}</h5>

                        {{-- Descripción corta (opcional) --}}
                        @isset($course->description)
                            <p class="text-muted small mb-3" style="
                                display: -webkit-box;
                                -webkit-line-clamp: 2;
                                -webkit-box-orient: vertical;
                                overflow: hidden;">
                                {{ $course->description }}
                            </p>
                        @endisset

                        {{-- Spacer para empujar el botón al fondo --}}
                        <div class="mt-auto pt-3">
                            <a href="{{ route('alumno.courses.progress', $course->id) }}"
                                class="btn btn-primary w-100">
                                    Entrar al curso →
                            </a>
                        </div>

                    </div>
                </div>
            </div>
            @endforeach
        </div>

    @else

        <!-- EMPTY STATE -->
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body text-center py-5">

                <div style="font-size:50px">📭</div>

                <h5 class="fw-semibold mt-3">Aún no tienes cursos asignados</h5>

                <p class="text-muted mb-0">
                    Cuando te inscribas a un programa, aparecerá aquí.
                </p>

            </div>
        </div>

    @endif

</div>
@endsection