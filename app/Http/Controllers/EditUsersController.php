<?php

namespace App\Http\Controllers;

use Auth;
use File;
use Hash;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Redirect;
use Session;
use Validator;

class EditUsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function postDelete_account()
    {
        $user=Auth::user();
        if($user->profile == 'avatar.png')
        {
            $user->Delete();
            Session::flash('acc_deleted','alt');
            return redirect('auth/login');
        }
        else
            if(File::exists('img/users/'.$user->profile))
            {
                File::delete('img/users/'.$user->profile);
                $user->Delete();
                Session::flash('acc_deleted','alt');
                return redirect('auth/login');
            }
        {{dd("ERROR 404");}}
    }

    public function postEdit_email(Request $request)
    {
        $rules = [
            'email' => 'required|email|unique:users|confirmed',
        ];
        $input = Input::only(
            'email',
            'email_confirmation'
        );
        $validator = Validator::make($input, $rules);
        if($validator->fails())
        {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        else
        {
            $new=$request->input('email');
            $user = Auth::user();
            $user->email=$new;
            $user->save();
            Session::flash('email_edited','alt');
            return redirect('account');
        }
    }

    public function postEdit_username(Request $request)
    {
        $rules = [
            'username' => 'required|min:6|unique:users|max:15|confirmed',
        ];
        $input = Input::only(
            'username',
            'username_confirmation'
        );
        $validator = Validator::make($input, $rules);
        if($validator->fails())
        {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        else
        {
            $new=$request->input('username');
            $user = Auth::user();
            $user->username=$new;
            $user->save();
            Session::flash('username_edited','alt');
            return redirect('account');
        }
    }


    public function postEdit_pass(Request $request)
    {
        $rules = [
            'old_pass' => 'required|min:6|max:60',
            'password' => 'required|min:6|max:60|confirmed',
        ];

        $input = Input::only(
            'old_pass',
            'password',
            'password_confirmation'
        );

        $validator =Validator::make($input, $rules);

        if($validator->fails())
        {
            Session::flash('error_pass',null);
            return Redirect::back()->withInput()->withErrors($validator);
        }
        $current = $request->input('old_pass');
        $new = $request->input('password');
        $user = Auth::user();
        if (Hash::check($current, $user->password))
        {
            $user->password = bcrypt($new);
            $user->save();
            Session::flash('pass_edited','alt');
            return redirect('account');
        }
        else
        {
            return redirect()->back()->withErrors('Incorrect password given.');
        }
    }

    public function postEdit_img()
    {
        $rules = [
            'image' => 'required|image|max:2000'
        ];

        $file = Input::only(
            'image'
        );
        $validator = Validator::make($file, $rules);
        if ($validator->fails()) {
            return Redirect::to('account')->withInput()->withErrors($validator);
        }
        else
        {
            $destinationPath = 'img/users';
            $extension = Input::file('image')->getClientOriginalExtension();
            $fileName = Auth::user()->id . '.' . $extension;
            Input::file('image')->move($destinationPath, $fileName);
            Auth::user()->profile = $fileName;
            Auth::user()->save();
            Session::flash('img_edited','alt');
            return redirect('account');
        }
    }
}
