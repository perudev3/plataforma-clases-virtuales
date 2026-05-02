@extends('layouts.landing')

@section('content')
<div class="course-page">

    {{-- ================================================================
         1. HEADER BANNER
    ================================================================ --}}
    <div class="header-course"
         style="background-image: url('{{ asset('Laravel/public/storage/'.$course->banner) }}');">

        <div class="container">
            <div class="row">
                <div class="col-md-7 col-lg-6">

                    <span class="course-badge">
                        {{ $course->programa }}
                    </span>
                    <h1>{{ $course->title ?? 'Curso sin título' }}</h1>
                    @auth
                        @if(auth()->user()->role === 'student')
                            <div class="rating-box">
                                <h5>Califica este curso</h5>
                                <form id="ratingForm" action="{{ route('alumno.reviews.store', $course->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="rating" id="ratingValue" value="{{ optional($userRating)->rating }}">
                                    <input type="hidden" name="comment" id="commentHidden" value="{{ optional($userRating)->comment }}">

                                    <div class="star-input">
                                        @for ($i = 5; $i >= 1; $i--)
                                            <span class="star-btn {{ optional($userRating)->rating >= $i ? 'active' : '' }}"
                                                data-value="{{ $i }}">★</span>
                                        @endfor
                                    </div>
                                </form>
                            </div>
                        @endif
                    @endauth

                    <div class="course-meta-grid">

                        <div class="meta-item">
                            <i class="bi bi-calendar3"></i>
                            <span>
                                <strong>Inicio:</strong>
                                {{ $course->start_date
                                    ? \Carbon\Carbon::parse($course->start_date)->locale('es')->translatedFormat('d \d\e F \d\e Y')
                                    : 'Por definir' }}
                            </span>
                        </div>

                        <div class="meta-item">
                            <i class="bi bi-clock"></i>
                            <span>
                                <strong>Horario:</strong>
                                {{ isset($course->start_time) && trim($course->start_time) !== ''
                                    ? \Carbon\Carbon::parse($course->start_time)->format('h:i A')
                                    : 'Por definir' }}
                            </span>
                        </div>

                        <div class="meta-item">
                            <i class="bi bi-laptop"></i>
                            <span>
                                <strong>Modalidad:</strong> Virtual en vivo vía Zoom
                            </span>
                        </div>

                        <div class="meta-item">
                            <i class="bi bi-mortarboard-fill"></i>
                            <span>
                                Certificación con código QR
                            </span>
                        </div>

                    </div>

                    <div class="header-actions">
                        @if(!empty($course->temario_link))
                            <a href="{{ $course->temario_link }}" class="btn-temario">
                                <i class="bi bi-lock-fill"></i> Ver Temario
                            </a>
                        @endif

                        @if(!empty($course->whatsapp))
                            <a href="https://wa.me/{{ $course->whatsapp }}" class="btn-whatsapp">
                                <i class="bi bi-whatsapp"></i> Inscribirme por WhatsApp
                            </a>
                        @endif

                        @auth
                            @if(auth()->user()->role === 'student')
                                @if($course->is_paid)
                                    <form action="{{ route('alumno.checkout.pay', $course->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-warning px-4 py-2 fw-semibold">
                                            Comprar curso
                                            <small>A solo S/{{ number_format( $course->price_display=="regular" ? $course->price : $course->discount_price, 2) }}</small>
                                        </button>
                                    </form>
                                    <a href="{{ route('checkout', $course->id) }}" class="btn-inscribete">
                                        <i class="bi bi-lightning-charge-fill"></i>
                                        Inicia Gratis
                                    </a>
                                @else
                                    <form action="{{ route('alumno.courses.enroll', $course->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        <button type="submit" class="btn-inscribete">
                                            <i class="bi bi-check-circle-fill"></i> Inscríbete Gratis
                                        </button>
                                    </form>
                                @endif
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn-inscribete">
                                <i class="bi bi-person-fill"></i> Inicia sesión para inscribirte
                            </a>
                        @endauth
                    </div>

                </div>
            </div>
        </div>
    </div>


    {{-- ================================================================
         2. BARRA DE STATS
    ================================================================ --}}
    <div class="course-stats-bar">
        <div class="container-fluid px-0">
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-icon-wrap"><i class="bi bi-clock"></i></div>
                    <div>
                        <div class="stat-label">Duración</div>
                        <div class="stat-value">{{ $course->duration_weeks ?? 'N/A' }} semanas</div>
                    </div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon-wrap"><i class="bi bi-qr-code"></i></div>
                    <div>
                        <div class="stat-label">Certificado</div>
                        <div class="stat-value">verificable con QR</div>
                    </div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon-wrap"><i class="bi bi-camera-video-fill"></i></div>
                    <div>
                        <div class="stat-label">Modalidad</div>
                        <div class="stat-value">Clases virtuales en Vivo</div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- ================================================================
         3. CUERPO (2 columnas)
    ================================================================ --}}
    <div class="course-body">
        <div class="container">
            <div class="row">

                {{-- Columna principal --}}
                <div class="col-md-8 course-main">

                    {{-- Presentación --}}
                    <div class="course-section">
                        <h3 class="course-section-title">¿POR QUÉ LLEVAR ESTE DIPLOMADO?</h3>
                        <p class="course-description">{!! $course->description ?? 'Sin descripción disponible.' !!}</p>
                    </div>

                    {{-- Dirigido a --}}
                    <div class="course-section">
                        <h3 class="course-section-title">¿A QUIÉN ESTÁ DIRIGIDO?</h3>
                        <p class="course-description">{!! $course->directed_to ?? 'Sin descripción disponible.' !!}</p>
                    </div>

                    {{-- Temario --}}
                    <div class="course-section">
                        <h3 class="course-section-title">Temario del Diplomado</h3>

                        @if($course->syllabus && $course->syllabus->count())
                            <div class="temario-accordion" id="temarioAccordion">
                                @foreach($course->syllabus as $index => $syllabus)
                                    <div class="temario-item">
                                        <button class="temario-btn" type="button" data-modulo="{{ $index + 1 }}">
                                            Módulo {{ $index + 1 }}: {{ $syllabus->title ?? 'Sin título' }}
                                            <i class="fas fa-chevron-down temario-arrow"></i>
                                        </button>
                                        <div class="temario-body">
                                            {!! $syllabus->description ?? 'No hay descripción disponible.' !!}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state">
                                <i class="bi bi-journal-text"></i>
                                No hay módulos disponibles para este curso.
                            </div>
                        @endif
                    </div>

                    {{-- Docentes --}}
                    <div class="course-section">
                        <h3 class="course-section-title">Docentes a Cargo</h3>

                        @if($course->teachers && $course->teachers->count())
                            <div class="docentes-grid">
                                @foreach($course->teachers as $teacher)
                                    <div class="docente-card">
                                        <img src="{{ asset($teacher->photo ?? 'images/default-teacher.jpg') }}"
                                             class="docente-photo"
                                             alt="{{ $teacher->name ?? 'Docente' }}">
                                        <div class="docente-name">{{ $teacher->name ?? 'Sin nombre' }}</div>
                                        <div class="docente-specialty">{{ $teacher->specialty ?? '' }}</div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state">
                                <i class="bi bi-person-badge"></i>
                                No hay docentes asignados para este curso.
                            </div>
                        @endif
                    </div>

                    {{-- Testimonios --}}
                    <div class="course-section">
                        <h3 class="course-section-title">¿Qué dicen nuestros alumnos?</h3>

                        @if($course->reviews && $course->reviews->count())

                            {{-- Promedio general --}}
                            @php
                                $avgRating = round($course->reviews->avg('rating'), 1);
                                $totalReviews = $course->reviews->count();
                            @endphp
                            <div class="reviews-summary">
                                <div class="reviews-avg-score">{{ number_format($avgRating, 1) }}</div>
                                <div class="reviews-avg-right">
                                    <div class="reviews-avg-stars">
                                        @for($i = 1; $i <= 5; $i++)
                                            <span class="{{ $i <= round($avgRating) ? 'star-filled' : 'star-empty' }}">★</span>
                                        @endfor
                                    </div>
                                    <div class="reviews-avg-label">Calificación promedio</div>
                                    <div class="reviews-avg-count">{{ $totalReviews }} {{ $totalReviews === 1 ? 'reseña' : 'reseñas' }}</div>
                                </div>
                            </div>

                            <div class="reviews-grid">
                                @foreach($course->reviews as $review)
                                    <div class="review-card">
                                        <div class="review-header">
                                            <div class="review-avatar">
                                                {{ strtoupper(substr($review->student_name ?? 'A', 0, 1)) }}
                                            </div>
                                            <div class="review-meta">
                                                <div class="review-author">{{ $review->student_name ?? 'Alumno' }}</div>
                                                <div class="review-stars-row">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <span class="{{ $i <= ($review->rating ?? 0) ? 'star-filled' : 'star-empty' }}">★</span>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                        @if($review->comment)
                                            <p class="review-text">"{{ $review->comment }}"</p>
                                        @endif
                                    </div>
                                @endforeach
                            </div>

                        @else
                            <div class="empty-state">
                                <i class="bi bi-star"></i>
                                No hay reseñas disponibles aún. ¡Sé el primero en calificar!
                            </div>
                        @endif
                    </div>

                    {{-- ¿Por qué elegir ESIPEC? --}}
                    <div class="course-section esipec-why">
                        <h3 class="course-section-title">¿Por qué elegir ESIPEC?</h3>

                        <div class="why-layout">

                            {{-- Video --}}
                            <div class="why-video-wrap">
                                <div class="why-video-placeholder">
                                    <i class="bi bi-play-circle-fill"></i>
                                    <span>Video presentación</span>
                                </div>
                                {{-- Cuando tengas la URL real, reemplaza el placeholder por: --}}
                                {{-- <iframe src="https://www.youtube-nocookie.com/embed/TU_ID" frameborder="0" allowfullscreen></iframe> --}}
                            </div>

                            {{-- Lista de razones --}}
                            <ul class="why-list">
                                <li>
                                    <span class="why-check"><i class="bi bi-check-lg"></i></span>
                                    <div>
                                        <strong>Formación especializada</strong> en áreas jurídicas estratégicas
                                    </div>
                                </li>
                                <li>
                                    <span class="why-check"><i class="bi bi-check-lg"></i></span>
                                    <div>
                                        <strong>Docentes con experiencia</strong> profesional real
                                    </div>
                                </li>
                                <li>
                                    <span class="why-check"><i class="bi bi-check-lg"></i></span>
                                    <div>
                                        <strong>Metodología práctica</strong> aplicada al ejercicio profesional
                                    </div>
                                </li>
                                <li>
                                    <span class="why-check"><i class="bi bi-check-lg"></i></span>
                                    <div>
                                        <strong>Certificación digital verificable</strong> con código QR de autenticidad
                                    </div>
                                </li>
                            </ul>

                        </div>
                    </div>

                </div>{{-- /col-md-8 --}}


                {{-- ============================================================
                     SIDEBAR
                ============================================================ --}}
                <div class="col-md-4 course-sidebar">
                    <div class="sidebar-card">
                        <img src="{{ asset('Laravel/public/storage/'.$course->banner) }}" class="sidebar-card-img" alt="Diploma Digital">

                        <div class="sidebar-card-body">

                            

                            

                            {{-- ── CTAs ── --}}
                            <div class="sidebar-cta">
                                @auth
                                    @if(auth()->user()->role === 'student')
                                        @if($course->is_paid)
                                            <form action="{{ route('alumno.checkout.pay', $course->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn-sidebar-buy">
                                                    Comprar curso
                                                    <small>A solo S/{{ number_format($course->price_display == 'regular' ? $course->price : $course->discount_price, 2) }}</small>
                                                </button>
                                            </form>
                                            <a href="{{ route('checkout', $course->id) }}" class="btn-sidebar-primary">
                                                <i class="bi bi-lightning-charge-fill"></i> Inicia gratis
                                            </a>
                                        @else
                                            <form action="{{ route('alumno.courses.enroll', $course->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn-sidebar-free">
                                                    <i class="bi bi-check-circle-fill"></i> Inicia gratis
                                                </button>
                                            </form>
                                        @endif
                                    @else
                                        <a href="#" class="btn btn-secondary disabled w-100">
                                            Solo estudiantes pueden inscribirse
                                        </a>
                                    @endif
                                @else
                                
                                {{-- ── BLOQUE: COMPRAR CURSO ── --}}
	                            <div class="sidebar-plan-block sidebar-plan-paid">
	                                <div class="sidebar-plan-header">
	                                    <i class="bi bi-star-fill"></i>
	                                    <strong>Al comprar el curso obtienes:</strong>
	                                </div>
	                                <ul class="sidebar-plan-list">
	                                    <li>✔ Clases en vivo con docentes especialistas</li>
	                                    <li>✔ Acceso a todas las grabaciones</li>
	                                    <li>✔ Materiales de estudio descargables</li>
	                                    <li>✔ Certificación con código QR verificable</li>
	                                    <li>✔ Diploma digital oficial de {{ $course->institution ?? 'ESIPEC' }}</li>
	                                    <li>✔ Acceso ilimitado al contenido</li>
	                                </ul>
	                            </div>
	                            <a href="{{ route('login') }}">
	                                    <button class="btn-sidebar-buy">
	                                        Comprar curso
	                                        <small>A solo S/{{ number_format($course->price_display == 'regular' ? $course->price : $course->discount_price, 2) }}</small>
	                                    </button>
                                    </a>
                                    
                                    {{-- ── BLOQUE: INICIAR GRATIS ── --}}
	                            <div class="sidebar-plan-block sidebar-plan-free">
	                                <div class="sidebar-plan-header">
	                                    <i class="bi bi-lightning-charge-fill"></i>
	                                    <strong>Al iniciar gratis accedes a:</strong>
	                                </div>
	                                <ul class="sidebar-plan-list">
	                                    <li>✔ 3 clases en vivo</li>
	                                    <li>✔ 3 clases grabadas</li>
	                                    <li>✔ Aviso de nuevos cursos</li>
	                                </ul>
	                            </div>
                                    <a href="{{ route('login') }}" class="btn-sidebar-free">
                                        <i class="bi bi-person-fill"></i> Inicia sesión para inscribirte
                                    </a>
                                @endauth
                            </div>

                        </div>
                    </div>
                </div>{{-- /col-md-4 --}}

            </div>{{-- /row --}}
        </div>{{-- /container --}}
    </div>{{-- /course-body --}}

    {{-- POPUP DE COMENTARIO --}}
    <div id="ratingPopupOverlay" class="rating-popup-overlay" style="display:none;">
        <div class="rating-popup">
            <button class="rating-popup-close" id="closeRatingPopup">
                <i class="bi bi-x-lg"></i>
            </button>

            <div class="rating-popup-stars" id="popupStars"></div>
            <h6 class="rating-popup-title">¿Qué te pareció el curso?</h6>
            <p class="rating-popup-sub">Tu opinión ayuda a otros estudiantes</p>

            <textarea id="commentInput"
                    class="rating-popup-textarea"
                    placeholder="Opcional: cuéntanos tu experiencia...">{{ optional($userRating)->comment }}</textarea>

            <button class="rating-popup-submit" id="submitRating">
                {{ isset($userRating) ? 'Actualizar calificación' : 'Enviar calificación' }}
            </button>
        </div>
    </div>

