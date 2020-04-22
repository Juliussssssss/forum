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
            'content_row.required' => 'Введите контент статьи',
            'content_row' => 'Минимальная длина статьи [:min] символов'
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
           'title' => 'Заголовок',
           'slug' => 'Cтрока',
           'excerpt' => 'Выдержка',
           'content_row' => 'Контент',
           'category_id' => 'категория'

       ];
    }
}
