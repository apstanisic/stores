<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Store;
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
        return bauth(Store::url())->guest();
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
                'max:60',
                'alpha_dash',
                Rule::unique('buyers')
                    ->where(function($query) {
                        $query->where('store_id', Store::url());
                })
            ],
            'email' => [
                'required',
                'email',
                'max:240',
                Rule::unique('buyers')
                    ->where(function($query) {
                        $query->where('store_id', Store::url())
                    })
            ],
            'password' =>
                'required|min:6'
        ];
    }
}
