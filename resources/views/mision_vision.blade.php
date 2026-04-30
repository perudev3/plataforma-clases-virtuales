@extends('layouts.landing')

@section('content')
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
@endsection