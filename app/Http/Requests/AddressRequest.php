<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Store;

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
            'name' => 'required|string|min:3|max:50',
            'street_name' => 'required|string|min:3|max:100',
            'building_number' => 'required|string|max:10',
            'city' => 'required|string|min:2|max:100',
            'postal_code' => 'required|integer|min:11000|max:37999'
        ];
    }
}
