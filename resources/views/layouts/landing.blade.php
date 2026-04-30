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
                    border: 1.5px solid #00c3efad;
                    background: #00c3efad;
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

                /* =========================================================
        HERO CAROUSEL - BOOTSTRAP 4 COMPATIBLE
        ========================================================= */

        .hero-carousel {
            position: relative;
            width: 100%;
            overflow: hidden;
        }

        /* SLIDE BASE */
        .hero-slide {
            position: relative;
            min-height: 85vh;
            width: 100%;
            display: flex;
            align-items: center;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-color: #0a1929;
        }

        .hero-carousel .carousel-item {
            backface-visibility: hidden;
            -webkit-backface-visibility: hidden;
        }

        /* OVERLAY OSCURO PARA LEGIBILIDAD DEL TEXTO */
        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(
                90deg,
                rgba(10, 25, 41, 0.85) 0%,
                rgba(10, 25, 41, 0.60) 40%,
                rgba(10, 25, 41, 0.30) 70%,
                transparent 100%
            );
            z-index: 1;
        }

        /* CONTENIDO DEL SLIDE */
        .hero-content {
            position: relative;
            z-index: 2;
            padding-left: 50px;
            padding-right: 50px;
        }

        /* TÍTULO */
        .hero-carousel .hero-title {
            font-size: 3.2rem;
            font-weight: 800;
            color: #ffffff;
            line-height: 1.25;
            margin-bottom: 1.2rem;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.6);
            max-width: 650px;
        }

        /* SUBTÍTULO */
        .hero-carousel .hero-subtitle {
            font-size: 1.25rem;
            color: rgba(255, 255, 255, 0.95);
            line-height: 1.7;
            margin-bottom: 2rem;
            max-width: 550px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
        }

        /* BUSCADOR */
        .search-hero-wrapper {
            display: flex;
            max-width: 520px;
            background: rgba(255, 255, 255, 0.98);
            border-radius: 50px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            margin-bottom: 1.5rem;
        }

        .search-hero-input {
            flex: 1;
            border: none;
            padding: 16px 26px;
            font-size: 1rem;
            outline: none;
            background: transparent;
            color: #2E2E2E;
        }

        .search-hero-input::placeholder {
            color: rgba(46, 46, 46, 0.5);
        }

        .search-hero-btn {
            background: linear-gradient(135deg, #00B4E6, #0B2C4D);
            border: none;
            padding: 0 30px;
            font-size: 1.2rem;
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .search-hero-btn:hover {
            background: linear-gradient(135deg, #0B2C4D, #1FA2FF);
        }

        /* BOTÓN ROJO (VER PROGRAMAS) */
        .btn-hero-red {
            background: linear-gradient(135deg, #c41e3a, #8b1428);
            color: white;
            padding: 15px 42px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.05rem;
            border: 2px solid rgba(255, 255, 255, 0.2);
            text-decoration: none;
            display: inline-block;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
            transition: all 0.3s ease;
        }

        .btn-hero-red:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(196, 30, 58, 0.6);
            color: white;
            text-decoration: none;
        }

        /* BOTÓN VERDE (CÓMO FUNCIONA) */
        .btn-hero-green {
            background: linear-gradient(135deg, #0f766e, #14b8a6);
            color: white;
            padding: 15px 42px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.05rem;
            border: 2px solid rgba(255, 255, 255, 0.2);
            text-decoration: none;
            display: inline-block;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
            transition: all 0.3s ease;
        }

        .btn-hero-green:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(15, 118, 110, 0.6);
            color: white;
            text-decoration: none;
        }

        /* BOTÓN BLANCO (VERIFICAR CERTIFICADO) */
        .btn-hero-white {
            background: rgba(255, 255, 255, 0.95);
            color: #0a1929;
            padding: 15px 42px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.05rem;
            border: 2px solid rgba(255, 255, 255, 0.3);
            text-decoration: none;
            display: inline-block;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }

        .btn-hero-white:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.4);
            background: white;
            color: #0a1929;
            text-decoration: none;
        }

        /* =========================================================
        CONTROLES DEL CAROUSEL (BOOTSTRAP 4)
        ========================================================= */

        .hero-carousel .carousel-control-prev,
        .hero-carousel .carousel-control-next {
            width: 8%;
            opacity: 0.9;
            z-index: 10;
        }

        .hero-carousel .carousel-control-prev:hover,
        .hero-carousel .carousel-control-next:hover {
            opacity: 1;
        }

        .hero-carousel .carousel-control-prev-icon,
        .hero-carousel .carousel-control-next-icon {
            background-color: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border-radius: 50%;
            width: 60px;
            height: 60px;
            background-size: 50%;
            border: 2px solid rgba(255, 255, 255, 0.7);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }

        /* =========================================================
        INDICADORES (BOOTSTRAP 4)
        ========================================================= */

        .hero-carousel .carousel-indicators {
            bottom: 30px;
            z-index: 3;
        }

        .hero-carousel .carousel-indicators li {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.4);
            border: 2px solid rgba(255, 255, 255, 0.8);
            margin: 0 6px;
            transition: all 0.3s ease;
            opacity: 1;
        }

        .hero-carousel .carousel-indicators li:hover {
            background-color: rgba(255, 255, 255, 0.6);
            transform: scale(1.2);
        }

        .hero-carousel .carousel-indicators li.active {
            background-color: white;
            border-color: white;
            width: 30px;
            border-radius: 6px;
        }

        /* =========================================================
        RESPONSIVE
        ========================================================= */

        /* Tablets grandes */
        @media (max-width: 1200px) {
            .hero-slide {
                min-height: 75vh;
            }
            
            .hero-content {
                padding-left: 40px;
                padding-right: 40px;
            }
            
            .hero-carousel .hero-title {
                font-size: 2.8rem;
            }
        }

        /* Tablets */
        @media (max-width: 991px) {
            .hero-slide {
                min-height: 70vh;
            }
            
            .hero-carousel .hero-title {
                font-size: 2.4rem;
            }
            
            .hero-overlay {
                background: linear-gradient(
                    90deg,
                    rgba(10, 25, 41, 0.90) 0%,
                    rgba(10, 25, 41, 0.70) 50%,
                    rgba(10, 25, 41, 0.50) 100%
                );
            }
            
            .hero-carousel .carousel-control-prev-icon,
            .hero-carousel .carousel-control-next-icon {
                width: 50px;
                height: 50px;
            }
        }

        /* Móviles grandes */
        @media (max-width: 767px) {
            .hero-slide {
                min-height: 65vh;
                padding: 40px 0;
            }
            
            .hero-overlay {
                background: rgba(10, 25, 41, 0.80);
            }
            
            .hero-content {
                padding-left: 25px;
                padding-right: 25px;
            }
            
            .hero-carousel .hero-title {
                font-size: 2rem;
            }
            
            .hero-carousel .hero-subtitle {
                font-size: 1.1rem;
            }
            
            .search-hero-wrapper {
                max-width: 100%;
            }
            
            .search-hero-input {
                padding: 14px 20px;
                font-size: 0.95rem;
            }
            
            .search-hero-btn {
                padding: 0 24px;
                font-size: 1.1rem;
            }
            
            .hero-carousel .carousel-control-prev,
            .hero-carousel .carousel-control-next {
                width: 12%;
            }
            
            .hero-carousel .carousel-indicators {
                bottom: 20px;
            }
        }

        /* Móviles pequeños */
        @media (max-width: 576px) {
            .hero-slide {
                min-height: 60vh;
            }
            
            .hero-content {
                padding-left: 20px;
                padding-right: 20px;
            }
            
            .hero-carousel .hero-title {
                font-size: 1.6rem;
            }
            
            .hero-carousel .hero-subtitle {
                font-size: 1rem;
            }
            
            .btn-hero-red,
            .btn-hero-green,
            .btn-hero-white {
                padding: 14px 32px;
                font-size: 0.95rem;
                width: 100%;
                text-align: center;
            }
            
            .hero-carousel .carousel-control-prev-icon,
            .hero-carousel .carousel-control-next-icon {
                width: 40px;
                height: 40px;
                background-size: 45%;
            }
            
            .hero-carousel .carousel-indicators li {
                width: 8px;
                height: 8px;
                margin: 0 4px;
            }
            
            .hero-carousel .carousel-indicators li.active {
                width: 24px;
            }
        }

        /* Móviles muy pequeños */
        @media (max-width: 400px) {
            .hero-slide {
                min-height: 55vh;
            }
            
            .hero-carousel .hero-title {
                font-size: 1.4rem;
            }
            
            .search-hero-input {
                padding: 12px 16px;
            }
            
            .search-hero-btn {
                padding: 0 20px;
            }
        }

        /* ============================================================
   COURSE DETAIL PAGE - CSS COMPLETO
   Copia este bloque dentro de @push('styles') en tu blade
   ============================================================ */

