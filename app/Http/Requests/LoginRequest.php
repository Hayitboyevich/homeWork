<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'Email to\'ldirilishi kerak',
            'email.email' => 'Email kiriting',
            'password.required' => 'Password to\'ldirilishi kerak',
            'password.min' => 'Kamida 6ta belgi kiriting',
            'password.confirmed' => 'Tasdiqlash noto\'g\'ri',
        ];
    }

}
