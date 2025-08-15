<?php

namespace App\Http\Controllers\instructor;

use Barryvdh\DomPDF\Facade\Pdf;
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
        })->latest()->get();

        return view('instructor.orders.index', get_defined_vars());
    }

    public function OrderDetails($payment_id)
    {
        $payment = Payment::with('user')->findOrFail($payment_id);
        $order = $payment->order;
        $instructorId = Auth::user()->id;
        $courses = $order->courses()->where('courses.instructor_id', $instructorId)->get();
        $total_price = number_format($courses->sum('discount_price') ?? $courses->sum('selling_price'), 2, '.', '');

        return view('instructor.orders.order-details', get_defined_vars());
    }

    public function OrderInvoice($payment_id)
    {
        $payment = Payment::with('user')->findOrFail($payment_id);
        $order = $payment->order;
        $instructorId = Auth::user()->id;
        $courses = $order->courses()->where('courses.instructor_id', $instructorId)->get();
        $total_price = number_format($courses->sum('discount_price') ?? $courses->sum('selling_price'), 2, '.', '');

        $pdf = PDF::loadView('instructor.orders.order-invoice', get_defined_vars())->setPaper('a4', 'portrait');
        return $pdf->download('invoice' . $order->id . '.pdf');
    }
}
