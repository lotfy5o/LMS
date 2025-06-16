<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'session_id',
        'user_id',
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'cart_course', 'cart_id', 'course_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSession($query)
    {
        return $query->where('session_id', session()->getId());
    }

    public function totalPrice()
    {
        return number_format($this->courses->sum(function ($course) {
            return $course->discount_price ?? $course->selling_price;
        }), 2);
    }
}
