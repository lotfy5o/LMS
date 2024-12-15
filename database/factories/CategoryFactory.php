<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $name = ucfirst($this->faker->word),
            'image' => UploadedFile::fake()->image('category_image.jpg', 640, 480), // Random Hotel image URL
            'slug' => Str::slug($name),
        ];
    }
}
