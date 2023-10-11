<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'start_at' => 'required',
            'test_duration' => 'required',
            'images' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Assuming max file size is 2MB
        ];
    }
}
