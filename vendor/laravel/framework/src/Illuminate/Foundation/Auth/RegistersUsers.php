<?php

namespace Illuminate\Foundation\Auth;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Mail;
use Redirect;
use Session;
use Validator;

trait RegistersUsers
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
        return view('register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
        $rules = [
            'username' => 'required|min:6|unique:users|max:15',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6|max:60'
        ];

        $input = Input::only(
            'username',
            'email',
            'password',
            'password_confirmation'
        );

        $validator = Validator::make($input, $rules);

        if($validator->fails())
        {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        $confirmation_code = str_random(30);
        //$code = ['confirmation_code' => '$confirmation_code'];

        User::create([
            'username' => Input::get('username'),
            'email' => Input::get('email'),
            'password' => bcrypt(Input::get('password')),
            'profile' => 'avatar.png',
            'chat_key' => str_random(30),
            'confirmation_code' => $confirmation_code
        ]);

        Mail::send('emails.verify', ['confirmation_code' => $confirmation_code], function($message) {
            $message->to(Input::get('email'), Input::get('username'))
                ->subject('Email verification');
        });

        Session::flash('flash_message','alt');

        return redirect ('/auth/login');
    }
}
