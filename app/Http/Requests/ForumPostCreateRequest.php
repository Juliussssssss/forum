<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ForumPostCreateRequest extends FormRequest
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
            'title' => 'required|min:5|max:200|unique:forum_posts',
            'slug' => 'max:200',
            'excerpt' => 'max:200',
            'content_row' => 'required|string|min:5|max:500',
            'category_id' => 'required|integer|exists:forum_categories,id'
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
            'title.required' => 'Введите заголовок статьи',
            'content_row' => 'Минимальная длина статьи [:min] символов'
        ];
    }

    public function attributes()
    {
       return [
           'title' => 'Заголовок'
       ];
    }
}
