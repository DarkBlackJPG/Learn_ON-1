<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class notification extends Model
{
    protected $table = 'notifications';

    protected $fillable=
        [
            'from',
            'to'
        ];

    public function getCreatedAtAttribute($date){
        return $this->asDateTime($date)->diffForHumans();
    }
}
