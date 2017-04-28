<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
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
        // return [];
        $user = auth()->user();
        $route = \Route::currentRouteName();

        switch ($route) {
            case 'user.updatePassword':

               return [
                    // Custom validation rule: check_password: AppServiceProvider
                    'old_password' => 'check_password:' . $user->password,
                    'password' => 'required|min:6|confirmed'
                ];
                break;

            case 'user.update':
            default:
                return [
                    'username' => [
                        'required',
                        'min:6',
                        'max:50',
                        'alpha_dash',
                        Rule::unique('users')->ignore($user->id)
                    ],
                    'email' => [
                        'required',
                        'email',
                        'max:255',
                        Rule::unique('users')->ignore($user->id)
                    ]
                ];
                break;

        }

    }
}
