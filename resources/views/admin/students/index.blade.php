@extends('layouts.app')

@section('content')
<div style="padding: 28px 30px;">

    {{-- Header --}}
    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; flex-wrap:wrap; gap:12px;">
        <div>
            <h2 style="font-family:'Montserrat',sans-serif; font-size:20px; font-weight:800; color:#0B2C4D; margin:0;">
                👥 Gestión de Estudiantes
            </h2>
            <p style="font-size:13px; color:#64748b; margin:4px 0 0;">
                Administra los alumnos registrados en la plataforma
            </p>
        </div>
    </div>

    {{-- Alerta success --}}
    @if(session('success'))
    <div style="background:#d1fae5; border-left:4px solid #10b981; padding:12px 16px; border-radius:8px; margin-bottom:20px; font-size:13.5px; color:#065f46; font-weight:600;">
        ✓ {{ session('success') }}
    </div>
    @endif

    {{-- Buscador --}}
    <form method="GET" action="{{ route('admin.students.index') }}"
          style="display:flex; gap:10px; margin-bottom:20px; flex-wrap:wrap;">
        <input type="text" name="search" value="{{ $search }}" placeholder="Buscar por nombre, email o DNI..."
            style="flex:1; min-width:220px; padding:10px 14px; border:1.5px solid #e2e8f0; border-radius:10px;
                   font-family:'Open Sans',sans-serif; font-size:13px; color:#1e293b; outline:none;">
        <button type="submit"
            style="background:#0B2C4D; color:#fff; border:none; padding:10px 20px; border-radius:10px;
                   font-family:'Montserrat',sans-serif; font-size:13px; font-weight:700; cursor:pointer;">
            🔍 Buscar
        </button>
        @if($search)
        <a href="{{ route('admin.students.index') }}"
           style="background:#f1f5f9; color:#64748b; padding:10px 16px; border-radius:10px;
                  font-family:'Montserrat',sans-serif; font-size:13px; font-weight:600; text-decoration:none;
                  display:flex; align-items:center;">
            ✕ Limpiar
        </a>
        @endif
    </form>

    {{-- Tabla --}}
    <div style="background:#fff; border-radius:14px; box-shadow:0 4px 20px rgba(11,44,77,.07); overflow:hidden;">
        <table style="width:100%; border-collapse:collapse;">
            <thead>
                <tr style="background:#0B2C4D;">
                    <th style="padding:14px 18px; text-align:left; font-family:'Montserrat',sans-serif; font-size:11px; font-weight:700; color:rgba(255,255,255,.7); letter-spacing:1px; text-transform:uppercase;">#</th>
                    <th style="padding:14px 18px; text-align:left; font-family:'Montserrat',sans-serif; font-size:11px; font-weight:700; color:rgba(255,255,255,.7); letter-spacing:1px; text-transform:uppercase;">Estudiante</th>
                    <th style="padding:14px 18px; text-align:left; font-family:'Montserrat',sans-serif; font-size:11px; font-weight:700; color:rgba(255,255,255,.7); letter-spacing:1px; text-transform:uppercase;">DNI</th>
                    <th style="padding:14px 18px; text-align:left; font-family:'Montserrat',sans-serif; font-size:11px; font-weight:700; color:rgba(255,255,255,.7); letter-spacing:1px; text-transform:uppercase;">WhatsApp</th>
                    <th style="padding:14px 18px; text-align:center; font-family:'Montserrat',sans-serif; font-size:11px; font-weight:700; color:rgba(255,255,255,.7); letter-spacing:1px; text-transform:uppercase;">Cursos</th>
                    <th style="padding:14px 18px; text-align:center; font-family:'Montserrat',sans-serif; font-size:11px; font-weight:700; color:rgba(255,255,255,.7); letter-spacing:1px; text-transform:uppercase;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $i => $student)
                <tr style="border-bottom:1px solid #f1f5f9; transition:background .15s;"
                    onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='#fff'">
                    <td style="padding:14px 18px; font-size:13px; color:#94a3b8; font-weight:600;">
                        {{ $students->firstItem() + $i }}
                    </td>
                    <td style="padding:14px 18px;">
                        <div style="display:flex; align-items:center; gap:10px;">
                            <div style="width:36px; height:36px; border-radius:50%;
                                        background:linear-gradient(135deg,#00B4E6,#0B2C4D);
                                        display:flex; align-items:center; justify-content:center;
                                        font-family:'Montserrat',sans-serif; font-size:14px; font-weight:800; color:#fff; flex-shrink:0;">
                                {{ strtoupper(substr($student->name, 0, 1)) }}
                            </div>
                            <div>
                                <div style="font-family:'Montserrat',sans-serif; font-size:13.5px; font-weight:700; color:#1e293b;">
                                    {{ $student->name }} {{ $student->lastname }}
                                </div>
                                <div style="font-size:12px; color:#64748b;">{{ $student->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td style="padding:14px 18px; font-size:13px; color:#475569; font-weight:600;">
                        {{ $student->dni ?? '—' }}
                    </td>
                    <td style="padding:14px 18px; font-size:13px; color:#475569;">
                        {{ $student->whatsapp ?? '—' }}
                    </td>
                    <td style="padding:14px 18px; text-align:center;">
                        <span style="background:rgba(0,180,230,.12); color:#009bc7; border-radius:20px;
                                     padding:4px 12px; font-family:'Montserrat',sans-serif; font-size:12px; font-weight:700;">
                            {{ $student->courses_count }}
                        </span>
                    </td>
                    <td style="padding:14px 18px; text-align:center;">
                        <div style="display:flex; align-items:center; justify-content:center; gap:8px;">
                            <a href="{{ route('admin.students.show', $student) }}"
                               style="background:#e0f2fe; color:#0369a1; border:none; padding:7px 14px;
                                      border-radius:8px; font-family:'Montserrat',sans-serif; font-size:12px;
                                      font-weight:700; text-decoration:none; display:inline-flex; align-items:center; gap:5px;">
                                👁 Ver cursos
                            </a>
                            <form method="POST" action="{{ route('admin.students.destroy', $student) }}"
                                  onsubmit="return confirm('¿Eliminar a {{ addslashes($student->name) }}? Esta acción no se puede deshacer.')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    style="background:#fee2e2; color:#dc2626; border:none; padding:7px 12px;
                                           border-radius:8px; font-family:'Montserrat',sans-serif; font-size:12px;
                                           font-weight:700; cursor:pointer; display:inline-flex; align-items:center; gap:5px;">
                                    🗑 Eliminar
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="padding:48px; text-align:center; color:#94a3b8; font-size:14px; font-family:'Montserrat',sans-serif; font-weight:600;">
                        No se encontraron estudiantes{{ $search ? ' con ese criterio' : '' }}.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginación --}}
    @if($students->hasPages())
    <div style="margin-top:20px; display:flex; justify-content:center;">
        {{ $students->appends(['search' => $search])->links() }}
    </div>
    @endif

</div>
@endsection