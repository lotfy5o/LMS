<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Category;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Web Development' => ['Laravel', 'React.js', 'Vue.js', 'Django'],
            'Mobile Development' => ['Flutter', 'React Native', 'Swift'],
            'Data Science' => ['Python', 'Machine Learning', 'Deep Learning'],
            'Graphic Design' => ['Adobe Photoshop', 'Illustrator'],
            'Cybersecurity' => ['Network Security', 'Ethical Hacking'],
            'Digital Marketing' => ['SEO', 'Content Marketing']
        ];

        foreach ($data as $categoryName => $subCategories) {
            $category = Category::where('name', $categoryName)->first();

            if (!$category) {
                continue;
            }

            foreach ($subCategories as $subName) {
                DB::table('sub_categories')->insert([
                    'name' => $subName,
                    'slug' => Str::slug($subName),
                    'category_id' => $category->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}
