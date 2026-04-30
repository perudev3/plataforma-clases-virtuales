@extends('layouts.app')

@section('content')
<div class="container py-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-0">✏️ Editar tema</h3>
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
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card shadow rounded-4">
        <div class="card-body p-4">

            <form method="POST"
                  action="{{ route('syllabus.update', [$course, $syllabus]) }}"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="row g-4">

                    <!-- TITULO -->
                    <div class="col-md-8">
                        <label class="form-label">Título</label>
                        <input type="text" name="title"
                               class="form-control"
                               value="{{ $syllabus->title }}" required>
                    </div>

                    <!-- ORDEN -->
                    <div class="col-md-4">
                        <label class="form-label">Orden</label>
                        <input type="number" name="order"
                               class="form-control"
                               value="{{ $syllabus->order }}">
                    </div>

                    <!-- DESCRIPCION -->
                    <div class="col-md-12">
                        <label class="form-label">Descripción</label>
                        <textarea name="description"
                                  class="form-control">{{ $syllabus->description }}</textarea>
                    </div>

                    <!-- DURACION -->
                    <div class="col-md-4">
                        <label class="form-label">Duración</label>
                        <input type="text" name="duration"
                               class="form-control"
                               value="{{ $syllabus->duration }}">
                    </div>

                    <!-- TIPO -->
                    <div class="col-md-4">
                        <label class="form-label">Tipo</label>
                        <select name="type" id="type" class="form-select">
                            <option value="video" {{ $syllabus->type == 'video' ? 'selected' : '' }}>🎥 Video</option>
                            <option value="zoom" {{ $syllabus->type == 'zoom' ? 'selected' : '' }}>💻 Zoom</option>
                            <option value="pdf" {{ $syllabus->type == 'pdf' ? 'selected' : '' }}>📄 PDF</option>
                        </select>
                    </div>

                    <!-- PREVIEW -->
                    <div class="col-md-4 d-flex align-items-end">
                        <input type="checkbox" name="is_preview" value="1"
                               {{ $syllabus->is_preview ? 'checked' : '' }}>
                        <label class="ms-2">Vista previa</label>
                    </div>

                    <!-- VIDEO -->
                    <div class="col-md-6" id="video-field">
                        <label>Link YouTube</label>
                        <input type="text" name="video_url"
                               class="form-control"
                               value="{{ $syllabus->video_url }}">
                    </div>

                    <!-- ZOOM -->
                    <div class="col-md-6" id="zoom-field">
                        <label>Link Zoom</label>
                        <input type="text" name="zoom_link"
                               class="form-control"
                               value="{{ $syllabus->zoom_link }}">
                    </div>

                    <!-- PDF -->
                    <div class="col-md-6">
                        <label>Subir nuevo PDF</label>
                        <input type="file" name="pdf" class="form-control">
                        
                        @if($syllabus->pdf)
                            <small class="text-muted">
                                📄 Ya existe un PDF subido
                            </small>
                        @endif
                    </div>

                </div>

                <hr>

                <div class="text-end">
                    <button class="btn btn-success">
                        Actualizar
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection