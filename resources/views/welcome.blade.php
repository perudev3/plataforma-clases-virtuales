@extends('layouts.landing')

@section('content')

<!-- HERO CAROUSEL BOOTSTRAP 4 -->
<section class="hero-carousel">
    <div id="heroCarousel" class="carousel slide" data-ride="carousel" data-interval="5000">
        <ol class="carousel-indicators">
            <li data-target="#heroCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#heroCarousel" data-slide-to="1"></li>
            <li data-target="#heroCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="hero-slide" style="background-image: url('{{ asset('images/banner.png') }}');">
                    <div class="hero-overlay"></div>
                    <div class="container hero-content">
                        <div class="col-lg-7 col-md-9">
                            <h1 class="hero-title">La escuela más completa de capacitación académica del Perú</h1>
                            <p class="hero-subtitle">Diplomados, programas especializados y educación continua con enfoque profesional</p>
                            <div class="search-hero-wrapper">
                                <input type="text" class="search-hero-input" placeholder="Busca un curso, diplomado o programa">
                                <button class="search-hero-btn"><i class="fas fa-search"></i></button>
                            </div>
                            <a href="#programas" class="btn-hero-red">Ver Programas</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="hero-slide" style="background-image: url('{{ asset('images/banner-2.png') }}');">
                    <div class="hero-overlay"></div>
                    <div class="container hero-content">
                        <div class="col-lg-7 col-md-9">
                            <h1 class="hero-title">Clases en vivo, acceso permanente y aprendizaje práctico</h1>
                            <p class="hero-subtitle">Estudia desde cualquier lugar con sesiones en vivo e interacción directa con expertos.</p>
                            <a href="#como-funciona" class="btn-hero-green">Cómo Funciona</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="hero-slide" style="background-image: url('{{ asset('images/banner-3.png') }}');">
                    <div class="hero-overlay"></div>
                    <div class="container hero-content">
                        <div class="col-lg-7 col-md-9">
                            <h1 class="hero-title">Certificación digital verificable con código QR</h1>
                            <p class="hero-subtitle">Obtén un diploma digital con validez oficial para el sector público o privado</p>
                            <a href="#verificar" class="btn-hero-white">Verificar Certificado</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon"></span><span class="sr-only">Anterior</span>
        </a>
        <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon"></span><span class="sr-only">Siguiente</span>
        </a>
    </div>
</section>

