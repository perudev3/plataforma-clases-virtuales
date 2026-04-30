<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ingresar — ESIPEC Campus Virtual</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Montserrat:wght@700;800;900&display=swap" rel="stylesheet">

    <style>
        :root {
            --azul:      #0B2C4D;
            --azul-med:  #1a4a72;
            --celeste:   #00B4E6;
            --dorado:    #C9A24D;
            --rojo:      #c62828;
            --gris-bg:   #F0F3F7;
            --gris-borde:#e2e8f0;
            --texto:     #1e293b;
            --texto-sec: #64748b;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--gris-bg);
            min-height: 100vh;
            display: flex;
            align-items: stretch;
        }

        /* ── WRAPPER ── */
        .auth-wrapper {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }

        /* ══════════════════════════════
           PANEL IZQUIERDO — IMAGEN
        ══════════════════════════════ */
        .auth-panel-left {
            flex: 1;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 48px;
            /* Imagen de fondo — reemplaza con tu banner real */
            background: url('https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=900&q=80') center/cover no-repeat;
        }

        /* Overlay degradado */
        .auth-panel-left::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(
                160deg,
                rgba(6, 18, 38, 0.55) 0%,
                rgba(11, 44, 77, 0.82) 55%,
                rgba(11, 44, 77, 0.97) 100%
            );
            z-index: 1;
        }

        /* Patrón puntillado decorativo */
        .auth-panel-left::after {
            content: '';
            position: absolute;
            top: 0; right: 0;
            width: 50%;
            height: 50%;
            background-image: radial-gradient(rgba(0,180,230,.18) 1px, transparent 1px);
            background-size: 22px 22px;
            z-index: 1;
            pointer-events: none;
        }

        .auth-left-content {
            position: relative;
            z-index: 2;
        }

        /* Pill badge */
        .auth-left-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(0,180,230,.18);
            border: 1px solid rgba(0,180,230,.4);
            color: #7ee8ff;
            font-size: 11.5px;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            padding: 6px 14px;
            border-radius: 30px;
            margin-bottom: 18px;
        }

        .auth-left-pill .dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            background: var(--celeste);
            animation: pulse 1.8s ease infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50%       { opacity: .5; transform: scale(1.4); }
        }

        .auth-left-title {
            font-family: 'Montserrat', sans-serif;
            font-size: clamp(1.8rem, 2.8vw, 2.6rem);
            font-weight: 900;
            color: #fff;
            line-height: 1.15;
            margin-bottom: 14px;
        }

        .auth-left-title em {
            font-style: normal;
            color: var(--celeste);
        }

        .auth-left-subtitle {
            font-size: 14px;
            color: rgba(255,255,255,.72);
            line-height: 1.7;
            max-width: 360px;
            margin-bottom: 30px;
        }

        /* Stats row */
        .auth-stats {
            display: flex;
            gap: 24px;
            flex-wrap: wrap;
        }

        .auth-stat {
            display: flex;
            flex-direction: column;
        }

        .auth-stat-value {
            font-family: 'Montserrat', sans-serif;
            font-size: 22px;
            font-weight: 800;
            color: #fff;
            line-height: 1;
        }

        .auth-stat-label {
            font-size: 11.5px;
            color: rgba(255,255,255,.55);
            font-weight: 500;
            margin-top: 3px;
        }

        .auth-stats-divider {
            width: 1px;
            background: rgba(255,255,255,.15);
            align-self: stretch;
        }

        /* ══════════════════════════════
           PANEL DERECHO — FORMULARIO
        ══════════════════════════════ */
        .auth-panel-right {
            width: 460px;
            flex-shrink: 0;
            background: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 52px 44px;
            position: relative;
            overflow-y: auto;
        }

        /* Línea decorativa izquierda */
        .auth-panel-right::before {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(180deg, var(--celeste) 0%, var(--dorado) 50%, var(--azul) 100%);
        }

        /* LOGO */
        .auth-logo-wrap {
            margin-bottom: 32px;
        }

        .auth-logo-wrap img {
            max-height: 46px;
            display: block;
        }

        /* TÍTULO FORMULARIO */
        .auth-form-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 22px;
            font-weight: 800;
            color: var(--azul);
            line-height: 1.2;
            margin-bottom: 4px;
        }

        .auth-form-sub {
            font-size: 13px;
            color: var(--texto-sec);
            font-weight: 500;
            margin-bottom: 28px;
        }

        /* INPUTS */
        .auth-field { margin-bottom: 18px; }

        .auth-label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            color: var(--azul);
            margin-bottom: 6px;
            letter-spacing: .03em;
        }

        .auth-input-wrap {
            position: relative;
        }

        .auth-input-wrap .auth-input-icon {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: #b0bec5;
            font-size: 14px;
            pointer-events: none;
            transition: color .2s;
        }

        .auth-input {
            display: block;
            width: 100%;
            padding: 11px 14px 11px 38px;
            border: 1.5px solid var(--gris-borde);
            border-radius: 10px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 14px;
            color: var(--texto);
            background: #fdfdfd;
            transition: border-color .2s, box-shadow .2s;
            outline: none;
        }

        .auth-input:focus {
            border-color: var(--celeste);
            box-shadow: 0 0 0 3px rgba(0,180,230,.12);
            background: #fff;
        }

        .auth-input:focus ~ .auth-input-icon,
        .auth-input-wrap:focus-within .auth-input-icon {
            color: var(--celeste);
        }

        .auth-input.is-invalid {
            border-color: var(--rojo);
            box-shadow: 0 0 0 3px rgba(198,40,40,.08);
        }

        .auth-error {
            font-size: 11.5px;
            color: var(--rojo);
            font-weight: 600;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* BTN SUBMIT */
        .auth-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, var(--azul) 0%, var(--azul-med) 100%);
            color: #fff;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 14.5px;
            font-weight: 700;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: all .25s ease;
            box-shadow: 0 4px 16px rgba(11,44,77,.28);
            margin-top: 6px;
            letter-spacing: .02em;
        }

        .auth-btn:hover {
            background: linear-gradient(135deg, #0d3660 0%, #1e56a0 100%);
            box-shadow: 0 6px 22px rgba(11,44,77,.38);
            transform: translateY(-1px);
        }

        .auth-btn:active { transform: translateY(0); }

        /* DIVIDER */
        .auth-divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 22px 0;
        }

        .auth-divider::before,
        .auth-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--gris-borde);
        }

        .auth-divider span {
            font-size: 11.5px;
            font-weight: 600;
            color: #b0bec5;
            white-space: nowrap;
        }

        /* FOOTER LINK */
        .auth-footer-link {
            text-align: center;
            font-size: 13px;
            color: var(--texto-sec);
            margin-top: 22px;
        }

        .auth-footer-link a {
            color: var(--celeste);
            font-weight: 700;
            text-decoration: none;
            transition: color .2s;
        }

        .auth-footer-link a:hover { color: var(--azul); }

        /* Back to site */
        .auth-back {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            font-weight: 600;
            color: var(--texto-sec);
            text-decoration: none;
            margin-bottom: 24px;
            transition: color .2s;
        }

        .auth-back:hover { color: var(--azul); }

        /* ANIMATION */
        @keyframes fadeSlideRight {
            from { opacity: 0; transform: translateX(18px); }
            to   { opacity: 1; transform: translateX(0); }
        }

        .auth-panel-right > * {
            animation: fadeSlideRight .4s ease both;
        }

        .auth-panel-right > *:nth-child(1) { animation-delay: .05s; }
        .auth-panel-right > *:nth-child(2) { animation-delay: .10s; }
        .auth-panel-right > *:nth-child(3) { animation-delay: .15s; }
        .auth-panel-right > *:nth-child(4) { animation-delay: .20s; }

        /* ══════════════════════════════
           RESPONSIVE
        ══════════════════════════════ */
        @media (max-width: 900px) {
            .auth-panel-left { display: none; }
            .auth-panel-right {
                width: 100%;
                padding: 40px 28px;
            }
        }

        @media (max-width: 480px) {
            .auth-panel-right { padding: 32px 20px; }
            .auth-form-title { font-size: 20px; }
        }
    </style>