/* ── FUENTES ── */
@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&family=Open+Sans:wght@400;500;600&display=swap');

/* ── VARIABLES ── */
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

/* ── RESET BASE ── */
.course-page * { box-sizing: border-box; }

/* ── WRAPPER PRINCIPAL ── */
.course-page {
    font-family: 'Open Sans', sans-serif;
    color: var(--texto);
    background: var(--gris-bg);
}

/* ================================================================
   1. HEADER BANNER
================================================================ */
.header-course {
    position: relative;
    width: 100%;
    min-height: 420px;
    display: flex;
    align-items: center;
    background-size: cover;
    background-position: center top;
    background-repeat: no-repeat;
    overflow: hidden;
}

/* Overlay degradado diagonal */
.header-course::before {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(
        105deg,
        rgba(6, 18, 38, 0.94) 0%,
        rgba(11, 44, 77, 0.82) 45%,
        rgba(11, 44, 77, 0.30) 75%,
        transparent 100%
    );
    z-index: 1;
}

.header-course .container {
    position: relative;
    z-index: 2;
    padding-top: 50px;
    padding-bottom: 50px;
}

/* Etiqueta tipo badge encima del título */
.course-badge {
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

/* Título principal */
.header-course h1 {
    font-family: 'Montserrat', sans-serif;
    font-size: clamp(1.8rem, 4vw, 2.9rem);
    font-weight: 800;
    color: #fff;
    line-height: 1.2;
    margin-bottom: 18px;
    text-shadow: 0 3px 18px rgba(0,0,0,.5);
    max-width: 640px;
}

/* Meta info (fecha, semanas, modalidad) */
.course-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 10px 22px;
    margin-bottom: 22px;
}

