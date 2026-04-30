@extends('layouts.app')

@section('content')
<div class="container py-4">

    <!-- HEADER -->
    <div class="syllabus-header">
        <div class="syllabus-header-info">
            <h3 class="fw-bold mb-0">📚 Sílabo del Curso</h3>
            <small class="text-muted">{{ $course->title }}</small>
        </div>
        <a href="{{ route('syllabus.create', $course) }}" class="btn btn-primary btn-add">
            + Agregar tema
        </a>
    </div>

    <!-- ALERT -->
    @if(session('success'))
        <div class="alert alert-success rounded-3">
            {{ session('success') }}
        </div>
    @endif

    <!-- CONTENEDOR -->
    <div class="card border-0 shadow rounded-4">
        <div class="card-body p-0">

            @forelse($syllabus as $item)

            <!-- ITEM -->
            <div class="p-3 p-md-4 border-bottom syllabus-item">

                <!-- FILA PRINCIPAL -->
                <div class="syllabus-row">

                    <!-- ICONO + INFO -->
                    <div class="syllabus-left">

                        <!-- ICONO -->
                        <div class="syllabus-icon flex-shrink-0">
                            @if($item->type === 'video') 🎥
                            @elseif($item->type === 'zoom') 💻
                            @else 📄
                            @endif
                        </div>

                        <!-- TEXTO -->
                        <div class="syllabus-text">
                            <h5 class="mb-1 fw-semibold syllabus-title">
                                {{ $item->order }}. {{ $item->title }}
                            </h5>
                            <p class="text-muted mb-2 syllabus-desc">
                                {{ $item->description }}
                            </p>

                            <!-- BADGES -->
                            <div class="d-flex gap-2 flex-wrap">
                                <span class="badge bg-primary-subtle text-primary px-3 py-2 text-capitalize">
                                    {{ $item->type }}
                                </span>
                                @if($item->duration)
                                <span class="badge bg-secondary-subtle text-secondary px-3 py-2">
                                    ⏱ {{ $item->duration }}
                                </span>
                                @endif
                                @if($item->is_preview)
                                <span class="badge bg-success-subtle text-success px-3 py-2">
                                    Vista previa
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- ACCIONES -->
                    <div class="syllabus-actions">
                        <a href="{{ route('syllabus.edit', [$course, $item]) }}"
                            class="btn btn-outline-warning btn-sm btn-action">
                            ✏️ Editar
                        </a>
                        @if($item->type === 'video')
                        <a href="{{ asset('Laravel/public/storage/'.$item->video_url) }}"
                           target="_blank"
                           class="btn btn-outline-primary btn-sm btn-action">
                            🎬 Ver video
                        </a>
                        @endif

                        @if($item->type === 'zoom')
                        <a href="{{ $item->zoom_link }}"
                           target="_blank"
                           class="btn btn-outline-success btn-sm btn-action">
                            🔗 Entrar Zoom
                        </a>
                        @endif

                        @if($item->pdf)
                        <a href="{{ asset('Laravel/public/storage/'.$item->pdf) }}"
                           target="_blank"
                           class="btn btn-outline-danger btn-sm btn-action">
                            📄 Ver PDF
                        </a>
                        @endif
                    </div>

                </div>

            </div>

            @empty

            <!-- EMPTY -->
            <div class="text-center py-5 px-3">
                <div style="font-size:50px">📭</div>
                <h5 class="fw-semibold mt-3">Este curso aún no tiene contenido</h5>
                <p class="text-muted mb-4">Empieza agregando los temas del sílabo</p>
                <a href="{{ route('syllabus.create', $course) }}" class="btn btn-primary px-4">
                    Agregar primer tema
                </a>
            </div>

            @endforelse

        </div>
    </div>

</div>

<!-- STYLES -->
<style>
/* ── HEADER ─────────────────────────────────────────── */
.syllabus-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.25rem;
    flex-wrap: wrap;
}

.syllabus-header-info {
    min-width: 0; /* evita overflow en móvil */
}

.btn-add {
    white-space: nowrap;
    flex-shrink: 0;
}

/* ── ITEM ────────────────────────────────────────────── */
.syllabus-item {
    transition: background .2s ease;
}

.syllabus-item:hover {
    background: #fafafa;
}

/* ── FILA PRINCIPAL: icono+info a la izq, acciones a la der ── */
.syllabus-row {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 1rem;
}

/* ── IZQUIERDA: icono + texto ────────────────────────── */
.syllabus-left {
    display: flex;
    gap: 0.75rem;
    align-items: flex-start;
    min-width: 0;
    flex: 1;
}

.syllabus-icon {
    width: 46px;
    height: 46px;
    min-width: 46px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    background: #f1f3f5;
    border-radius: 12px;
}

.syllabus-text {
    min-width: 0;
    flex: 1;
}

.syllabus-title {
    font-size: 1rem;
    line-height: 1.4;
    word-break: break-word;
}

.syllabus-desc {
    font-size: 0.875rem;
    line-height: 1.5;
    word-break: break-word;
    margin-bottom: 0.5rem !important;
}

/* ── ACCIONES ────────────────────────────────────────── */
.syllabus-actions {
    display: flex;
    flex-direction: column;
    gap: 0.4rem;
    align-items: flex-end;
    flex-shrink: 0;
}

.btn-action {
    white-space: nowrap;
    font-size: 0.8rem;
}

/* ── MÓVIL (≤ 576px) ─────────────────────────────────── */
@media (max-width: 576px) {
    /* Header: título arriba, botón abajo */
    .syllabus-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .btn-add {
        width: 100%;
        text-align: center;
    }

    /* Fila del item: todo apilado verticalmente */
    .syllabus-row {
        flex-direction: column;
        gap: 0.75rem;
    }

    /* Acciones: al ancho completo, en fila horizontal */
    .syllabus-actions {
        flex-direction: row;
        flex-wrap: wrap;
        align-items: flex-start;
        width: 100%;
    }

    .btn-action {
        flex: 1 1 auto;
        text-align: center;
    }

    .syllabus-icon {
        width: 40px;
        height: 40px;
        min-width: 40px;
        font-size: 18px;
    }

    .syllabus-title {
        font-size: 0.95rem;
    }
}

/* ── TABLET (577px – 768px) ──────────────────────────── */
@media (min-width: 577px) and (max-width: 768px) {
    .syllabus-actions {
        flex-direction: column;
        align-items: flex-end;
    }

    .btn-action {
        width: 100%;
        text-align: center;
    }
}
</style>
@endsection