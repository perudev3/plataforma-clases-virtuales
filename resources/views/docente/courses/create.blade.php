@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-3">Crear nuevo curso</h4>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('courses.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label>Título del curso</label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Descripción</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label>Tipo de curso</label>
                    <select name="is_paid" class="form-control" id="is_paid">
                        <option value="0">Gratis</option>
                        <option value="1">De pago</option>
                    </select>
                </div>

                <div class="form-group" id="price-group" style="display:none;">
                    <label>Precio</label>
                    <input type="number" step="0.01" name="price" class="form-control">
                </div>

                <div class="form-group">
                    <label>Tipo de programa</label>
                    <select name="programa" class="form-control" required>
                        <option value="">-- Seleccionar --</option>
                        <option value="diplomado">Diplomado</option>
                        <option value="especializacion">Especialización</option>
                        <option value="curso">Curso</option>
                        <option value="seminario">Seminario</option>
                    </select>
                </div>                

                <div class="form-group">
                    <label>Imagen de portada</label>
                    <input type="file" name="image" class="form-control" accept="image/*" required>
                </div>

                <button class="btn btn-primary">Guardar curso</button>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('is_paid').addEventListener('change', function () {
    document.getElementById('price-group').style.display =
        this.value == 1 ? 'block' : 'none';
});
</script>
@endsection
