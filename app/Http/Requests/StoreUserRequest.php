<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|max:100|alpha',
            'email' => 'required|email|max:100|unique:users',
            'phone' =>  'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:15',
        ];
    }
}
