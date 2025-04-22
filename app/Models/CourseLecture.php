<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CourseSection;

class CourseLecture extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = 'course_lectures';

    public function section()
    {
        return $this->belongsTo(CourseSection::class, 'section_id');
    }
}
