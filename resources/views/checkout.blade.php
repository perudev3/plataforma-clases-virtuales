@extends('layouts.landing')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&family=Open+Sans:wght@400;500;600&display=swap');

    :root {
        --azul:     #0B2C4D;
        --azul-med: #1a4a72;
        --celeste:  #00B4E6;
        --rojo:     #c62828;
        --verde:    #2e7d32;
        --gris-bg:  #f4f6f9;
        --borde:    #e2e8f0;
        --texto:    #1e293b;
        --texto-sec:#64748b;
        --blanco:   #ffffff;
        --sombra:   0 8px 32px rgba(11,44,77,.12);
    }

    /* ── PAGE WRAPPER ── */
    .checkout-page {
        background: var(--gris-bg);
        min-height: 100vh;
        font-family: 'Open Sans', sans-serif;
        padding-bottom: 80px;
    }

    /* ── HERO BANNER ── */
    .checkout-hero {
        background: linear-gradient(105deg, #061226 0%, #0B2C4D 55%, #1a4a72 100%);
        padding: 56px 0 44px;
        position: relative;
        overflow: hidden;
    }

    .checkout-hero::after {
        content: "";
        position: absolute;
        right: -60px;
        top: -60px;
        width: 380px;
        height: 380px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(0,180,230,.18) 0%, transparent 70%);
        pointer-events: none;
    }

    .checkout-hero .badge-tipo {
        display: inline-block;
        background: var(--celeste);
        color: #fff;
        font-family: 'Montserrat', sans-serif;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        padding: 5px 14px;
        border-radius: 30px;
        margin-bottom: 14px;
    }

    .checkout-hero h1 {
        font-family: 'Montserrat', sans-serif;
        font-size: clamp(1.6rem, 3.5vw, 2.4rem);
        font-weight: 800;
        color: #fff;
        line-height: 1.25;
        margin-bottom: 14px;
        max-width: 640px;
        text-shadow: 0 3px 16px rgba(0,0,0,.4);
    }

    .checkout-breadcrumb {
        font-size: 13px;
        color: rgba(255,255,255,.6);
    }

    .checkout-breadcrumb a {
        color: rgba(255,255,255,.75);
        text-decoration: none;
    }

    .checkout-breadcrumb a:hover { color: var(--celeste); }
    .checkout-breadcrumb span { margin: 0 6px; color: rgba(255,255,255,.35); }

    /* ── GRID PRINCIPAL ── */
    .checkout-grid {
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: 28px;
        max-width: 1100px;
        margin: -28px auto 0;
        padding: 0 20px;
        position: relative;
        z-index: 10;
    }

    /* ── CARD GENÉRICA ── */
    .co-card {
        background: var(--blanco);
        border-radius: 14px;
        box-shadow: var(--sombra);
        overflow: hidden;
        margin-bottom: 22px;
    }

    .co-card-header {
        background: linear-gradient(90deg, #0B2C4D, #1a4a72);
        padding: 16px 24px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .co-card-header i {
        font-size: 18px;
        color: var(--celeste);
    }

    .co-card-header h3 {
        font-family: 'Montserrat', sans-serif;
        font-size: 15px;
        font-weight: 700;
        color: #fff;
        margin: 0;
    }

    .co-card-body {
        padding: 26px 24px;
    }

    /* ── RESUMEN DEL CURSO ── */
    .course-summary {
        display: flex;
        gap: 18px;
        align-items: flex-start;
    }

    .course-summary-img {
        width: 110px;
        height: 75px;
        border-radius: 10px;
        object-fit: cover;
        flex-shrink: 0;
        background: linear-gradient(135deg, #0B2C4D, #00B4E6);
    }

    .course-summary-img-placeholder {
        width: 110px;
        height: 75px;
        border-radius: 10px;
        flex-shrink: 0;
        background: linear-gradient(135deg, #0B2C4D, #00B4E6);
        display: flex;
        align-items: center;
        justify-content: center;
        color: rgba(255,255,255,.5);
        font-size: 28px;
    }

    .course-summary-info h4 {
        font-family: 'Montserrat', sans-serif;
        font-size: 15px;
        font-weight: 700;
        color: var(--azul);
        margin-bottom: 6px;
        line-height: 1.35;
    }

    .course-summary-info .meta-pill {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #eef5fb;
        border: 1px solid #d0e4f4;
        border-radius: 20px;
        padding: 3px 10px;
        font-size: 12px;
        color: var(--azul-med);
        font-weight: 600;
        margin-right: 6px;
        margin-bottom: 6px;
    }

    .course-summary-info .meta-pill i { font-size: 11px; color: var(--celeste); }

    /* ── LÍNEA DIVISORIA ── */
    .co-divider {
        border: none;
        border-top: 1px solid var(--borde);
        margin: 20px 0;
    }

    /* ── BENEFICIOS DE INSCRIPCIÓN ── */
    .benefits-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .benefits-list li {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        font-size: 13.5px;
        color: #374151;
        line-height: 1.45;
    }

    .benefits-list li .bico {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: rgba(0,180,230,.12);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        margin-top: 1px;
    }

    .benefits-list li .bico i {
        font-size: 13px;
        color: var(--celeste);
    }

    /* ── PASOS / TIMELINE ── */
    .steps-list {
        display: flex;
        flex-direction: column;
        gap: 0;
    }

    .step-item {
        display: flex;
        gap: 16px;
        position: relative;
    }

    .step-item:not(:last-child)::before {
        content: "";
        position: absolute;
        left: 19px;
        top: 38px;
        width: 2px;
        height: calc(100% - 16px);
        background: var(--borde);
    }

    .step-num {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--celeste), var(--azul));
        color: #fff;
        font-family: 'Montserrat', sans-serif;
        font-weight: 800;
        font-size: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(0,180,230,.3);
    }

    .step-content {
        padding: 8px 0 24px;
    }

    .step-content h5 {
        font-family: 'Montserrat', sans-serif;
        font-size: 14px;
        font-weight: 700;
        color: var(--azul);
        margin-bottom: 3px;
    }

    .step-content p {
        font-size: 13px;
        color: var(--texto-sec);
        margin: 0;
        line-height: 1.5;
    }

    /* ── SIDEBAR ORDER SUMMARY ── */
    .order-summary {
        position: sticky;
        top: 90px;
    }

    .price-display {
        text-align: center;
        padding: 20px 0 10px;
    }

    .price-display .price-label {
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--texto-sec);
        font-weight: 600;
        margin-bottom: 6px;
    }

    .price-display .price-amount {
        font-family: 'Montserrat', sans-serif;
        font-size: 3rem;
        font-weight: 800;
        color: var(--azul);
        line-height: 1;
    }

    .price-display .price-amount sup {
        font-size: 1.4rem;
        font-weight: 700;
        vertical-align: super;
    }

    .price-display .price-free {
        font-family: 'Montserrat', sans-serif;
        font-size: 2.2rem;
        font-weight: 800;
        color: var(--verde);
    }

    .price-display .price-note {
        font-size: 12px;
        color: var(--texto-sec);
        margin-top: 6px;
    }

    /* Detalle de líneas */
    .price-lines {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .price-lines li {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 13.5px;
        color: #374151;
        padding: 9px 0;
        border-bottom: 1px dashed var(--borde);
    }

    .price-lines li:last-child { border-bottom: none; }

    .price-lines li .pl-label { color: var(--texto-sec); }
    .price-lines li .pl-val { font-weight: 600; color: var(--texto); }
    .price-lines li.total-row { font-size: 15px; margin-top: 4px; }
    .price-lines li.total-row .pl-label { font-weight: 700; color: var(--texto); }
    .price-lines li.total-row .pl-val { font-family: 'Montserrat', sans-serif; font-weight: 800; color: var(--azul); font-size: 18px; }

    /* Botón principal */
    .btn-checkout {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: 100%;
        background: linear-gradient(135deg, var(--rojo), #9b1c1c);
        color: #fff;
        font-family: 'Montserrat', sans-serif;
        font-size: 16px;
        font-weight: 800;
        padding: 17px 24px;
        border-radius: 12px;
        border: none;
        cursor: pointer;
        transition: all .3s ease;
        box-shadow: 0 6px 22px rgba(198,40,40,.4);
        letter-spacing: .3px;
        text-decoration: none;
        margin-top: 18px;
    }

    .btn-checkout:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(198,40,40,.55);
        color: #fff;
        text-decoration: none;
    }

    .btn-checkout-free {
        background: linear-gradient(135deg, var(--azul), var(--azul-med));
        box-shadow: 0 6px 22px rgba(11,44,77,.35);
    }

    .btn-checkout-free:hover {
        box-shadow: 0 10px 30px rgba(11,44,77,.5);
        color: #fff;
    }

    .btn-checkout i { font-size: 18px; }

    /* Garantías debajo del botón */
    .guarantee-row {
        display: flex;
        justify-content: center;
        gap: 18px;
        margin-top: 16px;
        flex-wrap: wrap;
    }

    .guarantee-item {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 12px;
        color: var(--texto-sec);
    }

    .guarantee-item i { font-size: 14px; color: var(--verde); }

    /* Trust badges */
    .trust-badges {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        padding: 16px;
        border-top: 1px solid var(--borde);
        margin-top: 6px;
        flex-wrap: wrap;
    }

    .trust-badge {
        font-size: 11px;
        color: var(--texto-sec);
        display: flex;
        align-items: center;
        gap: 4px;
        font-weight: 500;
    }

    .trust-badge i { color: var(--azul); font-size: 14px; }

    /* Formulario */
    .co-form-group {
        margin-bottom: 18px;
    }

    .co-form-group label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: var(--azul);
        margin-bottom: 6px;
    }

    .co-form-group .form-control {
        border: 1.5px solid var(--borde);
        border-radius: 10px;
        padding: 11px 16px;
        font-size: 14px;
        color: var(--texto);
        transition: border-color .2s, box-shadow .2s;
        background: #fafbfc;
    }

    .co-form-group .form-control:focus {
        border-color: var(--celeste);
        box-shadow: 0 0 0 3px rgba(0,180,230,.15);
        outline: none;
        background: #fff;
    }

    /* Alerta info */
    .co-alert {
        background: linear-gradient(90deg, #e8f7fd, #f0fbff);
        border: 1px solid #b3e5f5;
        border-left: 4px solid var(--celeste);
        border-radius: 10px;
        padding: 14px 18px;
        display: flex;
        gap: 12px;
        align-items: flex-start;
        font-size: 13.5px;
        color: #1e4a6a;
        margin-bottom: 22px;
    }

    .co-alert i { font-size: 18px; color: var(--celeste); flex-shrink: 0; margin-top: 1px; }

    /* Responsive */
    @media (max-width: 991px) {
        .checkout-grid {
            grid-template-columns: 1fr;
            margin-top: -20px;
        }
        .order-summary { position: static; }
        .benefits-list { grid-template-columns: 1fr; }
    }

    @media (max-width: 576px) {
        .checkout-hero { padding: 40px 0 36px; }
        .checkout-hero h1 { font-size: 1.4rem; }
        .course-summary { flex-direction: column; }
        .co-card-body { padding: 20px 16px; }
    }
</style>

<!-- ═══════════════ HERO ═══════════════ -->
<div class="checkout-hero">
    <div class="container">
        <div class="checkout-breadcrumb mb-3">
            <a href="/">Inicio</a>
            <span>›</span>
            <a href="{{ url('cursos') }}">Programas</a>
            <span>›</span>
            Checkout
        </div>
        <span class="badge-tipo">📋 Inscripción</span>
        <h1>{{ $course->title }}</h1>
        <p style="color:rgba(255,255,255,.75); font-size:14px; margin:0;">
            Estás a un paso de comenzar tu formación profesional con ESIPEC.
        </p>
    </div>
</div>

<!-- ═══════════════ GRID ═══════════════ -->
<div class="checkout-grid">

    <!-- ── COLUMNA IZQUIERDA ── -->
    <div class="checkout-main">

        <!-- Resumen del curso -->
        <div class="co-card">
            <div class="co-card-header">
                <i class="fas fa-graduation-cap"></i>
                <h3>Resumen del programa</h3>
            </div>
            <div class="co-card-body">
                <div class="course-summary">
                    @if($course->image ?? null)
                        <img src="{{ asset('Laravel/public/storage/' . $course->image) }}" alt="{{ $course->title }}" class="course-summary-img">
                    @else
                        <div class="course-summary-img-placeholder">
                            <i class="fas fa-book-open"></i>
                        </div>
                    @endif
                    <div class="course-summary-info">
                        <h4>{{ $course->title }}</h4>
                        <div class="mt-1">
                            @if($course->modality ?? null)
                                <span class="meta-pill"><i class="fas fa-laptop"></i> {{ $course->modality }}</span>
                            @endif
                            @if($course->duration ?? null)
                                <span class="meta-pill"><i class="fas fa-clock"></i> {{ $course->duration }}</span>
                            @endif
                            @if($course->start_date ?? null)
                                <span class="meta-pill"><i class="fas fa-calendar"></i> {{ \Carbon\Carbon::parse($course->start_date)->format('d M Y') }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <hr class="co-divider">

                <div class="co-alert">
                    <i class="fas fa-info-circle"></i>
                    <div>
                        Al inscribirte obtendrás acceso inmediato al campus virtual y recibirás tus credenciales por correo electrónico.
                    </div>
                </div>

                <div style="margin-top:10px;">

                    <p style="font-size:14px; font-weight:800; color:var(--azul); margin-bottom:10px;">
                        💰 INVERSIÓN
                    </p>

                    @if($course->discount_price ?? false)
                        <p style="margin:0; font-size:18px; font-weight:800; color:var(--rojo);">
                            S/ {{ number_format($course->discount_price, 2) }} (precio promocional)
                        </p>
                        <p style="margin:0; font-size:14px; text-decoration:line-through; color:var(--texto-sec);">
                            S/ {{ number_format($course->price, 2) }}
                        </p>
                    @else
                        <p style="margin:0; font-size:18px; font-weight:800;">
                            S/ {{ number_format($course->price, 2) }}
                        </p>
                    @endif

                    <p style="font-size:14px; font-weight:800; color:var(--azul); margin-bottom:10px;">
                        🎓 ACCESO COMPLETO INCLUYE:
                    </p>

                    <ul style="list-style:none; padding:0; margin-bottom:15px;">
                        <li>✔ Clases en vivo con docentes especialistas</li>
                        <li>✔ Acceso a todas las grabaciones</li>
                        <li>✔ Materiales de estudio descargables</li>
                        <li>✔ Certificación por 240 horas académicas</li>
                        <li>✔ Diploma verificable con código QR</li>
                        <li>✔ Acceso ilimitado al contenido</li>
                    </ul>


                    <div style="margin:15px 0;">
                        <form action="{{ route('alumno.checkout.pay', $course->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-checkout" style="width:100%;">
                                🔘 
                                Curso
                            </button>
                        </form>
                    </div>

                    
                    <p style="font-size:13px; font-weight:700; color:var(--azul);">
                        🔹 TAMBIÉN PUEDES…
                    </p>

                    <p style="font-size:16px; font-weight:800; color:var(--verde); margin-bottom:8px;">
                        🚀 EMPIEZA GRATIS
                    </p>

                    <ul style="list-style:none; padding:0;">
                        <li>✔ 3 clases en vivo</li>
                        <li>✔ 3 clases grabadas</li>
                        <li>✔ Aviso de nuevos cursos</li>
                    </ul>

                    <div style="margin-top:15px;">
                        <form action="{{ route('alumno.courses.enroll', $course->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="from_checkout" value="1">

                            <button type="submit" class="btn-checkout btn-checkout-free" style="width:100%;">
                                🔘 Iniciar Gratis
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <!-- Cómo funciona -->
        <div class="co-card">
            <div class="co-card-header">
                <i class="fas fa-list-ol"></i>
                <h3>¿Cómo funciona la inscripción?</h3>
            </div>
            <div class="co-card-body">
                <div class="steps-list">
                    <div class="step-item">
                        <div class="step-num">1</div>
                        <div class="step-content">
                            <h5>Confirma tu inscripción</h5>
                            <p>Haz clic en el botón de pago e inscripción. Si el programa es gratuito, el acceso es inmediato.</p>
                        </div>
                    </div>
                    <div class="step-item">
                        <div class="step-num">2</div>
                        <div class="step-content">
                            <h5>Recibe tus credenciales</h5>
                            <p>Te enviaremos un correo con tu usuario y contraseña para ingresar al campus virtual.</p>
                        </div>
                    </div>
                    <div class="step-item">
                        <div class="step-num">3</div>
                        <div class="step-content">
                            <h5>¡Empieza a aprender!</h5>
                            <p>Accede a todas las clases, materiales y recursos desde cualquier dispositivo, a tu propio ritmo.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- ── SIDEBAR ── -->
    <div class="order-summary">
        <div class="co-card">
            <div class="co-card-header">
                <i class="fas fa-receipt"></i>
                <h3>Resumen del pedido</h3>
            </div>
            <div class="co-card-body">

                <!-- Precio -->
                <div class="price-display">
                    @if(($course->price ?? 0) == 0)
                        <div class="price-label">Precio</div>
                        <div class="price-free">GRATUITO</div>
                        <div class="price-note">Sin costo de inscripción</div>
                    @else
                        <div class="price-label">Total a pagar</div>
                        @if($course->discount_price ?? false)
                            <div class="price-amount" style="color:var(--rojo);">
                                <sup>S/</sup>{{ number_format($course->discount_price, 2) }}
                            </div>
                            <div style="font-size:14px; color:var(--texto-sec); text-decoration:line-through;">
                                S/ {{ number_format($course->price, 2) }}
                            </div>
                            <div class="price-note">Precio promocional</div>
                        @else
                            <div class="price-amount">
                                <sup>S/</sup>{{ number_format($course->price, 2) }}
                            </div>
                        @endif
                        <div class="price-note">Pago único — sin cuotas ocultas</div>
                    @endif
                </div>

                <hr class="co-divider">

                <!-- Desglose -->
                <ul class="price-lines">
                    <li>
                        <span class="pl-label">Programa</span>
                        <span class="pl-val" style="max-width:180px; text-align:right; font-size:13px;">{{ Str::limit($course->title, 30) }}</span>
                    </li>
                    <li>
                        <span class="pl-label">Modalidad</span>
                        <span class="pl-val">{{ $course->modality ?? 'Virtual' }}</span>
                    </li>
                    <li>
                        <span class="pl-label">Certificado</span>
                        <span class="pl-val" style="color:var(--verde);">✔ Incluido</span>
                    </li>
                    @if($course->discount_price ?? false)
                    <li>
                        <span class="pl-label">Descuento</span>
                        <span class="pl-val" style="color:var(--verde);">
                            - S/ {{ number_format($course->price - $course->discount_price, 2) }}
                        </span>
                    </li>
                    @endif
                    <li class="total-row">
                        <span class="pl-label">Total</span>
                        @php
                            $finalPrice = $course->discount_price ?? $course->price;
                        @endphp

                        <span class="pl-val">
                            @if(($finalPrice ?? 0) == 0)
                                Gratis
                            @else
                                S/ {{ number_format($finalPrice, 2) }}
                            @endif
                        </span>
                    </li>
                </ul>

                <!-- FORM -->

                <form action="{{ route('alumno.checkout.pay', $course->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-checkout px-4 py-2 fw-semibold">
                        Comprar curso
                        <small>A solo S/{{ number_format($course->price_display=='regular' ? $course->price : $course->discount_price, 2) }}</small>
                    </button>
                </form><br>
                <form action="{{ route('alumno.courses.enroll', $course->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="from_checkout" value="1">

                    <button type="submit" class="btn-checkout {{ ($course->price ?? 0) == 0 ? 'btn-checkout-free' : '' }}">
                        @if(($course->price ?? 0) == 0)
                            <i class="fas fa-user-plus"></i>
                            Inicia Gratis
                        @else
                            <i class="fas fa-lock"></i>
                            Inicia Gratis
                        @endif
                    </button>
                </form>

                <div class="guarantee-row">
                    <span class="guarantee-item"><i class="fas fa-shield-alt"></i> Pago seguro</span>
                    <span class="guarantee-item"><i class="fas fa-undo"></i> Garantía de satisfacción</span>
                </div>
            </div>

            <div class="trust-badges">
                <span class="trust-badge"><i class="fas fa-lock"></i> SSL Seguro</span>
                <span class="trust-badge"><i class="fas fa-id-badge"></i> Certificado oficial</span>
                <span class="trust-badge"><i class="fas fa-headset"></i> Soporte 24/7</span>
            </div>
        </div>

        <!-- Contacto rápido -->
        <div class="co-card">
            <div class="co-card-body" style="padding:20px 22px;">
                <p style="font-size:13.5px; font-weight:700; color:var(--azul); margin-bottom:12px;">
                    ¿Tienes alguna duda?
                </p>
                <a href="https://wa.me/51950536397" target="_blank"
                   style="display:flex; align-items:center; gap:10px; background:#f0fdf4; border:1.5px solid #bbf7d0; border-radius:10px; padding:12px 16px; text-decoration:none; transition:all .2s ease;"
                   onmouseover="this.style.background='#dcfce7'" onmouseout="this.style.background='#f0fdf4'">
                    <i class="fab fa-whatsapp" style="font-size:24px; color:#16a34a;"></i>
                    <div>
                        <div style="font-size:13px; font-weight:700; color:#15803d;">Escríbenos por WhatsApp</div>
                        <div style="font-size:12px; color:#4b5563;">950 536 397 — Respuesta inmediata</div>
                    </div>
                </a>
            </div>
        </div>

    </div>
</div>

@endsection