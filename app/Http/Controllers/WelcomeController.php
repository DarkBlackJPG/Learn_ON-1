<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WelcomeController extends Controller
{
    public function index()
    {
        if (Auth::guest())
        {
            return redirect ('auth/login');
        }
        else
        {
            return redirect('courses');
        }
    }
}