.course-meta-item {
    display: flex;
    align-items: center;
    gap: 7px;
    font-size: 14px;
    color: rgba(255,255,255,0.92);
    font-weight: 500;
}

.course-meta-item i {
    font-size: 16px;
    color: var(--celeste);
}

.course-meta-sep {
    color: rgba(255,255,255,0.3);
    font-size: 18px;
    line-height: 1;
}

/* Fila de botones del header */
.header-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 10px;
}

/* Botón "Ver Temario" (blanco outline) */
.btn-temario {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    background: rgba(255,255,255,0.08);
    border: 1.5px solid rgba(255,255,255,0.55);
    color: #fff;
    font-family: 'Montserrat', sans-serif;
    font-size: 13.5px;
    font-weight: 600;
    padding: 10px 22px;
    border-radius: 8px;
    text-decoration: none;
    backdrop-filter: blur(6px);
    transition: all .25s ease;
}
.btn-temario:hover {
    background: rgba(255,255,255,0.18);
    color: #fff;
    text-decoration: none;
}

/* Botón WhatsApp */
.btn-whatsapp {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: var(--verde);
    border: none;
    color: #fff;
    font-family: 'Montserrat', sans-serif;
    font-size: 13.5px;
    font-weight: 700;
    padding: 10px 22px;
    border-radius: 8px;
    text-decoration: none;
    transition: all .25s ease;
    box-shadow: 0 4px 14px rgba(46,125,50,.4);
}
.btn-whatsapp:hover {
    background: var(--verde-hover);
    color: #fff;
    text-decoration: none;
    transform: translateY(-2px);
}

