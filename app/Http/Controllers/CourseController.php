<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseGoalsReq;
use App\Http\Requests\UpdateCourseRequest;
use Illuminate\Http\Request;
use App\Models\CourseGoal;
use App\Models\SubCategory;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::user()->id;
        $courses = Course::where('instructor_id', $id)
            ->orderBy('id', 'desc')
            ->with('category') // Eager load the related category
            ->get();
        return view('instructor.courses.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::latest()->get();
        return view('instructor.courses.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request)
    {
        $data = $request->validated();
        $data['instructor_id'] = Auth::user()->id;

        $course = Course::create(collect($data)->except(['image', 'video'])->toArray());
        $course_id = $course->id;

        if ($request->hasFile('image')) {
            // grap the image, rename it, store it in a collection called categories
            $course->addMediaFromRequest('image')
                ->usingFileName(time() . '.' . $request->file('image')->getClientOriginalExtension())
                ->toMediaCollection('courses_images');
        }

        if ($request->hasFile('video')) {
            $course->addMediaFromRequest('video')
                ->usingFileName(time() . '.' . $request->file('video')->getClientOriginalExtension())
                ->toMediaCollection('courses_videos');
        }

        $course_goals = $request->input('course_goals', []); // Default to empty array if no goals are provided

        if (count($course_goals) > 0) {
            foreach ($course_goals as $goal) {
                $gcount = new CourseGoal();
                $gcount->course_id = $course_id;
                $gcount->goal_name = $goal; // Use $goal directly
                $gcount->save();
            }
        }


        $notification = array(
            'message' => 'Course Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('courses.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
        $goals = CourseGoal::where('course_id', $course->id)->get();
        return view('instructor.courses.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {

            // delete old image
            $course->clearMediaCollection('courses_images');

            $course->addMediaFromRequest('image')
                ->usingFileName(time() . '.' . $request->file('image')->getClientOriginalExtension())
                ->toMediaCollection('courses_images');
        }

        if ($request->hasFile('video')) {

            // delete old video
            $course->clearMediaCollection('courses_videos');

            $course->addMediaFromRequest('video')
                ->usingFileName(time() . '.' . $request->file('video')->getClientOriginalExtension())
                ->toMediaCollection('courses_videos');
        }

        // I am using spatie media library so there is no columns in the database
        // for image, and video
        $dataToUpdate = collect($data)->except(['image', 'video'])->toArray();

        $course->update($dataToUpdate);

        $notification = array(
            'message' => 'Course Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('courses.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->clearMediaCollection('courses_images');
        $course->clearMediaCollection('courses_videos');

        $course->delete();

        $notification = array(
            'message' => 'Course Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('courses.index')->with($notification);
    }

    public function getSubCategory($category_id)
    {
        $subCategory = SubCategory::where('category_id', $category_id)
            ->orderBy('name', 'ASC')
            ->get();

        return response()->json($subCategory);
    }

    public function UpdateCourseGoal(Request $request, Course $course)
    {


        if (is_null($request->course_goals)) {
            return redirect()->back();
        }

        $course->goals()->delete();

        $goles = Count($request->course_goals);

        for ($i = 0; $i < $goles; $i++) {
            $gcount = new CourseGoal();
            $gcount->course_id = $course->id;
            $gcount->goal_name = $request->course_goals[$i];
            $gcount->save();
        }

        $notification = array(
            'message' => 'Course Goals Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('courses.index')->with($notification);
    }
}
