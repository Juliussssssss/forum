<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'name' => 'min:5|max:20|required|unique:users|string',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'image' => 'max:10240|mimes:jpeg,png,bmp,tiff'
        ];
    }

    /**
     * Get the error messages for the define validation rules
     *
     * @return array
     */
    public function messages()
    {
        return [
            'mimes' => 'Только jpeg, png, bmp, tiff файлы разрешены.'
        ];
    }
}
