<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ESIPEC – Formación Continua</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            color: #2E2E2E;
        }

        /* Paleta */
        :root {
            --azul-base: #0B2C4D;
            --azul-degradado: linear-gradient(90deg, #0B2C4D, #1FA2FF);
            --celeste: #00B4E6;
            --dorado: #C9A24D;
            --gris-claro: #F4F6F8;
        }

        /* Header */
        .top-bar {
            background: var(--azul-base);
            color: #fff;
            font-size: 14px;
            padding: 6px 0;
        }

        .top-bar a {
            color: #fff;
            margin-left: 15px;
        }

        .navbar {
            background: #fff;
        }

        .navbar-nav .nav-link {
            color: var(--azul-base);
            font-weight: 600;
        }

        /* Hero */
        .hero {
            background: var(--azul-degradado);
            color: #fff;
            padding: 80px 0;
        }

        .hero h1 {
            font-weight: 700;
        }

        .search-box input {
            border-radius: 30px;
            padding: 15px 25px;
        }

        .search-box button {
            border-radius: 30px;
            background: var(--celeste);
            border: none;
        }

        .hero {
            background: linear-gradient(120deg, #0b2c4d, #061821);
            color: #fff;
            padding: 100px 0;
        }

        .hero-title {
            font-size: 42px;
            font-weight: 700;
        }

        .hero-subtitle {
            font-size: 18px;
            color: #d1d5db;
        }

        .hero-question {
            font-size: 18px;
            font-weight: 600;
            color: #e5e7eb;
        }

        .search-hero {
            display: flex;
            align-items: center;
            background: #050b12;
            border: 2px solid #00e0b8;
            border-radius: 14px;
            padding: 6px 10px;
        }

        .search-hero input {
            flex: 1;
            background: transparent;
            border: none;
            outline: none;
            color: #fff;
            padding: 14px 12px;
            font-size: 16px;
        }

        .search-hero input::placeholder {
            color: #9ca3af;
        }

        .search-hero button {
            background: transparent;
            border: none;
            color: #00e0b8;
            font-size: 20px;
            padding: 0 12px;
            cursor: pointer;
        }

        .search-hero button:hover {
            color: #5fffe0;
        }

        .hero-extra {
            font-size: 14px;
            color: #d1d5db;
        }
       /* HERO alineado a la izquierda pegado a la esquina */
        .hero.hero-bg {
            text-align: left; /* contenido a la izquierda */
            background: url("{{ asset('images/banner.png') }}") center / cover no-repeat;
            position: relative;
            color: #fff;
            padding: 100px 30px; /* top/bottom y padding mínimo horizontal */
        }

        /* Overlay degradado diagonal de oscuro a claro */
        .hero-bg::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(
                135deg, /* diagonal top-left a bottom-right */
                rgba(6, 24, 33, 0.95),  /* más oscuro arriba izquierda */
                rgba(11, 44, 77, 0.3)   /* más claro abajo derecha */
            );
            z-index: 1;
        }

        /* Contenido encima del overlay */
        .hero-bg .container {
            position: relative;
            z-index: 2;
            max-width: 900px;
            margin-left: 0; /* pegado a la izquierda */
            padding-left: 0;
        }

        /* Títulos y textos */
        .hero-title {
            font-size: 42px;
            font-weight: 700;
            color: #fff;
        }

        .hero-subtitle,
        .hero-question,
        .hero-extra {
            color: #f1f5f9;
        }

        /* Buscador alineado a la izquierda */
        .search-hero {
            justify-content: flex-start;
            max-width: 100%;
            margin-left: 0;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 1200px) {
            .hero-title {
                font-size: 38px;
            }
        }

        @media (max-width: 992px) {
            .hero-title {
                font-size: 34px;
            }
            .hero-subtitle {
                font-size: 16px;
            }
        }

        @media (max-width: 768px) {
            .hero {
                padding: 80px 20px; /* más estrecho en móviles */
            }
            .hero-title {
                font-size: 28px;
            }
            .hero-subtitle,
            .hero-question,
            .hero-extra {
                font-size: 14px;
            }
            .search-hero input {
                font-size: 14px;
                padding: 12px 10px;
            }
        }

        @media (max-width: 576px) {
            .hero-title {
                font-size: 24px;
            }
            .hero-subtitle,
            .hero-question,
            .hero-extra {
                font-size: 13px;
            }
            .search-hero input {
                font-size: 13px;
            }
        }

        /* Sections */
        .section {
            padding: 70px 0;
        }

        .section-title {
            font-weight: 700;
            color: var(--azul-base);
            margin-bottom: 40px;
        }

        .card-custom {
            border: none;
            box-shadow: 0 4px 12px rgba(0,0,0,.08);
            border-radius: 10px;
        }

        /* Why */
        .why-icon {
            font-size: 30px;
            color: var(--celeste);
        }

        /* Footer */
        footer {
            background: var(--azul-base);
            color: #fff;
            padding: 50px 0;
        }

        footer a {
            color: #fff;
            display: block;
            margin-bottom: 8px;
        }
        .btn-login {
            border: 1.5px solid #fff;
            border-radius: 20px;
            padding: 4px 14px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: #fff;
            color: var(--azul-base);
            text-decoration: none;
        }

        .dropdown-menu {
            border-radius: 10px;
            border: none;
            box-shadow: 0 8px 20px rgba(0,0,0,.12);
        }

        .dropdown-item {
            font-weight: 500;
        }

        .dropdown-item:hover {
            background: var(--gris-claro);
            color: var(--azul-base);
        }

        .program-card {
            background: #fff;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 6px 20px rgba(0,0,0,.08);
            transition: transform .3s ease, box-shadow .3s ease;
            height: 100%;
        }

        .program-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 30px rgba(0,0,0,.12);
        }

        .program-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .program-body {
            padding: 20px;
        }

        .program-type {
            display: inline-block;
            font-size: 13px;
            font-weight: 600;
            color: var(--celeste);
            margin-bottom: 10px;
        }

        .program-body h5 {
            font-weight: 700;
            color: var(--azul-base);
            margin-bottom: 8px;
        }

        .program-body p {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 4px;
        }

        .program-meta {
            font-size: 13px;
            color: #374151;
            margin: 12px 0;
        }

        .program-actions {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }
        .why-esipec {
            background: #f8fafc;
        }

        .why-title {
            font-size: 34px;
            font-weight: 700;
            margin-bottom: 35px;
            color: #1f2937;
        }

        .why-title span {
            color: #007bff; /* rosado como la imagen */
        }

        .why-list {
            display: flex;
            flex-direction: column;
            gap: 22px;
        }

        .why-item {
            display: flex;
            gap: 18px;
        }

        .why-icon {
            width: 42px;
            height: 42px;
            flex-shrink: 0;
        }

        .why-icon svg {
            width: 100%;
            height: 100%;
            fill: none;
            stroke: #111827;
            stroke-width: 1.6;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .why-item h5 {
            font-size: 15px;
            font-weight: 700;
            margin-bottom: 4px;
            color: #111827;
        }

        .why-item p {
            font-size: 14px;
            color: #6b7280;
            margin: 0;
        }

        .why-image {
            max-width: 100%;
            height: auto;
        }
        /* ===== RESPONSIVE ===== */

        @media (max-width: 992px) {
            .why-title {
                font-size: 30px;
            }

            .why-image {
                max-width: 90%;
                margin-top: 30px;
            }
        }

        @media (max-width: 768px) {
            .why-esipec .row {
                flex-direction: column-reverse;
            }

            .why-title {
                text-align: center;
                font-size: 28px;
            }

            .why-list {
                align-items: center;
            }

            .why-item {
                max-width: 420px;
            }

            .why-image {
                max-width: 80%;
                margin: 0 auto 30px;
            }
        }

        @media (max-width: 576px) {
            .why-title {
                font-size: 24px;
            }

            .why-item {
                gap: 14px;
            }

            .why-icon {
                width: 36px;
                height: 36px;
            }

            .why-item h5 {
                font-size: 14px;
            }

            .why-item p {
                font-size: 13px;
            }
        }

        .docentes {
            background: #ffffff;
        }

        .docente-card {
            text-align: center;
            transition: transform .3s ease;
        }

        .docente-card:hover {
            transform: translateY(-6px);
        }

        .docente-photo {
            width: 180px;
            height: 180px;
            margin: 0 auto 15px;
            border-radius: 50%;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0,0,0,.12);
        }

        .docente-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .docente-card h5 {
            font-size: 16px;
            font-weight: 700;
            color: #1f2937;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .docente-photo {
                width: 150px;
                height: 150px;
            }
        }

        @media (max-width: 576px) {
            .docente-photo {
                width: 130px;
                height: 130px;
            }
        }

        .benefits-section {
            padding: 60px 20px;
            max-width: 1100px;
            margin: auto;
        }

        .section-title {
            text-align: center;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 40px;
        }

        .benefits-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 24px;
        }

        .benefits-pro {
            background: #f9fafb;
            padding: 80px 0;
        }

        .benefit-card {
            background: #ffffff;
            border-radius: 14px;
            padding: 30px 25px;
            height: 100%;
            display: flex;
            align-items: center;
            gap: 18px;
            box-shadow: 0 8px 30px rgba(0,0,0,.06);
            transition: all .3s ease;
        }

        .benefit-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 14px 40px rgba(0,0,0,.10);
        }

        .benefit-icon {
            min-width: 52px;
            height: 52px;
            border-radius: 50%;
            background: #0d6efd15; /* azul suave */
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: #0d6efd;
        }

        .benefit-card p {
            margin: 0;
            font-size: 15px;
            line-height: 1.6;
            font-weight: 500;
            color: #374151;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .benefit-card {
                padding: 22px;
            }
        }


        .benefit-item {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            background: #ffffff;
            padding: 18px 20px;
            border-radius: 14px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.06);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .benefit-item:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }

        .benefit-icon {
            font-size: 1.8rem;
            line-height: 1;
        }

        .benefit-item p {
            margin: 0;
            font-size: 1rem;
            line-height: 1.5;
        }

        /* Mobile ajustes */
        @media (max-width: 480px) {
            .section-title {
                font-size: 1.6rem;
            }

            .benefit-item {
                padding: 16px;
            }
        }

        .benefits-img {
            width: 100%;
            max-width: 480px;
            border-radius: 16px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.12);
        }
        
        .testimonial-card {
            background: #fff;
            border-radius: 16px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 12px 30px rgba(0,0,0,0.08);
            height: 100%;
        }

        .testimonial-avatar {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            object-fit: cover;
        }

        .testimonial-text {
            font-size: 15px;
            color: #555;
            margin: 15px 0;
        }

        .testimonial-stars {
            color: #f1c40f;
            font-size: 18px;
        }

        .footer-logo {
            max-width: 180px;
        }

        .footer-social a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255,255,255,0.08);
            color: #fff;
            margin-right: 8px;
            transition: all 0.3s ease;
            font-size: 16px;
        }

        .footer-social a:hover {
            background: #ffffff;
            color: #0d1b2a;
        }

        .header-fixed {
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar {
            background: #fff;
            box-shadow: 0 4px 12px rgba(0,0,0,0.06);
        }


    </style>
</head>
<body>


<div class="header-fixed">
    <!-- TOP BAR -->
    <div class="top-bar">
        <div class="container d-flex justify-content-end">
            <div class="d-flex align-items-center">
                <span>
                    Editorial | Revista Jurídica | ✔ Verificar Certificado
                </span>

                @auth
                    <a href="{{ url('/home') }}" class="ml-3">Campus Virtual</a>
                @else
                    <a href="{{ route('login') }}" class="ml-3 btn-login">Ingresar</a>
                @endauth
            </div>
        </div>
    </div>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('images/logo-esipec.png') }}" height="50" alt="ESIPEC">
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav ml-auto">

                    <!-- INSTITUCIONAL -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="institucional" data-toggle="dropdown">
                            INSTITUCIONAL
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ url('nosotros') }}">Historia</a>
                            <a class="dropdown-item" href="#">Misión / Visión</a>
                            <a class="dropdown-item" href="#">Consejo Directivo</a>
                            <a class="dropdown-item" href="#">Plana Docente</a>
                            <a class="dropdown-item" href="#">Convenios / Acreditaciones</a>
                            <a class="dropdown-item" href="#">Responsabilidad Social</a>
                        </div>
                    </li>

                    <!-- PROGRAMAS -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="programas" data-toggle="dropdown">
                            PROGRAMAS
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Diplomados</a>
                            <a class="dropdown-item" href="#">Programas de Especialización</a>
                            <a class="dropdown-item" href="#">Cursos</a>
                            <a class="dropdown-item" href="#">Seminarios</a>
                        </div>
                    </li>

                    <!-- ESCUELAS -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="escuelas" data-toggle="dropdown">
                            ESCUELAS
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Derecho</a>
                            <a class="dropdown-item" href="#">Educación</a>
                            <a class="dropdown-item" href="#">Ingeniería</a>
                            <a class="dropdown-item" href="#">Salud</a>
                            <a class="dropdown-item" href="#">Administración</a>
                            <a class="dropdown-item" href="#">Turismo</a>
                        </div>
                    </li>

                    <!-- EMPRESAS -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="empresas" data-toggle="dropdown">
                            EMPRESAS
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Capacitación corporativa</a>
                            <a class="dropdown-item" href="#">Programas a medida</a>
                            <a class="dropdown-item" href="#">Certificación para equipos</a>
                        </div>
                    </li>

                    <!-- ACTUALIDAD -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="actualidad" data-toggle="dropdown">
                            ACTUALIDAD
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="https://lpderecho.pe/category/noticias/" target="_blank">
                                Noticias
                            </a>
                            <a class="dropdown-item" href="#">Enlaces de interés</a>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
