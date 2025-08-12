<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Course;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    public function addToCart(Course $course)
    {
        $cart = Cart::firstOrCreate([
            'session_id' => session()->getId(),
            'user_id' => auth()->id() ? auth()->id() : null,
        ]);

        if ($cart->courses->contains($course->id)) {
            return response()->json(['error' => 'Course is already in your cart']);
        }

        $cart->courses()->syncWithoutDetaching($course);

        return response()->json(['success' => 'Successfully Added to Your Cart']);
    }

    public function removeFromCart(Course $course)
    {
        $cart = Cart::session()->first();

        if ($cart) {
            $cart->courses()->detach($course);
            return response()->json(['success' => 'Successfully Removed from Your Cart']);
        }

        return response()->json(['error' => 'Cart not found'], 404);
    }

    public function fetchCartData()
    {
        $cart = Cart::firstOrCreate([
            'session_id' => session()->getId(),
            'user_id' => auth()->user()?->id,
        ]);

        $cart->load('courses.instructor');

        $courses = $cart->courses->map(function ($course) {
            return [
                'id' => $course->id,
                'name' => $course->name,
                'price' => $course->discount_price ?? $course->selling_price,
                'image' => $course->getFirstMediaUrl('courses_images'),
                'slug' => $course->slug,
                'instructor' => $course->instructor,
                'quantity' => 1
            ];
        });

        return response()->json([
            'courses' => $courses,
            'total_price' => $cart->totalPrice(),
            'cart_count' => $cart->courses->count(),
        ]);
    }

    public function myCart()
    {
        return view('frontend.cart.index');
    }

    public function CouponApply(Request $request)
    {
        $coupon = Coupon::where('name', $request->coupon_name)
            ->where('validity', '>=', Carbon::now()->format('Y-m-d'))
            ->first();

        $cart = Cart::session()->first();

        if (!$coupon) {
            return response()->json(['error' => 'Invalid or expired coupon'], 404);
        }

        if (!$cart) {
            return response()->json(['error' => 'Cart not found'], 404);
        }

        $discount_amount = round($cart->totalPrice() * ($coupon->discount / 100), 2);
        $total_amount = $cart->totalPrice() - $discount_amount;

        Session::put('coupon', [
            'coupon_name' => $coupon->name,
            'discount' => $coupon->discount,
            'discount_amount' => $discount_amount,
            'total_amount' => $total_amount,
        ]);

        return response()->json([
            'validity' => true,
            'success' => 'Coupon applied successfully',
            'coupon_name' => $coupon->name,
            'discount_amount' => $discount_amount,
            'total_amount' => $total_amount,
        ]);
    }

    public function CouponRemove()
    {
        if (session()->has('coupon')) {
            session()->forget('coupon');

            // Get the current cart and calculate total amount
            $cart = Cart::session()->first();
            $total_amount = $cart ? $cart->totalPrice() : 0;

            session()->put('total_amount', $total_amount);

            return response()->json([
                'success' => 'Coupon removed successfully!',
                'total_amount' => $total_amount,
            ]);
        } else {
            return response()->json([
                'error' => 'No coupon found to remove.',
            ]);
        }
    }
}
