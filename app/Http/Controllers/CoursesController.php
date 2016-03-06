<?php namespace App\Http\Controllers;

use App\Comment;
use App\Courses;
use App\Enroll;
use App\Lectures;
use App\Course;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Requests\CourseRequest;
use App\Http\Requests\LectureRequest;
use App\Http\Requests\QuestionRequest;
use App\Http\Requests\CommentRequest;
use App\Tag;
use App\Test;
use App\Lecture;
use Auth;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use File;
use Illuminate\Support\Facades\Input;
use App\Question;
use Redirect;
use Session;
use Request;
use Validator;
use Illuminate\Support\Facades\View;



class CoursesController extends Controller
	{

    /**
     *Guests do nto have access to these pages!
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin', ['only'=>['delete_questions','redirecting','see','getMyCourses','lecture_pdf','getExamEdit','questionUpdate','editLecture','lectureUpdate','edit','create','store','lecture','update','test','getLecture','test_create','course_img','delete_course','question','getQuestion','delete_lecture']]);
    }

    public function comment_delete($id)
    {
        $comment=Comment::findOrFail($id);
        $comment->delete();
        Session::flash('comment_deleted','alt');
        return redirect::back();
    }

    public function comment(CommentRequest $request)
    {
        $comment=new Comment;
        $comment->user_id=Auth::user()->id;
        $comment->lecture_id=$request->id;
        $comment->comment=$request->comment;
        $comment->save();
        return redirect::back();
    }

    public function delete_question($id)
    {
        $question=Question::findOrFail($id);
        $test=$question->test()->first();
        if($test->questions()->count() == 1)
            return redirect::back()->withErrors(['You can not delete the last question in the exam.']);
        $question->delete();
        return redirect::back();
    }

    public function finish($id)
    {
        $course=Course::findOrFail($id);
        if($course->lectures()->exists() and $course->test()->exists() and $course->test()->first()->questions()->exists())
        {
            $course->done=1;
            $course->save();
            return redirect ('mycourses');
        }
        return abort(404);
    }

    public function redirecting($id)
    {
        $course=Course::findOrFail($id);
        if(! $course->lectures()->exists())
            return redirect('getLecture/'.$id);
        if(! $course->test()->exists())
            return redirect('test/'.$id);
        if(! $course->test()->first()->questions()->exists())
            return redirect('getQuestion/'.$id);
        if($course->done == 0)
        {
            $course->done=1;
            $course->save();
            return redirect('mycourses');
        }
        return abort(404);
    }

    public function getMyCourses()
    {
        if(! Auth::user()->courses()->exists())
            return redirect('main');
        return view('courses.my_courses');
    }

    public function course_lecture($id)
    {
        $lecture=Lecture::find($id);
        if(Enroll::where(['user_id'=>Auth::user()->id,'course_id'=>$lecture->course()->first()->id])->ongoing()->exists())
        {
            $course = $lecture->course()->first();
            $comments=$lecture->comments()->latest('created_at')->get();
            return view('courses.course', compact('course', 'lecture','comments'));
        }
        return redirect('main');
    }

    public function enroll($id)
    {
        if(Course::findOrFail($id)->done()) {
            if (Enroll::where(['user_id' => Auth::user()->id, 'course_id' => $id])->exists())
                Enroll::where(['user_id' => Auth::user()->id, 'course_id' => $id])->delete();
            $enroll = new Enroll;
            $enroll->course_id = $id;
            $enroll->user_id = Auth::user()->id;
            $enroll->save();
            return redirect('courses/' . $id);
        }
    }

    public function delete_course($id)
    {
        $course=Course::findorFail($id);
        $lectures=$course->lectures()->get();
        foreach($lectures as $lecture)
        {
            File::delete('pdf/'.$lecture->pdf);
        }
        if($course->thumbnail == 'default.jpg')
        {
            $course->Delete();
            Session::flash('course_deleted','alt');
            return redirect('main');
        }
        else
            if(File::exists('img/courses/'.$course->thumbnail))
            {
                File::delete('img/courses/'.$course->thumbnail);
                $course->Delete();
                Session::flash('course_deleted','alt');
                return redirect('main');
            }
        {{dd("ERROR 404");}}
    }

    public function course_img()
    {
        $rules = [
            'thumbnail' => 'required|image|max:2000'
        ];

        $file = Input::only(
            'thumbnail'
        );
        $validator = Validator::make($file, $rules);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        else
        {
            $course=Course::findorFail(Input::get('id'));
            $destinationPath = 'img/courses';
            $extension = Input::file('thumbnail')->getClientOriginalExtension();
            $fileName = $course->id . '.' . $extension;
            Input::file('thumbnail')->move($destinationPath, $fileName);
            $course->thumbnail = $fileName;
            $course->save();
            Session::flash('img_edited','alt');
            return redirect::back();
        }
    }

    public function categories()
    {
        $tags = \DB::table('tags')->get();
        return view('pages.categories', compact('tags'));
    }

    public function postSearch(Request $request)
    {
        $keywords = \Request::input('keywords');

        $courses = Course::published()->done()->latest('published_at')->get();

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

    /**
     * Redirects to main page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $courses= Course::latest('published_at')->Published()->Done()->Paginate(15);
        return view('pages.main', compact('courses'));
    }

    public function test_create()
    {
        return view ('tests.create_test');
    }

    public function main()
    {
        $courses= Course::latest('published_at')->Published()->Done()->Paginate(15);
        return view('pages.main', compact('courses'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    //public function index()
    //{

	//	$courses= Course::latest('published_at')->Published()->get();
	//	return view('pages.main', compact('courses'));
	//}

	//Create an course , return create view
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function create()
	{
		$tags = Tag::lists('name','id');
		return view ('courses.create', compact('tags'));
	}


	//Return a course that matches the $id

    public function show(Course $course)
	{
        if(Enroll::where(['course_id'=>$course->id,'user_id'=>Auth::user()->id])->ongoing()->exists() and $course->published())
        {
            $lecture=$course->lectures()->first();
            $comments=$lecture->comments()->latest('created_at')->get();
            return view('courses.course', compact('course','lecture','comments'));
        }
		return view('courses.show', compact('course'));
	}

    public function quit($id)
    {
        $enroll=Enroll::where(['course_id'=>$id,'user_id'=>Auth::user()->id])->first();
        $enroll->delete();
        return redirect('main');
    }

	//When course is created redirect to the "courses" page
    /**
     * @param CourseRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CourseRequest $request)
	{
        /**if ($request->published_at < Carbon::yesterday())
         {{dd('uspelo');}} */
        $course= Auth::user()->courses()->create($request->all());
        $this->syncTags ($course, $request->input('tag_list'));
        if($request->thumbnail)
        {
            $destinationPath = 'img/courses';
            $extension = $request->thumbnail->getClientOriginalExtension();
            $fileName = $course->id . '.' . $extension;
            $request->thumbnail->move($destinationPath, $fileName);
            $course->thumbnail = $fileName;
            $course->save();
        }
        $id=$course->id;

        return redirect('getLecture/'.$id);
	}

	//Finding the course requested by $id, and returning a view that contains a form
    /**
     * @param Course $course
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     * @internal param $id
     */
    public function edit(Course $course)
	{
        $tags = Tag::lists('name','id');

		return view('courses.edit', compact('course','tags'));
	}

	//Finding the course requested by $id,updating it, and redirecting to 'courses' page
    /**
     * @param CourseRequest|CourseRequest $request
     * @param Course $course
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @internal param $id
     */
    public function update(CourseRequest $request, Course $course)
	{
		$course->update($request->all());

        $this->syncTags ($course, $request->input('tag_list'));

		return redirect('main');
	}

    /**
     * Sync up the list of tags in the database
     * @param Course $course
     * @param array $tags
     * @internal param Course $article
     */
    private function syncTags ( Course $course, array $tags)
    {
        $course->tags()->sync($tags);
    }

    public function lecture($id, LectureRequest $request)
    {
        $course=Course::findorFail($id);
        $lecture=$course->lectures()->create($request->all());
        if(! str_contains($request->video,'youtube') && ! $request->video==null)
        {
            Session::flash('valid_url','alt');
            return View('courses.course_lecture')->with('id',$id);
        }
        if(str_contains($request->video,'watch?v='))
            $lecture->video=str_replace('watch?v=', 'embed/', $request->video);
        $destinationPath = 'pdf';
        $extension = $request->pdf->getClientOriginalExtension();
        $fileName = $lecture->id . '.' . $extension;
        $request->pdf->move($destinationPath, $fileName);
        $lecture->pdf=$fileName;
        $lecture->save();
        if($course->done == 1)
        {
            Session::flash('lec','alt');
            return redirect('courses/' . $course->id);
        }
        Session::flash('lecture_or_test','alt');
        return redirect('getLecture/'.$id);
    }

    public function getLecture($id)
    {

        return View('courses.course_lecture')->with('id', $id);
    }

    public function test($id)
    {
        if(Course::findorFail($id)->done==1) return redirect('main');
        $name=['name','title'];
        $test= Course::findorFail($id)->test()->create($name);
        $test->save();
        return redirect('getQuestion/'.$id);
    }


	public function question($id, QuestionRequest $request)
    {
        if($request->correct1 +$request->correct2 + $request->correct3 + $request->correct4 + $request->correct5 == null)
        {
            return redirect()->back()->withErrors(['There must be at least one correct answer.'])->withInput()->with('id',$id);
        }
        $course=Course::findorFail($id);
        $test=Test::where('course_id','=',$course->id)->firstOrFail();
        $question=$test->questions()->create($request->all());
        $question->save();
        $this->evaluate($question,$question->test()->first());
        if($course->done == 1)
        {
            Session::flash('qu_add','alt');
            return redirect('/exam/'.$course->id.'/edit');
        }
        Session::flash('question_or_finish','alt');
        return redirect('getQuestion/'.$id);
    }

    public function getQuestion($id)
    {
        return view('tests.test_create')->with('id',$id);
    }

    /**
     * Evaluate the points of a single question
     *
     * @param Question $question
     * @param Test $test
     */
    private function evaluate(Question $question, Test $test)
    {
        if($question->correct1 +$question->correct2 + $question->correct3 + $question->correct4 + $question->correct5 == 0)
            abort(404);
        if($question->correct1 == 1)
            $test->points++;
        if($question->correct2 == 1)
            $test->points++;
        if($question->correct3 == 1)
            $test->points++;
        if($question->correct4 == 1)
            $test->points++;
        if($question->correct5 == 1)
            $test->points++;
        $test->save();
    }

    public function editLecture($id)
    {
        $lecture=Lecture::findOrFail($id);

        return view('courses.edit_lecture', compact('lecture'));
    }

    public function lectureUpdate(\Illuminate\Http\Request $request, $id)
    {
        $messages=[
            'lecture_title.required'=>'The lecture title is required. ',
            'lecture_title.min'=>'The lecture title must be at least 3 characters long. ',
            'lecture_title.max'=>'The lecture title must be 30 characters long at most. ',
            'body.required'  => 'The lecture description is required. ',
        ];

        $rules=[
            'video'=>'url|min:6',
            'body' => 'required|min:3|max:255',
            'lecture_title'=>'required|min:3|max:30'
        ];

        $input = Input::only(
            'video',
            'body',
            'lecture_title'
        );
        $validator = Validator::make($input, $rules, $messages);
        if($validator->fails())
        {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $lecture=Lecture::findOrFail($id);
        $lecture->update($request->all());
        if(! str_contains($request->video,'youtube') && ! $request->video==null)
        {
            return redirect::back()->withErrors(['The URL is not of a valid youtube video.'])->with('id',$id);
        }
        if(str_contains($request->video,'watch?v='))
            $lecture->video=str_replace('watch?v=', 'embed/', $request->video);
        $lecture->save();
        return redirect('main');
    }

    public function delete_lecture($id)
    {
        $lecture=Lecture::findOrFail($id);
        if(Course::findOrFail($lecture->course_id)->lectures()->count() == 1)
            return redirect::back()->withInput()->withErrors(['You can not delete the last lecture in the course.']);
        File::delete('pdf/'.$lecture->pdf);
        dd($lecture->pdf);
        $lecture->Delete();
        Session::flash('lec_deleted','alt');
        return redirect('courses/'.$lecture->course()->first()->id);
    }

    public function lecture_pdf()
    {
        $rules = [
            'pdf' => 'required|mimes:pdf|max:2000'
        ];

        $file = Input::only(
            'pdf'
        );
        $validator = Validator::make($file, $rules);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        else
        {
            $lecture=Lecture::findorFail(Input::get('id'));
            $destinationPath = 'pdf';
            $fileName = $lecture->id . '.' . 'pdf';
            Input::file('pdf')->move($destinationPath, $fileName);
            $lecture->pdf = $fileName;
            $lecture->save();
            Session::flash('pdf_edited','alt');
            return redirect::back();
        }
    }

    public function getExam($id)
    {
        $course=Course::findOrFail($id);
        if($course->done())
        {
            if (Enroll::where(['course_id'=>$course->id,'user_id'=>Auth::user()->id])->finished()->exists())
                return redirect('main');
            $enroll=Enroll::where(['course_id'=>$course->id,'user_id'=>Auth::user()->id])->first();
            $test=$course->test()->first();
            $questions=$test->questions()->oldest('created_at')->get();
            $enroll->done=1;
            $enroll->save();
            return view('courses.exam', compact('course','questions'));
        }

        return redirect('main');
    }

    public function save (\Illuminate\Http\Request $request)
    {
        $points = 0;

        $question = Question::findOrfail(Input::get('id'));
        $course=$question->test()->first()->course()->first();

        $this->change($request);

        if($request->guess1 == 1 && $question->correct1 == 1)
            $points++;
        if($request->guess2 == 1 && $question->correct2 == 1)
            $points++;
        if($request->guess3 == 1 && $question->correct3 == 1)
            $points++;
        if($request->guess4 == 1 && $question->correct4 == 1)
            $points++;
        if($request->guess5 == 1 && $question->correct5 == 1)
            $points++;
        if($request->guess1 == 1 && $question->correct1 == 0)
            $points--;
        if($request->guess2 == 1 && $question->correct2 == 0)
            $points--;
        if($request->guess3 == 1 && $question->correct3 == 0)
            $points--;
        if($request->guess4 == 1 && $question->correct4 == 0)
            $points--;
        if($request->guess5 == 1 && $question->correct5 == 0)
            $points--;

        $enroll=Enroll::where(['course_id'=>$course->id,'user_id'=>Auth::user()->id])->first();
        $enroll->points+=$points;

        if($enroll->points < 0)
            $enroll->points=0;

        $enroll->save();
    }

    private function change(\Illuminate\Http\Request $request)
    {
        if($request->guess1 == 'false')
            $request->guess1=0;
        else
            $request->guess1=1;

        if($request->guess2 == 'false')
            $request->guess2=0;
        else
            $request->guess2=1;

        if($request->guess3 == 'false')
            $request->guess3=0;
        else
            $request->guess3=1;

        if($request->guess4 == 'false')
            $request->guess4=0;
        else
            $request->guess4=1;

        if($request->guess5 == 'false')
            $request->guess5=0;
        else
            $request->guess5=1;
        return $request;
    }

    public function getExamEdit($id)
    {
        $course=Course::findOrFail($id);
        $questions=$course->test()->first()->questions()->get();
        return view('courses.test_edit', compact ('questions'));
    }

    public function questionUpdate (QuestionRequest $request, $id)
    {
        $question= Question::findOrFail($id);
        $question->update($request->all());
        if($request->correct1 == 0)
            $question->correct1=0;
        if($request->correct2 == 0)
            $question->correct2=0;
        if($request->correct3 == 0)
            $question->correct3=0;
        if($request->correct4 == 0)
            $question->correct4=0;
        if($request->correct5 == 0)
            $question->correct5=0;
        $question->save();

        return redirect::back();
    }
}
