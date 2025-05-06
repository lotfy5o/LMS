<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Category;
use App\Models\CourseGoal;
use App\Models\SubCategory;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $popularCategories = Category::latest()->limit(6)->get();
        $categories = Category::with('courses', 'subCategories')->orderBy('name', 'ASC')->get();
        $courses = Course::with(['instructor', 'goals'])->orderBy('id', 'ASC')->get();
        return view('frontend.index', get_defined_vars());
    }

    public function courseDetails(Course $course)
    {
        $goals = CourseGoal::where('course_id', $course->id)->orderBy('id', 'ASC')->get();
        $isWishlisted = Wishlist::where('course_id', $course->id)->where('user_id', auth()->id())
            ->exists();


        return view('frontend.pages.course-details', get_defined_vars());
    }

    public function allCategories()
    {
        $categories = Category::with('courses', 'subCategories')->orderBy('name', 'ASC')->get();
        return view('frontend.pages.categories-all', get_defined_vars());
    }
    public function categoryDetails(Category $category)
    {
        return view('frontend.pages.category-details', get_defined_vars());
    }

    public function subcategoryDetails(Category $category, SubCategory $subcategory)
    {
        $allCategories = Category::orderBy('name', 'ASC')->get();
        return view('frontend.pages.subcategory-details', get_defined_vars());
    }

    public function instructorDetails(User $instructor)
    {

        return view('frontend.pages.instructor-details', get_defined_vars());
    }
}
