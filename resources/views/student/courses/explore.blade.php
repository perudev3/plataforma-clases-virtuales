@extends('layouts.app')

@section('content')

<style>
    :root {
        --azul-base: #0B2C4D;
        --celeste: #00B4E6;
        --dorado: #C9A24D;
        --gris-bg: #F4F6F8;
    }

    .explore-hero {
        background: linear-gradient(135deg, #0B2C4D 0%, #1a4a72 50%, #0e3a60 100%);
        padding: 50px 0 40px;
        position: relative;
        overflow: hidden;
    }

    .explore-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(0,180,230,0.15) 0%, transparent 70%);
        border-radius: 50%;
    }

    .explore-hero::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -5%;
        width: 350px;
        height: 350px;
        background: radial-gradient(circle, rgba(201,162,77,0.1) 0%, transparent 70%);
        border-radius: 50%;
    }

    .explore-hero .container { position: relative; z-index: 2; }

    .explore-hero h1 {
        font-size: 2rem;
        font-weight: 800;
        color: #fff;
        margin-bottom: 6px;
    }

    .explore-hero p {
        color: rgba(255,255,255,0.7);
        font-size: 15px;
        margin-bottom: 0;
    }

    /* SEARCH BAR */
    .search-bar-wrap {
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(255,255,255,0.15);
        backdrop-filter: blur(10px);
        border-radius: 50px;
        padding: 6px 6px 6px 22px;
        display: flex;
        align-items: center;
        max-width: 560px;
    }

    .search-bar-wrap input {
        background: transparent;
        border: none;
        outline: none;
        color: #fff;
        flex: 1;
        font-size: 15px;
    }

    .search-bar-wrap input::placeholder { color: rgba(255,255,255,0.5); }

    .search-bar-wrap button {
        background: var(--celeste);
        border: none;
        border-radius: 40px;
        color: #fff;
        padding: 10px 22px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: all .2s ease;
        white-space: nowrap;
    }

    .search-bar-wrap button:hover { background: #009fce; }

    /* FILTROS */
    .filters-bar {
        background: #fff;
        border-bottom: 1px solid #e8edf2;
        padding: 14px 0;
        position: sticky;
        top: 0;
        z-index: 100;
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
    }

    .filter-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 18px;
        border-radius: 30px;
        border: 1.5px solid #dde2e8;
        background: transparent;
        color: #5a6474;
        font-size: 13.5px;
        font-weight: 600;
        cursor: pointer;
        transition: all .2s ease;
        text-decoration: none;
    }

    .filter-btn:hover, .filter-btn.active {
        background: var(--azul-base);
        border-color: var(--azul-base);
        color: #fff;
        text-decoration: none;
    }

    .filter-btn .count {
        background: rgba(0,0,0,0.12);
        border-radius: 10px;
        padding: 1px 7px;
        font-size: 11px;
    }

    .filter-btn.active .count { background: rgba(255,255,255,0.2); }

    /* STATS */
    .results-info {
        font-size: 13.5px;
        color: #8a95a3;
        font-weight: 500;
    }

    .results-info strong { color: var(--azul-base); }

    /* COURSE CARDS */
    .courses-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(290px, 1fr));
        gap: 22px;
    }

    .course-card {
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 2px 12px rgba(0,0,0,0.07);
        transition: transform .25s ease, box-shadow .25s ease;
        display: flex;
        flex-direction: column;
    }

    .course-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 32px rgba(11,44,77,0.14);
    }

    .course-card-img {
        position: relative;
        height: 175px;
        overflow: hidden;
    }

    .course-card-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .4s ease;
    }

    .course-card:hover .course-card-img img { transform: scale(1.06); }

    .course-card-img .badge-tipo {
        position: absolute;
        top: 12px;
        left: 12px;
        background: var(--azul-base);
        color: #fff;
        font-size: 11px;
        font-weight: 700;
        padding: 4px 11px;
        border-radius: 20px;
        text-transform: uppercase;
        letter-spacing: .6px;
    }

    .course-card-img .badge-tipo.curso    { background: #0077cc; }
    .course-card-img .badge-tipo.diplomado { background: #6a0dad; }
    .course-card-img .badge-tipo.especializacion { background: #c62828; }
    .course-card-img .badge-tipo.seminario  { background: #1a7a4a; }

    .badge-gratis {
        position: absolute;
        top: 12px;
        right: 12px;
        background: #16a34a;
        color: #fff;
        font-size: 11px;
        font-weight: 700;
        padding: 4px 11px;
        border-radius: 20px;
    }

    .course-card-body {
        padding: 18px 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .course-card-title {
        font-size: 15px;
        font-weight: 700;
        color: var(--azul-base);
        margin-bottom: 8px;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .course-meta-row {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 14px;
    }

    .course-meta-item {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 12.5px;
        color: #6b7280;
    }

    .course-meta-item i { color: var(--celeste); font-size: 12px; }

    .course-card-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: auto;
        padding-top: 14px;
        border-top: 1px solid #f0f3f6;
    }

    .course-price {
        font-size: 18px;
        font-weight: 800;
        color: var(--azul-base);
    }

    .course-price .currency {
        font-size: 13px;
        font-weight: 600;
        color: #8a95a3;
        margin-right: 2px;
    }

    .course-price.free { color: #16a34a; font-size: 15px; }

    .btn-ver {
        background: var(--celeste);
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 9px 18px;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        transition: all .2s ease;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .btn-ver:hover {
        background: #009fce;
        color: #fff;
        text-decoration: none;
        transform: translateX(2px);
    }

    /* EMPTY STATE */
    .empty-state {
        text-align: center;
        padding: 80px 20px;
        color: #8a95a3;
    }

    .empty-state .icon {
        font-size: 60px;
        opacity: .3;
        display: block;
        margin-bottom: 16px;
    }

    .empty-state h5 {
        font-size: 17px;
        font-weight: 700;
        color: #4a5568;
        margin-bottom: 6px;
    }

    /* PAGINATION */
    .pagination .page-link {
        border-radius: 8px !important;
        margin: 0 2px;
        border: 1.5px solid #dde2e8;
        color: var(--azul-base);
        font-weight: 600;
        font-size: 13.5px;
    }

    .pagination .page-item.active .page-link {
        background: var(--azul-base);
        border-color: var(--azul-base);
    }

    @media (max-width: 768px) {
        .explore-hero { padding: 35px 0 28px; }
        .explore-hero h1 { font-size: 1.6rem; }
        .search-bar-wrap { max-width: 100%; }
        .courses-grid { grid-template-columns: 1fr; }
    }
</style>

{{-- HERO --}}
<div class="explore-hero">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-md-6">
                <h1>📚 Explorar Programas</h1>
                <p>Descubre todos nuestros cursos, diplomados y especializaciones</p>
            </div>
            <div class="col-md-6">
                <form method="GET" action="{{ route('alumno.courses.index') }}">
                    <div class="search-bar-wrap">
                        <i class="fas fa-search" style="color:rgba(255,255,255,0.4); margin-right:8px;"></i>
                        <input
                            type="text"
                            name="search"
                            placeholder="Busca un programa..."
                            value="{{ request('search') }}"
                        >
                        <button type="submit">Buscar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- FILTROS --}}
<div class="filters-bar">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
            <div class="d-flex flex-wrap gap-2">
                @php
                    $search = request('search');
                @endphp

                <a href="{{ route('alumno.courses.index', $search ? ['search' => $search] : []) }}"
                class="filter-btn {{ !request('programa') ? 'active' : '' }}">
                    Todos
                </a>
                <a href="{{ route('alumno.courses.index', array_filter(['search' => $search, 'programa' => 'curso'])) }}"
                class="filter-btn {{ request('programa') == 'curso' ? 'active' : '' }}">
                    Cursos
                </a>
                <a href="{{ route('alumno.courses.index', array_filter(['search' => $search, 'programa' => 'especializacion'])) }}"
                class="filter-btn {{ request('programa') == 'especializacion' ? 'active' : '' }}">
                    Especializaciones
                </a>
                <a href="{{ route('alumno.courses.index', array_filter(['search' => $search, 'programa' => 'diplomado'])) }}"
                class="filter-btn {{ request('programa') == 'diplomado' ? 'active' : '' }}">
                    Diplomados
                </a>
                <a href="{{ route('alumno.courses.index', array_filter(['search' => $search, 'programa' => 'seminario'])) }}"
                class="filter-btn {{ request('programa') == 'seminario' ? 'active' : '' }}">
                    Seminarios
                </a>
            </div>
            <span class="results-info">
                <strong>{{ $courses->total() }}</strong> programas encontrados
            </span>
        </div>
    </div>
</div>

{{-- CONTENIDO --}}
<div class="container py-4">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">
            ✅ {{ session('success') }}
            <button type="button" class="btn-close" data-dismiss="alert"></button>
        </div>
    @endif

    @if($courses->count())
        <div class="courses-grid mb-4">
            @foreach($courses as $course)
                <div class="course-card">
                    <div class="course-card-img">
                        <img
                            src="{{ $course->image ? asset('Laravel/public/storage/'.$course->image) : asset('images/placeholder-course.jpg') }}"
                            alt="{{ $course->title }}"
                        >
                        @if($course->programa)
                            <span class="badge-tipo {{ $course->programa }}">
                                {{ ucfirst($course->programa) }}
                            </span>
                        @endif
                        @if(!$course->is_paid)
                            <span class="badge-gratis">Gratis</span>
                        @endif
                    </div>

                    <div class="course-card-body">
                        <h6 class="course-card-title">{{ $course->title }}</h6>

                        <div class="course-meta-row">
                            @if($course->modality)
                                <span class="course-meta-item">
                                    <i class="fas fa-laptop"></i> {{ ucfirst($course->modality) }}
                                </span>
                            @endif
                            @if($course->duration_weeks)
                                <span class="course-meta-item">
                                    <i class="fas fa-clock"></i> {{ $course->duration_weeks }} semanas
                                </span>
                            @endif
                            @if($course->start_date)
                                <span class="course-meta-item">
                                    <i class="fas fa-calendar"></i>
                                    {{ \Carbon\Carbon::parse($course->start_date)->format('d M Y') }}
                                </span>
                            @endif
                        </div>

                        <div class="course-card-footer">
                            <div class="course-price {{ !$course->is_paid ? 'free' : '' }}">
                                @if($course->is_paid)
                                    <span class="currency">S/</span>{{ number_format($course->price ?? 0, 2) }}
                                @else
                                    🎁 Gratuito
                                @endif
                            </div>
                            <a href="{{ route('courses.show', $course->id) }}" class="btn-ver">
                                Ver más <i class="fas fa-arrow-right" style="font-size:11px;"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- PAGINACIÓN --}}
        <div class="d-flex justify-content-center">
            {{ $courses->appends(request()->query())->links() }}
        </div>

    @else
        <div class="empty-state">
            <span class="icon">🔍</span>
            <h5>No encontramos resultados</h5>
            <p>Intenta con otros términos o explora todas las categorías.</p>
            <a href="{{ route('alumno.courses.index') }}" class="btn btn-primary mt-2">Ver todos los programas</a>
        </div>
    @endif

</div>

@endsection