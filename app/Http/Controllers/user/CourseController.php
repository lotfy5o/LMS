<?php

namespace App\Http\Controllers\user;

use App\Models\Order;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();

        $mycourse = Order::where('orders.user_id', $user_id)
            ->join('course_order', 'orders.id', '=', 'course_order.order_id')
            ->join('courses', 'course_order.course_id', '=', 'courses.id')
            ->select('courses.*', DB::raw('MAX(orders.created_at) as order_date'))
            ->groupBy('courses.id') // group by course so only one per course
            ->orderByDesc('order_date') // sort by latest purchase
            ->get();

        /* 
        1- I want to fitch all the courses through the orders made by the user. so I select order_id and course_id from the course_order table.
        2- I want the details of the course, so I join the courses table.
        3- I want to get the latest order date for each course, so I use MAX(orders.created_at).
        4- I group by course id to ensure only one record per course.
        5- Finally, I order the results by the latest order date in descending order.
        This way, I can display the courses that the user has purchased, sorted by the most recent purchase date.
        
        */

        /* 
        ->select('courses.*', 'orders.created_at as order_date')
        You’re not selecting from the raw courses table directly.
        You’re selecting from the result of the join query (which is a temporary combined table in memory).

        here are the columns of the big temporary table:
        - orders.id
        - orders.user_id
        - orders.created_at
        - course_order.order_id
        - course_order.course_id
        - courses.id
        - courses.name
        - courses.description
        - courses.selling_price
        - courses.discount_price
        - courses.duration
        - courses.label
        - courses.instructor_id
        - courses.created_at
        - courses.updated_at
        - order_date (which is the MAX(orders.created_at) for each course)
        */



        return view('frontend.dashboard.courses.index', get_defined_vars());
    }



    public function show(Course $course)
    {

        $course->load('sections');
        $questions = $course->questions()
            ->whereNull('parent_id')   // only main questions
            ->with(['user', 'course.instructor', 'replies']) // eager load user and course with its instructor
            ->latest()
            ->get();


        return view('frontend.dashboard.courses.show', get_defined_vars());
    }



    // Additional methods for course management can be added here
}
