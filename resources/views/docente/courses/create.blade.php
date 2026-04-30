@extends('layouts.app')

@section('content')

<style>
  .form-page { padding: 28px 28px 48px; max-width: 900px; }

  /* Header */
  .form-page-header { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 2rem; flex-wrap: wrap; gap: 12px; }
  .form-page-title { font-family: 'Montserrat', sans-serif; font-size: 20px; font-weight: 800; color: #0B2C4D; margin: 0; }
  .form-page-sub { font-size: 12px; color: #64748b; margin: 3px 0 0; }
  .btn-cancel { font-family: 'Montserrat', sans-serif; font-size: 12px; font-weight: 600; color: #64748b; background: #F0F3F7; border: 1px solid #e2e8f0; border-radius: 7px; padding: 8px 16px; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; }
  .btn-cancel:hover { color: #0B2C4D; border-color: #0B2C4D55; text-decoration: none; }

  /* Section cards */
  .form-section { background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; margin-bottom: 16px; overflow: hidden; }
  .form-section-header { display: flex; align-items: center; gap: 10px; padding: 16px 20px; border-bottom: 1px solid #f1f5f9; }
  .section-icon { width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
  .section-icon.navy { background: #0B2C4D; }
  .section-icon.cyan  { background: #00B4E6; }
  .section-icon.gold  { background: #C9A24D; }
  .section-icon.slate { background: #475569; }
  .section-icon.green { background: #166534; }
  .section-icon svg { width: 16px; height: 16px; fill: none; stroke: #fff; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
  .section-title { font-family: 'Montserrat', sans-serif; font-size: 13px; font-weight: 700; color: #0B2C4D; margin: 0; }
  .section-sub { font-size: 11px; color: #94a3b8; margin: 1px 0 0; }
  .form-section-body { padding: 20px; }

  /* Form controls */
  .f-label { font-family: 'Montserrat', sans-serif; font-size: 11px; font-weight: 700; letter-spacing: 0.3px; color: #475569; margin-bottom: 6px; display: block; }
  .f-control { width: 100%; border: 1px solid #e2e8f0; border-radius: 8px; padding: 9px 12px; font-size: 13px; font-family: 'Open Sans', sans-serif; color: #1e293b; background: #fff; transition: border-color 0.15s, box-shadow 0.15s; outline: none; }
  .f-control:focus { border-color: #00B4E6; box-shadow: 0 0 0 3px rgba(0,180,230,0.12); }
  .f-control-lg { font-size: 15px; padding: 11px 14px; font-weight: 600; }
  .f-control::placeholder { color: #cbd5e1; }
  select.f-control { cursor: pointer; }
  textarea.f-control { resize: vertical; min-height: 90px; }

  .input-prefix { display: flex; align-items: center; }
  .input-prefix-text { background: #F0F3F7; border: 1px solid #e2e8f0; border-right: none; border-radius: 8px 0 0 8px; padding: 9px 12px; font-family: 'Montserrat', sans-serif; font-size: 12px; font-weight: 700; color: #475569; white-space: nowrap; }
  .input-prefix .f-control { border-radius: 0 8px 8px 0; }

  /* Grid helpers */
  .f-grid { display: grid; gap: 14px; }
  .f-grid-2 { grid-template-columns: 1fr 1fr; }
  .f-grid-3 { grid-template-columns: repeat(3, 1fr); }
  .f-grid-4 { grid-template-columns: repeat(4, 1fr); }
  .f-grid-8-4 { grid-template-columns: 2fr 1fr; }

  /* Toggle switch */
  .toggle-group { display: flex; background: #F0F3F7; border-radius: 8px; padding: 3px; gap: 2px; }
  .toggle-group input[type="radio"] { display: none; }
  .toggle-group label { flex: 1; text-align: center; padding: 7px 10px; border-radius: 6px; font-family: 'Montserrat', sans-serif; font-size: 12px; font-weight: 600; color: #64748b; cursor: pointer; transition: all 0.15s; }
  .toggle-group input[type="radio"]:checked + label { background: #fff; color: #0B2C4D; box-shadow: 0 1px 4px rgba(0,0,0,.1); }

  /* Docentes selector */
  .teacher-search-wrap { position: relative; margin-bottom: 10px; }
  .teacher-search-icon { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); width: 14px; height: 14px; color: #94a3b8; pointer-events: none; }
  .teacher-search-icon svg { width: 14px; height: 14px; fill: none; stroke: currentColor; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
  #teacherSearch { padding-left: 34px; }

  .teacher-list { display: flex; flex-direction: column; gap: 6px; max-height: 280px; overflow-y: auto; border: 1px solid #e2e8f0; border-radius: 8px; padding: 8px; background: #fafafa; }
  .teacher-list::-webkit-scrollbar { width: 4px; }
  .teacher-list::-webkit-scrollbar-track { background: transparent; }
  .teacher-list::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }

  .teacher-item { display: flex; align-items: center; gap: 10px; background: #fff; border: 1px solid #e2e8f0; border-radius: 8px; padding: 10px 12px; cursor: pointer; transition: border-color 0.15s; }
  .teacher-item:hover { border-color: #00B4E680; }
  .teacher-item.selected { border-color: #0B2C4D; background: rgba(11,44,77,.03); }
  .teacher-item input[type="checkbox"] { width: 16px; height: 16px; accent-color: #0B2C4D; flex-shrink: 0; cursor: pointer; }
  .teacher-avatar { width: 34px; height: 34px; border-radius: 50%; background: linear-gradient(135deg, #0B2C4D, #00B4E6); display: flex; align-items: center; justify-content: center; font-family: 'Montserrat', sans-serif; font-size: 13px; font-weight: 800; color: #fff; flex-shrink: 0; }
  .teacher-name { font-family: 'Montserrat', sans-serif; font-size: 13px; font-weight: 600; color: #0B2C4D; margin: 0; }
  .teacher-email { font-size: 11px; color: #94a3b8; margin: 1px 0 0; }
  .teacher-role-select { margin-left: auto; flex-shrink: 0; display: none; }
  .teacher-item.selected .teacher-role-select { display: block; }
  .teacher-role-select select { font-family: 'Montserrat', sans-serif; font-size: 11px; font-weight: 600; color: #0B2C4D; border: 1px solid #e2e8f0; border-radius: 6px; padding: 4px 8px; background: #F0F3F7; outline: none; cursor: pointer; }
  .teacher-empty { text-align: center; padding: 20px; font-size: 12px; color: #94a3b8; font-family: 'Open Sans', sans-serif; }

  .selected-count { display: inline-flex; align-items: center; gap: 5px; font-family: 'Montserrat', sans-serif; font-size: 11px; font-weight: 700; color: #0B2C4D; background: rgba(0,180,230,.1); border-radius: 20px; padding: 3px 10px; margin-left: 8px; }

  /* File upload */
  .file-upload-area { border: 2px dashed #e2e8f0; border-radius: 10px; padding: 20px; text-align: center; transition: border-color 0.15s; cursor: pointer; background: #fafafa; }
  .file-upload-area:hover { border-color: #00B4E680; }
  .file-upload-area input[type="file"] { position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%; }
  .file-upload-area .upload-wrap { position: relative; }
  .file-upload-icon svg { width: 24px; height: 24px; fill: none; stroke: #94a3b8; stroke-width: 1.5; stroke-linecap: round; stroke-linejoin: round; margin: 0 auto 6px; display: block; }
  .file-upload-label { font-family: 'Montserrat', sans-serif; font-size: 12px; font-weight: 600; color: #475569; margin: 0; }
  .file-upload-sub { font-size: 11px; color: #94a3b8; margin: 2px 0 0; }
  .file-name-preview { font-size: 11px; color: #0B2C4D; font-weight: 600; margin-top: 4px; display: none; }

  /* Price display preview box */
  .price-preview-box { background: linear-gradient(135deg, #fefce8, #fef9c3); border: 1px solid #fde68a; border-radius: 10px; padding: 14px 16px; display: flex; align-items: center; gap: 12px; margin-top: 14px; }
  .price-preview-icon { width: 36px; height: 36px; background: #C9A24D; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
  .price-preview-icon svg { width: 18px; height: 18px; fill: none; stroke: #fff; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
  .price-preview-label { font-family: 'Montserrat', sans-serif; font-size: 11px; font-weight: 700; color: #92400e; margin: 0 0 2px; }
  .price-preview-value { font-family: 'Montserrat', sans-serif; font-size: 20px; font-weight: 800; color: #0B2C4D; margin: 0; }
  .price-preview-value .currency-sym { font-size: 13px; font-weight: 600; color: #64748b; margin-right: 2px; }
  .price-preview-striked { font-family: 'Open Sans', sans-serif; font-size: 11px; color: #94a3b8; text-decoration: line-through; margin: 1px 0 0; }

  /* Actions */
  .form-actions { display: flex; align-items: center; justify-content: flex-end; gap: 10px; padding-top: 8px; }
  .btn-save { background: #0B2C4D; color: #fff; border: none; border-radius: 8px; padding: 11px 28px; font-family: 'Montserrat', sans-serif; font-size: 13px; font-weight: 700; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; transition: background 0.15s; }
  .btn-save:hover { background: #0e3860; }
  .btn-save svg { width: 15px; height: 15px; fill: none; stroke: #fff; stroke-width: 2.5; stroke-linecap: round; stroke-linejoin: round; }

  @media (max-width: 767px) {
    .form-page { padding: 16px 14px 40px; }
    .f-grid-2, .f-grid-3, .f-grid-4, .f-grid-8-4 { grid-template-columns: 1fr; }
  }
  @media (max-width: 575px) {
    .form-page-header { flex-direction: column; align-items: flex-start; }
  }
</style>

<div class="form-page">

  {{-- Header --}}
  <div class="form-page-header">
    <div>
      <h1 class="form-page-title">Crear nuevo curso</h1>
      <p class="form-page-sub">Completa la información académica, comercial y multimedia</p>
    </div>
    <a href="{{ url()->previous() }}" class="btn-cancel">
      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
      Cancelar
    </a>
  </div>

  <form method="POST" action="{{ route('courses.store') }}" enctype="multipart/form-data">
    @csrf

    {{-- ── 1. INFORMACIÓN GENERAL ── --}}
    <div class="form-section">
      <div class="form-section-header">
        <div class="section-icon navy">
          <svg viewBox="0 0 24 24"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
        </div>
        <div>
          <p class="section-title">Información general</p>
          <p class="section-sub">Datos principales del programa académico</p>
        </div>
      </div>
      <div class="form-section-body">

        {{-- Título + Programa --}}
        <div class="f-grid f-grid-8-4" style="margin-bottom:14px;">
          <div>
            <label class="f-label">Título del curso *</label>
            <input type="text" name="title" class="f-control f-control-lg" placeholder="Ej: Diplomado en Gestión Pública" required value="{{ old('title') }}">
          </div>
          <div>
            <label class="f-label">Programa *</label>
            <select name="programa" class="f-control" required>
              <option value="">Seleccionar</option>
              <option value="diplomado"       {{ old('programa')=='diplomado'       ?'selected':'' }}>Diplomado</option>
              <option value="especializacion" {{ old('programa')=='especializacion' ?'selected':'' }}>Especialización</option>
              <option value="curso"           {{ old('programa')=='curso'           ?'selected':'' }}>Curso</option>
              <option value="seminario"       {{ old('programa')=='seminario'       ?'selected':'' }}>Seminario</option>
            </select>
          </div>
        </div>

        {{-- ★ NUEVO: Subtítulo --}}
        <div style="margin-bottom:14px;">
          <label class="f-label">Subtítulo <span style="font-weight:400;color:#94a3b8;">(opcional)</span></label>
          <input type="text" name="subtitle" class="f-control" placeholder="Ej: Aprende las bases del derecho administrativo moderno" value="{{ old('subtitle') }}" maxlength="160">
          <p style="font-size:10px;color:#94a3b8;margin:4px 0 0;font-family:'Open Sans',sans-serif;">Frase breve que complementa el título. Máx. 160 caracteres.</p>
        </div>

        <div style="margin-bottom:14px;">
          <label class="f-label">Descripción</label>
          <textarea name="description" id="editor-description" class="f-control">{{ old('description') }}</textarea>
        </div>
        <div style="margin-bottom:14px;">
          <label class="f-label">Dirigido a</label>
          <textarea name="directed_to" id="editor-directed" class="f-control" placeholder="Profesionales, egresados, estudiantes...">{{ old('directed_to') }}</textarea>
        </div>
        <div style="max-width:240px;">
          <label class="f-label">¿Curso destacado?</label>
          <div class="toggle-group">
            <input type="radio" name="is_featured" id="feat_no"  value="0" {{ old('is_featured','0')=='0'?'checked':'' }}>
            <label for="feat_no">No destacado</label>
            <input type="radio" name="is_featured" id="feat_yes" value="1" {{ old('is_featured')=='1'?'checked':'' }}>
            <label for="feat_yes">⭐ Destacado</label>
          </div>
        </div>
      </div>
    </div>

    {{-- ── 2. DOCENTES ── --}}
    <div class="form-section">
      <div class="form-section-header">
        <div class="section-icon cyan">
          <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
        </div>
        <div style="display:flex;align-items:center;gap:6px;flex-wrap:wrap;">
          <div>
            <p class="section-title">Docentes del curso</p>
            <p class="section-sub">Selecciona uno o más docentes que dictarán el curso</p>
          </div>
          <span class="selected-count" id="teacherCountBadge" style="display:none;">
            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap: round; stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            <span id="teacherCountNum">0</span> seleccionados
          </span>
        </div>
      </div>
      <div class="form-section-body">
        <div class="teacher-search-wrap">
          <span class="teacher-search-icon">
            <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
          </span>
          <input type="text" id="teacherSearch" class="f-control" placeholder="Buscar docente por nombre...">
        </div>

        <div class="teacher-list" id="teacherList">
          @forelse($docentes as $docente)
          <label class="teacher-item" id="item_{{ $docente->id }}">
            <input type="checkbox"
                   name="teacher_ids[]"
                   value="{{ $docente->id }}"
                   onchange="toggleTeacher(this)">
            <div class="teacher-avatar">{{ strtoupper(substr($docente->name,0,1)) }}</div>
            <div style="flex:1;min-width:0;">
              <p class="teacher-name">{{ $docente->name }}</p>
              <p class="teacher-email">{{ $docente->email }}</p>
            </div>
            <div class="teacher-role-select">
              <select name="teacher_role_{{ $docente->id }}" onclick="event.stopPropagation()">
                <option value="principal">Principal</option>
                <option value="colaborador" selected>Colaborador</option>
                <option value="invitado">Invitado</option>
              </select>
            </div>
          </label>
          @empty
          <div class="teacher-empty">No hay docentes registrados aún.</div>
          @endforelse
        </div>
      </div>
    </div>

    {{-- ── 3. PROGRAMACIÓN ── --}}
    <div class="form-section">
      <div class="form-section-header">
        <div class="section-icon slate">
          <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        </div>
        <div>
          <p class="section-title">Programación académica</p>
          <p class="section-sub">Fechas, duración y modalidad</p>
        </div>
      </div>
      <div class="form-section-body">
        <div class="f-grid f-grid-4">
          <div>
            <label class="f-label">Fecha de inicio</label>
            <input type="date" name="start_date" class="f-control" value="{{ old('start_date') }}">
          </div>
          <div>
            <label class="f-label">Duración (semanas)</label>
            <input type="number" name="duration_weeks" class="f-control" placeholder="0" value="{{ old('duration_weeks') }}">
          </div>
          <div>
            <label class="f-label">Horas académicas</label>
            <input type="number" name="hours" class="f-control" placeholder="0" value="{{ old('hours') }}">
          </div>
          <div>
            <label class="f-label">Modalidad</label>
            <select name="modality" class="f-control">
              <option value="">Seleccionar</option>
              <option {{ old('modality')=='Virtual en vivo'   ?'selected':'' }}>Virtual en vivo</option>
              <option {{ old('modality')=='Virtual grabado'   ?'selected':'' }}>Virtual grabado</option>
              <option {{ old('modality')=='Presencial'        ?'selected':'' }}>Presencial</option>
              <option {{ old('modality')=='Mixto'             ?'selected':'' }}>Mixto</option>
            </select>
          </div>
        </div>
      </div>
    </div>

    {{-- ── 4. HORARIO ── --}}
    <div class="form-section">
      <div class="form-section-header">
        <div class="section-icon slate">
          <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        </div>
        <div>
          <p class="section-title">Horario del curso</p>
          <p class="section-sub">Días y horas de dictado</p>
        </div>
      </div>
      <div class="form-section-body">
        <div class="f-grid f-grid-3">
          <div>
            <label class="f-label">Días de clase</label>
            <input type="text" name="class_days" class="f-control" placeholder="Ej: Lunes y Miércoles" value="{{ old('class_days') }}">
          </div>
          <div>
            <label class="f-label">Hora de inicio</label>
            <input type="time" name="start_time" class="f-control" value="{{ old('start_time') }}">
          </div>
          <div>
            <label class="f-label">Hora de fin</label>
            <input type="time" name="end_time" class="f-control" value="{{ old('end_time') }}">
          </div>
        </div>
      </div>
    </div>

    {{-- ── 5. COMERCIAL ── --}}
    <div class="form-section">
      <div class="form-section-header">
        <div class="section-icon gold">
          <svg viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
        </div>
        <div>
          <p class="section-title">Configuración comercial</p>
          <p class="section-sub">Tipo de acceso, precios y precio a mostrar al público</p>
        </div>
      </div>
      <div class="form-section-body">

        {{-- Acceso: Gratuito / De pago --}}
        <div style="margin-bottom:16px;max-width:280px;">
          <label class="f-label">Tipo de acceso</label>
          <div class="toggle-group">
            <input type="radio" name="is_paid" id="free" value="0" {{ old('is_paid','0')=='0'?'checked':'' }} onchange="togglePrice(this.value)">
            <label for="free">Gratuito</label>
            <input type="radio" name="is_paid" id="paid" value="1" {{ old('is_paid')=='1'?'checked':'' }} onchange="togglePrice(this.value)">
            <label for="paid">De pago</label>
          </div>
        </div>

        {{-- Campos de precio (sólo si es de pago) --}}
        <div id="priceFields" style="display:none;">

          <div class="f-grid f-grid-3" style="margin-bottom:16px;">
            <div>
              <label class="f-label">Precio regular</label>
              <div class="input-prefix">
                <span class="input-prefix-text" id="currencySymbol">S/</span>
                <input type="number" step="0.01" name="price" id="inputPrice"
                       class="f-control" placeholder="0.00"
                       value="{{ old('price') }}"
                       oninput="updatePricePreview()">
              </div>
            </div>
            <div>
              <label class="f-label">Precio oferta</label>
              <div class="input-prefix">
                <span class="input-prefix-text" id="currencySymbol2">S/</span>
                <input type="number" step="0.01" name="discount_price" id="inputDiscount"
                       class="f-control" placeholder="0.00"
                       value="{{ old('discount_price') }}"
                       oninput="updatePricePreview()">
              </div>
            </div>
            <div>
              <label class="f-label">Moneda</label>
              <select name="currency" id="currencySelect" class="f-control" onchange="updateCurrencySymbols()">
                <option value="PEN" {{ old('currency','PEN')=='PEN'?'selected':'' }}>Soles (PEN)</option>
                <option value="USD" {{ old('currency')=='USD'?'selected':'' }}>Dólares (USD)</option>
              </select>
            </div>
          </div>

          {{-- ★ NUEVO: Precio a mostrar al público --}}
          <div style="border-top:1px solid #f1f5f9;padding-top:16px;">
            <label class="f-label">¿Qué precio se mostrará en la página del curso?</label>
            <div class="toggle-group" style="max-width:340px;">
              <input type="radio" name="price_display" id="disp_regular"  value="regular"  {{ old('price_display','regular')=='regular'  ?'checked':'' }} onchange="updatePricePreview()">
              <label for="disp_regular">Precio regular</label>
              <input type="radio" name="price_display" id="disp_discount" value="discount" {{ old('price_display')=='discount'?'checked':'' }} onchange="updatePricePreview()">
              <label for="disp_discount">Precio oferta</label>
            </div>

            {{-- Vista previa dinámica --}}
            <div class="price-preview-box" id="pricePreviewBox">
              <div class="price-preview-icon">
                <svg viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
              </div>
              <div>
                <p class="price-preview-label">El público verá este precio:</p>
                <p class="price-preview-value" id="previewBigPrice">
                  <span class="currency-sym" id="previewCurrencySym">S/</span><span id="previewAmount">0.00</span>
                </p>
                <p class="price-preview-striked" id="previewStriked" style="display:none;"></p>
              </div>
            </div>
          </div>

        </div>{{-- /priceFields --}}
      </div>
    </div>

    {{-- ── 6. CERTIFICACIÓN ── --}}
    <div class="form-section">
      <div class="form-section-header">
        <div class="section-icon green">
          <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89L17 22l-5-3-5 3 1.523-9.11"/></svg>
        </div>
        <div>
          <p class="section-title">Certificación</p>
          <p class="section-sub">Configuración del certificado de aprobación</p>
        </div>
      </div>
      <div class="form-section-body">
        <div class="f-grid f-grid-3">
          <div>
            <label class="f-label">¿Incluye certificado?</label>
            <div class="toggle-group">
              <input type="radio" name="has_certificate" id="cert_no"  value="0" {{ old('has_certificate','1')=='0'?'checked':'' }}>
              <label for="cert_no">No</label>
              <input type="radio" name="has_certificate" id="cert_yes" value="1" {{ old('has_certificate','1')=='1'?'checked':'' }}>
              <label for="cert_yes">Sí</label>
            </div>
          </div>
          <div>
            <label class="f-label">Tipo de certificado</label>
            <select name="certificate_type" class="f-control">
              <option value="">Seleccionar</option>
              <option {{ old('certificate_type')=='Digital'?'selected':'' }}>Digital</option>
              <option {{ old('certificate_type')=='Físico' ?'selected':'' }}>Físico</option>
              <option {{ old('certificate_type')=='Ambos'  ?'selected':'' }}>Ambos</option>
            </select>
          </div>
        </div>
      </div>
    </div>

    {{-- ── 7. MULTIMEDIA ── --}}
    <div class="form-section">
      <div class="form-section-header">
        <div class="section-icon cyan">
          <svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
        </div>
        <div>
          <p class="section-title">Multimedia</p>
          <p class="section-sub">Imágenes y video promocional</p>
        </div>
      </div>
      <div class="form-section-body">
        <div class="f-grid f-grid-2" style="margin-bottom:14px;">
          <div>
            <label class="f-label">Imagen portada *</label>
            <div class="file-upload-area">
              <div class="upload-wrap">
                <input type="file" name="image" accept="image/*" required onchange="previewFile(this,'prev_image')">
                <div class="file-upload-icon">
                  <svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                </div>
                <p class="file-upload-label">Subir portada</p>
                <p class="file-upload-sub">JPG, PNG – Recomendado 800×500px</p>
                <p class="file-name-preview" id="prev_image"></p>
              </div>
            </div>
          </div>
          <div>
            <label class="f-label">Banner</label>
            <div class="file-upload-area">
              <div class="upload-wrap">
                <input type="file" name="banner" accept="image/*" onchange="previewFile(this,'prev_banner')">
                <div class="file-upload-icon">
                  <svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                </div>
                <p class="file-upload-label">Subir banner</p>
                <p class="file-upload-sub">JPG, PNG – Recomendado 1440×400px</p>
                <p class="file-name-preview" id="prev_banner"></p>
              </div>
            </div>
          </div>
        </div>
        <div>
          <label class="f-label">Video promocional (URL)</label>
          <input type="text" name="promo_video" class="f-control" placeholder="https://youtube.com/watch?v=..." value="{{ old('promo_video') }}">
        </div>
      </div>
    </div>

    {{-- Actions --}}
    <div class="form-actions">
      <a href="{{ url()->previous() }}" class="btn-cancel">Cancelar</a>
      <button type="submit" class="btn-save">
        <svg viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
        Guardar curso
      </button>
    </div>

  </form>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  // CKEditor
  ['#editor-description', '#editor-directed'].forEach(sel => {
    const el = document.querySelector(sel);
    if (el) ClassicEditor.create(el).catch(console.error);
  });

  // Init price visibility
  togglePrice('{{ old('is_paid', '0') }}');
  updatePricePreview();
});

/* ── Visibilidad campos de precio ── */
function togglePrice(val) {
  document.getElementById('priceFields').style.display = val == 1 ? 'block' : 'none';
  updatePricePreview();
}

/* ── Actualiza símbolo de moneda en los dos prefijos ── */
function updateCurrencySymbols() {
  const sym = document.getElementById('currencySelect').value === 'USD' ? 'US$' : 'S/';
  document.getElementById('currencySymbol').textContent  = sym;
  document.getElementById('currencySymbol2').textContent = sym;
  document.getElementById('previewCurrencySym').textContent = sym;
  updatePricePreview();
}

/* ── Vista previa dinámica del precio público ── */
function updatePricePreview() {
  const isDiscount = document.getElementById('disp_discount') &&
                     document.getElementById('disp_discount').checked;

  const price    = parseFloat(document.getElementById('inputPrice')?.value)    || 0;
  const discount = parseFloat(document.getElementById('inputDiscount')?.value) || 0;
  const sym      = document.getElementById('previewCurrencySym')?.textContent || 'S/';

  const shown  = isDiscount ? discount : price;
  const struck = isDiscount && price > 0 ? price : null;

  const amountEl  = document.getElementById('previewAmount');
  const strikedEl = document.getElementById('previewStriked');
  if (!amountEl) return;

  amountEl.textContent = shown > 0 ? shown.toFixed(2) : '0.00';

  if (struck) {
    strikedEl.textContent = 'Antes: ' + sym + struck.toFixed(2);
    strikedEl.style.display = 'block';
  } else {
    strikedEl.style.display = 'none';
  }
}

/* ── Docentes ── */
function toggleTeacher(checkbox) {
  const item = checkbox.closest('.teacher-item');
  item.classList.toggle('selected', checkbox.checked);
  updateTeacherCount();
}

function updateTeacherCount() {
  const count = document.querySelectorAll('#teacherList input[type="checkbox"]:checked').length;
  const badge = document.getElementById('teacherCountBadge');
  document.getElementById('teacherCountNum').textContent = count;
  badge.style.display = count > 0 ? 'inline-flex' : 'none';
}

document.getElementById('teacherSearch').addEventListener('input', function () {
  const q = this.value.toLowerCase();
  document.querySelectorAll('.teacher-item').forEach(item => {
    const name = item.querySelector('.teacher-name').textContent.toLowerCase();
    item.style.display = name.includes(q) ? '' : 'none';
  });
});

/* ── Archivos ── */
function previewFile(input, previewId) {
  const preview = document.getElementById(previewId);
  if (input.files && input.files[0]) {
    preview.textContent = '✓ ' + input.files[0].name;
    preview.style.display = 'block';
  }
}
</script>
@endpush

@endsection