<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Store;
use App\Product;
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
            'name' => [
                'required',
                'min:2',
                Rule::unique('products')
                    ->ignore(Product::url()->id ?? null, 'id')
                    ->where(function($query) {
                        $query->where('store_id', Store::url()->id);
                    })
            ],
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
