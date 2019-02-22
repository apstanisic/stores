<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
        $routeStore = $this->route()->parameter('store');
        $routeCategory = $this->route()->parameter('category');

        // $uniqueRule = Rule::unique('categories', 'name')
        //             ->ignore($routeCategory ? $routeCategory->id : null)
        //             ->where(function ($query) {
        //                 $query->where('parent_id', request(['parent_id']))
        //                 ->orWhereNull('parent_id');
        //     });
        // if ()

        return [
            'name' => [
                'required',
                'min:2',
                /* Category name must be unique in its category,
                root categories can't have same name, and subcategories
                in category can't have same name */
                // Category must be unique
                // select * where name = $name where parent_id = $parent_id
                Rule::unique('categories', 'name')
                // where
                ->where(function($query) {
                    // parent is the same, or parent is null
                    $query->where('parent_id', request(['parent_id']))
                    ->orWhereNull('parent_id');
                })
                // Ignore current category
                ->ignore($routeCategory ? $routeCategory->id : null)
            ],
            'parent_id' => [
            	'nullable',
                /* Must exist in categories table in column id,
                and its store must be store from url. */
            	Rule::exists('categories', 'id')->where(function($query) use ($routeStore) {
            		$query->where('store_id', $routeStore->id);
                    // Uncomment if you want parent category 
                    // to not have it's own parent
            		//$query->where('parent_id', null);
            	}),
            ]
        ];
    }
}
