<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function checkout()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('products.index')->with('error', 'O seu carrinho está vazio.');
        }

        $items = [];
        $total = 0;

        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product) {
                $subtotal = $product->price * $quantity;
                $total += $subtotal;
                $items[] = ['product' => $product, 'quantity' => $quantity, 'subtotal' => $subtotal];
            }
        }

        return view('cart.checkout', compact('items', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name'    => 'required|string|max:255',
            'customer_phone'   => 'required|string|max:20',
            'customer_address' => 'required|string|max:500',
            'notes'            => 'nullable|string|max:500',
        ]);

        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('products.index')->with('error', 'O seu carrinho está vazio.');
        }

        $total = 0;
        $orderItems = [];

        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product) {
                $total += $product->price * $quantity;
                $orderItems[] = [
                    'product_id' => $product->id,
                    'quantity'   => $quantity,
                    'unit_price' => $product->price,
                ];
            }
        }

        $order = Order::create([
            'customer_name'    => $request->customer_name,
            'customer_phone'   => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'notes'            => $request->notes,
            'total'            => $total,
            'status'           => 'pending',
        ]);

        foreach ($orderItems as $item) {
            $order->items()->create($item);
        }

        session()->forget('cart');

        return redirect()->route('orders.confirmation', $order)->with('success', 'Pedido realizado com sucesso!');
    }

    public function confirmation(Order $order)
    {
        return view('cart.confirmation', compact('order'));
    }
}
