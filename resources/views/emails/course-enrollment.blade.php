<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Inscripción Exitosa — ESIPEC</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body, html {
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
            background-color: #EEF2F7;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }
        img { border: 0; outline: none; text-decoration: none; display: block; }
        table { border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; }

        .email-wrapper {
            width: 100%;
            background-color: #EEF2F7;
            padding: 40px 16px 60px;
        }

        .email-container {
            max-width: 580px;
            margin: 0 auto;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(11, 44, 77, 0.15);
        }

        /* ══ HEADER ══ */
        .email-header {
            background: linear-gradient(135deg, #061828 0%, #0B2C4D 55%, #0d3d6b 100%);
            padding: 44px 40px 0;
            text-align: center;
            position: relative;
        }

        .email-header::before {
            content: '';
            display: block;
            height: 4px;
            background: linear-gradient(90deg, #C9A24D, #00B4E6, #C9A24D);
            position: absolute;
            top: 0; left: 0; right: 0;
        }

        .header-logo-wrap {
            display: inline-block;
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 12px;
            padding: 12px 26px;
            margin-bottom: 28px;
        }

        .header-logo-wrap img {
            height: 38px;
            width: auto;
            margin: 0 auto;
            filter: brightness(0) invert(1);
        }

        .logo-text-fallback {
            font-size: 24px;
            font-weight: 900;
            color: #fff;
            letter-spacing: 3px;
        }
        .logo-text-fallback span { color: #00B4E6; }

        /* Círculo check animado */
        .success-circle {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: linear-gradient(135deg, #00B4E6, #0076a8);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 0 0 10px rgba(0,180,230,0.12), 0 0 0 20px rgba(0,180,230,0.06);
        }

        .success-icon {
            font-size: 32px;
            line-height: 1;
            display: inline-block;
            width: 72px;
            height: 72px;
            background: linear-gradient(135deg, #00B4E6, #0076a8);
            border-radius: 50%;
            text-align: center;
            line-height: 72px;
            margin: 0 auto 20px;
            box-shadow: 0 0 0 10px rgba(0,180,230,0.12), 0 0 0 22px rgba(0,180,230,0.06);
        }

        .header-badge {
            display: inline-block;
            background: rgba(201,162,77,0.18);
            border: 1px solid rgba(201,162,77,0.4);
            color: #C9A24D;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 5px 16px;
            border-radius: 30px;
            margin-bottom: 16px;
        }

        .header-title {
            font-size: 26px;
            font-weight: 800;
            color: #ffffff;
            line-height: 1.3;
            margin-bottom: 8px;
            letter-spacing: -0.3px;
        }

        .header-sub {
            font-size: 14px;
            color: rgba(255,255,255,0.55);
            margin-bottom: 36px;
        }

        /* Ola SVG */
        .header-wave {
            background: linear-gradient(135deg, #061828 0%, #0B2C4D 55%, #0d3d6b 100%);
            line-height: 0;
        }
        .header-wave svg { display: block; width: 100%; }

        /* ══ CUERPO ══ */
        .email-body {
            background: #ffffff;
            padding: 38px 44px 36px;
        }

        .greeting {
            font-size: 19px;
            font-weight: 700;
            color: #0B2C4D;
            margin-bottom: 12px;
        }

        .greeting-name { color: #00B4E6; }

        .body-text {
            font-size: 15px;
            line-height: 1.8;
            color: #4a5568;
            margin-bottom: 24px;
        }

        /* ── Tarjeta del curso ── */
        .course-card {
            border: 1.5px solid #dde8f5;
            border-radius: 14px;
            overflow: hidden;
            margin: 6px 0 28px;
            box-shadow: 0 4px 18px rgba(11,44,77,0.08);
        }

        .course-card-header {
            background: linear-gradient(105deg, #0B2C4D, #1a4a80);
            padding: 16px 22px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .course-card-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: rgba(0,180,230,0.2);
            border: 1px solid rgba(0,180,230,0.35);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
            text-align: center;
            line-height: 38px;
        }

        .course-card-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.5);
            margin-bottom: 3px;
        }

        .course-card-title {
            font-size: 16px;
            font-weight: 800;
            color: #ffffff;
            line-height: 1.3;
        }

        .course-card-body {
            background: #f7fafd;
            padding: 18px 22px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .status-dot {
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: #22c55e;
            box-shadow: 0 0 0 3px rgba(34,197,94,0.2);
            flex-shrink: 0;
        }

        .status-text {
            font-size: 13px;
            font-weight: 600;
            color: #166534;
        }

        /* ── Separador dorado ── */
        .divider-gold {
            height: 2px;
            background: linear-gradient(90deg, #C9A24D, rgba(201,162,77,0));
            border: none;
            margin: 4px 0 26px;
            border-radius: 2px;
        }

        /* ── Pasos ── */
        .steps-title {
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #0B2C4D;
            margin-bottom: 16px;
        }

        .step-item {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            margin-bottom: 14px;
        }

        .step-item:last-child { margin-bottom: 0; }

        .step-num {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: linear-gradient(135deg, #0B2C4D, #1a4a80);
            color: #fff;
            font-size: 12px;
            font-weight: 800;
            text-align: center;
            line-height: 26px;
            flex-shrink: 0;
        }

        .step-text {
            font-size: 14px;
            color: #374151;
            line-height: 1.55;
            padding-top: 3px;
        }

        .step-text strong { color: #0B2C4D; }

        /* ── CTA ── */
        .cta-wrap {
            text-align: center;
            margin: 30px 0 6px;
        }

        .cta-btn {
            display: inline-block;
            background: linear-gradient(135deg, #00B4E6, #0076a8);
            color: #ffffff !important;
            text-decoration: none;
            font-size: 15px;
            font-weight: 700;
            letter-spacing: 0.3px;
            padding: 16px 46px;
            border-radius: 50px;
            box-shadow: 0 8px 24px rgba(0,180,230,0.4);
        }

        .cta-note {
            text-align: center;
            font-size: 12px;
            color: #94a3b8;
            margin-top: 10px;
        }

        /* ══ FOOTER ══ */
        .email-footer {
            background: #0B2C4D;
            padding: 28px 40px;
            text-align: center;
        }

        .footer-brand {
            font-size: 12px;
            font-weight: 700;
            color: rgba(255,255,255,0.4);
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        .footer-line {
            height: 1px;
            background: rgba(255,255,255,0.08);
            margin: 14px 0;
        }

        .footer-text {
            font-size: 12px;
            color: rgba(255,255,255,0.3);
            line-height: 1.7;
        }

        .footer-celeste { color: #00B4E6; font-weight: 600; }

        /* ── Responsive ── */
        @media only screen and (max-width: 600px) {
            .email-body   { padding: 28px 22px 26px; }
            .email-header { padding: 34px 22px 0; }
            .email-footer { padding: 22px 20px; }
            .header-title { font-size: 21px; }
            .cta-btn      { padding: 14px 32px; font-size: 14px; }
            .course-card-header { padding: 14px 16px; }
            .course-card-body   { padding: 14px 16px; }
        }
    </style>
</head>
<body>

<div class="email-wrapper">
<div class="email-container">

    {{-- ══ HEADER ══ --}}
    <div class="email-header">

        <div class="header-logo-wrap">
            <img src="https://esipec.edu.pe/Laravel/public/images/logo-esipec.png"
                 alt="ESIPEC"
                 height="38"
                 onerror="this.style.display='none';document.getElementById('logo-fallback').style.display='block';">
            <div id="logo-fallback" class="logo-text-fallback" style="display:none;">
                ESI<span>PEC</span>
            </div>
        </div>

        {{-- Ícono de éxito --}}
        <div class="success-icon">✅</div>

        <div class="header-badge">✦ Inscripción Exitosa</div>

        <div class="header-title">¡Ya eres parte del curso!</div>
        <div class="header-sub">Tu acceso ha sido activado correctamente</div>

    </div>

    {{-- Ola de transición --}}
    <div class="header-wave">
        <svg viewBox="0 0 580 40" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0,30 C180,0 400,50 580,10 L580,0 L0,0 Z" fill="#ffffff"/>
        </svg>
    </div>

    {{-- ══ CUERPO ══ --}}
    <div class="email-body">

        <p class="greeting">
            Hola, <span class="greeting-name">{{ $user->name }}</span> 🎉
        </p>

        <p class="body-text">
            Tu inscripción fue procesada exitosamente. Ya tienes acceso completo
            al curso y puedes comenzar a estudiar cuando quieras.
        </p>

        {{-- Tarjeta del curso --}}
        <div class="course-card">
            <div class="course-card-header">
                <div class="course-card-icon">📖</div>
                <div>
                    <div class="course-card-label">Curso inscrito</div>
                    <div class="course-card-title">{{ $course->title }}</div>
                </div>
            </div>
            <div class="course-card-body">
                <div class="status-dot"></div>
                <div class="status-text">Acceso activo — Puedes empezar ahora</div>
            </div>
        </div>

        <hr class="divider-gold">

        {{-- Pasos --}}
        <div class="steps-title">¿Cómo empezar?</div>

        <div class="step-item">
            <div class="step-num">1</div>
            <div class="step-text">
                <strong>Ingresa a la plataforma</strong> con tu correo y contraseña registrados.
            </div>
        </div>

        <div class="step-item">
            <div class="step-num">2</div>
            <div class="step-text">
                Dirígete a <strong>Mis Cursos</strong> en el menú principal.
            </div>
        </div>

        <div class="step-item">
            <div class="step-num">3</div>
            <div class="step-text">
                Selecciona <strong>{{ $course->title }}</strong> y comienza tu aprendizaje.
            </div>
        </div>

        {{-- CTA --}}
        <div class="cta-wrap">
            <a href="https://esipec.edu.pe/" class="cta-btn">
                Ir a Mis Cursos →
            </a>
        </div>
        <p class="cta-note">Acceso disponible las 24 horas, desde cualquier dispositivo.</p>

    </div>

    {{-- ══ FOOTER ══ --}}
    <div class="email-footer">
        <div class="footer-brand">ESIPEC &mdash; Campus Virtual</div>
        <div class="footer-line"></div>
        <div class="footer-text">
            Saludos cordiales,<br>
            <span class="footer-celeste">Equipo ESIPEC</span>
        </div>
        <div class="footer-line"></div>
        <div class="footer-text">
            Este correo fue enviado a <strong style="color:rgba(255,255,255,0.45);">{{ $user->email ?? '' }}</strong><br>
            &copy; {{ date('Y') }} ESIPEC. Todos los derechos reservados.
        </div>
    </div>

</div>
</div>

</body>
</html>