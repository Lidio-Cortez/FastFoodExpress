<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

// Página principal — menu de produtos
Route::get('/', [ProductController::class, 'index'])->name('products.index');

// Carrinho
Route::get('/carrinho', [CartController::class, 'index'])->name('cart.index');
Route::post('/carrinho/adicionar/{product}', [CartController::class, 'add'])->name('cart.add');
Route::post('/carrinho/remover/{product}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/carrinho/limpar', [CartController::class, 'clear'])->name('cart.clear');
Route::get('/carrinho/total', [CartController::class, 'count'])->name('cart.count');

// Pedidos
Route::get('/checkout', [OrderController::class, 'checkout'])->name('orders.checkout');
Route::post('/pedido', [OrderController::class, 'store'])->name('orders.store');
Route::get('/pedido/{order}/confirmacao', [OrderController::class, 'confirmation'])->name('orders.confirmation');