</div>{{-- /course-page --}}

@push('scripts')
<script>

document.addEventListener('DOMContentLoaded', function () {

    /* ── Acordeón ── */
    document.querySelectorAll('.temario-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var body = this.nextElementSibling;
            var isOpen = this.classList.contains('open');
            if (isOpen) {
                body.style.maxHeight = body.scrollHeight + 'px';
                requestAnimationFrame(function () { body.style.maxHeight = '0'; });
                btn.classList.remove('open');
            } else {
                body.style.display = 'block';
                body.style.maxHeight = '0';
                requestAnimationFrame(function () { body.style.maxHeight = body.scrollHeight + 'px'; });
                btn.classList.add('open');
            }
        });
    });

    /* ── Rating popup ── */
    var selectedRating = parseInt(document.getElementById('ratingValue')?.value) || 0;
    var overlay   = document.getElementById('ratingPopupOverlay');
    var popupStars = document.getElementById('popupStars');

    function renderPopupStars(rating) {
        var html = '';
        for (var i = 1; i <= 5; i++) {
            html += i <= rating ? '★' : '☆';
        }
        popupStars.textContent = html;
    }

    // Click en estrella del header → abre popup
    document.querySelectorAll('.star-btn').forEach(function (star) {
        star.addEventListener('click', function () {
            selectedRating = parseInt(this.dataset.value);

            // Actualiza visual estrellas del header
            document.querySelectorAll('.star-btn').forEach(function (s) {
                s.classList.toggle('active', parseInt(s.dataset.value) <= selectedRating);
            });

            // Muestra popup
            renderPopupStars(selectedRating);
            overlay.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        });
    });

    // Cerrar popup
    document.getElementById('closeRatingPopup').addEventListener('click', function () {
        overlay.style.display = 'none';
        document.body.style.overflow = '';
    });

    overlay.addEventListener('click', function (e) {
        if (e.target === overlay) {
            overlay.style.display = 'none';
            document.body.style.overflow = '';
        }
    });

    // Enviar formulario desde popup
    document.getElementById('submitRating').addEventListener('click', function () {
        document.getElementById('ratingValue').value  = selectedRating;
        document.getElementById('commentHidden').value = document.getElementById('commentInput').value;

        overlay.style.display = 'none';
        document.body.style.overflow = '';
        document.getElementById('ratingForm').submit();
    });

});
</script>
@endpush

