@extends('app')

@section('content')
    <body style="overflow: hidden">
    <div id="gornjalinija"></div>
    <div id="learn"><a href="/main">LEARN_ON</a></div>
    <div id="podvucena"></div>
    <div style="width:80%; left:18.3%; text-align:center; position:absolute;">
        <section style="font-size:2em; font-family: Intro_Bold;"> - {{ $course->title }} - </section>
    </div>
    @include('partials._levi_meni')
    <div id="polje4" style="overflow-x: hidden">
        <div class="width" >
            <div id="wrapping_content_course" >
                <div id="span_container">
                    <div style="float:left;clear:both">
                        {!! Html::image('img/courses/'.$course->thumbnail,'error 404',['id'=>'thumbnail_course']) !!}
                        <br/>
                        <label style="color:rgba(120,120,120,.5);" >By: {{$course->user->username}}</label>
                        <br>
                        <label style="color:rgba(120,120,120,.5);" >Published {{$course->published_at->diffForHumans()}}</label>
                    </div>
				<span style="position:relative;display: inline; float:right;clear:both; left: 20px; width:40%">
					<p style="color:gray;">{{ $course->body }}</p>
				</span>
                </div>
            </div>
            <div id="bottom_content">
                <div style="text-align:center;border-bottom:1px solid black;">
                    <label style="color:red;font-size:32pt;padding:0px"><b>LECTURES</b></label>
                </div>
                @foreach($course->lectures as $lecture)
                <div id="lecture_wrapper">
                    <div style="width:100px; height:150px;">
                        {!! Html::image('img/paper.png','ERROR 404',['style'=>'width:100px;backgrgound-color:black;height:150px']) !!}
                    </div>
                    <div class="link" style="padding-top:50px; position:relative; width: 70%;left:20px;word-wrap:break-word; font-size: 40px">
                        {{ $lecture->lecture_title }}
                    </div>
                    @if(\Auth::User()->level==1) <div style="position: absolute;"><a href="/lectures/{{$lecture->id}}/edit">{!! Html::image('img/edit.png','ERROR 404',['style'=>'position:relative; height:60px;  left: 57px; top:30px; width:60px']) !!}<div style="position:relative; font-size: 35px; color: red; top: 20px;left:50px ">EDIT</div> </a></div> @endif
                 </div>
                @endforeach
                @if (\Auth::User()->level==1)
                    <div id="lecture_wrapper">
                        <div style="width:100px; height:150px;">
                            {!! Html::image('img/test.png','ERROR 404',['style'=>'width:120px;backgrgound-color:black;height:150px']) !!}
                        </div>
                        <div class="link" style="padding-top:50px; position:relative; width: 70%;left:20px;word-wrap:break-word; font-size: 40px">
                            Test
                        </div>
                        <div style="position: absolute;"><a href="/exam/{{$lecture->course()->first()->id}}/edit">{!! Html::image('img/edit.png','ERROR 404',['style'=>'position:relative; height:60px;  left: 57px; top:30px; width:60px']) !!}<div style="position:relative; font-size: 35px; color: red; top: 20px;left:50px ">EDIT</div> </a></div>
                    </div>
                    <div id="lecture_wrapper" style="margin-bottom: 20px">
                        {!! Form::open(['url'=>'/getLecture/'.$course->id,'method'=>'GET']) !!}
                        <button type="submit" class="addqu" style="cursor: pointer; left: 325px;  position:relative; width:682px; height:150px;">{!! Html::image('img/add_lecture.png','Error404',['class'=>'addqu','style'=>' position:absolute; left:0%; top:0%;  width:682px; height:150px;']) !!}</button>
                        {!! Form::close() !!}
                    </div>
                @endif
                <div style="text-align:center; overflow: visible ">
                    {!! Form::open(['url'=>'enroll/'.$course->id,]) !!}
                    <button type="submit" class="addqu" id="enroll" style="cursor: pointer;  position:relative; bottom: -10px; width:1265px; height:254px;">{!! Html::image('img/enroll.png','Error404',['class'=>'addqu','style'=>' position:absolute; left:0%; top:0%;  width:1265px; height:254px;']) !!}</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    @if(App\Enroll::where(['user_id'=>Auth::user()->id,'course_id'=>$course->id])->exists())
        <script>
            $('#enroll').on('click',function(e){
                e.preventDefault();
                var form = $(this).parents('form');
                swal({
                            title: "Are you sure?",
                            text: "If you enroll the previous record of you attending this course will be deleted",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Yes, enroll!",
                            allowEscapeKey: true,
                            allowOutsideClick:false
                        },
                        function(isConfirm){
                            if (isConfirm)
                            {
                                form.submit();
                            }
                        });})
        </script>
    @endif

    @if (Session::has('lec'))<script>swal({
            title:"Good job!",
            text:"You successfully made a new lecture",
            type:"success",
            timer:2000,
        })</script>
    @endif

    @if (Session::has('lec_deleted'))<script>swal({
            title:"Good job!",
            text:"The lecture has been successfully deleted",
            type:"success",
            timer:2000,
        })</script>
    @endif

    </body>
@stop