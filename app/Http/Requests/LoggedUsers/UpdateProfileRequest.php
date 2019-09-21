<?php

namespace App\Http\Requests\LoggedUsers;

use Illuminate\Foundation\Http\FormRequest;

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
        $user = auth()->user();
        return [
            'name' => 'required|string|min:3|max:190',
            'email' => 'required|string|email|max:190|unique:users,email,' . $user->id,
            'password' => 'nullable|required_with:password_confirmation|string|min:6|max:190',
            'password_confirmation' => 'nullable|required_with:password|same:password',
        ];
    }
}
