<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class test extends Model
{
    protected $table = 'tests';

    protected $fillable=[
        'title',
        'name',
        'points'
    ];

    public function course()
    {
        return $this->belongsTo('App\course');
    }

    public function questions()
    {
        return $this->hasMany('App\Question');
    }
}
