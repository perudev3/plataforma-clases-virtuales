@extends('layouts.app')

@section('content')
<div class="container py-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-0">📑 Nuevo tema / Sílabo</h3>
            <small class="text-muted">
                Curso: <strong>{{ $course->title }}</strong>
            </small>
        </div>

        <a href="{{ route('syllabus.index', $course) }}" class="btn btn-outline-secondary">
            ← Volver
        </a>
    </div>

    <!-- ERRORES -->
    @if ($errors->any())
    <div class="alert alert-danger rounded-3">
        <strong>Se encontraron errores:</strong>
        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- CARD -->
    <div class="card border-0 shadow rounded-4">
        <div class="card-body p-4">

            <form method="POST" action="{{ route('syllabus.store', $course) }}" enctype="multipart/form-data">
                @csrf

                <div class="row g-4">

                    <!-- TITULO -->
                    <div class="col-md-8">
                        <label class="form-label fw-semibold">Título del tema</label>
                        <input
                            type="text"
                            name="title"
                            class="form-control form-control-lg"
                            placeholder="Ej: Introducción al Derecho Penal"
                            required>
                    </div>

                    <!-- ORDEN -->
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Orden</label>
                        <input
                            type="number"
                            name="order"
                            class="form-control form-control-lg"
                            value="1">
                    </div>

                    <!-- DESCRIPCION -->
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Descripción</label>
                        <textarea
                            name="description"
                            rows="4"
                            class="form-control"
                            placeholder="Describe el contenido del tema..."></textarea>
                    </div>

                    <!-- DURACION -->
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Duración</label>
                        <input
                            type="text"
                            name="duration"
                            class="form-control"
                            placeholder="Ej: 1h 30min">
                    </div>

                    <!-- TIPO -->
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Tipo de contenido</label>
                        <select name="type" id="type" class="form-select" required>
                            <option value="">-- Selecciona --</option>
                            <option value="video">🎥 Video</option>
                            <option value="zoom">💻 Zoom</option>
                            <option value="pdf">📄 PDF</option>
                        </select>
                    </div>

                    <!-- PREVIEW -->
                    <div class="col-md-4 d-flex align-items-end">
                        <div class="form-check form-switch">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="is_preview"
                                value="1">
                            <label class="form-check-label">
                                Vista previa gratuita
                            </label>
                        </div>
                    </div>

                    <!-- VIDEO -->
                    <div class="col-md-6 d-none" id="video-field">
                        <label class="form-label fw-semibold">Link de YouTube</label>
                        <input
                            type="url"
                            name="video_url"
                            class="form-control"
                            placeholder="https://www.youtube.com/watch?v=xxxx"
                            disabled>
                    </div>

                    <!-- ZOOM -->
                    <div class="col-md-6 d-none" id="zoom-field">
                        <label class="form-label fw-semibold">Link de Zoom</label>
                        <input
                            type="text"
                            name="zoom_link"
                            class="form-control"
                            placeholder="https://zoom.us/..."
                            disabled>
                    </div>

                    <!-- PDF -->
                    <div class="col-md-6 d-none" id="pdf-field">
                        <label class="form-label fw-semibold">Subir PDF</label>
                        <input
                            type="file"
                            name="pdf"
                            class="form-control"
                            accept="application/pdf"
                            disabled>
                    </div>

                </div>

                <hr class="my-4">

                <!-- ACTIONS -->
                <div class="d-flex justify-content-end gap-2">

                    <a
                        href="{{ route('syllabus.index', $course) }}"
                        class="btn btn-light border px-4">
                        Cancelar
                    </a>

                    <button class="btn btn-success px-4">
                        Guardar tema
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>


<!-- SCRIPT DINAMICO -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    const typeSelect = document.getElementById('type');

    const videoField = document.getElementById('video-field');
    const zoomField = document.getElementById('zoom-field');
    const pdfField = document.getElementById('pdf-field');

    const videoInput = videoField.querySelector('input');
    const zoomInput = zoomField.querySelector('input');
    const pdfInput = pdfField.querySelector('input');

    function resetFields() {
        videoField.classList.add('d-none');
        zoomField.classList.add('d-none');
        pdfField.classList.add('d-none');

        videoInput.disabled = true;
        zoomInput.disabled = true;
        pdfInput.disabled = true;
    }

    typeSelect.addEventListener('change', function () {

        resetFields();

        if (this.value === 'video') {
            videoField.classList.remove('d-none');
            videoInput.disabled = false;
        }

        if (this.value === 'zoom') {
            zoomField.classList.remove('d-none');
            zoomInput.disabled = false;
        }

        if (this.value === 'pdf') {
            pdfField.classList.remove('d-none');
            pdfInput.disabled = false;
        }
    });

});
</script>
@endsection
