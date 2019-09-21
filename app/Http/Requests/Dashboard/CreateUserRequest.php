<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:190',
            'email' => 'required|string|email|max:190|unique:users,email',
            'password' => 'required|string|min:6|max:70',
            'password_confirmation' => 'required|same:password',
            'role_ids' => 'required|array|min:1',
            'role_ids.*' => 'integer|exists:roles,id',
        ];
    }
}
