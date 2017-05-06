<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Store;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3',
            // 'description' => 'required'
            'price' => 'numeric',
            'remaining' => 'numeric|nullable',
            'category_id' => [

	            'numeric',
            	Rule::exists('categories', 'id')->where(function($query) {
            		// I prodavnica iz url-a mora da bude prodavnica iz tabele
            		$query->where('store_id', Store::url()->id);
            	}),
            ]
        ];
    }
}
