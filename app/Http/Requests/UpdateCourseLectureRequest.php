<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseLectureRequest extends FormRequest
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
        // dd($this->all());
        return [
            'section_id' => 'required|exists:course_sections,id',  // Fixed typo here
            'title' => 'required|string|max:255',
            'duration' => 'nullable',
            'content' => 'required|string',
            'url' => 'required|string',
        ];
    }
}
