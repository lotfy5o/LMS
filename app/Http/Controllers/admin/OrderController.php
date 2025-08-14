<?php

namespace App\Http\Controllers\Admin;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function PendingOrders()
    {
        $payments = Payment::where('status', 'pending')->orderBy('id', 'DESC')->get();
        return view('admin.orders.pending-orders', get_defined_vars());
    }

    public function ConfirmedOrders()
    {
        $payments = Payment::where('status', 'paid')->orderBy('id', 'DESC')->get();
        return view('admin.orders.confirmed-orders', get_defined_vars());
    }


    public function OrderDetails($payment_id)
    {
        $payment = Payment::with('user')->findOrFail($payment_id);
        $order = $payment->order;
        $total_price = $order->courses->sum('discount_price');
        return view('admin.orders.order-details', get_defined_vars());
    }

    public function ConfirmOrder($payment_id)
    {
        $payment = Payment::findOrFail($payment_id);
        $payment->status = 'paid';
        $payment->save();

        $notification = array(
            'message' => 'Order Confrim Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
