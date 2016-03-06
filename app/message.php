<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class message extends Model
{
    protected $table = 'messages';

    protected $fillable=
        [
            'from_user_id',
            'to_user_id',
            'message'
        ];

    public function getCreatedAtAttribute($date){
        return $this->asDateTime($date)->diffForHumans();
    }

}
