<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to access the checkout page.');
        }

        $cart = Cart::with('courses')->session()->first();

        if (!$cart || $cart->totalPrice() <= 0) {
            return redirect()->route('myCart')->with('error', 'Your cart is empty. Please add items to your cart before proceeding to checkout.');
        }


        return view('frontend.checkout.index', get_defined_vars());
    }
}
