<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CreateRoleRequest extends FormRequest
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
            'display_name' => 'required|string|max:190|unique:roles,display_name',
            'description' => 'nullable|string|max:190',
            'permission_ids' => 'nullable|array|min:1',
            'permission_ids.*' => 'integer|exists:permissions,id'
        ];
    }
}
