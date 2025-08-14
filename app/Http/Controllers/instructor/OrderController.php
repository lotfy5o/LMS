<?php

namespace App\Http\Controllers\instructor;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $instructorId = Auth::user()->id;

        $orders = Order::whereHas('courses', function ($query) use ($instructorId) {
            $query->where('courses.instructor_id', $instructorId); // fully qualified
        })->get();

        return view('instructor.orders.index', get_defined_vars());
    }

    public function OrderDetails($payment_id)
    {
        $payment = Payment::with('user')->findOrFail($payment_id);
        $order = $payment->order;
        $total_price = $order->courses->sum('discount_price');
        return view('instructor.orders.order-details', get_defined_vars());
    }
}
