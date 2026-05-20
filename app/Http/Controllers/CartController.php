<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $items = [];
        $total = 0;

        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product) {
                $subtotal = $product->price * $quantity;
                $total += $subtotal;
                $items[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'subtotal' => $subtotal,
                ];
            }
        }

        return view('cart.index', compact('items', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $cart = session('cart', []);
        $cart[$product->id] = ($cart[$product->id] ?? 0) + 1;
        session(['cart' => $cart]);

        return response()->json([
            'success' => true,
            'cartCount' => array_sum($cart),
            'message' => $product->name . ' adicionado ao carrinho!',
        ]);
    }

    public function remove(Request $request, Product $product)
    {
        $cart = session('cart', []);

        if (isset($cart[$product->id])) {
            if ($cart[$product->id] > 1) {
                $cart[$product->id]--;
            } else {
                unset($cart[$product->id]);
            }
        }

        session(['cart' => $cart]);

        return response()->json([
            'success' => true,
            'cartCount' => array_sum($cart),
        ]);
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'Carrinho limpo!');
    }

    public function count()
    {
        $cart = session('cart', []);
        return response()->json(['count' => array_sum($cart)]);
    }
}
