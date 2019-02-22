<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Store;

class StoreRequest extends FormRequest
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
                'min:3',
                // User can only have one store with same name
                Rule::unique('stores')
                    ->ignore(Store::fromUrl()->id ?? null, 'id')
                    ->where(function($query) {
                        $query->where('user_id', auth()->id());
                })
            ]
        ];
    }
}
