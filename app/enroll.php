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

    public static function GetFriends($user){
        $userGroups = Enroll::where('user_id', $user->id)->get();
        $i = 0;
        $d=0;
        $friends = null;
        foreach($userGroups as $userGroup) {
            $friend[$i] = Enroll::where('course_id', $userGroup->course_id)->whereNotIn('user_id', [\Auth::user()->id])->get();
            foreach($friend[$i] as $friend[$d]){
                $friends[$d] = User::find($friend[$d]->user_id);
                $d++;
            }
            if($friend[$i] != '[]'){
                $i++;
            }
        }
        if($friends != null) {
            return array_unique($friends);
        } else {
            return $friends;
        }
    }
}
