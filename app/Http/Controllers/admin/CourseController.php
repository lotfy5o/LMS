<?php

namespace App\Http\Controllers\admin;

use App\Models\Course;
use App\Models\Category;
use App\Models\CourseGoal;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::with('category')
            ->orderBy('id', 'desc')
            ->get();
        return view('admin.courses.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
        $goals = CourseGoal::where('course_id', $course->id)->get();
        return view('admin.courses.show', get_defined_vars());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }

    public function UpdateCourseStatus(Request $request)
    {


        $course = Course::find($request->input('course_id'));
        $isChecked = $request->input('is_checked', 0);

        if ($course) {
            $course->status = $isChecked;
            $course->save();
        }


        return response()->json(['message' => 'Course Status Updated Successfully']);
    }
}
