<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class static_page extends Model
{
    protected $table = 'static_pages';

    protected $fillable=[
        'name',
        'content'
    ];
}
