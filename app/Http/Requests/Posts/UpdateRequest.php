<?php

namespace App\Http\Requests\Posts;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'title'          => 'required|min:10',
            'body'           => 'required|min:50',
            'category_id'    => 'required|min:1',
            'slug'           => 'required|unique:posts,slug,'.request()->route()->post->id,
            'images'         => 'sometimes|image|mimes:jpeg,bmp,png,jpg',
            'images'         => 'sometimes|array|max:3',
            'images.*'       => 'required_with:images|image|mimes:jpeg,bmp,png,jpg',
            'images_updated' => 'required|boolean',
            'is_thumbnail' => 'required|boolean',
        ];
    }
}
