<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\User;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = Category::where('name', 'Web Development')->first();
        $subcategory = SubCategory::where('name', 'Laravel')->first();
        $instructor = User::where('role', 'instructor')->first(); // Adjust if needed

        if (!$category || !$subcategory || !$instructor) {
            $this->command->warn("Missing category, subcategory, or instructor.");
            return;
        }

        DB::table('courses')->insert([
            [
                'category_id'     => $category->id,
                'subcategory_id'  => $subcategory->id,
                'instructor_id'   => $instructor->id,
                'title'           => 'Mastering Laravel for Beginners',
                'name'            => 'Laravel 9 Beginner Bootcamp',
                'slug'            => Str::slug('Laravel 9 Beginner Bootcamp'),
                'description'     => 'This course walks you through Laravel basics up to REST APIs and Blade components.',
                'label'           => 'Beginner',
                'duration'        => 25,
                'resources'       => true,
                'certificate'     => 'Yes',
                'selling_price'   => 99.99,
                'discount_price'  => 49.99,
                'prerequisites'   => 'Basic PHP, Composer',

                'status'          => 1, // published
                'created_at'      => Carbon::now(),
                'updated_at'      => Carbon::now(),
            ],
            [
                'category_id'     => $category->id,
                'subcategory_id'  => $subcategory->id,
                'instructor_id'   => $instructor->id,
                'title'           => 'Advanced Laravel Techniques',
                'name'            => 'Laravel Advanced Features & Testing',
                'slug'            => Str::slug('Laravel Advanced Features & Testing'),
                'description'     => 'Deep dive into Laravel’s advanced features including policies, jobs, queues, and testing.',
                'label'           => 'Advanced',
                'duration'        => 35,
                'resources'       => true,
                'certificate'     => 'No',
                'selling_price'   => 150.00,
                'discount_price'  => 100,
                'prerequisites'   => 'Laravel Basics, OOP PHP',


                'status'          => 1, // published
                'created_at'      => Carbon::now(),
                'updated_at'      => Carbon::now(),
            ]
        ]);
    }
}
