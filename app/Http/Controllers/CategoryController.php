<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('categories.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();

        $category = Category::create($data);

        if ($request->hasFile('image')) {

            $category->addMediaFromRequest('image')
                ->usingFileName(time() . '.' . $request->file('image')->getClientOriginalExtension())
                ->toMediaCollection('categories');
        }



        $notification = array(
            'message' => 'Category Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('back.categories.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('categories.show', get_defined_vars());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {

            // delete old image
            $category->clearMediaCollection('categories');

            $category->addMediaFromRequest('image')
                ->usingFileName(time() . '.' . $request->file('image')->getClientOriginalExtension())
                ->toMediaCollection('categories');
        }

        $category->update($data);

        $notification = array(
            'message' => 'Category Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('back.categories.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->clearMediaCollection('categories');
        $category->delete();

        $notification = array(
            'message' => 'Category Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('back.categories.index')->with($notification);
    }
}
