<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wishlist extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function toggleWishlist($courseId)
    {
        $user = Auth::user();
        $course = Course::find($courseId);
    }
}
