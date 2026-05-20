@extends('layouts.app')

@section('content')
<div class="container">
    <div class="confirmation-box">
        <div class="confirmation-icon">✓</div>
        <h2>Pedido Confirmado!</h2>
        <p>Obrigado, <strong>{{ $order->customer_name }}</strong>!</p>
        <p>O seu pedido <strong>#{{ $order->id }}</strong> foi recebido e está a ser preparado.</p>
        <div class="order-detail">
            <div>📍 Entrega para: {{ $order->customer_address }}</div>
            <div>📞 Contacto: {{ $order->customer_phone }}</div>
            <div>💰 Total: {{ number_format($order->total, 2, ',', '.') }} Kz</div>
        </div>
        <a href="{{ route('products.index') }}" class="btn-primary" style="margin-top:1.5rem;display:inline-block;">
            Voltar ao Menu
        </a>
    </div>
</div>
@endsection
