<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Stripe\Stripe;
use Stripe\Charge;
use App\Models\Order;
use App\Models\Checkout;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
        ]);


        Session::put('checkout_data', value: $data);

        return redirect()->route('checkout.stripe');
    }

    public function stripe()
    {
        return view('stripe');
    }

    public function charge(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $checkoutData = Session::get('checkout_data');
        $cart = Session::get('cart', []);

        $totalAmount = 0;

        
        foreach ($cart as $productId => $item) {
            if (isset($item['price']) && isset($item['quantity'])) {
                $totalAmount += $item['price'] * $item['quantity'];
            }
        }

        $totalAmountInCents = $totalAmount * 100;

        if ($totalAmountInCents < 1) {
            return back()->with('error', 'The total amount must be greater than or equal to $1.');
        }

        try {

            $charge = Charge::create([
                'amount' => $totalAmountInCents,
                'currency' => 'usd',
                'description' => 'Order Payment',
                'source' => $request->stripeToken,
            ]);


            $order = Checkout::create([
                'name' => $checkoutData['name'],
                'email' => $checkoutData['email'],
                'phone' => $checkoutData['phone'],
                'address' => $checkoutData['address'],
                'amount' => $totalAmount,
                'status' => 'paid',
            ]);


            foreach ($cart as $productId => $item) {
                //dd($productId, $item);
                \App\Models\Order::create([
                    'order_id' => $order->id,
                    'product_id' => (int) $productId,
                    'payment_method' => 'stripe',
                    'payment_status' => 'completed',
                    'transaction_id' => $charge->id,
                    'total_amount' => $item['price'] * $item['quantity'],
                ]);
            }


            Session::forget('checkout_data');
            Session::forget('cart');

            return redirect()->route('checkout.success')->with('success', 'Payment successful!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }


    public function success()
    {
        return view('success');
    }

}
