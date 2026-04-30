<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Registro — ESIPEC Campus Virtual</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Montserrat:wght@700;800;900&display=swap" rel="stylesheet">

    <style>
        :root {
            --azul:      #0B2C4D;
            --azul-med:  #1a4a72;
            --celeste:   #00B4E6;
            --dorado:    #C9A24D;
            --rojo:      #c62828;
            --verde:     #2e7d32;
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
           (en registro va a la DERECHA visualmente
            pero usamos order para invertir)
        ══════════════════════════════ */
        .auth-panel-left {
            flex: 1;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 48px;
            /* Imagen diferente al login — biblioteca/campus */
            background: url('https://images.unsplash.com/photo-1497633762265-9d179a990aa6?w=900&q=80') center/cover no-repeat;
            order: 2; /* En registro el panel imagen va a la derecha */
        }

        .auth-panel-left::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(
                200deg,
                rgba(201,162,77,.15) 0%,
                rgba(11, 44, 77, 0.80) 45%,
                rgba(6, 18, 38, 0.97) 100%
            );
            z-index: 1;
        }

        .auth-panel-left::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0;
            width: 50%;
            height: 50%;
            background-image: radial-gradient(rgba(201,162,77,.15) 1px, transparent 1px);
            background-size: 22px 22px;
            z-index: 1;
            pointer-events: none;
        }

        .auth-left-content {
            position: relative;
            z-index: 2;
        }

        .auth-left-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(201,162,77,.18);
            border: 1px solid rgba(201,162,77,.4);
            color: #f5d98a;
            font-size: 11.5px;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            padding: 6px 14px;
            border-radius: 30px;
            margin-bottom: 18px;
        }

        .auth-left-pill i { font-size: 12px; }

        .auth-left-title {
            font-family: 'Montserrat', sans-serif;
            font-size: clamp(1.8rem, 2.6vw, 2.5rem);
            font-weight: 900;
            color: #fff;
            line-height: 1.15;
            margin-bottom: 14px;
        }

        .auth-left-title em {
            font-style: normal;
            color: var(--dorado);
        }

        .auth-left-subtitle {
            font-size: 14px;
            color: rgba(255,255,255,.72);
            line-height: 1.7;
            max-width: 360px;
            margin-bottom: 30px;
        }

        /* Beneficios list */
        .auth-benefits { list-style: none; display: flex; flex-direction: column; gap: 12px; }

        .auth-benefits li {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13.5px;
            color: rgba(255,255,255,.85);
            font-weight: 500;
        }

        .auth-benefits li .benefit-icon {
            width: 28px; height: 28px;
            border-radius: 7px;
            background: rgba(0,180,230,.2);
            border: 1px solid rgba(0,180,230,.3);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            color: #7ee8ff;
            flex-shrink: 0;
        }

        /* ══════════════════════════════
           PANEL DERECHO — FORMULARIO
        ══════════════════════════════ */
        .auth-panel-right {
            width: 500px;
            flex-shrink: 0;
            background: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 44px 44px;
            position: relative;
            overflow-y: auto;
            order: 1; /* formulario va a la izquierda */
        }

        .auth-panel-right::before {
            content: '';
            position: absolute;
            top: 0; right: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(180deg, var(--dorado) 0%, var(--celeste) 50%, var(--azul) 100%);
        }

        /* LOGO */
        .auth-logo-wrap {
            margin-bottom: 24px;
        }

        .auth-logo-wrap img {
            max-height: 44px;
            display: block;
        }

        /* TÍTULO */
        .auth-form-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 21px;
            font-weight: 800;
            color: var(--azul);
            line-height: 1.2;
            margin-bottom: 3px;
        }

        .auth-form-sub {
            font-size: 13px;
            color: var(--texto-sec);
            font-weight: 500;
            margin-bottom: 24px;
        }

        /* INPUTS */
        .auth-field { margin-bottom: 15px; }

        .auth-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .auth-label {
            display: block;
            font-size: 11.5px;
            font-weight: 700;
            color: var(--azul);
            margin-bottom: 5px;
            letter-spacing: .03em;
        }

        .auth-label span { color: var(--rojo); }

        .auth-input-wrap {
            position: relative;
        }

        .auth-input-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #b0bec5;
            font-size: 13px;
            pointer-events: none;
            transition: color .2s;
        }

        .auth-input {
            display: block;
            width: 100%;
            padding: 10px 13px 10px 36px;
            border: 1.5px solid var(--gris-borde);
            border-radius: 9px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 13.5px;
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

        .auth-input-wrap:focus-within .auth-input-icon { color: var(--celeste); }

        .auth-input.is-invalid {
            border-color: var(--rojo);
        }

        .auth-error {
            font-size: 11px;
            color: var(--rojo);
            font-weight: 600;
            margin-top: 4px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* TERMS */
        .auth-terms {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            font-size: 12px;
            color: var(--texto-sec);
            margin: 12px 0 4px;
            cursor: pointer;
        }

        .auth-terms input[type="checkbox"] {
            margin-top: 2px;
            accent-color: var(--celeste);
            flex-shrink: 0;
            width: 15px; height: 15px;
            cursor: pointer;
        }

        .auth-terms a {
            color: var(--celeste);
            font-weight: 700;
            text-decoration: none;
        }

        /* BTN */
        .auth-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, var(--celeste) 0%, #009dc8 100%);
            color: #fff;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 14px;
            font-weight: 700;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: all .25s ease;
            box-shadow: 0 4px 16px rgba(0,180,230,.3);
            margin-top: 8px;
        }

        .auth-btn:hover {
            background: linear-gradient(135deg, #00a2d0 0%, #0082a8 100%);
            box-shadow: 0 6px 22px rgba(0,180,230,.4);
            transform: translateY(-1px);
        }

        /* FOOTER */
        .auth-footer-link {
            text-align: center;
            font-size: 13px;
            color: var(--texto-sec);
            margin-top: 18px;
        }

        .auth-footer-link a {
            color: var(--azul);
            font-weight: 700;
            text-decoration: none;
        }

        .auth-footer-link a:hover { color: var(--celeste); }

        /* BACK */
        .auth-back {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            font-weight: 600;
            color: var(--texto-sec);
            text-decoration: none;
            margin-bottom: 20px;
            transition: color .2s;
        }

        .auth-back:hover { color: var(--azul); }

        /* ANIMATION */
        @keyframes fadeSlideRight {
            from { opacity: 0; transform: translateX(-18px); }
            to   { opacity: 1; transform: translateX(0); }
        }

        .auth-panel-right > * {
            animation: fadeSlideRight .4s ease both;
        }

        @for ($i = 1; $i <= 6; $i++)
        .auth-panel-right > *:nth-child({{ $i }}) { animation-delay: {{ $i * 0.05 }}s; }
        @endfor

        /* RESPONSIVE */
        @media (max-width: 960px) {
            .auth-panel-left { display: none; }
            .auth-panel-right { width: 100%; }
            .auth-panel-right::before { display: none; }
        }

        @media (max-width: 480px) {
            .auth-panel-right { padding: 32px 20px; }
            .auth-row { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<div class="auth-wrapper">

    <!-- ════════ PANEL DERECHO (formulario, order:1) ════════ -->
    <div class="auth-panel-right">

        <a href="{{ url('/') }}" class="auth-back">
            <i class="fas fa-arrow-left"></i> Volver al sitio
        </a>

        <div class="auth-logo-wrap">
            <img src="{{ asset('images/logo-esipec.png') }}" alt="ESIPEC">
        </div>

        <div>
            <h2 class="auth-form-title">Crea tu cuenta</h2>
            <p class="auth-form-sub">Regístrate y accede a todos nuestros programas</p>
        </div>

        @if($errors->any())
        <div style="background:#fff1f2; border:1.5px solid #fecdd3; border-radius:10px; padding:11px 14px; margin-bottom:14px;">
            <div style="color:var(--rojo); font-size:12.5px; font-weight:700; display:flex; align-items:center; gap:7px;">
                <i class="fas fa-circle-exclamation"></i>
                Revisa los campos marcados en rojo
            </div>
        </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- NOMBRES + APELLIDOS --}}
            <div class="auth-row">
                <div class="auth-field">
                    <label class="auth-label" for="name">Nombres <span>*</span></label>
                    <div class="auth-input-wrap">
                        <input id="name" type="text" name="name"
                               class="auth-input {{ $errors->has('name') ? 'is-invalid' : '' }}"
                               value="{{ old('name') }}"
                               placeholder="Juan Carlos"
                               required autofocus>
                        <i class="fas fa-user auth-input-icon"></i>
                    </div>
                    @error('name')
                        <div class="auth-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</div>
                    @enderror
                </div>
                <div class="auth-field">
                    <label class="auth-label" for="lastname">Apellidos <span>*</span></label>
                    <div class="auth-input-wrap">
                        <input id="lastname" type="text" name="lastname"
                               class="auth-input {{ $errors->has('lastname') ? 'is-invalid' : '' }}"
                               value="{{ old('lastname') }}"
                               placeholder="Rodríguez P."
                               required>
                        <i class="fas fa-user auth-input-icon"></i>
                    </div>
                    @error('lastname')
                        <div class="auth-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- DNI --}}
            <div class="auth-field">
                <label class="auth-label" for="dni">DNI <span>*</span></label>
                <div class="auth-input-wrap">
                    <input id="dni" type="text" name="dni"
                           class="auth-input {{ $errors->has('dni') ? 'is-invalid' : '' }}"
                           value="{{ old('dni') }}"
                           placeholder="12345678"
                           maxlength="8"
                           required>
                    <i class="fas fa-id-card auth-input-icon"></i>
                </div>
                @error('dni')
                    <div class="auth-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</div>
                @enderror
            </div>

            {{-- EMAIL --}}
            <div class="auth-field">
                <label class="auth-label" for="email">Correo electrónico <span>*</span></label>
                <div class="auth-input-wrap">
                    <input id="email" type="email" name="email"
                           class="auth-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                           value="{{ old('email') }}"
                           placeholder="nombre@ejemplo.com"
                           required>
                    <i class="fas fa-envelope auth-input-icon"></i>
                </div>
                @error('email')
                    <div class="auth-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</div>
                @enderror
            </div>

            {{-- WHATSAPP --}}
            <div class="auth-field">
                <label class="auth-label" for="whatsapp">WhatsApp <span>*</span></label>
                <div class="auth-input-wrap">
                    <input id="whatsapp" type="text" name="whatsapp"
                           class="auth-input {{ $errors->has('whatsapp') ? 'is-invalid' : '' }}"
                           value="{{ old('whatsapp') }}"
                           placeholder="+51 999 999 999"
                           required>
                    <i class="fab fa-whatsapp auth-input-icon" style="color:#b0bec5;"></i>
                </div>
                @error('whatsapp')
                    <div class="auth-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</div>
                @enderror
            </div>

            {{-- TÉRMINOS --}}
            <label class="auth-terms">
                <input type="checkbox" name="terms" required>
                <span>Acepto los <a href="#">Términos y Condiciones</a> y la <a href="#">Política de Privacidad</a> de ESIPEC</span>
            </label>

            {{-- SUBMIT --}}
            <button type="submit" class="auth-btn">
                <i class="fas fa-user-plus"></i>
                Crear mi cuenta
            </button>
        </form>

        <div class="auth-footer-link">
            ¿Ya tienes cuenta?
            <a href="{{ route('login') }}">Ingresar aquí</a>
        </div>

    </div>

    <!-- ════════ PANEL IZQUIERDO (imagen, order:2) ════════ -->
    <div class="auth-panel-left">
        <div class="auth-left-content">
            <div class="auth-left-pill">
                <i class="fas fa-star"></i>
                Únete a ESIPEC
            </div>

            <h2 class="auth-left-title">
                Invierte en<br>
                tu <em>futuro</em><br>
                profesional
            </h2>

            <p class="auth-left-subtitle">
                Miles de profesionales ya certificados. Aprende con docentes de alto nivel y obtén tu certificado avalado.
            </p>

            <ul class="auth-benefits">
                <li>
                    <span class="benefit-icon"><i class="fas fa-check"></i></span>
                    Acceso inmediato a todos los cursos
                </li>
                <li>
                    <span class="benefit-icon"><i class="fas fa-certificate"></i></span>
                    Certificados con validez y reconocimiento
                </li>
                <li>
                    <span class="benefit-icon"><i class="fas fa-video"></i></span>
                    Clases grabadas para ver cuando quieras
                </li>
                <li>
                    <span class="benefit-icon"><i class="fas fa-headset"></i></span>
                    Soporte personalizado vía WhatsApp
                </li>
            </ul>
        </div>
    </div>

</div>

</body>
</html>