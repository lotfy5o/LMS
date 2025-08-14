<?php

use App\Models\CourseLecture;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\CourseLectureController;
use App\Http\Controllers\CourseSectionController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\SettingsController;

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





Route::controller(FrontendController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/courses/{course}/course-details', 'courseDetails')->name('frontend.course.details');
    Route::get('/courses/{instructor}/instructor-details', 'instructorDetails')->name('frontend.instructor.details');
    Route::get('/categories', 'allCategories')->name('frontend.allCategories');
    Route::get('/categories/{category}', 'categoryDetails')->name('frontend.category.details');
    Route::get('/categories/{category}/{subcategory}', 'subcategoryDetails')->name('frontend.subcategoryDetails');
});

Route::controller(WishlistController::class)->group(
    function () {
        Route::post('/course/toggle-wishlist', 'toggleWishlist');
        Route::get('/user/wishlist', 'AllWishlist')->name('user.wishlist');
        Route::get('/get-wishlisted-courses', 'GetWishListedCourses');
        Route::get('/remove-wishlist/{courseId}', 'removeWishlist');
    }
);

Route::controller(CartController::class)->group(function () {
    Route::post('/coupon-apply', 'CouponApply')->name('coupon.apply');
    Route::post('/coupon-remove', 'CouponRemove')->name('coupon.remove');
    Route::get('/addToCart/{course:slug}', 'addToCart')->name('addToCart');
    Route::get('/removeFromCart/{course:slug}', 'removeFromCart')->name('removeFromCart');
    Route::get('/cartData', 'fetchCartData')->name('fetchCartData');
    Route::get('/myCart', 'myCart')->name('myCart');
});

Route::controller(CheckoutController::class)->group(function () {
    Route::get('/checkout', 'index')->name('checkout');
    // Route::post('/checkout/store', 'store')->name('checkout.store');
    // Route::get('/checkout/success', 'success')->name('checkout.success');
    // Route::get('/checkout/cancel', 'cancel')->name('checkout.cancel');
});

Route::controller(PaymentController::class)->group(function () {
    Route::post('/payment', 'processDirectPayment')->name('payment');
});

Route::get('/dashboard', function () {
    return view('frontend.dashboard.index');
})->middleware(['auth', 'verified', 'roles:user'])->name('dashboard');

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

    // Admin Course Group
    Route::controller(App\Http\Controllers\Admin\CourseController::class)->prefix('/back')->name('back.')->group(function () {
        Route::resource('courses', App\Http\Controllers\Admin\CourseController::class);
        Route::post('/admin/courses/status/update', 'UpdateCourseStatus')->name('course.status.update');
    });

    // Admin Coupon Group
    Route::controller(App\Http\Controllers\Admin\CouponController::class)->prefix('/back')->name('back.')->group(function () {
        Route::resource('coupons', App\Http\Controllers\Admin\CouponController::class);
    });

    // Admin smpt settings
    Route::controller(SettingsController::class)->prefix('/back')->name('back.')->group(function () {
        Route::get('smtp-settings', 'SmtpSetting')->name('smtp.settings.index');
        Route::post('smtp-settings/update',  'SmtpUpdate')->name('smtp.settings.update');
    });

    // Admin manage orders
    Route::controller(App\Http\Controllers\admin\OrderController::class)->prefix('/back')->name('back.')->group(function () {
        Route::get('orders/pending', 'PendingOrders')->name('orders.pending');
        Route::get('orders/confirmed', 'ConfirmedOrders')->name('orders.confirmed.index');
        Route::get('orders/details/{id}', 'OrderDetails')->name('orders.details');
        Route::get('orders/confirmed{id}', 'ConfirmOrder')->name('orders.confirm');
    });
});


Route::get('/admin/login', [AdminController::class, 'AdminLogin'])
    ->name('admin.login')->middleware('guest');



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
        Route::post('/courses/status/update', 'UpdateCourseStatus')->name('course.status.update');
    });

    Route::resource('courses.sections', CourseSectionController::class);
    Route::resource('courses.lectures', CourseLectureController::class);
    // Route::post('/save-lecture', [CourseLectureController::class, 'store']);


});

Route::get('/instructor/login', [InstructorController::class, 'InstructorLogin'])
    ->name('instructor.login')->middleware('guest');

Route::get('/become/instructor', [InstructorController::class, 'becomeInstructor'])
    ->name('become.instructor');

Route::post('/instructor/register', [InstructorController::class, 'InstructorRegister'])->name('instructor.register');