</head>
<body>

<div class="auth-wrapper">

    <!-- ════════ PANEL IZQUIERDO ════════ -->
    <div class="auth-panel-left">
        <div class="auth-left-content">
            <div class="auth-left-pill">
                <span class="dot"></span>
                Campus Virtual Activo
            </div>

            <h1 class="auth-left-title">
                Formación continua<br>
                de <em>excelencia</em><br>
                a tu alcance
            </h1>

            <p class="auth-left-subtitle">
                Accede a diplomados, especializaciones y cursos con los mejores docentes del país. Certifícate y avanza en tu carrera.
            </p>

            <div class="auth-stats">
                <div class="auth-stat">
                    <div class="auth-stat-value">+1,200</div>
                    <div class="auth-stat-label">Estudiantes activos</div>
                </div>
                <div class="auth-stats-divider"></div>
                <div class="auth-stat">
                    <div class="auth-stat-value">50+</div>
                    <div class="auth-stat-label">Programas disponibles</div>
                </div>
                <div class="auth-stats-divider"></div>
                <div class="auth-stat">
                    <div class="auth-stat-value">98%</div>
                    <div class="auth-stat-label">Satisfacción</div>
                </div>
            </div>
        </div>
    </div>

    <!-- ════════ PANEL DERECHO ════════ -->
    <div class="auth-panel-right">

        <a href="{{ url('/') }}" class="auth-back">
            <i class="fas fa-arrow-left"></i> Volver al sitio
        </a>

        <div class="auth-logo-wrap">
            <img src="{{ asset('images/logo-esipec.png') }}" alt="ESIPEC">
        </div>

        <div>
            <h2 class="auth-form-title">Bienvenido de nuevo</h2>
            <p class="auth-form-sub">Ingresa tu correo para acceder al campus virtual</p>
        </div>

        {{-- ERRORES GENERALES --}}
        @if($errors->any())
        <div style="background:#fff1f2; border:1.5px solid #fecdd3; border-radius:10px; padding:12px 16px; margin-bottom:16px;">
            <div style="display:flex; align-items:center; gap:8px; color:var(--rojo); font-size:13px; font-weight:700;">
                <i class="fas fa-circle-exclamation"></i>
                @foreach($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- EMAIL --}}
            <div class="auth-field">
                <label class="auth-label" for="email">Correo electrónico</label>
                <div class="auth-input-wrap">
                    <input id="email"
                           type="email"
                           name="email"
                           class="auth-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                           value="{{ old('email') }}"
                           placeholder="nombre@ejemplo.com"
                           required autofocus>
                    <i class="fas fa-envelope auth-input-icon"></i>
                </div>
                @error('email')
                    <div class="auth-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</div>
                @enderror
            </div>

            {{-- SUBMIT --}}
            <button type="submit" class="auth-btn">
                <i class="fas fa-right-to-bracket"></i>
                Ingresar al campus
            </button>
        </form>

        <div class="auth-divider"><span>¿Eres nuevo?</span></div>

        <div class="auth-footer-link">
            ¿No tienes cuenta?
            <a href="{{ route('register') }}">Regístrate gratis</a>
        </div>

    </div>
</div>

</body>
</html>