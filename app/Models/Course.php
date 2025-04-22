<?php

namespace App\Models;

use App\Models\CourseLecture;
use App\Models\CourseSection;
use Spatie\Sluggable\HasSlug;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Course extends Model implements HasMedia
{
    use HasFactory, HasSlug, InteractsWithMedia;
    protected $guarded = [];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('courses_images')
            ->useDisk('upload')
            ->registerMediaConversions(function (Media $media) {
                $this
                    ->addMediaConversion('thumb')
                    ->width(100)
                    ->height(100);

                $this
                    ->addMediaConversion('original')
                    ->width(340)
                    ->height(246);
            });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function goals()
    {
        return $this->hasMany(CourseGoal::class);
    }

    public function sections()
    {
        return $this->hasMany(CourseSection::class);
    }

    public function lectures()
    {
        return $this->hasManyThrough(
            CourseLecture::class, // Final model
            CourseSection::class, // Intermediate model
            'course_id',          // Foreign key on course_sections table
            'section_id',         // Foreign key on course_lectures table
            'id',                 // Local key on courses table
            'id'                  // Local key on course_sections table
        );
    }
}
