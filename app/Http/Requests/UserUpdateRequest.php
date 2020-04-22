<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
            'name' => [
                'max:20',
                'min:5',
                'string',
                'required',
                Rule::unique('users')->ignore($this->route('user'))
                ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($this->route('user'))
                ],
            'image' => 'max:10240|mimes:jpeg,png,bmp,tiff'
        ];
    }

    /**
     * attributes for rules
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => 'Имя',
            'email' => 'Email',
            'image' => 'Картинка',
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
