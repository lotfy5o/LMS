<?php

use App\Models\CourseLecture;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\CourseLectureController;
use App\Http\Controllers\CourseSectionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




Route::get('/', [UserController::class, 'index'])->name('index');

Route::get('/dashboard', function () {
    return view('frontend.dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//User Group
Route::middleware('auth')->group(function () {
    Route::get('/user/profile', [UserController::class, 'UserProfileEdit'])->name('user.profile.edit');
    Route::post('user/profile/update', [UserController::class, 'UserProfileUpdate'])->name('user.profile.update');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');

    Route::get('/user/change/password', [UserController::class, 'UserChangePassword'])
        ->name('user.change.password');

    Route::post('/user/password/update', [UserController::class, 'UserPasswordUpdate'])
        ->name('user.password.update');
});

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'roles:admin'])->group(function () {

    // Admin Group Middlewares
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])
        ->name('admin.dashboard');

    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])
        ->name('admin.logout');

    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])
        ->name('admin.profile');

    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])
        ->name('admin.profile.store');

    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])
        ->name('admin.change.password');

    Route::post('/admin/password/update', [AdminController::class, 'AdminPasswordUpdate'])
        ->name('admin.password.update');

    // Category Group
    Route::controller(CategoryController::class)->prefix('/back')->name('back.')->group(function () {
        Route::resource('categories', CategoryController::class);
    });

    // SubCategory Group
    Route::controller(SubCategoryController::class)->prefix('/back')->name('back.')->group(function () {
        Route::resource('SubCategories', SubCategoryController::class);
    });

    // Teachers Group
    Route::controller(TeacherController::class)->prefix('/back')->name('back.')->group(function () {
        Route::resource('teachers', TeacherController::class);
        Route::post('teachers/update/user/status', [TeacherController::class, 'UpdateUserStatus'])->name('update.user.status');
    });
});

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])
    ->name('admin.login');



// Instructor Group Middlewares
Route::middleware(['auth', 'roles:instructor'])->group(function () {
    Route::get('/instructor/dashboard', [InstructorController::class, 'InstructorDashboard'])
        ->name('instructor.dashboard');

    Route::get('/instructor/logout', [InstructorController::class, 'InstructorLogout'])
        ->name('instructor.logout');

    Route::get('/instructor/profile', [InstructorController::class, 'InstructorProfile'])
        ->name('instructor.profile');

    Route::post('/instructor/profile/store', [InstructorController::class, 'InstructorProfileStore'])
        ->name('instructor.profile.store');

    Route::get('/instructor/change/password', [InstructorController::class, 'InstructorChangePassword'])
        ->name('instructor.change.password');

    Route::post('/instructor/password/update', [InstructorController::class, 'InstructorPasswordUpdate'])
        ->name('instructor.password.update');

    Route::controller(CourseController::class)->group(function () {
        Route::resource('courses', CourseController::class);
        Route::get('/subcategory/ajax/{category_id}', 'GetSubCategory');
        Route::post('/courses/{course}/goal/update', 'UpdateCourseGoal')->name('update.course.goal');
    });

    Route::resource('courses.sections', CourseSectionController::class);
    Route::resource('courses.lectures', CourseLectureController::class);
    // Route::post('/save-lecture', [CourseLectureController::class, 'store']);
});

Route::get('/instructor/login', [InstructorController::class, 'InstructorLogin'])
    ->name('instructor.login');

Route::get('/become/instructor', [InstructorController::class, 'becomeInstructor'])
    ->name('become.instructor');

Route::post('/instructor/register', [InstructorController::class, 'InstructorRegister'])->name('instructor.register');
