<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Category;
use App\Store;

class CategoryRequest extends FormRequest
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
            'name' => 'required|min:3',
            'parent_id' => [
            	// parent_id moze da bude null
            	'nullable',
            	// ako nije null mora da postoji u tabeli categories u tabeli id
            	Rule::exists('categories', 'id')->where(function($query) {
            		// I prodavnica iz url-a mora da bude prodavnica iz tabele
            		$query->where('store_id', Store::url()->id);

            		// Roditelj mora da nema svog roditelja
            		//$query->where('parent_id', null);
            		
            	}),
            ]
        ];
    }
}
