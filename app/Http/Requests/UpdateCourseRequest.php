<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'image' => 'nullable|image|mimes:png,jpg, jpeg',
            'video' => 'nullable|mimes:mp4|max:10000',
            'category_id' => 'required|exists:categories,id',  // Ensure the category exists
            'subcategory_id' => 'required|exists:sub_categories,id', // Ensure the subcategory exists
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',  // Allow empty but if filled, max 1000 chars
            'label' => 'nullable|string|max:100',
            'duration' => 'nullable|string|max:100', // For course duration, adjust as needed
            'resources' => 'nullable|string|max:1000',  // Resources text
            'certificate' => 'nullable|string|max:255',  // Certificate field
            'selling_price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lt:selling_price', // Ensure discount is less than selling price
            'prerequisites' => 'nullable|string|max:1000',  // Prerequisites
            'bestseller' => 'nullable|boolean',  // Boolean values
            'featured' => 'nullable|boolean',
            'highest_rated' => 'nullable|boolean',
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => 'Please select a category.',
            'subcategory_id.required' => 'Please select a subcategory.',
            'title.required' => 'Course title is required.',
            'name.required' => 'Course name is required.',
            'description.max' => 'Description can\'t exceed 1000 characters.',
            'video.required' => 'A course video is required.',
            'video.mimes' => 'Video must be of type mp4, avi, or mov.',
            'video.max' => 'Video size cannot exceed 10MB.',
            'selling_price.required' => 'Selling price is required.',
            'selling_price.numeric' => 'Selling price must be a valid number.',
            'discount_price.lt' => 'Discount price must be less than selling price.',
            'image.image' => 'Course image must be an image file.',
            'image.mimes' => 'Course image must be a jpeg, png, jpg, or gif.',
            'image.max' => 'Course image size can\'t exceed 10MB.',
        ];
    }
}
