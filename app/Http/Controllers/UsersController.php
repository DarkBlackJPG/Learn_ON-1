<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use File;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Redirect;
use Session;
use Validator;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function postUser_admin(Request $request)
    {
        $user=User::find($request->input('id'));
        $user->level=0;
        $user->save();
        Session::flash('acc_not_admin','alt');
        return Redirect::back();
    }

    /**
     * Make a user an administrator
     * @param Request $request
     * @return mixed
     */
    public function postAdmin_user(Request $request)
    {
        $user=User::find($request->input('id'));
        $user->level=1;
        $user->save();
        Session::flash('acc_admin','alt');
        return Redirect::back();
    }

    /**
     *Give admin a view to add a user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAdd_User()
    {
        return view('admin.add_user');
    }

    /**
     * Admin making a new user
     * @param Request $request
     * @return Redirect
     */
    public function postAdmin_Add_user(Request $request)
    {
        $rules = [
            'password' => 'required|min:6|max:60|confirmed',
            'username' => 'required|min:6|unique:users|max:15|confirmed',
            'email' => 'required|email|unique:users|confirmed',
        ];

        $input = Input::only(
            'password',
            'password_confirmation',
            'username',
            'username_confirmation',
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
            $password=$request->input('password');
            $username=$request->input('username');
            $email=$request->input('email');
            $user= new User();
            $user->password=bcrypt($password);
            $user->email=$email;
            $user->chat_key=str_random(30);
            $user->username=$username;
            $user->confirmed=1;
            $user->profile='avatar.png';
            if($request->input('administrator')==null){$user->level=0;}
            else if($request->input('administrator')== 1){$user->level=1;}
            $user->save();
            Session::flash('acc_created','alt');
            return redirect('users');
        }
    }

    /**
     * Show admin a specific user who's ID is in the page URL
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $user= User::find($id);
        return view('admin.edit_all_users', compact('user'));
    }

    /**
     * Give admin a view of all users registered and confirmed
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users= Auth::user()->where('confirmed','1')->paginate(15);
        return view('admin.all_users', compact('users'));
    }

    public function postAdmin_Edit_pass(Request $request)
    {
        $rules = [
            'password' => 'required|min:6|max:60|confirmed'
        ];

        $input = Input::only(
            'password',
            'password_confirmation'
        );

        $validator = Validator::make($input, $rules);

        if($validator->fails())
        {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        $new = $request->input('password');
        $user=User::find($request->input('id'));
        $user->password = bcrypt($new);
        $user->save();
        Session::flash('pass_edited','alt');
        return Redirect::back();
    }

    public function postAdmin_Edit_username(Request $request)
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
            $user=User::find($request->input('id'));
            $user->username=$new;
            $user->save();
            Session::flash('username_edited','alt');
            return Redirect::back();
        }
    }

    public function postAdmin_Edit_email(Request $request)
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
            $user=User::find($request->input('id'));
            $user->email=$new;
            $user->save();
            Session::flash('email_edited','alt');
            return Redirect::back();
        }
    }

    public function postAdmin_Delete_user(Request $request)
    {
        $user=User::find($request->input('id'));
        if($user->profile == 'avatar.png')
        {
            $user->Delete();
            Session::flash('acc_deleted','alt');
            return redirect('users');
        }
        else
        if(File::exists('img/users/'.$user->profile))
        {
            File::delete('img/users/'.$user->profile);
            $user->Delete();
            Session::flash('acc_deleted','alt');
            return redirect('users');
        }
    }
}
