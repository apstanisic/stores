<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\BAuth;
use Illuminate\Validation\Rule;

class BuyerRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return BAuth::guest();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => [
                'required',
                'min:6',
                'max:50',
                'alpha_dash',
                Rule::unique('buyers')
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('buyers')
            ],
            'password' =>
                'required|min:6'
        ];
    }
}
