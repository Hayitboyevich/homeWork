<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepositRequest extends FormRequest
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
            'deposit' => 'required|numeric|min:10|max:100',
        ];
    }

    public function messages()
    {
        return [
            'deposit.required' => 'Deposit to\'ldirilishi kerak',
            'deposit.min' => 'Deposit 10 dan katta qiymat kiriting',
            'deposit.max' => 'Deposit 100 dan kichik qiymat kiriting',
            'deposit.numeric' => 'Son kiriting',
        ];
    }
}
