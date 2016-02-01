<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class LectureRequest extends Request
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
            'pdf.mimes' => 'The lecture pdf must be a pdf file. ',
            'lecture_title.required'=>'The lecture title is required. ',
            'lecture_title.min'=>'The lecture title must be at least 3 characters long. ',
            'lecture_title.max'=>'The lecture title must be 30 characters long at most. ',
            'body.required'  => 'The lecture description is required. ',
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
            'video'=>'url|min:6',
            'pdf'=>'required|mimes:pdf|max:2000',
            'body' => 'required|min:3|max:255',
            'lecture_title'=>'required|min:3|max:30'
        ];
    }
}
