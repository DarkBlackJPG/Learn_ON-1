<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CourseRequest extends Request
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

    public function messages()
    {
        return [
            'title.required' => 'A title is required. ',
            'body.required'  => 'A description is required. ',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:3|max:50',
            'body' => 'required|min:3|max:255',
            'published_at' => 'required|date',
            'thumbnail' => 'image|max:2000',
        ];
    }
}
