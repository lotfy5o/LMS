<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use App\Mail\OrderConfirm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function processDirectPayment(Request $request)
    {

        $cart = Cart::session()->first();

        if (!$cart || $cart->courses->isEmpty()) {
            $notification = [
                'message' => 'Your cart is empty.',
                'alert-type' => 'error'
            ];
            return redirect()->route('index')->with($notification);
        }

        if (Session::has('coupon')) {
            $total_amount = Session::get('coupon')['total_amount'];
        } else {
            $total_amount = $cart->totalPrice();
        }

        $payment = Payment::create([
            'user_id'        => Auth::id(),
            'payment_method' => 'cash_on_delivery',
            'total_amount'   => $total_amount,
            'invoice_no'     => 'EOS' . mt_rand(10000000, 99999999),
            'status'         => 'pending',
        ]);

        // foreach ($cart->courses as $course) {

        //     $existingOrder = Order::where('user_id', Auth::user()->id)->where('course_id', $course->id)->first();

        //     if ($existingOrder) {

        //         $notification = array(
        //             'message' => 'You Have already enrolled in this course',
        //             'alert-type' => 'error'
        //         );
        //         return redirect()->back()->with($notification);
        //     } // end if 

        $order = Order::create([
            'user_id' => Auth::id(),
            'payment_id' => $payment->id,
        ]);

        $order->courses()->attach($cart->courses->pluck('id'));

        $cart->delete();
        Session::forget('coupon');

        // send email with array of payment details
        Mail::to(Auth::user()->email)->send(new OrderConfirm($payment));

        if ($request->payment_method == 'stripe') {
            echo "stripe";
        } else {

            $notification = array(
                'message' => 'Cash Payment Submit Successfully',
                'alert-type' => 'success'
            );


            return redirect()->route('index')->with($notification);
        }
    }
}
