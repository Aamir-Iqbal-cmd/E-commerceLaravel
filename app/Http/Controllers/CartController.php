<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{

    public function addToCart(Request $request)
    {

        $request->validate([
            'product_id' => 'required|integer',
            'product_title' => 'required|string|max:255',
            'product_price' => 'required|numeric|min:0.01',
            'product_image' => 'required|string|max:255',
        ]);

        $product = [
            'id' => $request->input('product_id'),
            'title' => $request->input('product_title'),
            'price' => $request->input('product_price'),
            'image' => $request->input('product_image'),
            'quantity' => 1,
        ];

        $cart = session()->get('cart', []);

        if (isset($cart[$product['id']])) {
            $cart[$product['id']]['quantity']++;
        } else {

            $cart[$product['id']] = $product;
        }


        session()->put('cart', $cart);

        return redirect()->route('cart.view')->with('success', 'Product added to cart successfully!');
    }

    public function viewCart()
    {

        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }

    public function removeFromCart($id)
{

    $cart = session()->get('cart');

    if (isset($cart[$id])) {

        unset($cart[$id]);


        session()->put('cart', $cart);
    }

    return redirect()->route('cart.view')->with('success', 'Product removed from cart successfully!');
}

}
