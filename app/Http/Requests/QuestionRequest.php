<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class QuestionRequest extends Request
{
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
        'question' => 'required|min:1|max:100',
        'answer1' => 'required|min:1|max:50',
        'answer2' => 'required|min:1|max:50',
        'answer3' => 'required|min:1|max:50',
        'answer4' => 'required|min:1|max:50',
        'answer5' => 'required|min:1|max:50',
        'correct1',
        'correct2',
        'correct3',
        'correct4',
        'correct5',

        ];
    }
}
