<?php

namespace App\Http\Controllers;

use App\Static_page;
use Redirect;
use App\Lecture;
use App\Course;
use Auth;
use DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\View;


class PagesController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('admin', ['only'=>['postSearchUser','account_access','postAbout']]);
	}

	public function show($id)
	{
		$lecture= Lecture::findorFail($id);
		return view('pages.rogue', compact('lecture'));
	}

	public function postSearchLecture(Request $request)
	{
		$keywords = $request->input('keywords');

		$lectures = Lecture::latest('created_at')->get();

		$searchLectures = new \Illuminate\Database\Eloquent\Collection();

		if($keywords == null)
			return view::make('pages.searchedLectures')->with('searchLectures',$lectures);

		foreach($lectures as $lecture)
		{
			if(Str_contains(Strtolower($lecture->lecture_title),Strtolower($keywords)) && $lecture->course()->first()->done ==1)
				$searchLectures->add($lecture);
		}

		return view::make('pages.searchedLectures')->with('searchLectures',$searchLectures);
	}

	public function library()
	{
		$lectures= Lecture::latest('created_at')->paginate(20);
		return view('pages.library', compact('lectures'));
	}

	public function account_access(User $acc)
	{
		$user=$acc->where('username','$acc->username');
		return view('admin.edit_all_users', compact('user'));
	}

	public function account()
	{
		$user= Auth::user();
		return view ('pages.edit_user', compact ('user'));
	}

    public function postSearchUser(Request $request)
    {
		$keywords = $request->input('keywords');

		$users = User::all();

		$searchUsers = new \Illuminate\Database\Eloquent\Collection();

		if($keywords == null)
			return view::make('admin.searchedUsers')->with('searchUsers',$users);

		foreach($users as $user)
		{
			if(Str_contains(Strtolower($user->username),Strtolower($keywords)))
				$searchUsers->add($user);
		}

		return view::make('admin.searchedUsers')->with('searchUsers',$searchUsers);
    }

	/**
	 *Redirects admin to the users page
	 * With the list of all active users and admins
     */

    public function getAbout()
	{
		$page= Static_page::find(1);
		return view('pages.about',compact('page'));
	}

    public function getContact()
    {
        $page= Static_page::find(3);
        return view('pages.about',compact('page'));
    }

    public function getTerms()
    {
        $page= Static_page::find(2);
        return view('pages.about',compact('page'));
    }

    public function getHelp()
    {
        $page= Static_page::find(4);
        return view('pages.about',compact('page'));
    }

	public function postAbout(Request $request)
	{
		$about = $request->input('static_content');
		$page= Static_page::find($request->id);
		$page->content=$about;
		$page->save();
		return redirect::back()->with('page',$page);
	}

}
?>
