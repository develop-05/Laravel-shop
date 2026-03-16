<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;


class CartController extends Controller
{

    public function index()
    {
        $cart = session('cart', []);
        return view('cart', compact('cart'));
    }

    public function add($id)
    {
        $product =  Product::find($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }

        $cart = session('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'id'       => $product->id,
                'name'     => $product->name,
                'price'    => $product->price,
                'quantity' => 1,
                'image'    => $product->image,
            ];
        }
        session(['cart' => $cart]);
        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function remove($id)
    {
        $cart = session('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session(['cart' => $cart]);
        }
        return redirect()->route('cart');
    }

    public function increase($id)
    {
        $cart = session('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
            session(['cart' => $cart]);
        }

        return redirect()->route('cart');
    }

    public function decrease($id)
    {
        $cart = session('cart', []);

        if (isset($cart[$id])) {

            if ($cart[$id]['quantity'] > 1) {
                $cart[$id]['quantity']--;
            } else {
                unset($cart[$id]);
            }
            session(['cart' => $cart]);
        }

        return redirect()->route('cart');
    }

    public function confirm()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->back();
        }

        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $order = Order::create([
            'total' => $total
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('cart')->with('success', 'Order confirmed!');
    }
}
