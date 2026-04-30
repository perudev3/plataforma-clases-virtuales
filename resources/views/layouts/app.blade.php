<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ESIPEC Campus Virtual') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        /* ═══════════════════════════════════════
           VARIABLES
        ═══════════════════════════════════════ */
        :root {
            --azul:        #0B2C4D;
            --azul-med:    #0d3560;
            --azul-light:  #1a4a80;
            --celeste:     #00B4E6;
            --celeste-dk:  #009bc7;
            --dorado:      #C9A24D;
            --dorado-dk:   #a8832c;
            --gris-bg:     #F0F3F7;
            --gris-borde:  #e2e8f0;
            --blanco:      #ffffff;
            --texto:       #1e293b;
            --texto-sec:   #64748b;

            --sidebar-w:   240px;
            --topbar-h:    62px;
        }

        *, *::before, *::after { box-sizing: border-box; }

        html, body {
            width: 100%;
            max-width: 100%;
            overflow-x: hidden;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            background: var(--gris-bg);
            color: var(--texto);
            margin: 0;
            padding: 0;
        }

        /* ═══════════════════════════════════════
           LAYOUT WRAPPER
        ═══════════════════════════════════════ */
        .dash-wrapper {
            display: flex;
            min-height: 100vh;
            width: 100%;
        }

        /* ═══════════════════════════════════════
           SIDEBAR
        ═══════════════════════════════════════ */
        .dash-sidebar {
            width: var(--sidebar-w);
            min-height: 100vh;
            background-image: linear-gradient(180deg, #0d3560 0%, #0B2C4D 60%, #071e34 100%);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 200;
            display: flex;
            flex-direction: column;
            transition: transform .3s ease;
        }

        /* ── Logo area ── */
        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 20px;
            height: var(--topbar-h);
            border-bottom: 1px solid rgba(255,255,255,.08);
            text-decoration: none;
            flex-shrink: 0;
        }
        .sidebar-brand img { height: 34px; width: auto; opacity: .92; }
        .sidebar-brand-text { display: flex; flex-direction: column; line-height: 1.2; }
        .sidebar-brand-name {
            font-family: 'Montserrat', sans-serif;
            font-size: 15px; font-weight: 800;
            color: #fff; letter-spacing: -.2px;
        }
        .sidebar-brand-sub {
            font-size: 10px; font-weight: 600;
            color: var(--celeste);
            letter-spacing: 1.2px; text-transform: uppercase;
        }

        /* ── Nav ── */
        .sidebar-nav { flex: 1; padding: 18px 12px; overflow-y: auto; }

        .sidebar-label {
            font-family: 'Montserrat', sans-serif;
            font-size: 10px; font-weight: 700;
            letter-spacing: 1.4px; text-transform: uppercase;
            color: rgba(255,255,255,.35);
            padding: 0 10px;
            margin: 16px 0 8px;
        }
        .sidebar-label:first-child { margin-top: 0; }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 11px;
            font-family: 'Montserrat', sans-serif;
            font-size: 13px; font-weight: 600;
            color: rgba(255,255,255,.72);
            padding: 10px 12px;
            border-radius: 9px;
            text-decoration: none;
            transition: all .2s ease;
            margin-bottom: 2px;
            position: relative;
        }
        .sidebar-link:hover { background: rgba(255,255,255,.08); color: #fff; text-decoration: none; }
        .sidebar-link.active { background: rgba(0,180,230,.18); color: var(--celeste); }
        .sidebar-link.active::before {
            content: '';
            position: absolute; left: 0; top: 50%; transform: translateY(-50%);
            width: 3px; height: 60%;
            background: var(--celeste);
            border-radius: 0 3px 3px 0;
        }

        .sidebar-link.admin-link { color: rgba(201,162,77,.85); }
        .sidebar-link.admin-link:hover { background: rgba(201,162,77,.12); color: var(--dorado); }
        .sidebar-link.admin-link.active { background: rgba(201,162,77,.15); color: var(--dorado); }
        .sidebar-link.admin-link.active::before { background: var(--dorado); }

        .sidebar-icon { width: 18px; text-align: center; font-size: 14px; flex-shrink: 0; opacity: .85; }

        /* ── Footer sidebar ── */
        .sidebar-footer { border-top: 1px solid rgba(255,255,255,.08); padding: 16px 12px; flex-shrink: 0; }
        .sidebar-user { display: flex; align-items: center; gap: 10px; }
        .sidebar-avatar {
            width: 36px; height: 36px; border-radius: 50%;
            background: linear-gradient(135deg, var(--celeste), var(--azul-light));
            display: flex; align-items: center; justify-content: center;
            font-family: 'Montserrat', sans-serif;
            font-size: 14px; font-weight: 800; color: #fff; flex-shrink: 0;
        }
        .sidebar-user-info { flex: 1; min-width: 0; }
        .sidebar-user-name {
            font-family: 'Montserrat', sans-serif;
            font-size: 12.5px; font-weight: 700; color: #fff;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }
        .sidebar-user-role { font-size: 11px; color: rgba(255,255,255,.45); font-weight: 500; }
        .sidebar-logout {
            display: flex; align-items: center; justify-content: center;
            width: 32px; height: 32px; border-radius: 8px;
            background: rgba(255,255,255,.07);
            color: rgba(255,255,255,.5); text-decoration: none;
            transition: all .2s ease; font-size: 13px; flex-shrink: 0;
        }
        .sidebar-logout:hover { background: rgba(198,40,40,.25); color: #ff6b6b; text-decoration: none; }

        /* ═══════════════════════════════════════
           TOPBAR
        ═══════════════════════════════════════ */
        .dash-topbar {
            position: fixed;
            top: 0;
            left: var(--sidebar-w);
            right: 0;
            height: var(--topbar-h);
            background: var(--blanco);
            border-bottom: 1px solid var(--gris-borde);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            z-index: 100;
            box-shadow: 0 1px 12px rgba(11,44,77,.07);
        }

        .topbar-left { display: flex; align-items: center; gap: 12px; }

        .topbar-toggle {
            display: none;
            background: none;
            border: 1.5px solid var(--gris-borde);
            border-radius: 8px;
            width: 36px; height: 36px;
            align-items: center; justify-content: center;
            cursor: pointer; color: var(--azul); font-size: 16px;
            flex-shrink: 0;
        }

        .topbar-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 15px; font-weight: 700; color: var(--azul);
        }

        .topbar-right { display: flex; align-items: center; gap: 8px; }

        .role-pill {
            display: inline-flex; align-items: center; gap: 5px;
            font-family: 'Montserrat', sans-serif;
            font-size: 11px; font-weight: 700;
            letter-spacing: .4px; text-transform: uppercase;
            padding: 4px 10px; border-radius: 20px;
        }
        .role-pill.admin   { background: rgba(201,162,77,.15); color: var(--dorado-dk); border: 1px solid rgba(201,162,77,.3); }
        .role-pill.teacher { background: rgba(0,180,230,.12);  color: var(--celeste-dk); border: 1px solid rgba(0,180,230,.25); }
        .role-pill.student { background: rgba(11,44,77,.08);   color: var(--azul);       border: 1px solid rgba(11,44,77,.15); }

        .topbar-user {
            display: flex; align-items: center; gap: 8px;
            background: var(--gris-bg);
            border: 1.5px solid var(--gris-borde);
            border-radius: 50px;
            padding: 5px 14px 5px 6px;
            font-family: 'Montserrat', sans-serif;
            font-size: 13px; font-weight: 600; color: var(--azul);
            cursor: pointer; transition: border-color .2s, background .2s;
        }
        .topbar-user:hover { border-color: var(--celeste); background: rgba(0,180,230,.06); }

        .topbar-avatar {
            width: 28px; height: 28px; border-radius: 50%;
            background: linear-gradient(135deg, var(--azul), var(--celeste));
            display: flex; align-items: center; justify-content: center;
            font-size: 11px; font-weight: 800; color: #fff; flex-shrink: 0;
        }

        .dropdown-menu {
            border: none; border-radius: 12px;
            box-shadow: 0 16px 40px rgba(11,44,77,.14);
            padding: 8px; min-width: 180px; margin-top: 8px !important;
        }
        .dropdown-item {
            font-family: 'Montserrat', sans-serif;
            font-size: 13px; font-weight: 600; color: var(--azul);
            border-radius: 8px; padding: 9px 14px; transition: background .15s;
        }
        .dropdown-item:hover { background: var(--gris-bg); color: var(--azul); }

        /* ═══════════════════════════════════════
           CONTENIDO PRINCIPAL
        ═══════════════════════════════════════ */
        .dash-content {
            margin-left: var(--sidebar-w);
            margin-top: var(--topbar-h);
            flex: 1;
            min-width: 0; /* CRÍTICO: evita que flex desborde */
            width: calc(100% - var(--sidebar-w));
        }

        /* El main NO tiene padding propio — cada vista maneja el suyo */
        main {
            min-height: calc(100vh - var(--topbar-h));
            width: 100%;
            overflow-x: hidden;
        }

        /* ═══════════════════════════════════════
           OVERLAY MOBILE
        ═══════════════════════════════════════ */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(11,44,77,.5);
            z-index: 199;
            backdrop-filter: blur(2px);
        }

        /* ═══════════════════════════════════════
           RESPONSIVE
        ═══════════════════════════════════════ */

        /* Tablet y móvil: sidebar oculto por defecto */
        @media (max-width: 991px) {
            .dash-sidebar {
                transform: translateX(-100%);
            }
            .dash-sidebar.open {
                transform: translateX(0);
            }
            .sidebar-overlay.open {
                display: block;
            }
            .dash-topbar {
                left: 0;
            }
            .topbar-toggle {
                display: inline-flex;
            }
            .dash-content {
                margin-left: 0;
                width: 100%;
            }
        }

        /* Móvil pequeño */
        @media (max-width: 575px) {
            .topbar-title  { display: none; }
            .role-pill     { display: none; }
            .dash-topbar   { padding: 0 12px; }
        }
        
        .profile-container {
	    padding: 30px;
	}
	
	.profile-card {
	    display: flex;
	    gap: 30px;
	    background: #fff;
	    border-radius: 14px;
	    padding: 30px;
	    box-shadow: 0 10px 30px rgba(0,0,0,.05);
	}
	
	.profile-left {
	    width: 250px;
	    text-align: center;
	}
	
	.profile-avatar-wrapper {
	    position: relative;
	}
	
	.profile-avatar {
	    width: 140px;
	    height: 140px;
	    border-radius: 50%;
	    object-fit: cover;
	    border: 4px solid #0B2C4D;
	}
	
	.btn-change-photo {
	    margin-top: 10px;
	    background: #00B4E6;
	    border: none;
	    color: white;
	    padding: 6px 12px;
	    border-radius: 8px;
	    cursor: pointer;
	}
	
	.profile-right {
	    flex: 1;
	}
	
	.profile-right h2 {
	    margin-bottom: 20px;
	}
	
	.form-group {
	    margin-bottom: 15px;
	}
	
	.form-group label {
	    font-weight: 600;
	    font-size: 13px;
	    display: block;
	    margin-bottom: 5px;
	}
	
	.form-group input {
	    width: 100%;
	    padding: 10px;
	    border-radius: 8px;
	    border: 1px solid #ddd;
	}
	
	.form-group input:disabled {
	    background: #f5f5f5;
	    cursor: not-allowed;
	}
	
	.btn-save {
	    margin-top: 15px;
	    background: #0B2C4D;
	    color: white;
	    border: none;
	    padding: 10px 20px;
	    border-radius: 10px;
	    cursor: pointer;
	}
	
	.alert-success {
	    background: #d1fae5;
	    padding: 10px;
	    border-radius: 8px;
	    margin-bottom: 15px;
	}
    </style>
</head>

<body>
<div id="app" class="dash-wrapper">

    @auth

    {{-- ═══════════════════════════════════
         SIDEBAR
    ═══════════════════════════════════ --}}
    <aside class="dash-sidebar" id="dashSidebar">

        <a class="sidebar-brand" href="{{ url('/') }}">
            <img src="{{ asset('images/escudo_blanco.png') }}" alt="ESIPEC">
            <div class="sidebar-brand-text">
                <span class="sidebar-brand-name">ESIPEC</span>
                <span class="sidebar-brand-sub">Campus Virtual</span>
            </div>
        </a>

        <nav class="sidebar-nav">

            @if(Auth::user()->role === 'admin')
                <div class="sidebar-label">Administración</div>
                <a class="sidebar-link admin-link" href="{{ route('admin.dashboard') }}">
                    <span class="sidebar-icon">⚙</span> Dashboard
                </a>
                <a class="sidebar-link admin-link" href="{{ route('docentes.index') }}">
                    <span class="sidebar-icon">👨‍🏫</span> Docentes
                </a>
                <a class="sidebar-link admin-link {{ request()->routeIs('admin.students*') ? 'active' : '' }}" href="{{ route('admin.students.index') }}">
                    <span class="sidebar-icon">👥</span> Estudiantes
                </a>
            @endif

            @if(Auth::user()->role === 'teacher')
                <div class="sidebar-label">Menú</div>
                <a class="sidebar-link" href="{{ route('docente.dashboard') }}">
                    <span class="sidebar-icon">🖥</span> Mi Panel
                </a>
                <a class="sidebar-link" href="{{ route('docente.courses.index') }}">
                    <span class="sidebar-icon">📖</span> Mis Cursos
                </a>
            @endif

            @if(Auth::user()->role === 'student')
                <div class="sidebar-label">Menú</div>
                <a class="sidebar-link" href="{{ route('alumno.courses.index') }}">
                    <span class="sidebar-icon">📚</span> Explorar Cursos
                </a>
                <a class="sidebar-link" href="{{ route('alumno.mis-courses') }}">
                    <span class="sidebar-icon">🎓</span> Mis Cursos
                </a>
                <a class="sidebar-link" href="{{ route('alumno.perfil') }}">
		    <span class="sidebar-icon">👤</span> Mi Perfil
		</a>
            @endif

        </nav>

        <div class="sidebar-footer">
            <div class="sidebar-user">
                <div class="sidebar-avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="sidebar-user-info">
                    <div class="sidebar-user-name">{{ Auth::user()->name }}</div>
                    <div class="sidebar-user-role">
                        @if(Auth::user()->role === 'admin') Administrador
                        @elseif(Auth::user()->role === 'teacher') Docente
                        @else Estudiante
                        @endif
                    </div>
                </div>
                <a class="sidebar-logout" href="{{ route('logout') }}" title="Cerrar sesión"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    ⏻
                </a>
            </div>
        </div>

    </aside>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    {{-- ═══════════════════════════════════
         CONTENIDO
    ═══════════════════════════════════ --}}
    <div class="dash-content">

        <header class="dash-topbar">
            <div class="topbar-left">
                <button class="topbar-toggle" id="sidebarToggle">☰</button>
                <span class="topbar-title">
                    {{ config('app.name', 'ESIPEC Campus Virtual') }}
                </span>
            </div>

            <div class="topbar-right">
                @php $rol = Auth::user()->role; @endphp
                <span class="role-pill {{ $rol }}">
                    @if($rol === 'admin') ⚙ Admin
                    @elseif($rol === 'teacher') 🎓 Docente
                    @else 📚 Alumno
                    @endif
                </span>

                <div class="dropdown">
                    <div class="topbar-user dropdown-toggle"
                         data-toggle="dropdown"
                         role="button"
                         aria-haspopup="true"
                         aria-expanded="false">
                        <div class="topbar-avatar">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <span class="d-none d-md-inline">
                            {{ explode(' ', Auth::user()->name)[0] }}
                        </span>
                    </div>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item"
                           href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Cerrar sesión
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>

        <main>
            @yield('content')
        </main>

    </div>

    @else

    {{-- GUEST --}}
    <div style="width:100%;">
        <nav style="
            background: var(--blanco);
            border-bottom: 3px solid var(--azul);
            height: 64px;
            display: flex;
            align-items: center;
            padding: 0 20px;
            box-shadow: 0 2px 12px rgba(11,44,77,.08);
        ">
            <a href="{{ url('/') }}" style="display:flex;align-items:center;gap:10px;text-decoration:none;">
                <img src="{{ asset('images/logo-esipec.png') }}" alt="ESIPEC" style="height:38px;">
                <span style="font-family:'Montserrat',sans-serif;font-weight:800;font-size:16px;color:var(--azul);">ESIPEC</span>
            </a>
        </nav>
        <main>
            @yield('content')
        </main>
    </div>

    @endauth

</div>

<script>
    const toggle  = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('dashSidebar');
    const overlay = document.getElementById('sidebarOverlay');

    if (toggle && sidebar && overlay) {
        toggle.addEventListener('click', () => {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('open');
        });
        overlay.addEventListener('click', () => {
            sidebar.classList.remove('open');
            overlay.classList.remove('open');
        });
    }
</script>

@stack('scripts')
</body>
</html>