<?php

namespace App\Http\Requests\auth;

use Illuminate\Foundation\Http\FormRequest;

class storeRequest extends FormRequest
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
            'name'     => 'required|min:3|max:50',
            'email'    => 'required|email|unique:users',
            'image'    => 'required|image|mimes:jpeg,bmp,png,jpg',
            'password' => 'required|confirmed|min:8',
        ];
    }
}