</div>

<!-- ================== SECCIÓN MISIÓN, VISIÓN Y VALORES ================== -->
<section class="section benefits-pro" id="mision-vision-valores">
    <div class="container">
        <!-- Título sección -->
        <h2 class="section-title text-center mb-5">Misión, Visión y Valores</h2>

        <div class="row g-4">
            <!-- Misión -->
            <div class="col-md-6">
                <div class="benefit-card text-start p-4 h-100">
                    <div class="d-flex align-items-center mb-3">
                        <div class="benefit-icon bg-primary text-white me-3">
                            <i class="fas fa-bullseye"></i>
                        </div>
                        <h4 class="mb-0">Misión</h4>
                    </div>
                    <p class="mb-0">Brindar educación continua y formación especializada de calidad, orientada a la actualización permanente y al fortalecimiento de las competencias profesionales, mediante programas académicos diseñados con rigor, enfoque práctico y alineados a las necesidades del ejercicio profesional.</p>
                </div>
            </div>

            <!-- Visión -->
            <div class="col-md-6">
                <div class="benefit-card text-start p-4 h-100">
                    <div class="d-flex align-items-center mb-3">
                        <div class="benefit-icon bg-primary text-white me-3">
                            <i class="fas fa-eye"></i>
                        </div>
                        <h4 class="mb-0">Visión</h4>
                    </div>
                    <p class="mb-0">Ser una institución referente en educación continua y formación especializada, reconocida por la calidad de sus programas, su propuesta académica innovadora y su contribución al desarrollo profesional y social.</p>
                </div>
            </div>
        </div>

        <!-- Valores -->
        <div class="row mt-5"> <!-- Separación con margin-top -->
            <div class="col-12">
                <div class="benefit-card text-start p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="benefit-icon bg-primary text-white me-3">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h4 class="mb-0">Valores</h4>
                    </div>
                    <ul class="mb-0 ps-3">
                        <li><i class="fas fa-check-circle text-primary me-2"></i> Excelencia académica, en el diseño y desarrollo de nuestros programas.</li>
                        <li><i class="fas fa-check-circle text-primary me-2"></i> Compromiso, con la formación y el crecimiento profesional de nuestros participantes.</li>
                        <li><i class="fas fa-check-circle text-primary me-2"></i> Ética, en el ejercicio académico e institucional.</li>
                        <li><i class="fas fa-check-circle text-primary me-2"></i> Responsabilidad social, como parte de nuestro aporte a la sociedad.</li>
                        <li><i class="fas fa-check-circle text-primary me-2"></i> Innovación, en el uso de herramientas y metodologías educativas.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="footer">
    <div class="container">
        <div class="row">

            <!-- COLUMNA 1 -->
            <div class="col-md-4 mb-4 mb-md-0">
                <img 
                    src="{{ asset('images/logo-esipec.png') }}" 
                    alt="ESIPEC"
                    class="footer-logo mb-3"
                >

                <p><strong>📍 ESIPEC</strong></p>
                <p>Av. Paseo de la República n.° 3691 Of. 1001, San Isidro</p>
                <p>📱 Celular: 950 536 397</p>
                <p>💬 WhatsApp: 999 887 545</p>
                <p>✉️ contacto@esipec.edu.pe</p>

                <!-- REDES -->
                <div class="footer-social mt-3">
                    <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" aria-label="X"><i class="fab fa-x-twitter"></i></a>
                    <a href="#" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
                    <span class="social-user">@esipecoficial</span>
                </div>
            </div>

            <!-- COLUMNA 2 -->
            <div class="col-md-4 mb-4 mb-md-0">
                <h5>📚 Enlaces rápidos</h5>
                <ul class="footer-links">
                    <li><a href="#">Programas</a></li>
                    <li><a href="#">Educación continua</a></li>
                    <li><a href="#">Campus virtual</a></li>
                    <li><a href="#">Biblioteca virtual</a></li>
                </ul>
            </div>

            <!-- COLUMNA 3 -->
            <div class="col-md-4">
                <h5>⚖️ Legal</h5>
                <ul class="footer-links">
                    <li><a href="#">Términos y Condiciones</a></li>
                    <li><a href="#">Política de Privacidad</a></li>
                    <li><a href="#">Política de Cookies</a></li>
                    <li><a href="#">Libro de Reclamaciones</a></li>
                </ul>
            </div>

        </div>
    </div>
</footer>



<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
