<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return bauth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:1|max:100',
            'street_name' => 'required|string|min:3|max:200',
            'building_number' => 'required|string|max:10',
            'city' => 'required|string|min:2|max:200',
            'postal_code' => 'required|integer|min:10000|max:100000'
        ];
    }
}
