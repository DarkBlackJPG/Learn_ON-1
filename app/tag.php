<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tag extends Model

{

    protected $fillable=[
        'name'
    ];
    /**
     * Get all the courses associated eith the given tag
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function courses()
    {
        return $this->belongsToMany('\App\Course');
    }
}
