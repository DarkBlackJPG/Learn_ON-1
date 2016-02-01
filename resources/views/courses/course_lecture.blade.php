@extends('app')
@section('content')
    <body style="overflow: hidden">
    <div id="gornjalinija"></div>
    <div id="learn"><a href="/main">LEARN_ON</a></div>
    <div id="podvucena"></div>
    <div style="width:35%; left:48.2%; position:absolute;">
        <section style="font-size:2em; font-family: Intro_Bold"> - LECTURE EDITOR - </section>
    </div>
    @include('partials._levi_meni')
    <div id="polje4">
        <div class="width">
        {!! Form::open(['url'=>'/lecture/'.$id,'files'=>true]) !!}
            <div class="form-group">
                {!! Form::text('lecture_title',null,['class' => 'width','id'=>'course_title','placeholder'=>'LECTURE TITLE HERE...','autocomplete'=>'off']) !!}
            </div>
            <div id="textbox_linija"></div>
            {!! Html::image('img/paper.png','ERROR 404',['style'=>'position:relative;left:20px; top:20px;']) !!}
            <div id="choose">Choose a PDF:</div>
            <input name="pdf" type="file" accept=".pdf" style="position:relative; left:290px; top:-150px;"/>
            <div id="video">Video URL:</div>
            {!! Form::text('video',null,['placeholder'=>'https://www.youtube.com/example','style'=>'position:relative; border:1; border-style:dashed; left:260px; top:-164px; width:500px; ']) !!}
            <hr class="width" style="position:relative; top:-40px; width: 97.5%; left: -17px; height: 2px; background-color: black; ">
            <div id="bottom_content">
                <div>
                    <div class="form-group">
                        {!! Form::textarea('body',null,['class' => 'width','style'=>'border: dashed red 2px; position:relative; top:5px; height: 175px; font-size: 1.5em; resize: none;', 'placeholder'=>'Description...']) !!}
                    </div>
                    <button type="submit" class="addqu" style="cursor: pointer;  position:absolute; left:27px;  top:67%; width:1265px; height:254px;">{!! Html::image('img/add_lecture.png','Error404',['class'=>'addqu','style'=>' position:absolute; left:0%; top:0%;  width:1265px; height:254px;']) !!}</button>

                </div>
            </div>
{!!Form::close()!!}
</body>
@endsection
@section('footer')
    @if (count($errors) > 0)
        <script>swal("Whoops!","There were some problems with your input.<?php foreach ($errors->all() as $error)
    {
        echo e($error);
    }
    ?>","error")</script>
    @endif
    @if(Session::has('lecture_or_test'))
        <script>
            var id = "{{$id}}";
            swal({
                        title: "You successfully made a lecture!",
                        text: "Do you want to make another lecture, or do you wish to proceed to making a test?",
                        type: "success",
                        showCancelButton: true,
                        cancelButtonText: "Make another lecture!",
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Make a test!",
                        allowEscapeKey: false,
                        allowOutsideClick:false
                    },
                    function(isConfirm){
                        if (isConfirm)
                        {
                            window.location = "{{ url('/test') }}/" + id;
                        }
                    });
        </script>
    @endif
    @if(Session::has('valid_url'))<script>swal("Whoops!","There were some problems with your input. The URL is not of a valid youtube video.","error")</script>@endif
@stop