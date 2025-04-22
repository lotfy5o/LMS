<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use App\Http\Requests\StoreSubCategoryRequest;
use App\Http\Requests\UpdateSubCategoryRequest;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $SubCategories = SubCategory::with('category')->latest()->get();
        return view('categories.sub-categories.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        return view('categories.sub-categories.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubCategoryRequest $request)
    {
        $data = $request->validated();

        $SubCategory = SubCategory::create($data);

        if ($request->hasFile('image')) {

            $SubCategory->addMediaFromRequest('image')
                ->usingFileName(time() . '.' . $request->file('image')->getClientOriginalExtension())
                ->toMediaCollection('SubCategories');
        }



        $notification = array(
            'message' => 'SubCategory Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('back.SubCategories.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCategory $SubCategory)
    {
        return view('categories.sub-categories.show', get_defined_vars());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $SubCategory)
    {
        $categories = Category::get();

        return view('categories.sub-categories.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubCategoryRequest $request, SubCategory $SubCategory)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {

            // delete old image
            $SubCategory->clearMediaCollection('SubCategories');

            $SubCategory->addMediaFromRequest('image')
                ->usingFileName(time() . '.' . $request->file('image')->getClientOriginalExtension())
                ->toMediaCollection('SubCategories');
        }

        $SubCategory->update($data);

        $notification = array(
            'message' => 'SubCategory Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('back.SubCategories.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $SubCategory)
    {
        $SubCategory->clearMediaCollection('SubCategories');
        $SubCategory->delete();

        $notification = array(
            'message' => 'SubCategory Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('back.SubCategories.index')->with($notification);
    }
}
