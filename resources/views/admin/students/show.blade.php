@extends('layouts.app')

@section('content')
<div style="padding: 28px 30px;">

    {{-- Back --}}
    <a href="{{ route('admin.students.index') }}"
       style="display:inline-flex; align-items:center; gap:7px; font-family:'Montserrat',sans-serif;
              font-size:13px; font-weight:700; color:#0B2C4D; text-decoration:none; margin-bottom:22px;">
        ← Volver a Estudiantes
    </a>

    {{-- Alerta --}}
    @if(session('success'))
    <div style="background:#d1fae5; border-left:4px solid #10b981; padding:12px 16px; border-radius:8px; margin-bottom:20px; font-size:13.5px; color:#065f46; font-weight:600;">
        ✓ {{ session('success') }}
    </div>
    @endif

    {{-- Card estudiante --}}
    <div style="background:#fff; border-radius:14px; box-shadow:0 4px 20px rgba(11,44,77,.07);
                padding:24px 28px; margin-bottom:24px; display:flex; align-items:center; gap:20px; flex-wrap:wrap;">
        <div style="width:56px; height:56px; border-radius:50%;
                    background:linear-gradient(135deg,#00B4E6,#0B2C4D);
                    display:flex; align-items:center; justify-content:center;
                    font-family:'Montserrat',sans-serif; font-size:22px; font-weight:800; color:#fff; flex-shrink:0;">
            {{ strtoupper(substr($student->name, 0, 1)) }}
        </div>
        <div style="flex:1; min-width:0;">
            <h2 style="font-family:'Montserrat',sans-serif; font-size:18px; font-weight:800; color:#0B2C4D; margin:0 0 4px;">
                {{ $student->name }} {{ $student->lastname }}
            </h2>
            <div style="font-size:13px; color:#64748b; display:flex; gap:20px; flex-wrap:wrap;">
                <span>✉ {{ $student->email }}</span>
                @if($student->dni) <span>🪪 {{ $student->dni }}</span> @endif
                @if($student->whatsapp) <span>📱 {{ $student->whatsapp }}</span> @endif
            </div>
        </div>
        <div>
            <span style="background:rgba(0,180,230,.12); color:#009bc7; border-radius:20px;
                         padding:6px 16px; font-family:'Montserrat',sans-serif; font-size:13px; font-weight:700;">
                {{ $enrollments->count() }} curso(s) inscrito(s)
            </span>
        </div>
    </div>

    {{-- Tabla de cursos --}}
    <div style="background:#fff; border-radius:14px; box-shadow:0 4px 20px rgba(11,44,77,.07); overflow:hidden;">
        <div style="padding:18px 24px; border-bottom:1px solid #f1f5f9;">
            <h3 style="font-family:'Montserrat',sans-serif; font-size:15px; font-weight:800; color:#0B2C4D; margin:0;">
                📋 Cursos Inscritos
            </h3>
        </div>
        <table style="width:100%; border-collapse:collapse;">
            <thead>
                <tr style="background:#f8fafc;">
                    <th style="padding:13px 20px; text-align:left; font-family:'Montserrat',sans-serif; font-size:11px; font-weight:700; color:#64748b; letter-spacing:1px; text-transform:uppercase;">Curso</th>
                    <th style="padding:13px 20px; text-align:left; font-family:'Montserrat',sans-serif; font-size:11px; font-weight:700; color:#64748b; letter-spacing:1px; text-transform:uppercase;">Inscripción</th>
                    <th style="padding:13px 20px; text-align:center; font-family:'Montserrat',sans-serif; font-size:11px; font-weight:700; color:#64748b; letter-spacing:1px; text-transform:uppercase;">Estado de Pago</th>
                    <th style="padding:13px 20px; text-align:center; font-family:'Montserrat',sans-serif; font-size:11px; font-weight:700; color:#64748b; letter-spacing:1px; text-transform:uppercase;">Acción</th>
                </tr>
            </thead>
            <tbody>
                @forelse($enrollments as $course)
                <tr style="border-bottom:1px solid #f1f5f9;">
                    <td style="padding:15px 20px;">
                        <div style="font-family:'Montserrat',sans-serif; font-size:13.5px; font-weight:700; color:#1e293b;">
                            {{ $course->title }}
                        </div>
                        <div style="font-size:12px; color:#94a3b8; margin-top:2px; text-transform:capitalize;">
                            {{ $course->programa ?? '' }}
                        </div>
                    </td>
                    <td style="padding:15px 20px; font-size:13px; color:#64748b;">
                        {{ $course->pivot->enrolled_at
                            ? \Carbon\Carbon::parse($course->pivot->enrolled_at)->format('d/m/Y')
                            : '—' }}
                    </td>
                    <td style="padding:15px 20px; text-align:center;">
                        @if($course->pivot->is_paid)
                            <span style="background:#d1fae5; color:#065f46; border-radius:20px;
                                         padding:5px 14px; font-family:'Montserrat',sans-serif; font-size:12px; font-weight:700;">
                                ✓ Pagado
                            </span>
                        @else
                            <span style="background:#fef3c7; color:#92400e; border-radius:20px;
                                         padding:5px 14px; font-family:'Montserrat',sans-serif; font-size:12px; font-weight:700;">
                                ⏳ Pendiente
                            </span>
                        @endif
                    </td>
                    <td style="padding:15px 20px; text-align:center;">
                        <form method="POST"
                              action="{{ route('admin.students.toggle-paid', [$student, $course->id]) }}">
                            @csrf @method('PATCH')
                            @if($course->pivot->is_paid)
                                <input type="hidden" name="is_paid" value="0">
                                <button type="submit"
                                    style="background:#fee2e2; color:#dc2626; border:none; padding:7px 14px;
                                           border-radius:8px; font-family:'Montserrat',sans-serif; font-size:12px;
                                           font-weight:700; cursor:pointer;">
                                    Marcar pendiente
                                </button>
                            @else
                                <input type="hidden" name="is_paid" value="1">
                                <button type="submit"
                                    style="background:#dcfce7; color:#16a34a; border:none; padding:7px 14px;
                                           border-radius:8px; font-family:'Montserrat',sans-serif; font-size:12px;
                                           font-weight:700; cursor:pointer;">
                                    ✓ Marcar pagado
                                </button>
                            @endif
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="padding:40px; text-align:center; color:#94a3b8; font-family:'Montserrat',sans-serif; font-size:13px; font-weight:600;">
                        Este estudiante no está inscrito en ningún curso.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection