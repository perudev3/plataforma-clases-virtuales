@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-6 mx-auto">
        <div class="card shadow-sm">
            <div class="card-header font-weight-bold">
                Nuevo Docente
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('docentes.store') }}" enctype="multipart/form-data">
                    @csrf

                    <input class="form-control mb-2" name="name" placeholder="Nombres" required>
                    <input class="form-control mb-2" name="lastname" placeholder="Apellidos" required>
                    <input class="form-control mb-2" name="email" placeholder="Correo" required>
                    <input class="form-control mb-3" name="whatsapp" placeholder="WhatsApp" required>

                    <input type="file" class="form-control mb-2" name="photo" accept="image/*">


                    <textarea class="form-control mb-3" name="academic_level" 
                        placeholder="Descripción del nivel académico" rows="3"></textarea>

                    <button class="btn btn-primary btn-block">
                        Guardar Docente
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
