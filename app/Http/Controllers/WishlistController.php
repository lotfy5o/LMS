<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class WishlistController extends Controller
{

    public function toggleWishlist(Request $request)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return response()->json(['error' => 'Please log in to add courses to your wishlist.'], 401);
        }

        // Get the course_id from the request
        $courseId = $request->input('course_id');

        // Validate that course_id is provided and is a valid number
        if (!$courseId || !is_numeric($courseId)) {
            return response()->json(['error' => 'Invalid course ID provided.'], 400);
        }

        try {
            $user = Auth::user();

            // Check if the course exists
            $course = Course::find($courseId);
            if (!$course) {
                return response()->json(['error' => 'Course not found.'], 404);
            }

            // Check if the course is already in the user's wishlist
            if ($user->wishListedCourses()->where('course_id', $courseId)->exists()) {
                $user->wishListedCourses()->detach($courseId);
                return response()->json(['success' => 'Successfully removed course from your wishlist.']);
            } else {
                $user->wishListedCourses()->attach($courseId);
                return response()->json(['success' => 'Successfully added course to your wishlist.']);
            }
        } catch (\Exception $e) {
            // Log the exception for debugging
            Log::error('Error adding course to wishlist: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong. Please try again later.'], 500);
        }
    }


    public function AllWishlist()
    {
        return view('frontend.dashboard.all-wishlists');
    }

    public function GetWishListedCourses()
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Please log in to add courses to your wishlist.'], 401);
        }

        $user = Auth::user();
        $wishlist = $user->wishListedCourses()->with('category')->get();

        $wishlistData = $wishlist->map(function ($value) {
            return [
                'id' => $value->id,
                'name' => $value->name,
                'label' => $value->label,
                'selling_price' => $value->selling_price,
                'discount_price' => $value->discount_price,
                'category' => $value->category,
                'image' => $value->getFirstMediaUrl('courses_images'),
            ];
        });
        return response()->json(['wishlistedCourses' => $wishlistData]);
    }

    public function removeWishlist($courseId)
    {
        $user = Auth::user();

        $user->wishListedCourses()->detach($courseId);
        return response()->json(['success' => 'Remove Course From Wishlist Successfully']);
    }
}
