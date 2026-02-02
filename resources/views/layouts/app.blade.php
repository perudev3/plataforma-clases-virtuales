<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ESIPEC Campus Virtual') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #F4F6F8;
        }

        .navbar-esipec {
            background-color: #FFFFFF;
            border-bottom: 3px solid #0B2C4D;
        }

        .navbar-brand img {
            max-height: 45px;
        }

        .nav-link {
            color: #0B2C4D !important;
            font-weight: 600;
        }

        .nav-link:hover {
            color: #00B4E6 !important;
        }

        .nav-admin {
            color: #C9A24D !important;
            font-weight: 700;
        }

        .dropdown-menu {
            border-radius: 6px;
            border: none;
            box-shadow: 0 4px 12px rgba(0,0,0,.08);
        }

        main {
            min-height: calc(100vh - 70px);
        }
    </style>
</head>

<body>
<div id="app">

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-md navbar-light navbar-esipec shadow-sm">
        <div class="container">

            {{-- LOGO --}}
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('images/logo-esipec.png') }}" alt="ESIPEC">
            </a>
            @auth
            <button class="navbar-toggler" type="button"
                    data-toggle="collapse"
                    data-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                {{-- LEFT MENU --}}
                <ul class="navbar-nav mr-auto">

                  
                        {{-- ADMIN --}}
                        @if(Auth::user()->role === 'admin')
                            <li class="nav-item">
                                <a class="nav-link nav-admin" href="{{ route('admin.dashboard') }}">
                                    Dashboard
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link nav-admin" href="{{ route('docentes.index') }}">
                                    Docentes
                                </a>
                            </li>
                        @endif

                        {{-- DOCENTE --}}
                        @if(Auth::user()->role === 'teacher')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('docente.dashboard') }}">
                                    Mi Panel
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('docente.courses.index') }}">
                                    Mis Cursos
                                </a>
                            </li>

                        @endif

                    @endauth

                </ul>

                {{-- RIGHT MENU --}}
                <ul class="navbar-nav ml-auto">

                    @guest
                      
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle"
                               href="#"
                               role="button"
                               data-toggle="dropdown">
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item"
                                   href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                                    Cerrar sesión
                                </a>

                                <form id="logout-form"
                                      action="{{ route('logout') }}"
                                      method="POST"
                                      class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest

                </ul>
            </div>
        </div>
    </nav>

    {{-- CONTENIDO --}}
    <main class="py-4">
        @yield('content')
    </main>

</div>
</body>
</html>
