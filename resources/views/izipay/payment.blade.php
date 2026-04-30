@extends('layouts.checkout')

@push('styles')
<style>
    /* ═══════════════════════════════════════
       PAGE
    ═══════════════════════════════════════ */
    .checkout-page {
        min-height: 100vh;
        background: linear-gradient(145deg, #071828 0%, #0B2C4D 55%, #0d3d6b 100%);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 40px 16px;
        position: relative;
        overflow: hidden;
    }

    /* Círculos decorativos de fondo */
    .checkout-page::before {
        content: '';
        position: absolute;
        top: -120px;
        right: -120px;
        width: 420px;
        height: 420px;
        border-radius: 50%;
        background: rgba(0,180,230,.06);
        pointer-events: none;
    }

    .checkout-page::after {
        content: '';
        position: absolute;
        bottom: -100px;
        left: -100px;
        width: 340px;
        height: 340px;
        border-radius: 50%;
        background: rgba(201,162,77,.05);
        pointer-events: none;
    }

    /* ── Marca top ── */
    .checkout-brand {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 32px;
        text-decoration: none;
        position: relative;
        z-index: 2;
    }

    .checkout-brand img {
        height: 32px;
        opacity: .85;
    }

    .checkout-brand-name {
        font-family: 'Montserrat', sans-serif;
        font-size: 16px;
        font-weight: 800;
        color: rgba(255,255,255,.85);
        letter-spacing: -.2px;
    }

    .checkout-brand-sep {
        width: 1px;
        height: 18px;
        background: rgba(255,255,255,.2);
    }

    .checkout-brand-sub {
        font-size: 12px;
        font-weight: 600;
        color: rgba(255,255,255,.4);
        letter-spacing: .5px;
    }

    /* ═══════════════════════════════════════
       CARD PRINCIPAL
    ═══════════════════════════════════════ */
    .checkout-card {
        background: #ffffff;
        border-radius: 24px;
        box-shadow: 0 32px 80px rgba(0,0,0,.35);
        width: 100%;
        max-width: 460px;
        overflow: hidden;
        position: relative;
        z-index: 2;
    }

    /* ── HEADER de la card ── */
    .checkout-card-header {
        background: linear-gradient(110deg, #061828 0%, #0B2C4D 100%);
        padding: 30px 32px 28px;
        position: relative;
        overflow: hidden;
    }

    /* Barra de color top */
    .checkout-card-header::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
        background: linear-gradient(90deg, #00B4E6, #C9A24D, #00B4E6);
    }

    /* Ícono SSL */
    .checkout-lock-wrap {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: rgba(0,180,230,.15);
        border: 1px solid rgba(0,180,230,.3);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 14px;
        font-size: 18px;
        color: #00B4E6;
    }

    .checkout-card-header h5 {
        font-family: 'Montserrat', sans-serif;
        font-size: 17px;
        font-weight: 800;
        color: #fff;
        margin: 0 0 5px;
    }

    .checkout-card-header p {
        font-size: 12.5px;
        color: rgba(255,255,255,.45);
        margin: 0;
    }

    /* ── CUERPO ── */
    .checkout-card-body {
        padding: 30px 32px 28px;
    }

    /* Fila del monto */
    .checkout-amount-row {
        background: #F4F8FC;
        border: 1.5px solid #dde8f5;
        border-radius: 14px;
        padding: 16px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 26px;
    }

    .checkout-amount-label {
        font-size: 12px;
        font-weight: 700;
        letter-spacing: .8px;
        text-transform: uppercase;
        color: #64748b;
        margin-bottom: 3px;
    }

    .checkout-course-name {
        font-family: 'Montserrat', sans-serif;
        font-size: 13.5px;
        font-weight: 700;
        color: #0B2C4D;
        max-width: 220px;
        line-height: 1.35;
    }

    .checkout-amount-price {
        text-align: right;
        flex-shrink: 0;
    }

    .checkout-amount-currency {
        font-size: 12px;
        font-weight: 600;
        color: #94a3b8;
        display: block;
        margin-bottom: 1px;
    }

    .checkout-amount-value {
        font-family: 'Montserrat', sans-serif;
        font-size: 26px;
        font-weight: 900;
        color: #0B2C4D;
        line-height: 1;
    }

    /* Divisor */
    .checkout-divider {
        height: 1px;
        background: #e8eef5;
        margin: 0 0 22px;
        border: none;
    }

    /* Etiqueta de sección */
    .checkout-section-label {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1.2px;
        text-transform: uppercase;
        color: #94a3b8;
        margin-bottom: 14px;
    }

    /* ── Formulario IziPay ── */
    .kr-embedded {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .kr-payment-button {
        background: linear-gradient(135deg, #00B4E6, #0B2C4D) !important;
    font-size: 15px !important;
    letter-spacing: .5px !important;
        border-radius: 50px !important;
        height: 50px !important;
        font-family: 'Montserrat', sans-serif !important;
        font-weight: 700 !important;
        box-shadow: 0 6px 20px rgba(11,44,77,.35) !important;
        transition: all .25s ease !important;
        border: none !important;
    }

    .kr-payment-button:hover {
        background: linear-gradient(135deg, #143d67, #00B4E6) !important;
        box-shadow: 0 8px 26px rgba(11,44,77,.45) !important;
        transform: translateY(-1px) !important;
    }

    .kr-form-error {
        color: #dc2626 !important;
        font-size: 12px !important;
        background: #fef2f2 !important;
        border: 1px solid #fecaca !important;
        border-radius: 8px !important;
        padding: 8px 12px !important;
    }

    /* ── Footer info ── */
    .checkout-footer-info {
        margin-top: 22px;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 12px;
    }

    .checkout-ssl-badge {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        font-size: 12px;
        font-weight: 600;
        color: #64748b;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 30px;
        padding: 6px 14px;
    }

    .checkout-ssl-badge .ssl-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #16a34a;
        box-shadow: 0 0 0 3px rgba(22,163,74,.15);
    }

    .checkout-cards {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .checkout-cards .c-badge {
        background: #f1f5f9;
        border: 1px solid #e2e8f0;
        border-radius: 7px;
        padding: 5px 12px;
        font-size: 11px;
        font-weight: 700;
        color: #475569;
        display: flex;
        align-items: center;
        gap: 5px;
        transition: border-color .2s;
    }

    .checkout-cards .c-badge:hover {
        border-color: #00B4E6;
    }

    /* ── Volver al curso ── */
    .checkout-back {
        margin-top: 28px;
        position: relative;
        z-index: 2;
    }

    .checkout-back a {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        font-size: 13px;
        font-weight: 600;
        color: rgba(255,255,255,.45);
        text-decoration: none;
        font-family: 'Montserrat', sans-serif;
        transition: color .2s ease;
    }

    .checkout-back a:hover {
        color: rgba(255,255,255,.8);
    }

    /* ── Responsive ── */
    @media (max-width: 500px) {
        .checkout-card-header  { padding: 24px 22px 20px; }
        .checkout-card-body    { padding: 24px 22px 22px; }
        .checkout-amount-value { font-size: 22px; }
    }
</style>
@endpush

@section('content')

<div class="checkout-page">

    {{-- Marca --}}
    <a href="{{ url('/') }}" class="checkout-brand">
        <img src="{{ asset('Laravel/public/images/logo_blanco.png') }}" alt="ESIPEC">
        <span class="checkout-brand-name">ESIPEC</span>
        <span class="checkout-brand-sep"></span>
        <span class="checkout-brand-sub">Campus Virtual</span>
    </a>

    {{-- Card de pago --}}
    <div class="checkout-card">

        {{-- Header --}}
        <div class="checkout-card-header">
            <div class="checkout-lock-wrap">
                <i class="fas fa-lock"></i>
            </div>
            <h5>Pago seguro</h5>
            <p>Tus datos están protegidos con cifrado SSL</p>
        </div>

        {{-- Body --}}
        <div class="checkout-card-body">

            <hr class="checkout-divider">

            <div class="checkout-section-label">Datos de pago</div>

            {{-- Formulario IziPay --}}
            <div class="kr-embedded"
                kr-form-token="{{ $formToken }}"
                kr-language="es-ES">

                <div class="kr-pan"></div>
                <div class="kr-expiry"></div>
                <div class="kr-security-code"></div>
                <div class="kr-card-holder-name"></div>
                <button class="kr-payment-button"></button>
                <div class="kr-form-error"></div>

            </div>

            {{-- Badges info --}}
            <div class="checkout-footer-info">
                <div class="checkout-ssl-badge">
                    <span class="ssl-dot"></span>
                    Pago procesado por IziPay — Perú
                </div>

                <div class="checkout-cards">
                    <span class="c-badge" style="color:#1a1f71;font-style:italic;">VISA</span>
                    <span class="c-badge">
                        <i class="fab fa-cc-mastercard" style="color:#eb001b;"></i> Mastercard
                    </span>
                    <span class="c-badge">Transferencia</span>
                </div>
            </div>

        </div>
    </div>

    {{-- Volver --}}
    <div class="checkout-back">
        <a href="javascript:history.back()">
            ← Volver al curso
        </a>
    </div>

</div>

<script type="text/javascript"
    src="https://static.micuentaweb.pe/static/js/krypton-client/V4.0/stable/kr-payment-form.min.js"
    kr-public-key="{{ config('services.izipay.key_public_test') }}">
</script>


@endsection