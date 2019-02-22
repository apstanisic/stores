<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Store;

class BuyerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return bauth()->guest();
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
                'max:30',
                'alpha_dash',
                Rule::unique('buyers')
                    ->ignore(bauth()->check() ? bauch()->user()->username : null)
                    ->where(function($query) {
                        $query->where('store_id', Store::fromUrl());
                })
            ],
            'email' => [
                'required',
                'email',
                'max:100',
                Rule::unique('buyers')
                    ->ignore(bauth()->check() ? bauch()->user()->username : null)
                    ->where(function($query) {
                        $query->where('store_id', Store::fromUrl());
                    })
            ],
            'password' =>
                'required|min:6'
        ];
    }
}
