<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentStoreRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:students,email',
            'mobile_number' => 'required|unique:students,mobile_number',
            'password' => 'required|min:8',
            'conf_password' => 'same:password',
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'The email has already been taken.',
            'mobile_number.unique' => 'The mobile number has already been taken.',
            'conf_password.same' => 'The confirmation password must match the password.',
        ];
    }
}