/* Botón Inscríbete (rojo) */
.btn-inscribete {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: var(--rojo);
    border: none;
    color: #fff;
    font-family: 'Montserrat', sans-serif;
    font-size: 13.5px;
    font-weight: 700;
    padding: 10px 22px;
    border-radius: 8px;
    text-decoration: none;
    transition: all .25s ease;
    box-shadow: 0 4px 14px rgba(198,40,40,.4);
    cursor: pointer;
}
.btn-inscribete:hover, .btn-inscribete:focus {
    background: var(--rojo-hover);
    color: #fff;
    text-decoration: none;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(198,40,40,.5);
}

/* Precio bajo el botón inscribirse */
.btn-inscribete small {
    display: block;
    font-size: 11px;
    font-weight: 400;
    opacity: .85;
    margin-top: 1px;
}

/* ================================================================
   2. BARRA DE STATS (3 columnas)
================================================================ */
.course-stats-bar {
    background: var(--blanco);
    border-bottom: 1px solid var(--gris-borde);
    padding: 0;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
}

.stat-item {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 20px 28px;
    border-right: 1px solid var(--gris-borde);
    transition: background .2s;
}

.stat-item:last-child { border-right: none; }

.stat-item:hover { background: var(--gris-bg); }

.stat-icon-wrap {
    width: 46px;
    height: 46px;
    border-radius: 50%;
    background: rgba(0,180,230,.10);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.stat-icon-wrap i {
    font-size: 20px;
    color: var(--azul);
}

.stat-label {
    font-size: 11px;
    color: var(--texto-sec);
    text-transform: uppercase;
    letter-spacing: .8px;
    margin-bottom: 2px;
    font-weight: 600;
}

.stat-value {
    font-family: 'Montserrat', sans-serif;
    font-size: 15px;
    font-weight: 700;
    color: var(--texto);
    line-height: 1.2;
}

/* ================================================================
   3. CUERPO PRINCIPAL (2 columnas)
================================================================ */
.course-body {
    padding: 48px 0 60px;
}

/* ── COLUMNA IZQUIERDA (contenido principal) ── */
.course-main { /* col-md-8 */ }

/* Sección genérica */
.course-section {
    background: var(--blanco);
    border-radius: var(--radio);
    box-shadow: var(--sombra);
    padding: 32px 36px;
    margin-bottom: 28px;
}

.course-section-title {
    font-family: 'Montserrat', sans-serif;
    font-size: 1.25rem;
    font-weight: 800;
    color: var(--azul);
    margin-bottom: 18px;
    padding-bottom: 12px;
    border-bottom: 2px solid var(--gris-borde);
    display: flex;
    align-items: center;
    gap: 10px;
}

.course-section-title::before {
    content: "";
    display: inline-block;
    width: 4px;
    height: 22px;
    background: var(--celeste);
    border-radius: 3px;
    flex-shrink: 0;
}

.course-description {
    font-size: 15px;
    line-height: 1.8;
    color: #374151;
}

/* ── SIDEBAR (columna derecha) ── */
.course-sidebar { /* col-md-4 */ }

.sidebar-card {
    background: var(--blanco);
    border-radius: var(--radio);
    box-shadow: var(--sombra);
    overflow: hidden;
    margin-bottom: 24px;
}

.sidebar-card-img {
    width: 100%;
    height: auto;
    display: block;
}

.sidebar-card-body {
    padding: 22px 24px;
}

.sidebar-cert-list {
    list-style: none;
    padding: 0;
    margin: 14px 0 0;
}

.sidebar-cert-list li {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    font-size: 13.5px;
    color: #374151;
    padding: 6px 0;
    border-bottom: 1px solid var(--gris-borde);
    line-height: 1.4;
}
.sidebar-cert-list li:last-child { border-bottom: none; }

.sidebar-cert-list li::before {
    content: "✅";
    flex-shrink: 0;
    margin-top: 1px;
}

/* ================================================================
   4. TEMARIO / ACORDEÓN
================================================================ */
.temario-accordion .accordion-item {
    border: 1px solid var(--gris-borde);
    border-radius: 10px !important;
    margin-bottom: 10px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,.04);
}

