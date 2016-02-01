<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Course;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use View;

class TagsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Tag $tag)
    {
        $tags = \DB::table('tags')->get();
        $courses = $tag->courses()->published()->done()->latest('published_at')->paginate(3);

        return view('pages.tags', compact ('courses','tags','tag'));
    }

    public function postSearch(Request $request)
    {
        $keywords = \Request::input('keywords');

        $tag =Tag::findOrFail($request->tag);

        $courses = $tag->courses()->published()->done()->latest('published_at')->get();

        $searchCourses = new \Illuminate\Database\Eloquent\Collection();

        if($keywords == null)
            return view::make('courses.searchedCourses')->with('searchCourses',$courses);

        foreach($courses as $course)
        {
            if(Str_contains(Strtolower($course->title),Strtolower($keywords)))
                $searchCourses->add($course);
        }

        return View::make('courses.searchedCourses')->with('searchCourses',$searchCourses);
    }
}
