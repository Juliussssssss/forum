<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ForumCommentCreateRequest extends FormRequest
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
            'comment' => 'required|min:5|max:500',
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
            'comment' => 'Комментарий'
        ];
    }
}
