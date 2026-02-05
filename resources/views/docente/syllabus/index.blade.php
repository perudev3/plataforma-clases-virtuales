@extends('layouts.app')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Sílabo – {{ $course->title }}</h3>

        <button class="btn btn-primary" data-toggle="modal" data-target="#addSyllabusModal">
            + Agregar tema
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- CONTENEDOR CON SCROLL --}}
    <div class="card">
        <div class="card-body p-0">

            <div style="max-height: 420px; overflow-y: auto;">
                @forelse($syllabus as $item)
                    <div class="border-bottom p-3">

                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="mb-1">{{ $item->title }}</h6>
                                <small class="text-muted">{{ $item->description }}</small><br>

                                @if($item->type === 'video')
                                    <span class="badge badge-info mt-1">🎥 Video</span>
                                @else
                                    <span class="badge badge-success mt-1">🔗 Zoom</span>
                                @endif
                            </div>

                            <div>
                                @if($item->type === 'video')
                                    <a href="{{ $item->video_url }}" target="_blank"
                                       class="btn btn-sm btn-outline-secondary">
                                        Ver video
                                    </a>
                                @else
                                    <a href="{{ $item->zoom_link }}" target="_blank"
                                       class="btn btn-sm btn-outline-success">
                                        Entrar a Zoom
                                    </a>
                                @endif
                            </div>
                        </div>

                    </div>
                @empty
                    <p class="text-muted text-center p-4">
                        Este curso aún no tiene contenido.
                    </p>
                @endforelse
            </div>

        </div>
    </div>

</div>

{{-- MODAL CREAR TEMA --}}
<div class="modal fade" id="addSyllabusModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form method="POST" action="{{ route('syllabus.store', $course) }}" enctype="multipart/form-data">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Agregar tema</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        &times;
                    </button>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label>Título del tema</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Descripción</label>
                        <textarea name="description" class="form-control" rows="2"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Tipo de contenido</label>
                        <select name="type" id="type" class="form-control" required>
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
                    </div>

                    <div class="form-group d-none" id="zoom-field">
                        <label>Link de Zoom</label>
                        <input type="url"
                            name="zoom_link"
                            class="form-control"
                            placeholder="https://zoom.us/..."
                        >
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Cancelar
                    </button>
                    <button class="btn btn-success">
                        Guardar tema
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

{{-- SCRIPT --}}
<script>
document.addEventListener('change', function (e) {

    if (!e.target.matches('#type')) return;

    const videoField = document.getElementById('video-field');
    const zoomField  = document.getElementById('zoom-field');

    // Reset total
    videoField.classList.add('d-none');
    zoomField.classList.add('d-none');

    // Mostrar según selección
    if (e.target.value === 'video') {
        videoField.classList.remove('d-none');
    } 
    else if (e.target.value === 'zoom') {
        zoomField.classList.remove('d-none');
    }

});
</script>

@endsection
