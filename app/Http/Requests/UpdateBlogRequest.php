<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogRequest extends FormRequest
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
            'name' => 'required|max:200',
            'slug' => 'required|max:200',
            'short_description'  => 'required|max:200',
            'description' => 'required|max:65000',
            'image' => 'mimes:png,jpg,jpeg|max:2048',
        ];
    }
}
