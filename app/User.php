<?php

namespace App;

use Auth;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'email', 'password', 'confirmation_code', 'profile' ,'chat_key'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token', 'level'];

    /**
     * User can have many courses.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courses()
    {
        return $this->hasMany('App\Course');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }


    /**
     * Checking if authenticated user has a level of 0
     * @return bool
     */
    public function isAdmin()
    {
        if(Auth::user()->level=='1')
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public static function getSender($message)
    {
        $user=user::Where('id', $message->from_user_id)->first();
        return $user;
    }

    public static function getReceiver($message)
    {
        $user=user::Where('id', $message->to_user_id)->first();
        return $user;
    }



    public static function writeScript() {
        echo "

                            var channel = pusher.subscribe('" . \Auth::user()->chat_key . "');
                            channel.bind('new-message', addMessage);

        ";
    }

    public static function writeScriptz() {
        echo "
            var channel = pusher.subscribe('" . \Auth::user()->chat_key . "');
            channel.bind('new-message', notificationz);
        ";
    }

}
