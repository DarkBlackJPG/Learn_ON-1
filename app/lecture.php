<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class lecture extends Model
{
    protected $fillable=[
        'video',
        'pdf',
        'body',
        'lecture_title'
    ];

    public function course()
    {
        return $this->belongsTo('App\course');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
