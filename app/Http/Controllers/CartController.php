<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Course;
use Illuminate\Http\Request;

class CartController extends Controller
{

    // public function addToCart(Course $course)
    // {
    //     $cart = Cart::firstOrCreate([
    //         'session_id' => session()->getId(),
    //         'user_id' => auth()->user() ? auth()->user() : null,
    //     ]);

    //     if ($cart->courses->contains($course->id)) {
    //         return response()->json(['error' => 'Course is already in your cart']);
    //     }

    //     $cart->courses()->syncWithoutDetaching($course);
    //     // Refresh the relationship to include the newly attached course
    //     $cart->load('courses');

    //     return response()->json([
    //         'success' => 'Successfully Added on Your Cart',
    //         'course' => [
    //             'id' => $course->id,
    //             'name' => $course->name,
    //             'price' => $course->discount_price ?? $course->selling_price,
    //             'image' => $course->getFirstMediaUrl('courses_images'),
    //             'slug' => $course->slug,
    //             'instructor' => $course->instructor,
    //             'quantity' => 1, // Default quantity set to 1
    //         ],

    //         'total_price' => $cart->totalPrice(),
    //         'cart_count' => $cart->courses()->count(),

    //     ]);
    // }

    public function addToCart(Course $course)
    {
        $cart = Cart::firstOrCreate([
            'session_id' => session()->getId(),
            'user_id' => auth()->user()?->id,
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
}
