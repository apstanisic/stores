<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteProfileRequest extends FormRequest
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
     * User must type his username to delete his profile
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|in:' . auth()->user()->username
        ];
    }
}