<style>
/* ════ SECCIONES ════ */
.programs-section { padding: 65px 0; }
.programs-section.bg-alt { background: #f4f6f9; }
.prog-section-header { display:flex; align-items:flex-end; justify-content:space-between; flex-wrap:wrap; gap:12px; margin-bottom:32px; }
.prog-section-title { font-size:1.75rem; font-weight:800; color:#0B2C4D; margin-bottom:4px; }
.prog-section-sub   { font-size:14px; color:#6b7280; margin:0; }

/* ════ SLIDER CUSTOM (sin Bootstrap carousel) ════ */
.pslider-wrap   { position:relative; padding:0 50px; }
.pslider-track  { overflow:hidden; }
.pslider-inner  { display:flex; transition:transform .4s ease; will-change:transform; }
.pslider-inner .pslide { flex-shrink:0; padding:0 8px; box-sizing:border-box; }

/* Flechas */
.pslider-arrow {
    position:absolute; top:50%; transform:translateY(-50%);
    width:42px; height:42px; border-radius:50%;
    background:#fff; border:2px solid #e2e8f0; color:#0B2C4D;
    font-size:15px; display:flex; align-items:center; justify-content:center;
    cursor:pointer; z-index:10; text-decoration:none;
    box-shadow:0 4px 14px rgba(0,0,0,.09); transition:all .22s ease;
}
.pslider-arrow:hover { background:#0B2C4D; border-color:#0B2C4D; color:#fff; text-decoration:none; }
.pslider-arrow.prev { left:0; }
.pslider-arrow.next { right:0; }

/* Dots */
.pslider-dots { display:flex; justify-content:center; gap:7px; margin-top:20px; }
.pslider-dot  { width:8px; height:8px; border-radius:50%; background:#cbd5e1; border:none; cursor:pointer; transition:all .22s ease; padding:0; }
.pslider-dot.active { background:#0B2C4D; width:22px; border-radius:4px; }

/* ════ CARDS ════ */
.prog-card {
    background:#fff; border-radius:14px; overflow:hidden;
    box-shadow:0 3px 14px rgba(0,0,0,.07);
    transition:transform .28s ease, box-shadow .28s ease;
    height:100%; display:flex; flex-direction:column;
}
.prog-card:hover { transform:translateY(-6px); box-shadow:0 14px 30px rgba(11,44,77,.13); }

.prog-card-img { position:relative; height:168px; overflow:hidden; background:#e2e8f0; }
.prog-card-img img { width:100%; height:100%; object-fit:cover; transition:transform .4s ease; }
.prog-card:hover .prog-card-img img { transform:scale(1.05); }

.prog-badge {
    position:absolute; top:10px; left:10px;
    font-size:10px; font-weight:700; padding:3px 10px; border-radius:20px;
    color:#fff; text-transform:uppercase; letter-spacing:.5px;
}
.prog-badge.curso           { background:#0077cc; }
.prog-badge.diplomado       { background:#6a0dad; }
.prog-badge.especializacion { background:#c62828; }
.prog-badge.seminario       { background:#1a7a4a; }
.prog-badge.destacado       { background:#C9A24D; }
.prog-badge.modality-badge  { background:rgba(11,44,77,.85); backdrop-filter:blur(4px); text-transform:capitalize; letter-spacing:.3px; }
.prog-badge-free { position:absolute; top:10px; right:10px; font-size:10px; font-weight:700; padding:3px 10px; border-radius:20px; background:#16a34a; color:#fff; }

.prog-card-body { padding:15px 18px 17px; flex:1; display:flex; flex-direction:column; }
.prog-card-type { font-size:10px; font-weight:600; color:#9ca3af; text-transform:uppercase; letter-spacing:.6px; margin-bottom:3px; }
.prog-card-title { font-size:12px; font-weight:500; color:#6b7280; margin-bottom:4px; line-height:1.35; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; }
.prog-card-subtitle { font-size:15px; font-weight:800; color:#0B2C4D; margin-bottom:8px; line-height:1.4; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; }

.prog-card-meta { font-size:12px; color:#6b7280; margin-bottom:12px; display:flex; flex-wrap:wrap; gap:8px; }
.prog-card-meta span { display:flex; align-items:center; gap:4px; }
.prog-card-meta i { color:#00B4E6; }

.badge-en-progreso { display:inline-flex; align-items:center; gap:4px; background:#fef3c7; color:#92400e; font-size:10px; font-weight:700; padding:2px 8px; border-radius:20px; border:1px solid #fcd34d; }

.prog-card-footer { margin-top:auto; display:flex; align-items:center; gap:8px; padding-top:11px; border-top:1px solid #f0f3f6; }
.btn-prog { background:#0B2C4D; color:#fff; border:none; border-radius:7px; padding:8px 14px; font-size:12px; font-weight:700; text-decoration:none; transition:all .2s ease; display:inline-flex; align-items:center; gap:5px; white-space:nowrap; flex:1; justify-content:center; }
.btn-prog:hover { background:#1a4a72; color:#fff; text-decoration:none; }
.btn-prog-outline { background:transparent; color:#0B2C4D; border:2px solid #0B2C4D; border-radius:7px; padding:6px 14px; font-size:12px; font-weight:700; text-decoration:none; transition:all .2s ease; display:inline-flex; align-items:center; gap:5px; white-space:nowrap; flex:1; justify-content:center; }
.btn-prog-outline:hover { background:#0B2C4D; color:#fff; text-decoration:none; }

.btn-ver-mas { display:inline-flex; align-items:center; gap:6px; border:2px solid #0B2C4D; color:#0B2C4D; background:transparent; border-radius:8px; padding:9px 20px; font-size:13.5px; font-weight:700; text-decoration:none; transition:all .22s ease; white-space:nowrap; }
.btn-ver-mas:hover { background:#0B2C4D; color:#fff; text-decoration:none; }

@media (max-width:768px) {
    .pslider-wrap { padding:0 40px; }
    .pslider-arrow { width:36px; height:36px; font-size:13px; }
    .programs-section { padding:45px 0; }
    .prog-section-title { font-size:1.4rem; }
    .prog-section-header { flex-direction:column; align-items:flex-start; }
}
@media (max-width:576px) { .pslider-wrap { padding:0 34px; } }
</style>

{{-- ══════════ MACRO: card de programa ══════════ --}}
{{-- Reutilizable con @include si lo separas en partial --}}

{{-- ═══════════════════════════
     DESTACADOS
═══════════════════════════ --}}
<section class="programs-section" id="programas">
    <div class="container">
        <div class="prog-section-header">
            <div>
                <h2 class="prog-section-title">Programas Destacados</h2>
                <p class="prog-section-sub">Los programas más populares de nuestra plataforma</p>
            </div>
        </div>
        <div class="pslider-wrap">
            <button class="pslider-arrow prev" data-slider="featuredSlider"><i class="fas fa-chevron-left"></i></button>
            <div class="pslider-track">
                <div class="pslider-inner" id="featuredSlider">
                    @foreach($featuredCourses as $course)
                    <div class="pslide">
                        <div class="prog-card">
                            <div class="prog-card-img">
                                <img src="{{ asset('Laravel/public/storage/'.$course->image) }}" alt="{{ $course->title }}">
                                <span class="prog-badge destacado">⭐ Destacado</span>
                                @if(!$course->is_paid)<span class="prog-badge-free">Gratis</span>@endif
                            </div>
                            <div class="prog-card-body">
                                @if($course->modality)<p class="prog-card-type"><i class="fas fa-laptop" style="color:#00B4E6;margin-right:3px;"></i>{{ ucfirst($course->modality) }}</p>@endif
                                <p class="prog-card-title">{{ $course->title }}</p>
                                @if($course->subtitle)<h6 class="prog-card-subtitle">{{ $course->subtitle }}</h6>@endif
                                <div class="prog-card-meta">
                                    @if($course->start_date)
                                        <span><i class="fas fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($course->start_date)->locale('es')->translatedFormat('j \d\e F') }}</span>
                                    @else
                                        <span class="badge-en-progreso"><i class="fas fa-circle" style="font-size:6px;color:#d97706;"></i> En Progreso</span>
                                    @endif
                                    @if($course->start_time)<span><i class="fas fa-clock"></i> {{ \Carbon\Carbon::parse($course->start_time)->format('h:i A') }}</span>@endif
                                </div>
                                <div class="prog-card-footer">
                                    <a href="{{ route('checkout', $course->id) }}" class="btn-prog"><i class="fas fa-bolt" style="font-size:10px;"></i> Inicia Gratis</a>
                                    <a href="{{ route('courses.show', $course->id) }}" class="btn-prog-outline">Ver más <i class="fas fa-arrow-right" style="font-size:9px;"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <button class="pslider-arrow next" data-slider="featuredSlider"><i class="fas fa-chevron-right"></i></button>
        </div>
        <div class="pslider-dots" id="featuredDots"></div>
    </div>
</section>

{{-- ═══════════════════════════
     CURSOS
═══════════════════════════ --}}
<section class="programs-section bg-alt">
    <div class="container">
        <div class="prog-section-header">
            <div>
                <h2 class="prog-section-title">Cursos</h2>
                <p class="prog-section-sub">Aprende a tu ritmo con nuestros cursos especializados</p>
            </div>
            <a href="{{ route('cursos.index') }}" class="btn-ver-mas">Ver todos <i class="fas fa-arrow-right" style="font-size:10px;"></i></a>
        </div>
        <div class="pslider-wrap">
            <button class="pslider-arrow prev" data-slider="cursosSlider"><i class="fas fa-chevron-left"></i></button>
            <div class="pslider-track">
                <div class="pslider-inner" id="cursosSlider">
                    @foreach($cursos as $curso)
                    <div class="pslide">
                        <div class="prog-card">
                            <div class="prog-card-img">
                                <img src="{{ asset('Laravel/public/storage/'.$curso->image) }}" alt="{{ $curso->title }}">
                                @if($curso->modality)
                                    <span class="prog-badge modality-badge"><i class="fas fa-laptop"></i> {{ ucfirst($curso->modality) }}</span>
                                @else
                                    <span class="prog-badge curso">Curso</span>
                                @endif
                                @if(!$curso->is_paid)<span class="prog-badge-free">Gratis</span>@endif
                            </div>
                            <div class="prog-card-body">
                                <p class="prog-card-type">Curso</p>
                                <p class="prog-card-title">{{ $curso->title }}</p>
                                @if($curso->subtitle)<h6 class="prog-card-subtitle">{{ $curso->subtitle }}</h6>@endif
                                <div class="prog-card-meta">
                                    @if(isset($curso->start_date) && $curso->start_date)
                                        <span><i class="fas fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($curso->start_date)->locale('es')->translatedFormat('j \d\e F') }}</span>
                                    @else
                                        <span class="badge-en-progreso"><i class="fas fa-circle" style="font-size:6px;color:#d97706;"></i> En Progreso</span>
                                    @endif
                                    @if($curso->duration_weeks)<span><i class="fas fa-clock"></i> {{ $curso->duration_weeks }} sem.</span>@endif
                                </div>
                                <div class="prog-card-footer">
                                    <a href="{{ route('checkout', $curso->id) }}" class="btn-prog"><i class="fas fa-bolt" style="font-size:10px;"></i> Inicia Gratis</a>
                                    <a href="{{ route('courses.show', $curso->id) }}" class="btn-prog-outline">Ver más <i class="fas fa-arrow-right" style="font-size:9px;"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <button class="pslider-arrow next" data-slider="cursosSlider"><i class="fas fa-chevron-right"></i></button>
        </div>
        <div class="pslider-dots" id="cursosDots"></div>
    </div>
</section>

{{-- ═══════════════════════════
     ESPECIALIZACIONES
═══════════════════════════ --}}
<section class="programs-section">
    <div class="container">
        <div class="prog-section-header">
            <div>
                <h2 class="prog-section-title">Especializaciones</h2>
                <p class="prog-section-sub">Profundiza en tu área con programas de alto nivel</p>
            </div>
            <a href="{{ route('especializaciones.index') }}" class="btn-ver-mas">Ver todas <i class="fas fa-arrow-right" style="font-size:10px;"></i></a>
        </div>
        <div class="pslider-wrap">
            <button class="pslider-arrow prev" data-slider="espSlider"><i class="fas fa-chevron-left"></i></button>
            <div class="pslider-track">
                <div class="pslider-inner" id="espSlider">
                    @foreach($especializaciones as $esp)
                    <div class="pslide">
                        <div class="prog-card">
                            <div class="prog-card-img">
                                <img src="{{ asset('Laravel/public/storage/'.$esp->image) }}" alt="{{ $esp->title }}">
                                @if($esp->modality)
                                    <span class="prog-badge modality-badge"><i class="fas fa-laptop"></i> {{ ucfirst($esp->modality) }}</span>
                                @else
                                    <span class="prog-badge especializacion">Especialización</span>
                                @endif
                                @if(!$esp->is_paid)<span class="prog-badge-free">Gratis</span>@endif
                            </div>
                            <div class="prog-card-body">
                                <p class="prog-card-type">Especialización</p>
                                <p class="prog-card-title">{{ $esp->title }}</p>
                                @if($esp->subtitle)<h6 class="prog-card-subtitle">{{ $esp->subtitle }}</h6>@endif
                                <div class="prog-card-meta">
                                    @if(isset($esp->start_date) && $esp->start_date)
                                        <span><i class="fas fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($esp->start_date)->locale('es')->translatedFormat('j \d\e F') }}</span>
                                    @else
                                        <span class="badge-en-progreso"><i class="fas fa-circle" style="font-size:6px;color:#d97706;"></i> En Progreso</span>
                                    @endif
                                    @if($esp->duration_weeks)<span><i class="fas fa-clock"></i> {{ $esp->duration_weeks }} sem.</span>@endif
                                </div>
                                <div class="prog-card-footer">
                                    <a href="{{ route('checkout', $esp->id) }}" class="btn-prog"><i class="fas fa-bolt" style="font-size:10px;"></i> Inicia Gratis</a>
                                    <a href="{{ route('courses.show', $esp->id) }}" class="btn-prog-outline">Ver más <i class="fas fa-arrow-right" style="font-size:9px;"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <button class="pslider-arrow next" data-slider="espSlider"><i class="fas fa-chevron-right"></i></button>
        </div>
        <div class="pslider-dots" id="espDots"></div>
    </div>
</section>

{{-- ═══════════════════════════
     DIPLOMADOS
═══════════════════════════ --}}
<section class="programs-section bg-alt">
    <div class="container">
        <div class="prog-section-header">
            <div>
                <h2 class="prog-section-title">Diplomados</h2>
                <p class="prog-section-sub">Formación intensiva con certificación oficial</p>
            </div>
            <a href="{{ route('diplomados.index') }}" class="btn-ver-mas">Ver todos <i class="fas fa-arrow-right" style="font-size:10px;"></i></a>
        </div>
        <div class="pslider-wrap">
            <button class="pslider-arrow prev" data-slider="diplomadosSlider"><i class="fas fa-chevron-left"></i></button>
            <div class="pslider-track">
                <div class="pslider-inner" id="diplomadosSlider">
                    @foreach($diplomados as $diplomado)
                    <div class="pslide">
                        <div class="prog-card">
                            <div class="prog-card-img">
                                <img src="{{ asset('Laravel/public/storage/'.$diplomado->image) }}" alt="{{ $diplomado->title }}">
                                @if($diplomado->modality)
                                    <span class="prog-badge modality-badge"><i class="fas fa-laptop"></i> {{ ucfirst($diplomado->modality) }}</span>
                                @else
                                    <span class="prog-badge diplomado">Diplomado</span>
                                @endif
                                @if(!$diplomado->is_paid)<span class="prog-badge-free">Gratis</span>@endif
                            </div>
                            <div class="prog-card-body">
                                <p class="prog-card-type">Diplomado</p>
                                <p class="prog-card-title">{{ $diplomado->title }}</p>
                                @if($diplomado->subtitle)<h6 class="prog-card-subtitle">{{ $diplomado->subtitle }}</h6>@endif
                                <div class="prog-card-meta">
                                    @if(isset($diplomado->start_date) && $diplomado->start_date)
                                        <span><i class="fas fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($diplomado->start_date)->locale('es')->translatedFormat('j \d\e F') }}</span>
                                    @else
                                        <span class="badge-en-progreso"><i class="fas fa-circle" style="font-size:6px;color:#d97706;"></i> En Progreso</span>
                                    @endif
                                    @if($diplomado->duration_weeks)<span><i class="fas fa-clock"></i> {{ $diplomado->duration_weeks }} sem.</span>@endif
                                </div>
                                <div class="prog-card-footer">
                                    <a href="{{ route('checkout', $diplomado->id) }}" class="btn-prog"><i class="fas fa-bolt" style="font-size:10px;"></i> Inicia Gratis</a>
                                    <a href="{{ route('courses.show', $diplomado->id) }}" class="btn-prog-outline">Ver más <i class="fas fa-arrow-right" style="font-size:9px;"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <button class="pslider-arrow next" data-slider="diplomadosSlider"><i class="fas fa-chevron-right"></i></button>
        </div>
        <div class="pslider-dots" id="diplomadosDots"></div>
    </div>
</section>

<!-- POR QUÉ ESIPEC -->
<section class="section why-esipec">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2 class="why-title">Te <span>ofrecemos</span></h2>
                <div class="why-list">
                    <div class="why-item">
                        <div class="why-icon"><svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="14" rx="2"/><path d="M8 20h8"/><path d="M12 14v4"/></svg></div>
                        <div><h5>Clases en vivo</h5><p>Participa en vivo, aprende desde cualquier lugar.</p></div>
                    </div>
                    <div class="why-item">
                        <div class="why-icon"><svg viewBox="0 0 24 24"><path d="M4 7h16"/><path d="M4 12h16"/><path d="M4 17h16"/><path d="M9 7v10"/></svg></div>
                        <div><h5>Proyectos reales</h5><p>Entrénate con desafíos reales.</p></div>
                    </div>
                    <div class="why-item">
                        <div class="why-icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c1.5-4 14.5-4 16 0"/></svg></div>
                        <div><h5>Docentes expertos</h5><p>Directivos y profesionales de primer nivel.</p></div>
                    </div>
                    <div class="why-item">
                        <div class="why-icon"><svg viewBox="0 0 24 24"><rect x="4" y="3" width="16" height="18" rx="2"/><path d="M8 7h8"/><path d="M8 11h8"/><path d="M8 15h6"/></svg></div>
                        <div><h5>Programas académicos dedicados</h5><p>Desde fundamentos hasta especializaciones.</p></div>
                    </div>
                    <div class="why-item">
                        <div class="why-icon"><svg viewBox="0 0 24 24"><rect x="2" y="4" width="20" height="14" rx="2"/><path d="M8 20h8"/></svg></div>
                        <div><h5>Softwares profesionales</h5><p>Domina tecnologías clave para tu carrera.</p></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 text-center">
                <img src="{{ asset('images/image_destacados.png') }}" class="why-image responsive-img" alt="Formación ESIPEC">
            </div>
        </div>
    </div>
</section>

<!-- DOCENTES -->
<section class="section docentes">
    <div class="container">
        <h2 class="section-title text-center mb-5">Docentes</h2>
        <div class="row justify-content-center">
            @foreach($docentes as $docente)
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="docente-card">
                    <div class="docente-photo"><img src="{{ asset('Laravel/public/storage/'.$docente->photo) }}" alt="{{$docente->name}} {{$docente->lastname}}"></div>
                    <h5>{{$docente->name}} {{$docente->lastname}}</h5>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- BENEFICIOS -->
<section class="benefits-pro">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 mb-4 mb-lg-0 text-center">
                <img src="{{ asset('images/beneficios.jpg') }}" alt="Beneficios ESIPEC" class="benefits-img">
            </div>
            <div class="col-lg-7">
                <h2 class="section-title mb-4">Beneficios exclusivos</h2>
                <div class="row">
                    <div class="col-md-6 mb-4"><div class="benefit-card"><div class="benefit-icon"><i class="fas fa-certificate"></i></div><p>Diploma digital verificable</p></div></div>
                    <div class="col-md-6 mb-4"><div class="benefit-card"><div class="benefit-icon"><i class="fas fa-qrcode"></i></div><p>Código único y código QR para validación inmediata</p></div></div>
                    <div class="col-md-6 mb-4"><div class="benefit-card"><div class="benefit-icon"><i class="fas fa-university"></i></div><p>Validez institucional para fines académicos y profesionales</p></div></div>
                    <div class="col-md-6 mb-4"><div class="benefit-card"><div class="benefit-icon"><i class="fas fa-book-open"></i></div><p>Acceso a biblioteca virtual con material actualizado</p></div></div>
                    <div class="col-md-6 mb-4"><div class="benefit-card"><div class="benefit-icon"><i class="fas fa-users"></i></div><p>Comunidad académica para networking y aprendizaje continuo</p></div></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- TESTIMONIOS -->
<section class="section bg-light">
    <div class="container">
        <h2 class="section-title text-center mb-5">Testimonios</h2>
        <div class="row mb-4">
            @for ($i = 1; $i <= 3; $i++)
                <div class="col-md-4 mb-4">
                    <div class="testimonial-card">
                        <img src="https://via.placeholder.com/80" class="testimonial-avatar" alt="Alumno">
                        <h6 class="mt-3 mb-1">Nombre del alumno</h6>
                        <p class="testimonial-text">Excelente experiencia académica, contenidos claros y docentes muy preparados.</p>
                        <div class="testimonial-stars">★★★★★</div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════
     SCRIPT SLIDER PROPIO — sin Bootstrap carousel
     Desktop ≥992px → 3 cards
     Tablet  768-991px → 2 cards
     Móvil   <768px   → 1 card
══════════════════════════════════════════════ --}}
<script>
(function () {
    function getVisible() {
        var w = window.innerWidth;
        if (w >= 992) return 3;
        if (w >= 768) return 2;
        return 1;
    }

    function initSlider(innerId, dotsId) {
        var inner  = document.getElementById(innerId);
        var dotsEl = document.getElementById(dotsId);
        if (!inner) return;

        var slides  = inner.querySelectorAll('.pslide');
        var total   = slides.length;
        var current = 0;

        /* ── Aplica anchos y posición ── */
        function render() {
            var vis      = getVisible();
            var pct      = 100 / vis;
            var maxIndex = Math.max(0, total - vis);
            if (current > maxIndex) current = maxIndex;

            slides.forEach(function (s) {
                s.style.width = pct + '%';
            });

            inner.style.transform = 'translateX(-' + (current * pct) + '%)';
            buildDots(vis, maxIndex);
        }

        /* ── Dots ── */
        function buildDots(vis, maxIndex) {
            if (!dotsEl) return;
            var pages      = Math.ceil(total / vis);
            var activePage = Math.min(Math.floor(current / vis), pages - 1);
            dotsEl.innerHTML = '';
            for (var i = 0; i < pages; i++) {
                (function (page) {
                    var btn = document.createElement('button');
                    btn.className = 'pslider-dot' + (page === activePage ? ' active' : '');
                    btn.addEventListener('click', function () {
                        current = Math.min(page * vis, maxIndex);
                        render();
                    });
                    dotsEl.appendChild(btn);
                })(i);
            }
        }

        /* ── Flechas: busca por data-slider ── */
        document.querySelectorAll('.pslider-arrow[data-slider="' + innerId + '"]').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var vis      = getVisible();
                var maxIndex = Math.max(0, total - vis);
                if (btn.classList.contains('prev')) {
                    current = Math.max(0, current - 1);
                } else {
                    current = Math.min(maxIndex, current + 1);
                }
                render();
            });
        });

        /* ── Swipe táctil ── */
        var touchX = 0;
        inner.addEventListener('touchstart', function (e) { touchX = e.changedTouches[0].screenX; }, { passive: true });
        inner.addEventListener('touchend', function (e) {
            var diff     = touchX - e.changedTouches[0].screenX;
            var vis      = getVisible();
            var maxIndex = Math.max(0, total - vis);
            if (Math.abs(diff) > 40) {
                current = diff > 0
                    ? Math.min(maxIndex, current + 1)
                    : Math.max(0, current - 1);
                render();
            }
        }, { passive: true });

        /* ── Resize ── */
        var resizeTimer;
        window.addEventListener('resize', function () {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(render, 150);
        });

        /* ── Init ── */
        render();
    }

    document.addEventListener('DOMContentLoaded', function () {
        initSlider('featuredSlider',   'featuredDots');
        initSlider('cursosSlider',     'cursosDots');
        initSlider('espSlider',        'espDots');
        initSlider('diplomadosSlider', 'diplomadosDots');
    });
})();
</script>

@endsection