<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Store;
use App\Product;

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
                // You can have only 1 product with same name in store
                Rule::unique('products')
                    ->ignore(Product::fromUrl()->id ?? null, 'id')
                    ->where(function($query) {
                        $query->where('store_id', Store::fromUrl()->id);
                    })
            ],
            'price' => 'integer',
            'remaining' => 'integer|nullable',
            'category_id' => [
	            'integer',
                // Categorie must be valid and its store must be store from url
            	Rule::exists('categories', 'id')->where(function($query) {
            		$query->where('store_id', Store::fromUrl()->id);
            	}),
            ]
        ];
    }
}
