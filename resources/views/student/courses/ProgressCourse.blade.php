@extends('layouts.app')

@section('content')
<div class="container-fluid py-4 px-4">

    @php
        $isPaid = $course->isPaidBy(auth()->user());
    @endphp

    {{-- ══════════════════════════════════════════
         HEADER DEL CURSO
    ══════════════════════════════════════════ --}}
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1 small">
                    <li class="breadcrumb-item">
                        <a href="{{ route('alumno.mis-courses') }}" class="text-decoration-none">
                            Mis Cursos
                        </a>
                    </li>
                    <li class="breadcrumb-item active">{{ $course->title }}</li>
                </ol>
            </nav>
            <h4 class="fw-bold mb-0">{{ $course->title }}</h4>
            @isset($course->programa)
                <span class="badge bg-primary-subtle text-primary px-2 py-1 text-capitalize mt-1">
                    {{ $course->programa }}
                </span>
            @endisset
        </div>

        {{-- Progreso global --}}
        <div class="progress-header-box">
            <div class="d-flex justify-content-between align-items-center mb-1">
                <small class="text-muted fw-semibold">Tu progreso</small>
                <small class="fw-bold text-primary">{{ $progressPercent }}%</small>
            </div>
            <div class="progress rounded-pill" style="height:10px;">
                <div
                    class="progress-bar bg-primary rounded-pill"
                    role="progressbar"
                    style="width: {{ $progressPercent }}%;"
                    aria-valuenow="{{ $progressPercent }}"
                    aria-valuemin="0"
                    aria-valuemax="100">
                </div>
            </div>
            <small class="text-muted">
                {{ $completedCount }} de {{ $totalCount }} clases completadas
            </small>
        </div>
    </div>


    {{-- ══════════════════════════════════════════
         LAYOUT: VIDEO  |  SÍLABO
    ══════════════════════════════════════════ --}}
    <div class="row g-4 align-items-start">

        {{-- ─── COLUMNA IZQUIERDA: Video + info de clase ─── --}}
        <div class="col-lg-8">
        @if($currentLesson)

            {{-- Player --}}
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">

                @if($currentLesson->video_url)

                    @php
                        $url = $currentLesson->video_url;
                    @endphp

                    @if(str_contains($url, 'youtube.com') ||
                        str_contains($url, 'youtu.be') ||
                        str_contains($url, 'vimeo.com'))

                        @php
                            $embedBase = $url;

                            if (str_contains($url, 'youtube.com/watch')) {
                                parse_str(parse_url($url, PHP_URL_QUERY), $ytParams);
                                $videoId   = $ytParams['v'] ?? '';
                                $embedBase = 'https://www.youtube-nocookie.com/embed/' . $videoId;
                            } elseif (str_contains($url, 'youtu.be/')) {
                                $videoId   = basename(parse_url($url, PHP_URL_PATH));
                                $embedBase = 'https://www.youtube-nocookie.com/embed/' . $videoId;
                            } elseif (str_contains($url, 'vimeo.com/')) {
                                $videoId   = basename(parse_url($url, PHP_URL_PATH));
                                $embedBase = 'https://player.vimeo.com/video/' . $videoId;
                            }

                            $appUrl    = rtrim(config('app.url'), '/');
                            $separator = str_contains($embedBase, '?') ? '&' : '?';
                            $embedUrl  = $embedBase . $separator
                                    . 'rel=0'
                                    . '&modestbranding=1'
                                    . '&playsinline=1'
                                    . '&enablejsapi=1'
                                    . '&fs=1'
                                    . '&origin=' . urlencode($appUrl);
                        @endphp

                        <div class="video-wrapper">
                            <iframe
                                src="{{ $embedUrl }}"
                                title="{{ $currentLesson->title }}"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share; fullscreen"
                                allowfullscreen
                                referrerpolicy="strict-origin-when-cross-origin"
                                loading="lazy"
                                class="video-iframe"
                                style="-webkit-overflow-scrolling: touch;">
                            </iframe>
                        </div>

                    @else
                        <div class="video-wrapper">
                            <video
                                controls
                                playsinline
                                class="video-local">
                                <source src="{{ asset('Laravel/public/storage/' . $url) }}" type="video/mp4">
                                Tu navegador no soporta el video.
                            </video>
                        </div>
                    @endif

                @else
                    <div class="video-placeholder d-flex flex-column align-items-center justify-content-center">
                        <span style="font-size:52px; opacity:.4;">🎬</span>
                        <p class="text-white-50 mt-2 mb-0 small">Video no disponible</p>
                    </div>
                @endif

                {{-- Info de la clase activa --}}
                <div class="card-body p-4">
                    <div class="d-flex flex-wrap align-items-start justify-content-between gap-3">

                        <div>
                            <p class="lesson-label mb-1">
                                Clase {{ $currentLesson->order ?? '—' }}
                            </p>
                            <h5 class="fw-bold mb-0">{{ $currentLesson->title }}</h5>
                            @isset($currentLesson->description)
                                <p class="text-muted mt-2 mb-0 small">
                                    {{ $currentLesson->description }}
                                </p>
                            @endisset
                        </div>

                        {{-- Botón marcar como completada --}}
                        @if(!$currentLesson->isCompletedBy(auth()->user()))
                            <form action="{{ route('alumno.lessons.complete', [$course->id, $currentLesson->id]) }}" method="POST" class="flex-shrink-0">
                                @csrf
                                <button type="submit" class="btn-complete">
                                    ✔ Marcar como completada
                                </button>
                            </form>
                        @else
                            <span class="badge-done">
                                ✔ Completada
                            </span>
                        @endif

                    </div>
                </div>
            </div>

            {{-- Navegación Anterior / Siguiente --}}
            <div class="d-flex justify-content-between gap-3 mb-4">
                @if($prevLesson)
                    <a href="{{ route('alumno.courses.progress', ['course' => $course->id, 'lesson' => $prevLesson->id]) }}"
                       class="nav-lesson-btn">
                        ← Anterior
                    </a>
                @else
                    <div></div>
                @endif

                @if($nextLesson)
                    <a href="{{ route('alumno.courses.progress', ['course' => $course->id, 'lesson' => $nextLesson->id]) }}"
                       class="nav-lesson-btn nav-lesson-btn--next">
                        Siguiente →
                    </a>
                @else
                    <div></div>
                @endif
            </div>

            @if(!$isPaid)
                <div class="card border-0 shadow-sm rounded-4 unlock-card">
                    <div class="card-body text-center py-4">
                        <h5 class="fw-bold mb-2">🔓 Desbloquea el curso completo</h5>
                        <p class="text-muted mb-3">
                            Obtén acceso a todas las clases y continúa tu aprendizaje sin límites.
                        </p>
                        <form action="{{ route('alumno.checkout.pay', $course->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-pay">
                                💳 Comprar ahora
                            </button>
                        </form>
                    </div>
                </div>
            @endif

        @else
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                <div class="video-placeholder d-flex flex-column align-items-center justify-content-center">
                    <span style="font-size:52px; opacity:.4;">📚</span>
                    <p class="text-white-50 mt-2 mb-0">Este curso aún no tiene clases disponibles.</p>
                    <small class="text-white-25 mt-1">Vuelve pronto</small>
                </div>
            </div>
        @endif

        </div>{{-- /col video --}}


        {{-- ─── COLUMNA DERECHA: Sílabo ─── --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 syllabus-card">
                <div class="card-header bg-transparent border-0 px-4 pt-4 pb-2">
                    <h6 class="fw-bold mb-0 syllabus-title">📋 Temario del curso</h6>
                    <small class="text-muted">{{ $completedCount }}/{{ $totalCount }} completadas</small>
                </div>

                {{-- ══════════════════════════════════════════
                     LISTA EN ACORDEÓN — rediseño premium
                ══════════════════════════════════════════ --}}
                <div class="syllabus-scroll" id="syllabusAccordion">

                    @foreach($syllabus as $index => $lesson)
                        @php
                            $isActive = $currentLesson && $lesson->id === $currentLesson->id;
                            $isDone   = $lesson->isCompletedBy(auth()->user());
                            $isLocked = !$isPaid && $lesson->order > 2;
                            $hasPdf   = !empty($lesson->pdf);
                            $accordionId = 'lesson-acc-' . $lesson->id;
                            // Abrir automáticamente la lección activa si tiene PDF
                            $isOpenByDefault = $isActive && $hasPdf;
                        @endphp

                        @if($isLocked)
                            {{-- ── LECCIÓN BLOQUEADA ── --}}
                            <div class="acc-item locked-item">
                                <div class="acc-header d-flex align-items-center gap-3 px-4 py-3">
                                    <span class="lesson-badge lesson-badge--locked">🔒</span>
                                    <div class="flex-grow-1 min-w-0">
                                        <p class="lesson-title mb-0 text-muted text-truncate">{{ $lesson->title }}</p>
                                        <small class="text-muted fst-italic" style="font-size:11px;">Disponible al comprar</small>
                                    </div>
                                </div>
                            </div>

                        @else
                            {{-- ── LECCIÓN ACCESIBLE (con o sin PDF) ── --}}
                            <div class="acc-item {{ $isActive ? 'acc-item--active' : '' }} {{ $isDone ? 'acc-item--done' : '' }}">

                                {{-- Cabecera: siempre visible --}}
                                <div class="acc-header d-flex align-items-center gap-3 px-4 py-3
                                            {{ $hasPdf ? 'acc-header--expandable' : '' }}"
                                     @if($hasPdf)
                                         data-target="#{{ $accordionId }}"
                                         aria-expanded="{{ $isOpenByDefault ? 'true' : 'false' }}"
                                         aria-controls="{{ $accordionId }}"
                                         role="button"
                                     @endif>

                                    {{-- Badge estado --}}
                                    <div class="flex-shrink-0">
                                        @if($isDone)
                                            <span class="lesson-badge lesson-badge--done">
                                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                                            </span>
                                        @elseif($isActive)
                                            <span class="lesson-badge lesson-badge--playing">
                                                <svg width="9" height="9" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                                            </span>
                                        @else
                                            <span class="lesson-badge lesson-badge--default">{{ $lesson->order ?? $index+1 }}</span>
                                        @endif
                                    </div>

                                    {{-- Título + meta --}}
                                    <div class="flex-grow-1 min-w-0">
                                        {{-- Título: link solo al video, no al toggle --}}
                                        <a href="{{ route('alumno.courses.progress', ['course' => $course->id, 'lesson' => $lesson->id]) }}"
                                           class="lesson-title-link {{ $isActive ? 'lesson-title-link--active' : '' }}"
                                           onclick="event.stopPropagation();">
                                            {{ $lesson->title }}
                                        </a>

                                        {{-- Duración --}}
                                        @isset($lesson->duration)
                                            <div class="mt-1">
                                                <span class="lesson-meta-chip">
                                                    <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                                    {{ $lesson->duration }} min
                                                </span>
                                            </div>
                                        @endisset
                                    </div>

                                    {{-- Indicador de que tiene PDF / chevron --}}
                                    @if($hasPdf)
                                        <div class="flex-shrink-0 acc-chevron-wrap"
                                        style="background: #e5e5e5;
                                                padding: 5px;
                                                border-radius: 11px;">
                                            <svg class="acc-chevron ms-1" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
                                        </div>
                                    @endif

                                </div>{{-- /acc-header --}}

                                {{-- Panel colapsable con recursos PDF --}}
                                @if($hasPdf)
                                    <div id="{{ $accordionId }}"
                                         class="acc-collapse {{ $isOpenByDefault ? '' : 'open' }}">
                                        <div class="acc-body px-4 pb-3 pt-1">

                                            {{-- Separador visual --}}
                                            <div class="acc-divider mb-2"></div>

                                            <p class="acc-resources-label mb-2">
                                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                                                Material descargable
                                            </p>

                                            {{-- Tarjeta PDF -- soporte para múltiples si en el futuro es array --}}
                                            @php
                                                $pdfs = is_array($lesson->pdf) ? $lesson->pdf : [$lesson->pdf];
                                            @endphp

                                            @foreach($pdfs as $pdfIndex => $pdfFile)
                                                @php
                                                    $pdfName = basename($pdfFile);
                                                    // Quitar hash/timestamp si los hay (formato: nombre_abc123.pdf)
                                                    $cleanName = preg_replace('/_[a-f0-9]{8,}(\.\w+)$/', '$1', $pdfName);
                                                    $cleanName = str_replace(['_', '-'], ' ', pathinfo($cleanName, PATHINFO_FILENAME));
                                                    $cleanName = ucwords($cleanName);
                                                @endphp
                                                @if($isPaid)
                                                  {{-- ✅ Puede descargar --}}
                                                  <a href="{{ asset('Laravel/public/storage/' . $pdfFile) }}"
                                                     target="_blank"
                                                     rel="noopener"
                                                     class="pdf-resource-card"
                                                     onclick="event.stopPropagation();">

                                                      {{-- Ícono PDF --}}
                                                      <div class="pdf-icon-wrap">
                                                          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                                              <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                                              <polyline points="14 2 14 8 20 8"/>
                                                              <line x1="9" y1="13" x2="15" y2="13"/>
                                                              <line x1="9" y1="17" x2="13" y2="17"/>
                                                          </svg>
                                                          <span class="pdf-ext-label">PDF</span>
                                                      </div>

                                                      {{-- Nombre --}}
                                                      <div class="pdf-info flex-grow-1 min-w-0">
                                                          <span class="pdf-filename">{{ Str::limit($cleanName, 28) }}</span>
                                                          <span class="pdf-sub">Clase {{ $lesson->order ?? $index+1 }} · Recurso {{ $pdfIndex + 1 }}</span>
                                                      </div>

                                                      {{-- Botón --}}
                                                      <div class="pdf-download-btn flex-shrink-0">
                                                          Descargar
                                                      </div>

                                                    </a>
                                                @else
                                                    {{-- ❌ NO puede descargar --}}
                                                    <div class="pdf-resource-card" style="opacity:.6; cursor:not-allowed;">

                                                        {{-- Ícono PDF --}}
                                                        <div class="pdf-icon-wrap">
                                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                                                <polyline points="14 2 14 8 20 8"/>
                                                                <line x1="9" y1="13" x2="15" y2="13"/>
                                                                <line x1="9" y1="17" x2="13" y2="17"/>
                                                            </svg>
                                                            <span class="pdf-ext-label">PDF</span>
                                                        </div>

                                                        {{-- Nombre --}}
                                                        <div class="pdf-info flex-grow-1 min-w-0">
                                                            <span class="pdf-filename">{{ Str::limit($cleanName, 28) }}</span>
                                                            <span class="pdf-sub">Clase {{ $lesson->order ?? $index+1 }} · Recurso {{ $pdfIndex + 1 }}</span>
                                                        </div>

                                                        {{-- Botón bloqueado --}}
                                                        <div class="pdf-download-btn flex-shrink-0">
                                                            🔒 Comprar para descargar
                                                        </div>

                                                    </div>
                                                @endif
                                            @endforeach

                                        </div>
                                    </div>
                                @endif

                            </div>{{-- /acc-item --}}
                        @endif
                    @endforeach

                </div>{{-- /syllabus-scroll --}}

                @if(!$isPaid)
                    <div class="px-4 pb-3">
                        <div class="unlock-alert small text-center mb-0">
                            🔒 {{ $syllabus->count() - 2 }} clases bloqueadas.
                            <form action="{{ route('alumno.checkout.pay', $course->id) }}" method="POST" class="mt-2">
                                @csrf
                                <button type="submit" class="btn-pay btn-pay--sm">
                                    Comprar curso
                                </button>
                            </form>
                        </div>
                    </div>
                @endif

                <div class="card-footer bg-transparent border-0 px-4 py-3">
                    <div class="d-flex justify-content-between mb-1">
                        <small class="text-muted">Progreso general</small>
                        <small class="fw-bold" style="color:var(--celeste);">{{ $progressPercent }}%</small>
                    </div>
                    <div class="progress rounded-pill" style="height:6px;">
                        <div class="progress-bar-custom rounded-pill" style="width:{{ $progressPercent }}%;"></div>
                    </div>
                </div>

            </div>
        </div>{{-- /col sílabo --}}

    </div>{{-- /row --}}

</div>

<style>
/* ═══════════════════════════════════
   VARIABLES
═══════════════════════════════════ */
:root {
    --azul:       #0B2C4D;
    --azul-med:   #143d67;
    --celeste:    #00B4E6;
    --celeste-bg: rgba(0,180,230,.10);
    --dorado:     #C9A24D;
    --verde:      #16a34a;
    --verde-bg:   rgba(22,163,74,.10);
    --gris-bg:    #F4F6F8;
    --gris-b:     #e2e8f0;
    --texto:      #1e293b;
    --texto-sec:  #64748b;
    --blanco:     #ffffff;
    --sombra:     0 4px 24px rgba(11,44,77,.10);
}

/* ═══════════════════════════════════
   BREADCRUMB
═══════════════════════════════════ */
.breadcrumb-item a { color: var(--celeste); font-weight: 600; font-size: 13px; }
.breadcrumb-item.active { color: var(--texto-sec); font-size: 13px; }
.breadcrumb-item + .breadcrumb-item::before { color: var(--gris-b); }

/* ═══════════════════════════════════
   HEADER PROGRESO BOX
═══════════════════════════════════ */
.progress-header-box { min-width: 200px; max-width: 260px; width: 100%; }

/* ═══════════════════════════════════
   TÍTULO
═══════════════════════════════════ */
h4.fw-bold {
    font-family: 'Montserrat', sans-serif;
    font-size: 1.35rem; font-weight: 800; color: var(--azul);
}

/* ═══════════════════════════════════
   BARRAS DE PROGRESO
═══════════════════════════════════ */
.progress { background: var(--gris-b); }
.progress-bar.bg-primary {
    background: linear-gradient(90deg, var(--celeste), var(--azul-med)) !important;
}
.progress-bar-custom {
    height: 100%;
    background: linear-gradient(90deg, var(--celeste), var(--azul-med));
    border-radius: 50px;
    transition: width .5s ease;
}

/* ═══════════════════════════════════
   VIDEO WRAPPER — 16:9 puro
═══════════════════════════════════ */
.video-wrapper {
    position: relative;
    width: 100%;
    padding-bottom: 56.25%;
    background: #000;
    overflow: hidden;
    min-height: 220px;
}

.video-iframe,
.video-local {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    border: none;
    object-fit: contain;
    background: #000;
}

@media (min-width: 768px) { .video-wrapper { min-height: 340px; } }
@media (min-width: 992px) { .video-wrapper { min-height: 420px; } }

/* ═══════════════════════════════════
   PLACEHOLDER
═══════════════════════════════════ */
.video-placeholder {
    width: 100%; min-height: 320px;
    background: linear-gradient(135deg, #061828, #0B2C4D);
}
@media (min-width: 992px) { .video-placeholder { min-height: 440px; } }

/* ═══════════════════════════════════
   INFO CLASE
═══════════════════════════════════ */
.lesson-label {
    font-family: 'Montserrat', sans-serif;
    font-size: 11px; font-weight: 700;
    letter-spacing: 1.4px; text-transform: uppercase;
    color: var(--celeste);
}

/* ═══════════════════════════════════
   BOTÓN COMPLETADA
═══════════════════════════════════ */
.btn-complete {
    display: inline-flex; align-items: center; gap: 7px;
    background: linear-gradient(135deg, var(--verde), #15803d);
    color: #fff; border: none;
    font-family: 'Montserrat', sans-serif;
    font-size: 13px; font-weight: 700;
    padding: 10px 22px; border-radius: 50px; cursor: pointer;
    box-shadow: 0 4px 14px rgba(22,163,74,.35);
    transition: all .22s ease;
}
.btn-complete:hover { transform: translateY(-2px); box-shadow: 0 7px 20px rgba(22,163,74,.45); }

.badge-done {
    display: inline-flex; align-items: center; gap: 6px;
    background: var(--verde-bg); color: var(--verde);
    border: 1.5px solid rgba(22,163,74,.25);
    font-family: 'Montserrat', sans-serif;
    font-size: 13px; font-weight: 700;
    padding: 8px 18px; border-radius: 50px;
}

/* ═══════════════════════════════════
   NAVEGACIÓN
═══════════════════════════════════ */
.nav-lesson-btn {
    display: inline-flex; align-items: center; gap: 7px;
    background: var(--blanco); border: 1.5px solid var(--gris-b);
    color: var(--azul);
    font-family: 'Montserrat', sans-serif;
    font-size: 13px; font-weight: 700;
    padding: 10px 22px; border-radius: 50px;
    text-decoration: none;
    box-shadow: 0 2px 10px rgba(11,44,77,.07);
    transition: all .2s ease;
}
.nav-lesson-btn:hover {
    border-color: var(--celeste); color: var(--celeste);
    background: var(--celeste-bg); text-decoration: none;
    transform: translateY(-1px);
}
.nav-lesson-btn--next {
    background: linear-gradient(135deg, var(--azul), var(--azul-med));
    border-color: transparent; color: #fff;
    box-shadow: 0 4px 14px rgba(11,44,77,.3);
}
.nav-lesson-btn--next:hover {
    background: linear-gradient(135deg, var(--azul-med), var(--celeste));
    color: #fff; border-color: transparent;
}

/* ═══════════════════════════════════
   CARD DESBLOQUEO
═══════════════════════════════════ */
.unlock-card {
    background: linear-gradient(135deg, #fffbeb, #fef9c3) !important;
    border: 1.5px solid #fde68a !important;
}
.unlock-card h5 { font-family:'Montserrat',sans-serif; font-size:15px; font-weight:800; color:#92400e; }

/* ═══════════════════════════════════
   BOTÓN PAGAR
═══════════════════════════════════ */
.btn-pay {
    display: inline-flex; align-items: center; gap: 8px;
    background: linear-gradient(135deg, var(--dorado), #a8832c);
    color: #fff; border: none;
    font-family: 'Montserrat', sans-serif;
    font-size: 14px; font-weight: 700;
    padding: 12px 30px; border-radius: 50px; cursor: pointer;
    box-shadow: 0 4px 14px rgba(201,162,77,.4);
    transition: all .22s ease; text-decoration: none;
}
.btn-pay:hover { transform: translateY(-2px); box-shadow: 0 7px 22px rgba(201,162,77,.5); color: #fff; }
.btn-pay--sm { font-size: 13px; padding: 9px 22px; }

/* ═══════════════════════════════════
   SÍLABO — CARD
═══════════════════════════════════ */
.syllabus-card { border: 1px solid var(--gris-b) !important; }
.syllabus-title { font-family:'Montserrat',sans-serif; font-size:14px; font-weight:800; color:var(--azul); }

.syllabus-scroll {
    max-height: 480px; overflow-y: auto;
    scrollbar-width: thin; scrollbar-color: var(--gris-b) var(--gris-bg);
}
.syllabus-scroll::-webkit-scrollbar { width: 4px; }
.syllabus-scroll::-webkit-scrollbar-track { background: var(--gris-bg); }
.syllabus-scroll::-webkit-scrollbar-thumb { background: var(--gris-b); border-radius: 4px; }
@media (min-width: 992px) { .syllabus-scroll { max-height: 600px; } }

/* ═══════════════════════════════════
   ACORDEÓN — ITEMS
═══════════════════════════════════ */
.acc-item {
    border-bottom: 1px solid var(--gris-b);
    transition: background .15s ease;
}

/* Item activo: resaltado lateral */
.acc-item--active {
    background: linear-gradient(90deg, rgba(0,180,230,.07), transparent);
    border-left: 3px solid var(--celeste);
}

/* Item completado: sutil */
.acc-item--done { background: rgba(22,163,74,.03); }

/* Bloqueado */
.locked-item {
    background: #f8f9fa;
    opacity: .55;
    filter: grayscale(60%);
    cursor: not-allowed;
}

/* ═══════════════════════════════════
   ACORDEÓN — CABECERA
═══════════════════════════════════ */
.acc-header {
    transition: background .15s ease;
    cursor: default;
    user-select: none;
}

/* Solo tiene cursor pointer cuando es expandible */
.acc-header--expandable {
    cursor: pointer;
}
.acc-header--expandable:hover {
    background: rgba(0,180,230,.06);
}

/* ═══════════════════════════════════
   TÍTULO DE LECCIÓN — link limpio
═══════════════════════════════════ */
.lesson-title-link {
    display: block;
    font-size: 12.5px;
    font-weight: 600;
    color: var(--texto);
    line-height: 1.4;
    text-decoration: none;
    white-space: normal;
    word-break: break-word;
    transition: color .15s ease;
}
.lesson-title-link:hover {
    color: var(--celeste);
    text-decoration: none;
}
.lesson-title-link--active {
    color: var(--celeste) !important;
    font-weight: 700 !important;
}

/* ═══════════════════════════════════
   CHEVRON + PILL INDICADOR PDF
═══════════════════════════════════ */
.acc-chevron-wrap {
    display: flex;
    align-items: center;
    gap: 4px;
}

.pdf-pill-indicator {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: 10px;
    font-weight: 700;
    color: var(--celeste);
    background: var(--celeste-bg);
    border: 1px solid rgba(0,180,230,.25);
    border-radius: 20px;
    padding: 2px 8px;
    white-space: nowrap;
    letter-spacing: .3px;
}

.acc-chevron {
    color: var(--texto-sec);
    transition: transform .25s ease;
    flex-shrink: 0;
}

/* Rotar chevron cuando el panel está abierto */
[aria-expanded="true"] .acc-chevron {
    transform: rotate(180deg);
}

/* ═══════════════════════════════════
   ACORDEÓN — CUERPO (panel PDF)
═══════════════════════════════════ */
.acc-body {
    background: var(--gris-bg);
    border-top: 1px dashed var(--gris-b);
}

.acc-divider {
    height: 1px;
    background: linear-gradient(90deg, var(--celeste-bg), transparent);
    border-radius: 1px;
}

.acc-resources-label {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 10.5px;
    font-weight: 700;
    letter-spacing: .8px;
    text-transform: uppercase;
    color: var(--texto-sec);
}

/* ═══════════════════════════════════
   TARJETA PDF — el corazón del rediseño
═══════════════════════════════════ */
.pdf-resource-card {
    display: flex;
    align-items: center;
    gap: 10px;
    background: var(--blanco);
    border: 1.5px solid var(--gris-b);
    border-radius: 12px;
    padding: 10px 12px;
    text-decoration: none;
    transition: all .2s ease;
    margin-bottom: 6px;
    box-shadow: 0 1px 6px rgba(11,44,77,.05);
}
.pdf-resource-card:last-child { margin-bottom: 0; }

.pdf-resource-card:hover {
    border-color: var(--celeste);
    background: #fff;
    box-shadow: 0 4px 16px rgba(0,180,230,.15);
    transform: translateY(-1px);
    text-decoration: none;
}

/* Ícono PDF */
.pdf-icon-wrap {
    width: 38px;
    height: 38px;
    background: linear-gradient(135deg, #fee2e2, #fecaca);
    border-radius: 10px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    color: #dc2626;
    gap: 1px;
    transition: background .2s ease;
}
.pdf-resource-card:hover .pdf-icon-wrap {
    background: linear-gradient(135deg, var(--celeste-bg), rgba(0,180,230,.2));
    color: var(--celeste);
}

.pdf-ext-label {
    font-size: 8px;
    font-weight: 800;
    letter-spacing: .5px;
    line-height: 1;
}

/* Nombre e info */
.pdf-info {
    display: flex;
    flex-direction: column;
    gap: 2px;
    overflow: hidden;
}

.pdf-filename {
    font-size: 12px;
    font-weight: 700;
    color: var(--texto);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    font-family: 'Montserrat', sans-serif;
    transition: color .2s ease;
}
.pdf-resource-card:hover .pdf-filename { color: var(--celeste); }

.pdf-sub {
    font-size: 10px;
    color: var(--texto-sec);
    white-space: nowrap;
}

/* Botón descargar */
.pdf-download-btn {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: 11px;
    font-weight: 700;
    color: var(--celeste);
    background: var(--celeste-bg);
    border: 1px solid rgba(0,180,230,.25);
    border-radius: 20px;
    padding: 5px 10px;
    white-space: nowrap;
    transition: all .18s ease;
    font-family: 'Montserrat', sans-serif;
}
.pdf-resource-card:hover .pdf-download-btn {
    background: var(--celeste);
    color: #fff;
    border-color: var(--celeste);
}

/* ═══════════════════════════════════
   META CHIPS (duración)
═══════════════════════════════════ */
.lesson-meta-chip {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: 11px;
    font-weight: 500;
    color: var(--texto-sec);
    background: var(--gris-bg);
    border: 1px solid var(--gris-b);
    border-radius: 20px;
    padding: 2px 9px;
    white-space: nowrap;
}

/* ═══════════════════════════════════
   BADGES
═══════════════════════════════════ */
.lesson-badge {
    width: 28px; height: 28px; border-radius: 50%;
    display: inline-flex; align-items: center; justify-content: center;
    font-size: 11px; font-weight: 800;
    font-family: 'Montserrat', sans-serif; flex-shrink: 0;
}
.lesson-badge--done    { background: var(--verde-bg);   color: var(--verde);     border: 1.5px solid rgba(22,163,74,.3); }
.lesson-badge--playing { background: var(--celeste-bg); color: var(--celeste);   border: 1.5px solid rgba(0,180,230,.35); }
.lesson-badge--default { background: var(--gris-bg);    color: var(--texto-sec); border: 1.5px solid var(--gris-b); }
.lesson-badge--locked  { background: #f1f5f9;           color: #94a3b8;          border: 1.5px solid var(--gris-b); }

/* ═══════════════════════════════════
   ALERTA DESBLOQUEO
═══════════════════════════════════ */
.unlock-alert {
    background: linear-gradient(135deg, #fffbeb, #fef9c3);
    border: 1.5px solid #fde68a; border-radius: 12px;
    padding: 16px 18px; color: #92400e; font-weight: 600;
}

/* min-width fix para flex child */
.min-w-0 { min-width: 0; }

/* ═══════════════════════════════════
   RESPONSIVE
═══════════════════════════════════ */
@media (max-width: 576px) {
    .progress-header-box { max-width: 100%; }
    .nav-lesson-btn { font-size: 12px; padding: 9px 14px; }
    .card-body.p-4 { padding: 1rem !important; }
    .btn-complete { font-size: 12px; padding: 9px 16px; }
}
@media (max-width: 768px) {
    .nav-lesson-btn { font-size: 12px; padding: 9px 16px; }
}

.acc-collapse {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease;
}

.acc-collapse.open {
    max-height: 500px; /* suficiente para contenido */
}
</style>


<script>

document.addEventListener('DOMContentLoaded', function () {

    const headers = document.querySelectorAll('.acc-header--expandable');

    headers.forEach(header => {

        header.addEventListener('click', function () {

            const targetId = this.getAttribute('data-target');
            const body = document.querySelector(targetId);

            if (!body) return;

            const isOpen = body.classList.contains('open');

            // 🔁 OPCIONAL: cerrar todos los demás
            document.querySelectorAll('.acc-collapse').forEach(el => {
                el.classList.remove('open');
                el.style.maxHeight = null;
            });

            if (!isOpen) {
                body.classList.add('open');
                body.style.maxHeight = body.scrollHeight + "px";
            } else {
                body.classList.remove('open');
                body.style.maxHeight = null;
            }

        });

    });

});
</script>

@endsection