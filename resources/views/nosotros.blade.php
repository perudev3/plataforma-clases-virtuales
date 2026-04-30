
@extends('layouts.landing')

@section('content')

<section class="section benefits-pro" id="nosotros">
    <div class="container">
        <!-- Título sección -->
        <h2 class="section-title text-center">Nosotros</h2>

        <!-- BLOQUE 1: Qué es ESIPEC -->
        <div class="row align-items-center mb-5">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="{{ asset('images/nosotros1.jpg') }}" alt="Qué es ESIPEC" class="benefits-img">
            </div>
            <div class="col-lg-6">
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="fas fa-school"></i>
                    </div>
                    <div>
                        <h5>¿Qué es ESIPEC?</h5>
                        <p>ESIPEC Formación Continua es una institución dedicada a la educación continua y la formación especializada, orientada a la actualización permanente de profesionales que buscan fortalecer sus competencias y mantenerse vigentes en un entorno académico y laboral en constante cambio.</p>
                        <p>Nuestra propuesta académica se centra en el desarrollo de programas formativos con enfoque práctico, contenido actualizado y rigor académico, dirigidos a profesionales del sector público y privado, así como a estudiantes que buscan complementar su formación.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- BLOQUE 2: Historia -->
        <div class="row align-items-center flex-lg-row-reverse mb-5">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="{{ asset('images/nosotros2.jpg') }}" alt="Historia ESIPEC" class="benefits-img">
            </div>
            <div class="col-lg-6">
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="fas fa-history"></i>
                    </div>
                    <div>
                        <h5>¿Cuándo comenzó y por qué?</h5>
                        <p>ESIPEC Formación Continua nace a inicios del año 2014, como respuesta a la necesidad de contar con espacios de capacitación accesibles, especializados y alineados a las exigencias reales del ejercicio profesional.</p>
                        <p>Desde su creación, la institución surge con el propósito de acercar el conocimiento académico a la práctica profesional, promoviendo una formación continua que permita a los participantes adaptarse a los cambios normativos, tecnológicos y sociales de su entorno.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- BLOQUE 3: Qué ofrece y para quién -->
        <div class="row mb-5">
            <div class="col-12 text-center mb-4">
                <h5>¿Qué ofrece y para quién?</h5>
            </div>
            <div class="col-lg-6">
                <div class="benefit-item flex-column align-items-start">
                    <div class="benefit-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div>
                        <p>ESIPEC ofrece diplomados, programas de especialización, cursos y seminarios en diversas áreas:</p>
                        <ul>
                            <li><i class="fas fa-gavel text-primary"></i> Derecho</li>
                            <li><i class="fas fa-book-open text-primary"></i> Educación</li>
                            <li><i class="fas fa-chart-line text-primary"></i> Administración</li>
                            <li><i class="fas fa-cogs text-primary"></i> Ingeniería</li>
                            <li><i class="fas fa-heartbeat text-primary"></i> Salud</li>
                            <li><i class="fas fa-plane text-primary"></i> Turismo</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="benefit-item flex-column align-items-start">
                    <div class="benefit-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div>
                        <p>Nuestros programas están dirigidos a profesionales, egresados, estudiantes de últimos ciclos y servidores públicos, que buscan fortalecer su perfil profesional mediante una formación flexible, actualizada y orientada a resultados.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- BLOQUE 4: Diferenciales -->
        <div class="row mb-5">
            <div class="col-12 text-center mb-4">
                <h5>Diferenciales</h5>
            </div>

            <div class="col-md-4 mb-3">
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="fas fa-qrcode"></i>
                    </div>
                    <div>
                        <p>Certificación digital con código QR, verificable en línea.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="fas fa-globe"></i>
                    </div>
                    <div>
                        <p>Modalidad virtual, con acceso a clases en vivo y grabadas.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div>
                        <p>Acceso práctico e inmediato a los contenidos académicos desde cualquier dispositivo.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <div>
                        <p>Docentes con experiencia profesional, que integran la teoría con la práctica.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <div>
                        <p>Material académico complementario, diseñado para reforzar el aprendizaje.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection