<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class question extends Model
{
    protected $table = 'questions';

    protected $fillable = [
        'question',
        'answer1',
        'answer2',
        'answer3',
        'answer4',
        'answer5',
        'correct1',
        'correct2',
        'correct3',
        'correct4',
        'correct5',
    ];

    public function test()
    {
        return $this->belongsTo('App\Test');
    }

}
