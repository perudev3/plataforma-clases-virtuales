@extends('layouts.landing')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-center">
        Seminario
    </h1>

    {{-- BUSCADOR --}}
    <div class="row mb-4 justify-content-center">
        <div class="col-md-6">
            <form method="GET" action="{{ url()->current() }}">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Busca un programa..." value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit">Buscar</button>
                </div>
            </form>
        </div>
    </div>

    {{-- LISTA DE PROGRAMAS --}}
    <div class="row">
        @forelse($programas as $programa)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('Laravel/public/storage/'.$programa->image) }}" class="card-img-top" alt="{{ $programa->title }}">
                    <div class="card-body d-flex flex-column">
                        <span class="badge bg-{{ $programa->is_paid ? 'danger' : 'success' }}">
                            {{ $programa->is_paid ? 'Pago' : 'Gratis' }}
                        </span>
                        <h5 class="card-title mt-2">{{ $programa->title }}</h5>
                        <p class="card-text mb-1">
                            Precio: S/{{ $programa->price ?? '0.00' }}
                        </p>
                        <p class="card-text text-muted mb-2">
                            {{ $programa->type ?? 'Curso' }}
                        </p>
                        <div class="mt-auto d-flex justify-content-between">
                            <a href="{{ route('courses.show', $programa->id) }}" class="btn btn-primary btn-sm">
                                Ver detalles
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center w-100">No hay programas disponibles.</p>
        @endforelse
    </div>

    {{-- PAGINACIÓN --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $programas->links() }}
    </div>
</div>
@endsection
