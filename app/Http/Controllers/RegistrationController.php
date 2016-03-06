<?php namespace App\Http\Controllers;

use Session;

class RegistrationController extends Controller {

    public function confirm($confirmation_code)
    {
        if( ! $confirmation_code)
        {
            abort(404);
        }

        $user = \App\User::whereConfirmationCode($confirmation_code)->first();

        if ( ! $user)
        {
            abort(404);
        }
        $user->confirmed = 1;
        $user->confirmation_code = null;
        $user->save();

        Session::flash('success','alt');

        return redirect('auth/login');
    }
}