.temario-accordion .accordion-header { margin: 0; }

.temario-accordion .accordion-button {
    font-family: 'Montserrat', sans-serif;
    font-size: 14.5px;
    font-weight: 700;
    color: var(--azul);
    background: var(--blanco);
    padding: 16px 22px;
    border: none;
    box-shadow: none !important;
    display: flex;
    align-items: center;
    gap: 12px;
}

/* Número de módulo */
.temario-accordion .accordion-button::before {
    content: attr(data-modulo);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 28px;
    height: 28px;
    border-radius: 50%;
    background: var(--azul);
    color: #fff;
    font-size: 12px;
    font-weight: 800;
    flex-shrink: 0;
}

.temario-accordion .accordion-button:not(.collapsed) {
    background: linear-gradient(90deg, #e8f4fd, var(--blanco));
    color: var(--azul);
}

.temario-accordion .accordion-button::after {
    filter: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%230B2C4D' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
    margin-left: auto;
    transition: transform .3s ease;
}

.temario-accordion .accordion-body {
    font-size: 14px;
    line-height: 1.75;
    color: #475569;
    padding: 16px 22px 20px 60px;
    border-top: 1px solid var(--gris-borde);
    background: #fafcff;
}

/* ================================================================
   5. DOCENTES
================================================================ */
.docentes-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
    gap: 22px;
    margin-top: 4px;
}

.docente-card {
    text-align: center;
    padding: 24px 14px 18px;
    background: var(--gris-bg);
    border-radius: var(--radio);
    border: 1px solid var(--gris-borde);
    transition: all .3s ease;
}

.docente-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 28px rgba(11,44,77,.14);
    background: var(--blanco);
}

.docente-photo {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid var(--blanco);
    box-shadow: 0 4px 16px rgba(0,0,0,.15);
    margin: 0 auto 14px;
    display: block;
}

.docente-name {
    font-family: 'Montserrat', sans-serif;
    font-size: 13.5px;
    font-weight: 700;
    color: var(--azul);
    margin-bottom: 4px;
}

.docente-specialty {
    font-size: 12px;
    color: var(--texto-sec);
    line-height: 1.4;
}

/* ================================================================
   6. TESTIMONIOS
================================================================ */
.reviews-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 20px;
    margin-top: 4px;
}

.review-card {
    background: var(--gris-bg);
    border: 1px solid var(--gris-borde);
    border-radius: var(--radio);
    padding: 24px 22px;
    position: relative;
    transition: all .3s ease;
}

.review-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 28px rgba(0,0,0,.08);
    background: var(--blanco);
}

/* Comilla decorativa */
.review-card::before {
    content: "\201C";
    position: absolute;
    top: -4px;
    left: 18px;
    font-size: 72px;
    color: var(--celeste);
    font-family: Georgia, serif;
    opacity: .35;
    line-height: 1;
}

.review-text {
    font-size: 14px;
    color: #475569;
    line-height: 1.7;
    margin-bottom: 14px;
    padding-top: 8px;
    font-style: italic;
}

.review-author {
    font-family: 'Montserrat', sans-serif;
    font-size: 13px;
    font-weight: 700;
    color: var(--azul);
}

.review-stars {
    color: #f59e0b;
    font-size: 14px;
    margin-top: 6px;
    letter-spacing: 2px;
}

/* ================================================================
   7. CTA / BOTÓN INSCRIPCIÓN (en sección de temario y sidebar)
================================================================ */
.cta-inscripcion {
    text-align: center;
    padding: 28px 24px 10px;
}

