<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AdminPostsRequest extends Request
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
            'title' => 'required|min:3',
            'body' => 'required|min:10',
            'category_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'photo_id.required' => 'The photo field is required',
            'category_id.required' => 'The category field is required',
        ];
    }
}
