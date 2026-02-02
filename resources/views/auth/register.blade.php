@extends('layouts.app')

@section('content')
<style>
    body {
        background: #F4F6F8;
    }
    .auth-card {
        border: none;
        border-top: 4px solid #0B2C4D;
        border-radius: 8px;
    }
    .auth-title {
        color: #0B2C4D;
        font-weight: 700;
    }
    .btn-esipec {
        background: #00B4E6;
        border: none;
        color: #fff;
        font-weight: 600;
    }
    .btn-esipec:hover {
        background: #1FA2FF;
    }
    .auth-link {
        color: #0B2C4D;
        font-weight: 600;
    }
    .auth-logo {
        max-height: 60px;
    }
</style>

<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="col-md-6">
            <div class="text-center mb-4">
                <img src="{{ asset('images/logo-esipec.png') }}" class="auth-logo" alt="ESIPEC">
            </div>

            <div class="card auth-card shadow-sm">
                <div class="card-body p-4">
                    <h5 class="text-center auth-title mb-4">
                        Registro de Alumno
                    </h5>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        {{-- Nombres --}}
                        <div class="form-group">
                            <label for="name">Nombres</label>
                            <input id="name" type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   name="name"
                                   value="{{ old('name') }}"
                                   required autofocus>

                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Apellidos --}}
                        <div class="form-group">
                            <label for="lastname">Apellidos</label>
                            <input id="lastname" type="text"
                                   class="form-control @error('lastname') is-invalid @enderror"
                                   name="lastname"
                                   value="{{ old('lastname') }}"
                                   required>

                            @error('lastname')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Correo --}}
                        <div class="form-group">
                            <label for="email">Correo electrónico</label>
                            <input id="email" type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   name="email"
                                   value="{{ old('email') }}"
                                   required>

                            @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- WhatsApp --}}
                        <div class="form-group">
                            <label for="whatsapp">Número de WhatsApp</label>
                            <input id="whatsapp" type="text"
                                   class="form-control @error('whatsapp') is-invalid @enderror"
                                   name="whatsapp"
                                   value="{{ old('whatsapp') }}"
                                   placeholder="+51 999 999 999"
                                   required>

                            @error('whatsapp')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Botón --}}
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-esipec btn-block">
                                Registrarme
                            </button>
                        </div>

                        <div class="text-center mt-3">
                            <small>
                                ¿Ya estás registrado?
                                <a href="{{ route('login') }}" class="auth-link">
                                    Ingresar
                                </a>
                            </small>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
