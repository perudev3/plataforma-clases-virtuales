<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pago Seguro — {{ config('app.name', 'ESIPEC') }}</title>

    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800&family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --azul:    #0B2C4D;
            --celeste: #00B4E6;
            --dorado:  #C9A24D;
            --gris-bg: #EEF2F7;
        }

        *, *::before, *::after { box-sizing: border-box; }

        body {
            font-family: 'Open Sans', sans-serif;
            background: var(--gris-bg);
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }
        
        /* Inputs Izipay */
.kr-input {
    border: 1.5px solid #dbe3ec !important;
    border-radius: 10px !important;
    height: 48px !important;
    padding: 10px 14px !important;
    font-size: 14px !important;
    transition: all .2s ease !important;
    background: #f9fbfd !important;
}

.kr-input:focus {
    border-color: #00B4E6 !important;
    box-shadow: 0 0 0 3px rgba(0,180,230,.15) !important;
    background: #fff !important;
}

/* Labels */
.kr-label {
    font-size: 11px !important;
    font-weight: 700 !important;
    color: #64748b !important;
    margin-bottom: 4px !important;
}

/* Selects */
.kr-select {
    border-radius: 10px !important;
    height: 48px !important;
}
    </style>

    @stack('styles')
</head>
<body>

    @yield('content')

    @stack('scripts')
</body>
</html>