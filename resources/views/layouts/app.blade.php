<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PalancaFood</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
   <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
</head>
<body>

<header class="header">
    <div class="container header-inner">
        <div class="brand">
            <div class="brand-logo"><img width="65px" height="65px" src="{{ asset('images/Palanca.png') }}" alt="Logo"></div>
            <div>
                <div class="brand-name">SapemuaFood</div>
                <div class="brand-tagline">Entrega rápida e saborosa</div>
            </div>
        </div>
        <a href="{{ route('cart.index') }}" class="cart-btn">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/>
                <path d="M16 10a4 4 0 0 1-8 0"/>
            </svg>
            Carrinho
            <span class="cart-count" id="cart-count">{{ array_sum(session('cart', [])) }}</span>
        </a>
    </div>
</header>

<main>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    @yield('content')
</main>

<div class="toast" id="toast"></div>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
