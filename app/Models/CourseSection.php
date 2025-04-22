<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CourseLecture;
use App\Models\Course;

class CourseSection extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = 'course_sections';

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function lectures()
    {
        return $this->hasMany(CourseLecture::class, 'section_id');
    }
}
