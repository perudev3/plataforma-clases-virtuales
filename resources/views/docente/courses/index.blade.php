@extends('layouts.app')

@section('content')
<div class="container py-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="mb-0 fw-bold">📚 Mis Cursos</h3>
            <small class="text-muted">Administra y gestiona todos tus programas académicos</small>
        </div>

        <a href="{{ route('courses.create') }}" class="btn btn-primary px-4">
            + Crear curso
        </a>
    </div>
    <!-- LISTADO -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">

            @if($courses->count())

            <div class="table-responsive">
                <table class="table align-middle mb-0">

                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Curso</th>
                            <th>Tipo</th>
                            <th>Programa</th>
                            <th>Precio</th>
                            <th class="text-end pe-4">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($courses as $course)
                        <tr>

                            <!-- CURSO -->
                            <td class="ps-4">
                                <div class="d-flex align-items-center gap-3">

                                    <!-- <img
                                        src="{{ asset('storage/'.$course->image) }}"
                                        class="rounded"
                                        width="70"
                                        height="50"
                                        style="object-fit:cover"> -->
                                    <img
                                        src="{{ asset('Laravel/public/storage/'.$course->image) }}"
                                        class="rounded"
                                        width="70"
                                        height="50"
                                        style="object-fit:cover">

                                    <div>
                                        <div class="fw-semibold">
                                            {{ $course->title }}
                                        </div>
                                    </div>

                                </div>
                            </td>

                            <!-- TIPO -->
                            <td>
                                @if($course->is_paid)
                                    <span class="badge bg-success-subtle text-success px-3 py-2">
                                        De pago
                                    </span>
                                @else
                                    <span class="badge bg-secondary-subtle text-secondary px-3 py-2">
                                        Gratis
                                    </span>
                                @endif
                            </td>

                            <!-- PROGRAMA -->
                            <td>
                                <span class="badge bg-primary-subtle text-primary px-3 py-2 text-capitalize">
                                    {{ $course->programa }}
                                </span>
                            </td>

                            <!-- PRECIO -->
                            <td class="fw-semibold">
                                @if($course->is_paid)
                                    S/ {{ number_format($course->price, 2) }}
                                @else
                                    —
                                @endif
                            </td>

                            <!-- ACCIONES -->
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">

                                    <a
                                        href="{{ route('syllabus.index', $course->id) }}"
                                        class="btn btn-outline-primary btn-sm">
                                        Sílabo
                                    </a>

                                    <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-outline-secondary btn-sm">
                                        Editar
                                    </a>


                                    <button
                                        class="btn btn-outline-danger btn-sm">
                                        Eliminar
                                    </button>

                                </div>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

            @else

            <!-- EMPTY STATE -->
            <div class="text-center py-5">

                <div style="font-size:50px">📭</div>

                <h5 class="fw-semibold mt-3">
                    Aún no has creado cursos
                </h5>

                <p class="text-muted mb-4">
                    Empieza creando tu primer programa académico
                </p>

                <a href="{{ route('courses.create') }}" class="btn btn-primary px-4">
                    Crear mi primer curso
                </a>

            </div>

            @endif

        </div>
    </div>

</div>
@endsection