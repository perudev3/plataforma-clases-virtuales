@extends('layouts.app')

@section('content')
<div class="container">

    <h3 class="mb-4">Nuevo tema – {{ $course->title }}</h3>

    <form method="POST" action="{{ route('docente.syllabus.store', $course) }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>Título del tema</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Descripción</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label>Tipo de contenido</label>
            <select name="type" id="type" class="form-control">
                 <option value="">-- Selecciona --</option>
                <option value="video">Video</option>
                <option value="zoom">Zoom</option>
            </select>
        </div>

        <div class="form-group d-none" id="video-field">
            <label>Subir video</label>
            <input type="file"
                name="video_file"
                class="form-control"
                accept="video/*">
            <small class="text-muted">
                Formatos permitidos: MP4, MOV, WEBM
            </small>
        </div>


        <div class="form-group d-none" id="zoom-field">
            <label>Link de Zoom</label>
            <input type="text" name="zoom_link" class="form-control">
        </div>

        <button class="btn btn-success">Guardar tema</button>
        <a href="{{ route('docente.syllabus.index', $course) }}"
           class="btn btn-secondary">
            Volver
        </a>

    </form>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const typeSelect = document.getElementById('type')
    const videoField = document.getElementById('video-field')
    const zoomField  = document.getElementById('zoom-field')

    typeSelect.addEventListener('change', function () {

        // Reset
        videoField.classList.add('d-none')
        zoomField.classList.add('d-none')

        if (this.value === 'video') {
            videoField.classList.remove('d-none')
        }

        if (this.value === 'zoom') {
            zoomField.classList.remove('d-none')
        }
    })

})
</script>

@endsection
