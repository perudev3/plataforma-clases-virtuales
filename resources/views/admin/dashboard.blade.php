@extends('layouts.app')
@section('content')

<style>
  .dash-page {
    padding: 28px 28px 40px;
    max-width: 960px;
  }

  .dash-header {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    margin-bottom: 1.75rem;
    flex-wrap: wrap;
    gap: 10px;
  }
  .dash-title {
    font-family: 'Montserrat', sans-serif;
    font-size: 22px;
    font-weight: 800;
    color: #0B2C4D;
    margin: 0;
    letter-spacing: -0.3px;
  }
  .dash-subtitle {
    font-size: 12px;
    color: #64748b;
    margin: 3px 0 0;
    font-family: 'Open Sans', sans-serif;
  }
  .badge-admin {
    background: #0B2C4D;
    color: #C9A24D;
    font-size: 10px;
    font-weight: 700;
    font-family: 'Montserrat', sans-serif;
    letter-spacing: 1px;
    text-transform: uppercase;
    padding: 4px 10px;
    border-radius: 4px;
  }

  /* ── Stats ── */
  .stats-row {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 12px;
    margin-bottom: 2rem;
  }
  .stat-card {
    background: #F0F3F7;
    border-radius: 10px;
    padding: 14px 16px;
  }
  .stat-label {
    font-size: 11px;
    font-family: 'Montserrat', sans-serif;
    font-weight: 600;
    letter-spacing: 0.4px;
    color: #64748b;
    margin: 0 0 5px;
    text-transform: uppercase;
  }
  .stat-value {
    font-size: 28px;
    font-weight: 800;
    font-family: 'Montserrat', sans-serif;
    color: #0B2C4D;
    margin: 0;
    line-height: 1;
  }
  .stat-value.cyan  { color: #00B4E6; }
  .stat-value.gold  { color: #C9A24D; }

  /* ── Section label ── */
  .section-label {
    font-family: 'Montserrat', sans-serif;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 1.2px;
    text-transform: uppercase;
    color: #94a3b8;
    margin: 0 0 14px;
  }

  /* ── Module cards ── */
  .cards-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 14px;
  }
  .mod-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 18px;
    display: flex;
    flex-direction: column;
    gap: 10px;
    transition: border-color 0.2s, box-shadow 0.2s;
  }
  .mod-card:hover {
    border-color: rgba(11,44,77,0.3);
    box-shadow: 0 4px 16px rgba(11,44,77,0.07);
  }
  .mod-icon {
    width: 38px;
    height: 38px;
    border-radius: 9px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }
  .mod-icon.navy { background: #0B2C4D; }
  .mod-icon.cyan { background: #00B4E6; }
  .mod-icon.gold { background: #C9A24D; }
  .mod-icon svg {
    width: 18px;
    height: 18px;
    fill: none;
    stroke: #fff;
    stroke-width: 2;
    stroke-linecap: round;
    stroke-linejoin: round;
  }
  .mod-title {
    font-family: 'Montserrat', sans-serif;
    font-size: 14px;
    font-weight: 700;
    color: #0B2C4D;
    margin: 0;
  }
  .mod-desc {
    font-size: 12px;
    color: #64748b;
    margin: 0;
    line-height: 1.5;
    font-family: 'Open Sans', sans-serif;
    flex: 1;
  }
  .mod-actions {
    display: flex;
    flex-direction: column;
    gap: 7px;
  }
  .btn-nav {
    border-radius: 7px;
    padding: 8px 12px;
    font-size: 12px;
    font-family: 'Montserrat', sans-serif;
    font-weight: 700;
    text-align: center;
    text-decoration: none;
    display: block;
    transition: background 0.15s, color 0.15s;
  }
  .btn-nav.primary {
    background: #0B2C4D;
    color: #fff;
    border: none;
  }
  .btn-nav.primary:hover { background: #0e3860; color: #fff; }
  .btn-nav.outline {
    background: transparent;
    color: #0B2C4D;
    border: 1.5px solid #0B2C4D;
  }
  .btn-nav.outline:hover { background: rgba(11,44,77,0.06); color: #0B2C4D; }

  /* ── Divider ── */
  .dash-divider {
    height: 1px;
    background: #e2e8f0;
    margin: 1.75rem 0 1.5rem;
  }

  /* ── Quick actions ── */
  .quick-row {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
  }
  .quick-btn {
    background: #F0F3F7;
    border: 1px solid #e2e8f0;
    border-radius: 7px;
    padding: 7px 14px;
    font-size: 12px;
    font-family: 'Montserrat', sans-serif;
    font-weight: 600;
    color: #1e293b;
    text-decoration: none;
    transition: border-color 0.15s;
    display: inline-flex;
    align-items: center;
    gap: 6px;
  }
  .quick-btn:hover { border-color: rgba(11,44,77,0.35); color: #0B2C4D; text-decoration: none; }
  .status-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: #3B6D11;
    display: inline-block;
    flex-shrink: 0;
  }

  /* ── Responsive ── */
  @media (max-width: 767px) {
    .dash-page   { padding: 20px 16px 32px; }
    .stats-row   { grid-template-columns: repeat(2, 1fr); }
  }
  @media (max-width: 479px) {
    .stats-row   { grid-template-columns: 1fr 1fr; }
    .cards-grid  { grid-template-columns: 1fr; }
    .dash-title  { font-size: 18px; }
  }
</style>

<div class="dash-page">

  {{-- Header --}}
  <div class="dash-header">
    <div>
      <h1 class="dash-title">Panel Administrador</h1>
      <p class="dash-subtitle">Campus Virtual · ESIPEC</p>
    </div>
    <span class="badge-admin">Admin</span>
  </div>

  {{-- Módulos --}}
  <p class="section-label">Módulos</p>
  <div class="cards-grid">

    <div class="mod-card">
      <div class="mod-icon navy">
        <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
      </div>
      <p class="mod-title">Docentes</p>
      <p class="mod-desc">Registrar, editar y administrar el equipo docente.</p>
      <div class="mod-actions">
        <a href="{{ route('docentes.index') }}" class="btn-nav primary">Gestionar docentes</a>
      </div>
    </div>

    <div class="mod-card">
      <div class="mod-icon cyan">
        <svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>
      </div>
      <p class="mod-title">Cursos</p>
      <p class="mod-desc">Administrar catálogo de cursos y crear nuevos contenidos.</p>
      <div class="mod-actions">
        <a href="{{ route('courses.create') }}" class="btn-nav primary">Crear curso</a>
        <a href="{{ route('courses.index') }}" class="btn-nav outline">Ver todos los cursos</a>
      </div>
    </div>

  </div>

  <div class="dash-divider"></div>

  {{-- Acciones rápidas --}}
  <p class="section-label">Acciones rápidas</p>
  <div class="quick-row">
    <a href="{{ route('courses.create') }}" class="quick-btn">+ Nuevo curso</a>
    <a href="{{ route('docentes.index') }}" class="quick-btn">+ Nuevo docente</a>
    <span class="quick-btn"><span class="status-dot"></span>Sistema activo</span>
  </div>

</div>
@endsection