@push('styles')
<style>

/* ============================================================
   COURSE DETAIL PAGE - CSS COMPLETO
============================================================ */
@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&family=Open+Sans:wght@400;500;600&display=swap');

:root {
    --azul:      #0B2C4D;
    --azul-med:  #1a4a72;
    --celeste:   #00B4E6;
    --rojo:      #c62828;
    --rojo-hover:#9b1c1c;
    --verde:     #2e7d32;
    --verde-hover:#1b5e20;
    --dorado:    #C9A24D;
    --gris-bg:   #f4f6f9;
    --gris-borde:#e2e8f0;
    --texto:     #1e293b;
    --texto-sec: #64748b;
    --blanco:    #ffffff;
    --sombra:    0 4px 24px rgba(11,44,77,.12);
    --radio:     12px;
}

.course-page * { box-sizing: border-box; }
.course-page { font-family: 'Open Sans', sans-serif; color: var(--texto); background: var(--gris-bg); }

/* --- HEADER --- */
.header-course .container { position: relative; z-index: 2; padding-top: 50px; padding-bottom: 50px; }
.course-badge {
    display: inline-block; background: var(--celeste); color: #fff;
    font-family: 'Montserrat', sans-serif; font-size: 11px; font-weight: 700;
    letter-spacing: 1.5px; text-transform: uppercase; padding: 5px 14px;
    border-radius: 30px; margin-bottom: 14px;
}
.header-course h1 {
    font-family: 'Montserrat', sans-serif;
    font-size: clamp(1.8rem, 4vw, 2.9rem); font-weight: 800; color: #fff;
    line-height: 1.2; margin-bottom: 18px;
    text-shadow: 0 3px 18px rgba(0,0,0,.5); max-width: 640px;
}
.header-actions { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 10px; }
.btn-temario {
    display: inline-flex; align-items: center; gap: 7px;
    background: rgba(255,255,255,.08); border: 1.5px solid rgba(255,255,255,.55);
    color: #fff; font-family: 'Montserrat', sans-serif; font-size: 13.5px; font-weight: 600;
    padding: 10px 22px; border-radius: 8px; text-decoration: none;
    backdrop-filter: blur(6px); transition: all .25s ease;
}
.btn-temario:hover { background: rgba(255,255,255,.18); color: #fff; text-decoration: none; }
.btn-whatsapp {
    display: inline-flex; align-items: center; gap: 8px;
    background: var(--verde); border: none; color: #fff;
    font-family: 'Montserrat', sans-serif; font-size: 13.5px; font-weight: 700;
    padding: 10px 22px; border-radius: 8px; text-decoration: none;
    transition: all .25s ease; box-shadow: 0 4px 14px rgba(46,125,50,.4);
}
.btn-whatsapp:hover { background: var(--verde-hover); color: #fff; text-decoration: none; transform: translateY(-2px); }
.btn-inscribete {
    display: inline-flex; align-items: center; gap: 8px; flex-direction: row; flex-wrap: wrap;
    background: var(--rojo); border: none; color: #fff;
    font-family: 'Montserrat', sans-serif; font-size: 13.5px; font-weight: 700;
    padding: 10px 22px; border-radius: 8px; text-decoration: none;
    transition: all .25s ease; box-shadow: 0 4px 14px rgba(198,40,40,.4); cursor: pointer;
}
.btn-inscribete:hover, .btn-inscribete:focus { background: var(--rojo-hover); color: #fff; text-decoration: none; transform: translateY(-2px); }
.btn-inscribete small { display: block; font-size: 11px; font-weight: 400; opacity: .85; width: 100%; }

/* --- STATS BAR --- */
.course-stats-bar { background: var(--blanco); border-bottom: 1px solid var(--gris-borde); }
.stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); }
.stat-item { display: flex; align-items: center; gap: 14px; padding: 20px 28px; border-right: 1px solid var(--gris-borde); transition: background .2s; }
.stat-item:last-child { border-right: none; }
.stat-item:hover { background: var(--gris-bg); }
.stat-icon-wrap { width: 46px; height: 46px; border-radius: 50%; background: rgba(0,180,230,.10); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.stat-icon-wrap i { font-size: 20px; color: var(--azul); }
.stat-label { font-size: 11px; color: var(--texto-sec); text-transform: uppercase; letter-spacing: .8px; margin-bottom: 2px; font-weight: 600; }
.stat-value { font-family: 'Montserrat', sans-serif; font-size: 15px; font-weight: 700; color: var(--texto); line-height: 1.2; }

/* --- BODY --- */
.course-body { padding: 48px 0 60px; }
.course-section { background: var(--blanco); border-radius: var(--radio); box-shadow: var(--sombra); padding: 32px 36px; margin-bottom: 28px; }
.course-section-title {
    font-family: 'Montserrat', sans-serif; font-size: 1.25rem; font-weight: 800; color: var(--azul);
    margin-bottom: 18px; padding-bottom: 12px; border-bottom: 2px solid var(--gris-borde);
    display: flex; align-items: center; gap: 10px;
}
.course-section-title::before { content: ""; display: inline-block; width: 4px; height: 22px; background: var(--celeste); border-radius: 3px; flex-shrink: 0; }
.course-description { font-size: 15px; line-height: 1.8; color: #374151; }
.course-description ul { padding-left: 22px; margin-top: 12px; margin-bottom: 12px; }
.course-description li { margin-bottom: 8px; line-height: 1.7; }
.course-description p { margin-bottom: 12px; }
.course-description strong { color: var(--azul); }

/* --- ACORDEÓN CUSTOM --- */
.temario-item {
    border: 1px solid var(--gris-borde);
    border-radius: 10px;
    margin-bottom: 10px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,.04);
}
.temario-btn {
    width: 100%; text-align: left; background: var(--blanco); border: none;
    padding: 16px 22px; font-family: 'Montserrat', sans-serif; font-size: 14.5px;
    font-weight: 700; color: var(--azul); cursor: pointer;
    display: flex; align-items: center; gap: 12px; transition: background .2s ease;
}
.temario-btn:hover { background: #f0f7ff; }
.temario-btn.open { background: linear-gradient(90deg, #e8f4fd, var(--blanco)); }
.temario-btn::before {
    content: attr(data-modulo); display: inline-flex; align-items: center; justify-content: center;
    min-width: 28px; height: 28px; border-radius: 50%; background: var(--azul); color: #fff;
    font-size: 12px; font-weight: 800; flex-shrink: 0;
}
.temario-arrow { margin-left: auto; font-size: 13px; transition: transform .3s ease; color: var(--azul); }
.temario-btn.open .temario-arrow { transform: rotate(180deg); }
.temario-body {
    font-size: 14px; line-height: 1.75; color: #475569;
    padding: 0 22px 0 62px; background: #fafcff;
    max-height: 0; overflow: hidden;
    transition: max-height .3s ease, padding .3s ease;
}
.temario-btn.open + .temario-body {
    padding: 16px 22px 20px 62px;
    border-top: 1px solid var(--gris-borde);
}

/* --- DOCENTES --- */
.docentes-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); gap: 22px; margin-top: 4px; }
.docente-card { text-align: center; padding: 24px 14px 18px; background: var(--gris-bg); border-radius: var(--radio); border: 1px solid var(--gris-borde); transition: all .3s ease; }
.docente-card:hover { transform: translateY(-5px); box-shadow: 0 12px 28px rgba(11,44,77,.14); background: var(--blanco); }
.docente-photo { width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 3px solid var(--blanco); box-shadow: 0 4px 16px rgba(0,0,0,.15); margin: 0 auto 14px; display: block; }
.docente-name { font-family: 'Montserrat', sans-serif; font-size: 13.5px; font-weight: 700; color: var(--azul); margin-bottom: 4px; }
.docente-specialty { font-size: 12px; color: var(--texto-sec); line-height: 1.4; }

/* --- REVIEWS --- */
.reviews-summary {
    display: flex; align-items: center; gap: 20px;
    background: linear-gradient(135deg, #0B2C4D 0%, #1a4a72 100%);
    border-radius: 14px; padding: 24px 28px; margin-bottom: 24px;
}
.reviews-avg-score { font-family: 'Montserrat', sans-serif; font-size: 56px; font-weight: 800; color: #fff; line-height: 1; flex-shrink: 0; }
.reviews-avg-right { display: flex; flex-direction: column; gap: 4px; }
.reviews-avg-stars { font-size: 22px; letter-spacing: 3px; line-height: 1; }
.reviews-avg-label { font-size: 12px; color: rgba(255,255,255,.65); font-weight: 500; text-transform: uppercase; letter-spacing: .6px; margin-top: 2px; }
.reviews-avg-count { font-size: 13px; color: rgba(255,255,255,.5); font-weight: 500; }
.reviews-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 16px; }
.review-card { background: var(--blanco); border: 1px solid var(--gris-borde); border-radius: 14px; padding: 20px; transition: all .3s ease; display: flex; flex-direction: column; gap: 14px; }
.review-card:hover { transform: translateY(-4px); box-shadow: 0 12px 28px rgba(11,44,77,.10); border-color: #c7dff0; }
.review-header { display: flex; align-items: center; gap: 12px; }
.review-avatar { width: 42px; height: 42px; border-radius: 50%; background: linear-gradient(135deg, #0B2C4D, #00B4E6); color: #fff; font-family: 'Montserrat', sans-serif; font-size: 16px; font-weight: 800; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.review-meta { display: flex; flex-direction: column; gap: 3px; }
.review-author { font-family: 'Montserrat', sans-serif; font-size: 13.5px; font-weight: 700; color: var(--azul); line-height: 1; }
.review-stars-row { font-size: 14px; letter-spacing: 1px; line-height: 1; }
.star-filled { color: #f59e0b; }
.star-empty  { color: #d1d5db; }
.review-text { font-size: 13.5px; color: #475569; line-height: 1.7; font-style: italic; margin: 0; padding-top: 10px; border-top: 1px solid var(--gris-borde); }

/* --- ¿POR QUÉ ESIPEC? --- */
.why-layout { display: grid; grid-template-columns: 1fr 1fr; gap: 28px; align-items: center; margin-top: 8px; }
.why-video-wrap { border-radius: 12px; overflow: hidden; aspect-ratio: 16/9; background: var(--azul); }
.why-video-wrap iframe { width: 100%; height: 100%; border: none; display: block; }
.why-video-placeholder { width: 100%; height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 10px; background: linear-gradient(135deg, #0B2C4D, #1a4a72); color: rgba(255,255,255,.6); cursor: pointer; min-height: 200px; }
.why-video-placeholder i { font-size: 52px; color: var(--celeste); opacity: .85; }
.why-video-placeholder span { font-size: 13px; font-family: 'Montserrat', sans-serif; font-weight: 600; letter-spacing: .5px; }
.why-list { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 16px; }
.why-list li { display: flex; align-items: flex-start; gap: 14px; padding: 14px 16px; background: var(--gris-bg); border: 1px solid var(--gris-borde); border-radius: 10px; transition: all .25s ease; font-size: 14px; color: #374151; line-height: 1.5; }
.why-list li:hover { background: var(--blanco); border-color: var(--celeste); box-shadow: 0 4px 14px rgba(0,180,230,.10); transform: translateX(4px); }
.why-check { width: 30px; height: 30px; border-radius: 50%; background: linear-gradient(135deg, var(--azul), var(--azul-med)); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.why-check i { font-size: 15px; color: var(--celeste); font-weight: 900; }
.why-list li strong { color: var(--azul); }

/* --- SIDEBAR --- */
.course-sidebar { position: sticky; top: 100px; align-self: flex-start; }
.sidebar-card { background: var(--blanco); border-radius: var(--radio); box-shadow: var(--sombra); overflow: hidden; margin-bottom: 24px; }
.sidebar-card-img { width: 100%; height: auto; display: block; }
.sidebar-card-body { padding: 22px 24px; }

/* --- SIDEBAR PLAN BLOCKS --- */
.sidebar-plan-block {
    border-radius: 10px;
    padding: 16px 18px;
    margin-bottom: 14px;
}

.sidebar-plan-paid {
    background: linear-gradient(135deg, #0B2C4D, #1a4a72);
    border: 1px solid #1a4a72;
}

.sidebar-plan-free {
    background: linear-gradient(135deg, #f0fdf4, #dcfce7);
    border: 1px solid #bbf7d0;
}

.sidebar-plan-header {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 10px;
    font-family: 'Montserrat', sans-serif;
    font-size: 13px;
    font-weight: 700;
}

.sidebar-plan-paid .sidebar-plan-header {
    color: #fff;
}

.sidebar-plan-paid .sidebar-plan-header i {
    color: var(--dorado);
    font-size: 14px;
}

.sidebar-plan-free .sidebar-plan-header {
    color: #15803d;
}

.sidebar-plan-free .sidebar-plan-header i {
    color: #16a34a;
    font-size: 14px;
}

.sidebar-plan-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.sidebar-plan-list li {
    font-size: 13px;
    line-height: 1.4;
}

.sidebar-plan-paid .sidebar-plan-list li {
    color: rgba(255, 255, 255, 0.88);
}

.sidebar-plan-free .sidebar-plan-list li {
    color: #166534;
}

/* --- SIDEBAR CTAs --- */
.sidebar-cta { margin-top: 20px; display: flex; flex-direction: column; gap: 10px; }

.btn-sidebar-buy {
    display: block; width: 100%; text-align: center;
    background: linear-gradient(135deg, var(--rojo), #9b1c1c);
    color: #fff; font-family: 'Montserrat', sans-serif; font-weight: 700;
    padding: 13px; border-radius: 8px; border: none; cursor: pointer;
    transition: all .25s ease; box-shadow: 0 4px 16px rgba(198,40,40,.35);
    text-decoration: none;
}
.btn-sidebar-buy small { display: block; font-size: 11px; font-weight: 400; opacity: .85; margin-top: 2px; }
.btn-sidebar-buy:hover { background: linear-gradient(135deg, #9b1c1c, #7b1212); transform: translateY(-2px); color: #fff; text-decoration: none; }

.btn-sidebar-primary {
    display: flex; align-items: center; justify-content: center; gap: 6px;
    text-align: center; background: var(--rojo); color: #fff;
    font-family: 'Montserrat', sans-serif; font-weight: 700;
    padding: 12px; border-radius: 8px; text-decoration: none; transition: .25s;
}
.btn-sidebar-primary:hover { background: var(--rojo-hover); transform: translateY(-2px); color: #fff; text-decoration: none; }

.btn-sidebar-free {
    display: flex; align-items: center; justify-content: center; gap: 6px;
    text-align: center; background: var(--azul); color: #fff;
    font-family: 'Montserrat', sans-serif; font-weight: 700;
    padding: 12px; border-radius: 8px; text-decoration: none;
    transition: .25s; border: none; cursor: pointer; width: 100%;
}
.btn-sidebar-free:hover { background: var(--azul-med); color: #fff; text-decoration: none; }

/* --- EMPTY STATES --- */
.empty-state { text-align: center; padding: 30px 10px; color: var(--texto-sec); font-size: 14px; }
.empty-state i { font-size: 36px; opacity: .3; display: block; margin-bottom: 8px; }

/* --- META GRID EN HEADER --- */
.course-meta-grid { display: grid; grid-template-columns: repeat(2, 1fr); margin-bottom: 20px; }
.meta-item { display: flex; align-items: center; gap: 8px; font-size: 14px; color: rgba(255,255,255,.95); font-weight: 500; padding: 10px 15px; }
.meta-item:nth-child(odd) { border-right: 1px solid rgba(255,255,255,0.2); }
.meta-item i { color: var(--celeste); font-size: 16px; }
.meta-item strong { font-weight: 700; }

/* --- RATING BOX --- */
.rating-box { background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.15); border-radius: 12px; padding: 14px 18px; margin-top: 15px; display: inline-block; backdrop-filter: blur(6px); }
.rating-box h5 { color: rgba(255,255,255,.85); font-family: 'Montserrat', sans-serif; font-size: 12px; font-weight: 600; letter-spacing: .5px; margin-bottom: 8px; text-transform: uppercase; }
.star-input { direction: rtl; display: inline-flex; gap: 4px; }
.star-btn { font-size: 30px; color: rgba(255,255,255,.3); cursor: pointer; transition: color .15s ease, transform .15s ease; line-height: 1; user-select: none; }
.star-btn:hover, .star-btn:hover ~ .star-btn { color: #f59e0b; transform: scale(1.15); }
.star-btn.active { color: #f59e0b; }

/* --- POPUP --- */
.rating-popup-overlay { position: fixed; inset: 0; background: rgba(6,18,38,.65); backdrop-filter: blur(4px); z-index: 9999; display: flex; align-items: center; justify-content: center; animation: fadeInOverlay .2s ease; }
@keyframes fadeInOverlay { from { opacity: 0; } to { opacity: 1; } }
.rating-popup { background: #fff; border-radius: 18px; padding: 36px 32px 28px; width: 100%; max-width: 420px; text-align: center; position: relative; box-shadow: 0 24px 60px rgba(0,0,0,.25); animation: slideUpPopup .25s ease; }
@keyframes slideUpPopup { from { opacity: 0; transform: translateY(24px); } to { opacity: 1; transform: translateY(0); } }
.rating-popup-close { position: absolute; top: 14px; right: 16px; background: none; border: none; font-size: 18px; color: #94a3b8; cursor: pointer; padding: 4px; line-height: 1; transition: color .2s; }
.rating-popup-close:hover { color: #0B2C4D; }
.rating-popup-stars { font-size: 42px; letter-spacing: 6px; color: #f59e0b; margin-bottom: 14px; line-height: 1; }
.rating-popup-title { font-family: 'Montserrat', sans-serif; font-size: 17px; font-weight: 800; color: #0B2C4D; margin-bottom: 4px; }
.rating-popup-sub { font-size: 13px; color: #94a3b8; margin-bottom: 18px; }
.rating-popup-textarea { width: 100%; border: 1.5px solid #e2e8f0; border-radius: 10px; padding: 12px 14px; font-size: 14px; font-family: 'Open Sans', sans-serif; color: #374151; resize: none; height: 100px; transition: border-color .2s; outline: none; }
.rating-popup-textarea:focus { border-color: #00B4E6; box-shadow: 0 0 0 3px rgba(0,180,230,.12); }
.rating-popup-submit { margin-top: 16px; width: 100%; background: #0B2C4D; color: #fff; border: none; border-radius: 10px; padding: 13px; font-family: 'Montserrat', sans-serif; font-size: 14px; font-weight: 700; cursor: pointer; transition: all .25s ease; }
.rating-popup-submit:hover { background: #1a4a72; transform: translateY(-2px); }

/* --- RESPONSIVE --- */
@media (max-width: 991px) {
    .stats-grid { grid-template-columns: 1fr 1fr; }
    .stat-item:nth-child(2) { border-right: none; }
    .stat-item:nth-child(3) { border-top: 1px solid var(--gris-borde); }
    .course-section { padding: 24px 22px; }
    .course-sidebar { position: static; }
}
@media (max-width: 768px) {
    .stats-grid { grid-template-columns: 1fr; }
    .stat-item { border-right: none; border-bottom: 1px solid var(--gris-borde); }
    .stat-item:last-child { border-bottom: none; }
    .header-course h1 { font-size: 1.6rem; }
    .course-body { padding: 28px 0 40px; }
    .course-section { padding: 20px 18px; }
    .temario-body { padding-left: 22px; }
    .docentes-grid { grid-template-columns: repeat(2, 1fr); }
    .reviews-grid { grid-template-columns: 1fr; }
    .reviews-summary { flex-direction: column; text-align: center; }
    .reviews-avg-right { align-items: center; }
    .why-layout { grid-template-columns: 1fr; }
}
@media (max-width: 576px) {
    .course-meta-grid { grid-template-columns: 1fr; }
    .meta-item { border-right: none !important; border-bottom: 1px solid rgba(255,255,255,0.2); }
    .meta-item:last-child { border-bottom: none; }
    .header-course { min-height: 360px; }
    .header-actions { flex-direction: column; }
    .header-actions a, .header-actions button { width: 100%; justify-content: center; }
    .docentes-grid { grid-template-columns: repeat(2, 1fr); gap: 14px; }
}

</style>
@endpush
@endsection