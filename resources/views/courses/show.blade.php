@extends('app')

@section('content')
    <body style="overflow: hidden">
    <div id="gornjalinija">

        <div id="learn"><a href="{{ url('main') }}">LEARN_ON</a></div>
        <div id="hamburger_menu">
            <div id="nav-icon3">
                <span></span>
                <span></span>
                <span></span>
                <span></span>

                <div id="menimeni">
                    MENU
                </div>
            </div>
        </div>
        <div id="chat"><a href="{{URL('chat')}}">{!! Html::image('img/chat.svg','alt',['style'=>'width:30px']) !!}</a></div>


        <section class="header_text" > - {{$course->title}} - </section>

    </div>
    @include('partials._levi_meni')
    <div id="content_wrapper">
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
            <div >
                <div style="text-align:center;border-bottom:1px solid black;">
                    <label style="color:red;font-size:32pt;padding:0px"><b>LECTURES</b></label>
                </div>
                @foreach($course->lectures as $lecture)
                <div id="lecture_wrapper">
                    <div style="width:100px; height:150px;margin-left: 25px">
                        {!! Html::image('img/paper.png','ERROR 404',['style'=>'width:100px;backgrgound-color:black;height:150px;']) !!}
                    </div>
                    <div class="link" style="padding-top:50px; width: auto;left:20px;word-wrap:break-word; font-size: 30px">
                        {{ $lecture->lecture_title }}
                    </div>
                    @if(\Auth::User()->level==1) <div style="margin-left: 20px;" ><a href="/lectures/{{$lecture->id}}/edit">{!! Html::image('img/edit.png','ERROR 404',['style'=>'height:60px;  width:60px']) !!}<div style="font-size: 2em; color: red;position: relative;left:-10px  ">EDIT</div> </a></div> @endif
                 </div>
                @endforeach
                @if (\Auth::User()->level==1)
                    <div id="lecture_wrapper">
                        <div style="width:150px; height:150px;">
                            {!! Html::image('img/test.png','ERROR 404',['style'=>'backgrgound-color:black;height:150px']) !!}
                        </div>
                        <div class="link" style="padding-top:50px;  width: auto;word-wrap:break-word; font-size: 30px">
                            Test
                        </div>
                        <div style="margin-left: 20px"><a href="/exam/{{$lecture->course()->first()->id}}/edit">{!! Html::image('img/edit.png','ERROR 404',['style'=>'height:60px; width:60px']) !!}<div style="position:relative; font-size: 2em; color: red; left:-10px ">EDIT</div> </a></div>
                    </div>
                   <div id="lecture_wrapper" style="margin-bottom: 20px">
                        {!! Form::open(['url'=>'/getLecture/'.$course->id,'method'=>'GET','style'=>'width:100%;text-align:center']) !!}
                        <button type="submit" class="addqu" style="cursor: pointer;  width:250px; height:54px;;">{!! Html::image('img/add_lecture.png','Error404',['class'=>'addqu','style'=>' width:100%; height:100%;']) !!}</button>
                        {!! Form::close() !!}
                    </div>
                @endif
                <div style="text-align:center; overflow: visible ">
                    {!! Form::open(['url'=>'enroll/'.$course->id,]) !!}
                    <button type="submit" class="addqu" id="enroll" style="cursor: pointer; height:54px; width: 250px;">{!! Html::image('img/enroll.png','Error404',['class'=>'addqu','style'=>' width:100%; height:100%;']) !!}</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    </div>
    @if(App\Enroll::where(['user_id'=>Auth::user()->id,'course_id'=>$course->id])->exists())
        <script>
            $('#enroll').on('click',function(e){l
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