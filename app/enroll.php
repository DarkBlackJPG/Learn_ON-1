<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class enroll extends Model
{
    protected $table = 'course_user';

    protected $fillable=
        [
            'user_id',
            'course_id'
        ];

    public function scopeOngoing($query)
    {
        $query->where('done','=',0);
    }

    public function scopeFinished($query)
    {
        $query->where('done','=',1);
    }
}
