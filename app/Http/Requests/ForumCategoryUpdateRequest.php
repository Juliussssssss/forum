<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ForumCategoryUpdateRequest extends FormRequest
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
            'title' => [
                'required',
                'min:5',
                'max:200',
                Rule::unique('forum_categories')->ignore($this->route('category'))
            ],
            'slug' => 'max:200',
            'description' => 'string|max:500|min:3',
            'parent_id' => 'required|integer|exists:forum_categories,id'
        ];
    }
}
