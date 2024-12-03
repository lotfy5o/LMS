<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminProfileReq extends FormRequest
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
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'photo' => 'nullable|image|mimes:png,jpg, jpeg',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',

        ];
    }

    // public function attributes()
    // {
    //     return [
    //         'name'   => __('keywords.name'),
    //         'username'     => __('keywords.username'),
    //         'email'  => __('keywords.email'),
    //         'password'   => __('keywords.password'),
    //         'photo'   => __('keywords.photo'),
    //         'phone'  => __('keywords.phone'),
    //         'address' => __('keywords.address'),

    //     ];
    // }
}