.btn-cta-primary {
    display: inline-block;
    background: var(--rojo);
    color: #fff;
    font-family: 'Montserrat', sans-serif;
    font-size: 15px;
    font-weight: 700;
    padding: 14px 38px;
    border-radius: 10px;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all .25s ease;
    box-shadow: 0 4px 16px rgba(198,40,40,.35);
    letter-spacing: .3px;
}
.btn-cta-primary:hover, .btn-cta-primary:focus {
    background: var(--rojo-hover);
    color: #fff;
    text-decoration: none;
    transform: translateY(-2px);
    box-shadow: 0 7px 22px rgba(198,40,40,.45);
}

.btn-free-primary {
    display: inline-block;
    background: var(--azul);
    color: #fff;
    font-family: 'Montserrat', sans-serif;
    font-size: 15px;
    font-weight: 700;
    padding: 14px 38px;
    border-radius: 10px;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all .25s ease;
    box-shadow: 0 4px 16px rgba(11,44,77,.3);
}
.btn-free-primary:hover, .btn-free-primary:focus {
    background: var(--azul-med);
    color: #fff;
    text-decoration: none;
    transform: translateY(-2px);
}

/* ================================================================
   8. EMPTY STATES
================================================================ */
.empty-state {
    text-align: center;
    padding: 30px 10px;
    color: var(--texto-sec);
    font-size: 14px;
}

.empty-state i {
    font-size: 36px;
    opacity: .3;
    display: block;
    margin-bottom: 8px;
}

/* ================================================================
   9. RESPONSIVE
================================================================ */
@media (max-width: 991px) {
    .stats-grid { grid-template-columns: 1fr 1fr; }
    .stat-item:nth-child(2) { border-right: none; }
    .stat-item:nth-child(3) { border-top: 1px solid var(--gris-borde); }
    .course-section { padding: 24px 22px; }
}

@media (max-width: 768px) {
    .stats-grid { grid-template-columns: 1fr; }
    .stat-item { border-right: none; border-bottom: 1px solid var(--gris-borde); }
    .stat-item:last-child { border-bottom: none; }
    .header-course h1 { font-size: 1.6rem; }
    .course-body { padding: 28px 0 40px; }
    .course-section { padding: 20px 18px; }
    .temario-accordion .accordion-body { padding-left: 22px; }
    .docentes-grid { grid-template-columns: repeat(2, 1fr); }
    .reviews-grid { grid-template-columns: 1fr; }
}

@media (max-width: 480px) {
    .header-course { min-height: 360px; }
    .header-actions { flex-direction: column; }
    .header-actions a, .header-actions button { width: 100%; justify-content: center; }
    .docentes-grid { grid-template-columns: repeat(2, 1fr); gap: 14px; }
}
    </style>

    @stack('styles')
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
                    <a href="{{ url('/home') }}" class="ml-3 btn-login">Campus Virtual</a>
                @else
                    <a href="{{ route('login') }}" class="ml-3 btn-login">Ingresar</a>
                @endauth
            </div>
        </div>
    </div>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
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
                            <a class="dropdown-item" href="{{ url('mision_vision') }}">Misión / Visión</a>
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
                            <a class="dropdown-item" href="{{ url('diplomados') }}">Diplomados</a>
                            <a class="dropdown-item" href="{{ url('especializaciones') }}">Programas de Especialización</a>
                            <a class="dropdown-item" href="{{ url('cursos') }}">Cursos</a>
                            <a class="dropdown-item" href="{{ url('seminarios') }}">Seminarios</a>
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

        @yield('content')

        @stack('scripts')

<!-- FOOTER -->
<footer class="footer">
    <div class="container">
        <div class="row">

            <!-- COLUMNA 1 -->
            <div class="col-md-4 mb-4 mb-md-0">
                <img 
                    src="{{ asset('images/logo_blanco.png') }}" 
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

<!-- jQuery (requerido para Bootstrap 4) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<!-- Popper.js (requerido para dropdowns) -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Bootstrap 4 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function(){
        console.log('jQuery loaded:', typeof jQuery !== 'undefined');
        console.log('Bootstrap loaded:', typeof $.fn.dropdown !== 'undefined');
        
        // Forzar inicialización de dropdowns
        $('.dropdown-toggle').dropdown();
    });
</script>

</body>
</html>
