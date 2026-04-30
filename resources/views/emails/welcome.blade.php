<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bienvenido a ESIPEC</title>
    <style>
        /* ── Reset email ── */
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

        /* ── Wrapper ── */
        .email-wrapper {
            width: 100%;
            background-color: #EEF2F7;
            padding: 40px 16px 60px;
        }

        /* ── Contenedor principal ── */
        .email-container {
            max-width: 580px;
            margin: 0 auto;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(11, 44, 77, 0.15);
        }

        /* ── HEADER con degradado ── */
        .email-header {
            background: linear-gradient(135deg, #061828 0%, #0B2C4D 50%, #0d3d6b 100%);
            padding: 44px 40px 36px;
            text-align: center;
            position: relative;
        }

        /* Línea decorativa superior */
        .email-header::before {
            content: '';
            display: block;
            height: 4px;
            background: linear-gradient(90deg, #00B4E6, #C9A24D, #00B4E6);
            position: absolute;
            top: 0; left: 0; right: 0;
        }

        .header-logo-wrap {
            display: inline-block;
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 14px;
            padding: 14px 28px;
            margin-bottom: 24px;
            backdrop-filter: blur(4px);
        }

        .header-logo-wrap img {
            height: 42px;
            width: auto;
            margin: 0 auto;
            filter: brightness(0) invert(1);
        }

        /* Fallback si no hay imagen */
        .logo-text-fallback {
            font-size: 26px;
            font-weight: 900;
            color: #fff;
            letter-spacing: 3px;
            font-family: 'Segoe UI', sans-serif;
        }

        .logo-text-fallback span {
            color: #00B4E6;
        }

        .header-badge {
            display: inline-block;
            background: rgba(0,180,230,0.18);
            border: 1px solid rgba(0,180,230,0.35);
            color: #00B4E6;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 5px 16px;
            border-radius: 30px;
            margin-bottom: 18px;
        }

        .header-title {
            font-size: 28px;
            font-weight: 800;
            color: #ffffff;
            line-height: 1.25;
            letter-spacing: -0.3px;
        }

        .header-title span {
            color: #00B4E6;
        }

        /* ── Ola decorativa SVG ── */
        .header-wave {
            background: linear-gradient(135deg, #061828 0%, #0B2C4D 50%, #0d3d6b 100%);
            line-height: 0;
        }
        .header-wave svg {
            display: block;
            width: 100%;
        }

        /* ── CUERPO ── */
        .email-body {
            background: #ffffff;
            padding: 40px 44px 36px;
        }

        .greeting {
            font-size: 20px;
            font-weight: 700;
            color: #0B2C4D;
            margin-bottom: 16px;
            line-height: 1.3;
        }

        .greeting-name {
            color: #00B4E6;
        }

        .body-text {
            font-size: 15px;
            line-height: 1.8;
            color: #4a5568;
            margin-bottom: 14px;
        }

        /* ── Separador dorado ── */
        .divider-gold {
            height: 2px;
            background: linear-gradient(90deg, #C9A24D, rgba(201,162,77,0));
            border: none;
            margin: 28px 0;
            border-radius: 2px;
        }

        /* ── Card de beneficios ── */
        .benefits-card {
            background: #F4F8FC;
            border: 1px solid #dde6f0;
            border-radius: 12px;
            padding: 24px 26px;
            margin: 24px 0 28px;
        }

        .benefits-title {
            font-size: 13px;
            font-weight: 700;
            color: #0B2C4D;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 16px;
        }

        .benefit-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 12px;
        }

        .benefit-item:last-child { margin-bottom: 0; }

        .benefit-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #00B4E6;
            margin-top: 6px;
            flex-shrink: 0;
        }

        .benefit-text {
            font-size: 14px;
            color: #374151;
            line-height: 1.5;
        }

        /* ── CTA Button ── */
        .cta-wrap {
            text-align: center;
            margin: 30px 0 8px;
        }

        .cta-btn {
            display: inline-block;
            background: linear-gradient(135deg, #0B2C4D, #1a4a80);
            color: #ffffff !important;
            text-decoration: none;
            font-size: 15px;
            font-weight: 700;
            letter-spacing: 0.3px;
            padding: 16px 42px;
            border-radius: 50px;
            box-shadow: 0 8px 24px rgba(11,44,77,0.35);
        }

        /* ── FOOTER ── */
        .email-footer {
            background: #0B2C4D;
            padding: 28px 40px;
            text-align: center;
        }

        .footer-brand {
            font-size: 13px;
            font-weight: 700;
            color: rgba(255,255,255,0.5);
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .footer-text {
            font-size: 12px;
            color: rgba(255,255,255,0.3);
            line-height: 1.6;
        }

        .footer-line {
            height: 1px;
            background: rgba(255,255,255,0.08);
            margin: 16px 0;
        }

        .footer-celeste {
            color: #00B4E6;
            font-weight: 600;
        }

        /* ── Responsive ── */
        @media only screen and (max-width: 600px) {
            .email-body    { padding: 30px 24px 28px; }
            .email-header  { padding: 36px 24px 28px; }
            .email-footer  { padding: 24px 20px; }
            .header-title  { font-size: 22px; }
            .cta-btn       { padding: 14px 32px; font-size: 14px; }
            .benefits-card { padding: 18px 18px; }
        }
    </style>
</head>
<body>

<div class="email-wrapper">
<div class="email-container">

    {{-- ══ HEADER ══ --}}
    <div class="email-header">

        {{-- Logo --}}
        <div class="header-logo-wrap">
            {{-- Si tienes URL absoluta del logo usa img, si no el fallback de texto --}}
            <img src="https://esipec.edu.pe/Laravel/public/images/logo-esipec.png"
                 alt="ESIPEC"
                 height="42"
                 onerror="this.style.display='none';document.getElementById('logo-fallback').style.display='block';">
            <div id="logo-fallback" class="logo-text-fallback" style="display:none;">
                ESI<span>PEC</span>
            </div>
        </div>

        <div class="header-badge">✦ Campus Virtual</div>

        <div class="header-title">
            ¡Bienvenido a la<br>
            <span>comunidad ESIPEC!</span>
        </div>

    </div>

    {{-- Ola SVG de transición --}}
    <div class="header-wave">
        <svg viewBox="0 0 580 40" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0,0 C145,40 435,0 580,30 L580,0 Z" fill="#ffffff"/>
        </svg>
    </div>

    {{-- ══ CUERPO ══ --}}
    <div class="email-body">

        <p class="greeting">
            Hola, <span class="greeting-name">{{ $user->name }} {{ $user->lastname }}</span> 👋
        </p>

        <p class="body-text">
            Gracias por registrarte en nuestra plataforma educativa. Es un gusto tenerte como
            parte de nuestra comunidad de aprendizaje.
        </p>

        <hr class="divider-gold">

        <p class="body-text">
            Muy pronto podrás acceder a nuestros cursos y contenidos exclusivos diseñados
            para impulsar tu desarrollo profesional.
        </p>

        {{-- Beneficios --}}
        <div class="benefits-card">
            <div class="benefits-title">¿Qué te espera en ESIPEC?</div>

            <div class="benefit-item">
                <div class="benefit-dot"></div>
                <div class="benefit-text">
                    <strong>Cursos certificados</strong> con validez nacional e internacional.
                </div>
            </div>
            <div class="benefit-item">
                <div class="benefit-dot"></div>
                <div class="benefit-text">
                    <strong>Docentes expertos</strong> con experiencia en el sector.
                </div>
            </div>
            <div class="benefit-item">
                <div class="benefit-dot"></div>
                <div class="benefit-text">
                    <strong>Aprende a tu ritmo</strong> desde cualquier dispositivo.
                </div>
            </div>
            <div class="benefit-item">
                <div class="benefit-dot"></div>
                <div class="benefit-text">
                    <strong>Contenido exclusivo</strong> actualizado constantemente.
                </div>
            </div>
        </div>

        {{-- CTA --}}
        <div class="cta-wrap">
            <a href="https://esipec.edu.pe/" class="cta-btn">
                Ingresar al Campus →
            </a>
        </div>

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
            Este correo fue enviado a <strong style="color:rgba(255,255,255,0.45);">{{ $user->email ?? '' }}</strong>
            porque te registraste en nuestra plataforma.<br>
            &copy; {{ date('Y') }} ESIPEC. Todos los derechos reservados.
        </div>
    </div>

</div>
</div>

</body>
</html>