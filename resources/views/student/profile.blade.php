@extends('layouts.app')

@section('content')

<style>
    /* ── PALETA ESIPEC ── */
    :root {
        --azul:    #0B2C4D;
        --azul-md: #0e3a63;
        --celeste: #00B4E6;
        --celeste2:#1FA2FF;
        --dorado:  #C9A24D;
        --dorado-lt:#dbb96a;
        --gris-bg: #F4F6F8;
        --gris-bd: #DDE2EA;
        --texto:   #2E2E2E;
        --muted:   #6B7A8D;
        --blanco:  #FFFFFF;
        --verde:   #28a745;
    }

    .perfil-wrap {
        background: var(--gris-bg);
        min-height: calc(100vh - 120px);
        padding: 36px 16px 60px;
    }

    .perfil-inner {
        max-width: 960px;
        margin: 0 auto;
    }

    /* ── BREADCRUMB ── */
    .perfil-breadcrumb {
        font-size: 13px;
        color: var(--muted);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .perfil-breadcrumb a {
        color: var(--celeste);
        text-decoration: none;
    }

    .perfil-breadcrumb a:hover { text-decoration: underline; }
    .perfil-breadcrumb i { font-size: 10px; color: var(--muted); }

    /* ── HERO HEADER ── */
    .perfil-header {
        background: linear-gradient(120deg, #0b2c4d 0%, #061821 100%);
        border-radius: 14px 14px 0 0;
        padding: 32px 36px 28px;
        display: flex;
        align-items: center;
        gap: 24px;
        position: relative;
        overflow: hidden;
    }

    .perfil-header::before {
        content: '';
        position: absolute;
        inset: 0;
        background: repeating-linear-gradient(
            -55deg,
            rgba(255,255,255,.025) 0px,
            rgba(255,255,255,.025) 1px,
            transparent 1px,
            transparent 22px
        );
    }

    .perfil-header::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 2px;
        background: linear-gradient(90deg, var(--celeste), var(--dorado), var(--celeste));
    }

    .ph-avatar-wrap {
        position: relative;
        flex-shrink: 0;
        z-index: 1;
    }

    .ph-avatar {
        width: 96px;
        height: 96px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid var(--celeste);
        box-shadow: 0 0 0 4px rgba(0,180,230,.2);
        display: block;
        transition: transform .3s ease;
    }

    .ph-avatar:hover { transform: scale(1.04); }

    .ph-camera {
        position: absolute;
        bottom: 2px; right: 2px;
        width: 28px; height: 28px;
        background: var(--dorado);
        border-radius: 50%;
        border: 2px solid #061821;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer;
        transition: background .2s, transform .2s;
    }

    .ph-camera:hover { background: var(--dorado-lt); transform: scale(1.1); }
    .ph-camera i { font-size: 11px; color: var(--azul); }

    .ph-info { z-index: 1; }

    .ph-nombre {
        font-size: 20px;
        font-weight: 700;
        color: var(--blanco);
        margin-bottom: 4px;
        line-height: 1.3;
    }

    .ph-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(0,180,230,.15);
        border: 1px solid rgba(0,180,230,.35);
        color: var(--celeste);
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        padding: 4px 12px;
        border-radius: 20px;
        margin-bottom: 10px;
    }

    .ph-badge i { font-size: 10px; }

    .ph-meta {
        font-size: 13px;
        color: rgba(255,255,255,.6);
        display: flex;
        align-items: center;
        gap: 16px;
        flex-wrap: wrap;
    }

    .ph-meta span {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .ph-meta i { color: var(--dorado); font-size: 12px; }

    /* ── CARD BODY ── */
    .perfil-card {
        background: var(--blanco);
        border-radius: 0 0 14px 14px;
        border: 1px solid var(--gris-bd);
        border-top: none;
        box-shadow: 0 8px 32px rgba(11,44,77,.08);
    }

    .perfil-tabs {
        display: flex;
        border-bottom: 1px solid var(--gris-bd);
        padding: 0 36px;
        gap: 4px;
    }

    .ptab {
        padding: 16px 20px;
        font-size: 13.5px;
        font-weight: 600;
        color: var(--muted);
        cursor: pointer;
        border-bottom: 2px solid transparent;
        margin-bottom: -1px;
        display: flex;
        align-items: center;
        gap: 7px;
        transition: color .2s, border-color .2s;
        user-select: none;
    }

    .ptab i { font-size: 13px; }
    .ptab:hover { color: var(--azul); }

    .ptab.active {
        color: var(--celeste);
        border-bottom-color: var(--celeste);
    }

    .perfil-body {
        padding: 32px 36px 36px;
    }

    .alerta-ok {
        background: #d4edda;
        border-left: 4px solid var(--verde);
        color: #155724;
        padding: 12px 16px;
        border-radius: 8px;
        font-size: 13.5px;
        font-weight: 600;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-section-label {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1.2px;
        text-transform: uppercase;
        color: var(--muted);
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-section-label::after {
        content: '';
        flex: 1;
        height: 1px;
        background: var(--gris-bd);
    }

    .form-row-esipec {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px 20px;
        margin-bottom: 20px;
    }

    .form-row-esipec.one-col { grid-template-columns: 1fr; }

    .fg {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .fg label {
        font-size: 11.5px;
        font-weight: 700;
        color: var(--azul);
        letter-spacing: .5px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .fg label i {
        color: var(--celeste);
        font-size: 12px;
        width: 14px;
        text-align: center;
    }

    .fg input {
        background: var(--gris-bg);
        border: 1.5px solid var(--gris-bd);
        border-radius: 8px;
        padding: 10px 14px;
        font-size: 14px;
        color: var(--texto);
        font-family: 'Nunito', sans-serif;
        transition: border-color .2s, box-shadow .2s, background .2s;
        outline: none;
        width: 100%;
    }

    .fg input:disabled {
        background: #ECEEF2;
        color: var(--muted);
        cursor: not-allowed;
        border-color: #E0E4EA;
    }

    .fg input:not(:disabled):focus {
        border-color: var(--celeste);
        box-shadow: 0 0 0 3px rgba(0,180,230,.12);
        background: #f0faff;
    }

    .lbl-editable {
        font-size: 9px;
        background: rgba(0,180,230,.12);
        color: var(--celeste);
        border: 1px solid rgba(0,180,230,.3);
        padding: 1px 7px;
        border-radius: 20px;
        font-weight: 700;
        letter-spacing: .8px;
        text-transform: uppercase;
    }

    .sep { height: 1px; background: var(--gris-bd); margin: 24px 0; }

    .btn-esipec-save {
        background: linear-gradient(90deg, var(--azul), var(--azul-md));
        color: var(--blanco);
        border: none;
        padding: 12px 30px;
        border-radius: 8px;
        font-family: 'Nunito', sans-serif;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: opacity .2s, transform .15s, box-shadow .2s;
        box-shadow: 0 4px 14px rgba(11,44,77,.2);
        text-decoration: none;
    }

    .btn-esipec-save:hover {
        opacity: .92;
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(11,44,77,.28);
        color: var(--blanco);
    }

    .btn-esipec-save:active { transform: translateY(0); }
    .btn-esipec-save i { color: var(--dorado); font-size: 14px; }

    .nota-readonly {
        font-size: 12px;
        color: var(--muted);
        margin-top: 20px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .nota-readonly i { color: var(--dorado); }

    /* drop zone foto */
    .foto-dropzone {
        border: 2px dashed var(--gris-bd);
        border-radius: 12px;
        padding: 28px 24px;
        text-align: center;
        cursor: pointer;
        transition: border-color .2s, background .2s;
        background: var(--gris-bg);
        margin-top: 16px;
    }

    .foto-dropzone:hover {
        border-color: var(--celeste);
        background: #f0faff;
    }

    .foto-dropzone i {
        font-size: 28px;
        color: var(--celeste);
        margin-bottom: 8px;
        display: block;
    }

    .foto-dropzone p {
        font-size: 13px;
        color: var(--muted);
        margin: 0;
    }

    .foto-dropzone .dropzone-hint {
        font-size: 11px;
        color: #aab;
        margin-top: 4px;
    }

    /* ── RESPONSIVE ── */
    @media (max-width: 700px) {
        .perfil-header { flex-direction: column; text-align: center; padding: 28px 20px 24px; }
        .ph-meta { justify-content: center; }
        .perfil-tabs { padding: 0 16px; overflow-x: auto; }
        .ptab { white-space: nowrap; padding: 14px 14px; font-size: 13px; }
        .perfil-body { padding: 24px 18px 28px; }
        .form-row-esipec { grid-template-columns: 1fr; }
        .btn-esipec-save { width: 100%; justify-content: center; }
    }

    .perfil-header, .perfil-card {
        animation: esipecFade .4s ease both;
    }
    .perfil-card { animation-delay: .07s; }

    @keyframes esipecFade {
        from { opacity: 0; transform: translateY(12px); }
        to   { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="perfil-wrap">
<div class="perfil-inner">

    {{-- BREADCRUMB --}}
    <div class="perfil-breadcrumb">
        <a href="{{ url('/home') }}"><i class="fas fa-home"></i> Campus Virtual</a>
        <i class="fas fa-chevron-right"></i>
        <span>Mi Perfil</span>
    </div>

    {{-- HEADER (fuera de cualquier form) --}}
    <div class="perfil-header">
        <div class="ph-avatar-wrap">
            <img id="previewImage"
                 src="{{ Auth::user()->photo
                     ? asset('/Laravel/public/storage/'.Auth::user()->photo)
                     : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name.' '.Auth::user()->lastname).'&background=0B2C4D&color=00B4E6&size=200&bold=true' }}"
                 class="ph-avatar"
                 alt="Foto de perfil">
        </div>

        <div class="ph-info">
            <div class="ph-badge"><i class="fas fa-user-graduate"></i> Alumno</div>
            <div class="ph-nombre">{{ Auth::user()->name }} {{ Auth::user()->lastname }}</div>
            <div class="ph-meta">
                <span><i class="fas fa-id-card"></i> DNI: {{ Auth::user()->dni }}</span>
                <span><i class="fas fa-envelope"></i> {{ Auth::user()->email }}</span>
                @if(Auth::user()->whatsapp)
                <span><i class="fab fa-whatsapp"></i> {{ Auth::user()->whatsapp }}</span>
                @endif
            </div>
        </div>
    </div>

    {{-- CARD --}}
    <div class="perfil-card">

        {{-- TABS --}}
        <div class="perfil-tabs">
            <div class="ptab active" onclick="showTab('datos')">
                <i class="fas fa-user"></i> Mis datos
            </div>
            <div class="ptab" onclick="showTab('foto')">
                <i class="fas fa-camera"></i> Subir Foto
            </div>
        </div>

        <div class="perfil-body">

            @if(session('success'))
                <div class="alerta-ok">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            {{-- ══════════════════════════════
                 TAB 1: DATOS — form solo email
                 ══════════════════════════════ --}}
            <div id="tab-datos">

                <form action="{{ route('alumno.perfil.update') }}" method="POST">
                @csrf

                    <div class="form-section-label">Información personal</div>

                    <div class="form-row-esipec">
                        <div class="fg">
                            <label><i class="fas fa-user"></i> Nombres</label>
                            <input type="text" value="{{ Auth::user()->name }}" disabled>
                        </div>
                        <div class="fg">
                            <label><i class="fas fa-user"></i> Apellidos</label>
                            <input type="text" value="{{ Auth::user()->lastname }}" disabled>
                        </div>
                        <div class="fg">
                            <label><i class="fas fa-id-card"></i> DNI</label>
                            <input type="text" value="{{ Auth::user()->dni }}" disabled>
                        </div>
                        <div class="fg">
                            <label><i class="fab fa-whatsapp"></i> WhatsApp</label>
                            <input type="text" value="{{ Auth::user()->whatsapp }}" disabled>
                        </div>
                    </div>

                    <div class="sep"></div>

                    <div class="form-section-label">Datos editables</div>

                    <div class="form-row-esipec one-col" style="max-width:460px">
                        <div class="fg">
                            <label>
                                <i class="fas fa-envelope"></i> Correo electrónico
                                <span class="lbl-editable">editable</span>
                            </label>
                            <input type="email" name="email" value="{{ Auth::user()->email }}">
                        </div>
                    </div>

                    <div class="d-flex align-items-center flex-wrap" style="gap:12px">
                        <button type="submit" class="btn-esipec-save">
                            <i class="fas fa-save"></i> Guardar cambios
                        </button>
                        <p class="nota-readonly mb-0">
                            <i class="fas fa-info-circle"></i>
                            Los demás campos son gestionados por la institución.
                        </p>
                    </div>

                </form>

            </div>

            {{-- ══════════════════════════════
                 TAB 2: FOTO — form con enctype
                 ══════════════════════════════ --}}
            <div id="tab-foto" style="display:none">

                <form action="{{ route('alumno.perfil.update') }}"
                      method="POST"
                      enctype="multipart/form-data">
                @csrf

                    {{-- campo email oculto obligatorio por la validación del controller --}}
                    <input type="hidden" name="email" value="{{ Auth::user()->email }}">

                    <input type="file" name="photo" id="photoInput" hidden accept="image/*">

                    <div class="form-section-label">Foto de perfil</div>

                    <div class="d-flex align-items-start flex-wrap" style="gap:24px">

                        <img id="previewImage2"
                             src="{{ Auth::user()->photo
                                 ? asset('/Laravel/public/storage/'.Auth::user()->photo)
                                 : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name.' '.Auth::user()->lastname).'&background=0B2C4D&color=00B4E6&size=200&bold=true' }}"
                             style="width:100px;height:100px;border-radius:50%;object-fit:cover;
                                    border:3px solid var(--celeste);flex-shrink:0;"
                             alt="Preview">

                        <div style="flex:1;min-width:200px">
                            <p style="font-size:13.5px;color:var(--texto);margin-bottom:12px;">
                                Tu foto aparece en tu perfil y en los certificados de los cursos.<br>
                                <span style="color:var(--muted);font-size:12px;">
                                    Formatos aceptados: JPG, PNG · Máximo 2MB
                                </span>
                            </p>

                            {{-- Drop zone clicable --}}
                            <div class="foto-dropzone" id="dropZone" onclick="document.getElementById('photoInput').click()">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <p>Haz clic para seleccionar una imagen</p>
                                <p class="dropzone-hint" id="dropZoneHint">o arrastra y suelta aquí</p>
                            </div>
                        </div>
                    </div>

                    <div class="sep"></div>

                    <button type="submit" class="btn-esipec-save" id="btnGuardarFoto" disabled
                            style="opacity:.5;cursor:not-allowed">
                        <i class="fas fa-save"></i> Guardar foto
                    </button>

                    <p class="nota-readonly">
                        <i class="fas fa-info-circle"></i>
                        Selecciona una foto para habilitar el botón de guardado.
                    </p>

                </form>

            </div>

        </div>
    </div>

</div>
</div>

<script>
/* ── Tabs ── */
function showTab(tab) {
    document.getElementById('tab-datos').style.display = tab === 'datos' ? '' : 'none';
    document.getElementById('tab-foto').style.display  = tab === 'foto'  ? '' : 'none';
    document.querySelectorAll('.ptab').forEach((el, i) => {
        el.classList.toggle('active',
            (i === 0 && tab === 'datos') ||
            (i === 1 && tab === 'foto')
        );
    });
}

/* ── Preview + habilitar botón al seleccionar foto ── */
document.getElementById('photoInput').addEventListener('change', function (e) {
    const file = e.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function (ev) {
        const src = ev.target.result;
        document.getElementById('previewImage').src  = src;
        document.getElementById('previewImage2').src = src;
    };
    reader.readAsDataURL(file);

    // actualizar hint y habilitar botón
    document.getElementById('dropZoneHint').textContent = file.name;
    const btn = document.getElementById('btnGuardarFoto');
    btn.disabled = false;
    btn.style.opacity = '1';
    btn.style.cursor  = 'pointer';
});

/* ── Drag & drop sobre la dropzone ── */
const dz = document.getElementById('dropZone');

dz.addEventListener('dragover', function (e) {
    e.preventDefault();
    dz.style.borderColor = 'var(--celeste)';
    dz.style.background  = '#f0faff';
});

dz.addEventListener('dragleave', function () {
    dz.style.borderColor = '';
    dz.style.background  = '';
});

dz.addEventListener('drop', function (e) {
    e.preventDefault();
    dz.style.borderColor = '';
    dz.style.background  = '';

    const file = e.dataTransfer.files[0];
    if (!file || !file.type.startsWith('image/')) return;

    // inyectar archivo en el input real para que el form lo envíe
    const dt = new DataTransfer();
    dt.items.add(file);
    const input = document.getElementById('photoInput');
    input.files = dt.files;
    input.dispatchEvent(new Event('change'));
});

/* ── Abrir tab correcto si volvemos tras guardar foto ── */
@if(session('tab') === 'foto')
    showTab('foto');
@endif
</script>

@endsection