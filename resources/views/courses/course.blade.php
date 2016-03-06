@extends('app')
<script type="text/javascript" src="{!! asset('ckeditor-comment/ckeditor.js') !!}"></script>
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


        <section class="header_text" > - {{$lecture->lecture_title}} - </section>

    </div>

</div>
    <!-- Levi meni -->

    <div id="desnimeni">
        <div id="avatar">{!! Html::image('img/courses/'.$course->thumbnail,'Error 404') !!}</div>
        <div id="titl" style="width:100%;text-align:center" ><b title="{{$course->title}}" style="color:red; font-family:Intro_Bold; text-decoration: underline;  font-size:1.5em;">{{$course->title}}</b></div>
        {!! Form::open(['url'=>'/quit/'.$course->id, 'method'=>'POST', 'style' => 'text-align:center;margin-top:10px']) !!}
        <button type="submit" class="addqu" id="del" style="cursor: pointer;margin: auto;">{!! Html::image('img/quit.png','Error404',['class'=>'addqu','style'=>'  height:25px; width:90px;  ']) !!}</button>
        {!! Form::close() !!}
        <div style="position:relative; top: -30px">
            @foreach($course->lectures()->oldest('created_at')->get() as $lecturec)
            <div style="position:relative;">
                <div id="account">{!! Html::image('img/paper.png','alt',['style'=>'width:50px; height:70px; left:20px;top:45px;  position:relative;']) !!}</div>
                <div style="width:205px; font-family:Intro_Bold; left:33%; position:relative; font-size:130%; padding-bottom: -4%;"><a href="{{URL('lectures/'.$lecturec->id)}}" class="link">{{ $lecturec->lecture_title }}</a></div>
            </div>
            @endforeach
            <div style="position:relative;">
                <div id="account">{!! Html::image('img/test.png','alt',['style'=>'width:70px; height:70px; left:12%;top:45px;  position:relative;']) !!}</div>
                <div style="font-family:Intro_Bold; left:35%; position:relative; font-size:150%; padding-bottom: -4%;"><a href="{{URL('exam/'.$course->id)}}" class="link">Test</a></div>
            </div>

        </div>
    <div id="linija"></div>
        <div id="static">
            <div >
                <div class="block" id="about_img">{!! Html::image('img/about.png','alt',['style'=>' width:25px; ']) !!}</div>
                <div class="block" id="about"><a href="{{URL('about')}}" class="link">About us</a></div>
            </div>
            <div>
                <div class="block" id="contact_img">{!! Html::image('img/contact.png','alt',['style'=>'width:25px;']) !!}</div>
                <div class="block" id="contact"><a href="{{URL('contact')}}" class="link">Contacts</a></div>
            </div>
            <div >
                <div class="block" id="help_img">{!! Html::image('img/help.png','alt',['style'=>' width:25px;']) !!}</div>
                <div class="block" id="help"><a class="link" href="help">Help</a></div>
            </div>
            <div >
                <div class="block" id="t&c_img">{!! Html::image('img/t&c.svg','alt',['style'=>'width:25px']) !!}</div>
                <div class="block" id="t&c"><a href="{{URL('terms&conditions')}}" class="link">T & C</a></div>
            </div>
        </div>
    </div>

    <!-- End -->
<div id="content_wrapper">
    <div id="polje4" style="overflow-x:hidden ">

        <div style="position: relative; left:0%; top: 7px; max-width: 630px; font-size: 25px; font-family: Exo_bold; text-align: center">{{ $lecture->body }}</div>
        <div class="width" style="margin-top:15px; position:relative; width: 80%;  height: 2px; background-color: red; "></div>
        <div style="position: relative; left:20%; margin-top:15px"><iframe width="60%" height="845" src="/pdf/{{$lecture->pdf}}" frameborder="0"></iframe></div>
        @if($lecture->video)
            <div class="width" style="margin-top:15px; position:relative; width: 80%;  height: 2px; background-color: red; "></div>
            <div style="position: relative; left:20%; margin-top:15px"><iframe width="60%" height="366" src="{{$lecture->video}}" frameborder="0" allowfullscreen></iframe></div>
        @endif
        <div class="width" style="margin-top:15px; margin-bottom: 10px; position:relative; width: 80%;  height: 2px; background-color: red; "></div>
        <div style="position: relative;  height: 300px; width:60%; left:20%; color: #808080; font-family: Calibri">
            {!! Form::open(['url'=>'/comment', 'method'=>'POST']) !!}
            Add a public comment...
            {!! Form::textarea('comment',null,['id'=>'comment-ckeditor','style'=>'position: relative;']) !!}
            {!! Form::hidden('id',$lecture->id) !!}
            {!! Form::submit('Post',['class'=>'btn1', 'style'=>'position:relative; left:10px; top:5px; width:50px;']) !!}
            {!! Form::close() !!}
        </div>
        <div class="width" style="margin-top:15px; margin-bottom: 10px; position:relative; width: 80%; font-family: Calibri ">
            @foreach($comments as $comment)
                <div style="position:relative; min-height:80px; width:100%; margin-bottom: 15px;">
                    {!! Html::image('img/users/'.$comment->user()->first()->profile,'Error 404',['style'=>'border-radius: 50%; object-fit: cover; position:relative; height:50px; width:50px; left:5px; top:5px;"']) !!}
                    <div style="position:relative; left:70px; top:-50px;"><b>{{ $comment->user()->first()->username }}</b>&nbsp; &nbsp; <span style="color: #808080">{{ $comment->created_at->diffForHumans() }}</span>
                       @if(\Auth::user()->level == 1 or $comment->user_id == \Auth::user()->id)
                        {!! Form::open(['url'=>'/comment_delete/'.$comment->id, 'method'=>'POST']) !!}
                        <button type="submit" id="com" class="addqu" title="Delete comment" style="cursor: pointer; position: absolute; top:-5px; right:10px; height: 15px; width: 15px;"> {!! Html::image('img/x.gif','ERROR 404',['class'=>'addqu', 'style'=>'position:absolute; width:15px; height:15px; top:0px; left:0px;']) !!} </button>
                        {!! Form::close() !!}
                       @endif
                    </div>
                    <div style="position:absolute; left:70px; top:0px; width:80%;"><i>{!! $comment->comment !!}</i></div>
                </div>
            @endforeach
        </div>
    </div>
    </div>
    </body>
    @endsection
@section('footer')
    <script type="text/javascript">
        CKEDITOR.replace ('comment-ckeditor');
    </script>
    <script>
        $(document).ready(function() {
            $("#titl").dotdotdot();
        });
    </script>
    @if (count($errors) > 0)
        <script>swal("Whoops!!","There were some problems with your input.<?php foreach ($errors->all() as $error)
    {
        echo e($error);
    }
    ?>","error")</script>
    @endif
    <script>
        $('#del').on('click',function(e){
            e.preventDefault();
            var form = $(this).parents('form');
            swal({
                        title: "Are you sure?",
                        text: "You will not have record of attending this course if you do not finish it",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, quit!",
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
    <script type="text/javascript">
        $(document).ready(function(){
            var height = $('#gornjalinija').height();
            $('#desnimeni').height( $(window).height() - height )
            $(window).resize(function(){$('#slideshow').height( $(window).height() - height )
                $('#desnimeni').height( $(window).height() - height )});

        });
    </script>

    @if (Session::has('comment_deleted'))<script>swal({
            title:"Good job!",
            text:"The comment has been successfully deleted",
            type:"success",
            timer:2000,
        })</script>
    @endif

@stop