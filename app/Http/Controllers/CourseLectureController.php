<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseLecture;
use App\Http\Requests\StoreCourseLectureRequest;
use App\Http\Requests\UpdateCourseLectureRequest;

class CourseLectureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Course $course)
    {
        // return view('instructor.lectures.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Course $course)
    {
        // return view('instructor.lectures.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseLectureRequest $request)
    {
        $data = $request->validated();
        CourseLecture::create($data);

        return response()->json(['success' => 'Lecture Saved Successfully']);
    }

    /**
     * Display the specified resource.
     */
    // public function show(Course $course, CourseLecture $lecture)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course, CourseLecture $lecture)
    {
        return view('instructor.sections.lectures.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseLectureRequest $request, Course $course, CourseLecture $lecture)
    {

        $data = $request->validated();

        $lecture->update($data);

        $notification = array(
            'message' => 'Lecture Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course, CourseLecture $lecture)
    {
        $lecture->delete();
        $notification = array(
            'message' => 'Lecture Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
