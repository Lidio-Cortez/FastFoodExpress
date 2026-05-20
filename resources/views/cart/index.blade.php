@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="page-title">O Seu Carrinho</h2>

    @if(empty($items))
        <div class="empty-cart">
            <p>O seu carrinho está vazio.</p>
            <a href="{{ route('products.index') }}" class="btn-primary">Ver Menu</a>
        </div>
    @else
        <div class="cart-layout">
            <div class="cart-items">
                @foreach($items as $item)
                    <div class="cart-row" id="cart-item-{{ $item['product']->id }}">
                        <div class="cart-item-info">
                            <span class="cart-item-name">{{ $item['product']->name }}</span>
                            <span class="cart-item-price">{{ $item['product']->price }} Kz cada</span>
                        </div>
                        <div class="cart-item-controls">
                            <button class="qty-btn" onclick="removeFromCart({{ $item['product']->id }})">−</button>
                            <span class="qty-num" id="qty-{{ $item['product']->id }}">{{ $item['quantity'] }}</span>
                            <button class="qty-btn" onclick="addToCart({{ $item['product']->id }}, '{{ $item['product']->name }}')">+</button>
                        </div>
                        <span class="cart-item-subtotal" id="sub-{{ $item['product']->id }}">
                            {{ number_format($item['subtotal'], 2, ',', '.') }} Kz
                        </span>
                    </div>
                @endforeach
            </div>

            <div class="cart-summary">
                <div class="summary-row total-row">
                    <span>Total</span>
                    <span class="total-price">{{ number_format($total, 2, ',', '.') }} Kz</span>
                </div>
                <a href="{{ route('orders.checkout') }}" class="btn-primary btn-block">Finalizar Pedido</a>
                <form action="{{ route('cart.clear') }}" method="POST" style="margin-top:8px;">
                    @csrf
                    <button type="submit" class="btn-ghost btn-block">Limpar Carrinho</button>
                </form>
            </div>
        </div>
    @endif
</div>
@endsection
