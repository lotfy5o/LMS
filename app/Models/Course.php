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

use Illuminate\Database\Eloquent\Casts\Attribute;

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

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id');
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

    protected function discountPercentage(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->discount_price === null || $this->selling_price == 0) {
                    return 0;
                }

                $discountAmount = $this->selling_price - $this->discount_price;
                $discountPercentage = ($discountAmount / $this->selling_price) * 100;

                return round($discountPercentage, 2);
            }
        );
    }

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id', 'id');
    }

    public function wishlistedByUsers()
    {
        return $this->belongsToMany(User::class, 'wishlists', 'course_id', 'user_id');
    }

    public function isWishlistedByCurrentUser()
    {
        return auth()->check() && $this->wishlistedByUsers()->where('user_id', auth()->id())->exists();
    }
}
