<?php

namespace App\Http\Requests\LoggedUsers;

use Illuminate\Foundation\Http\FormRequest;

class CreateAlbumRequest extends FormRequest
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
            'type' => 'required|in:public,private',
            'notes' => 'nullable|string|max:190',
            'cover' => 'nullable|image',
            'images' => 'nullable|array',
            'images.*' => 'image',
        ];
    }
}
