@extends('app')

@section('content')
	{!! Form::model($course=new \App\Course, ['url'=>'courses', 'files'=>true]) !!}
<body style="overflow: hidden">
<div id="gornjalinija"></div>
<div id="learn"><a href="/main">LEARN_ON</a></div>
<div id="podvucena"></div>
<div style="width:35%; left:48.4%; position:absolute;">
    <section style="font-size:2em; font-family: Intro_Bold"> - COURSE EDITOR - </section>
</div>
@include('partials._levi_meni')
<div id="polje4">
    <div class="width" id="markup">
        <div class="form-group">
            {!! Form::text('title',null,['class' => 'width','id'=>'course_title','placeholder'=>'COURSE TITLE HERE...','autocomplete'=>'off']) !!}
        </div>
        <div id="wrapping_content" >
            <div>
                <div id="thumbnail">
                    <img src="/img/courses/default.jpg" style="height: 190px; width: 350px;" alt="error"/>
                </div>
                <section style="position:relative; top:30px;display: inline">
                    <div class="form-group" style="position:relative; left: 5%;">
                        {!! Form::label('published_at','Publish on:') !!}
                        {!! Form::input('date','published_at',$course->published_at->format('Y-m-d'),['id'=>'filename','class'=>'form-control']) !!}
                    </div>
                    <div style="position: relative; top: 10px; left:65px;">
                    Choose a thumbnail: {!! Form::file('thumbnail',null,['accept'=>'image/*']) !!}
                    </div>
                    <div class="form-group" style="position:relative; top:20px; left:5%;">
                        {!! Form::label('tag_list','Category:') !!}
                        {!! Form::select('tag_list[]',$tags,null,['id'=>'tag_list','class'=>'form-control','style'=>'font-family:Exo_bold; width:250px', 'placeholder' =>'Choose Category...']) !!}
                    </div>
                </section>
            </div>
        </div>
        <hr class="width" style="position:relative; top:135px; width: 97.5%; left: -24%; height: 2px; background-color: black; ">
        <div id="bottom_content">
            <div>
                <div class="form-group">
                    {!! Form::textarea('body',null,['class' => 'width','id'=>'text_area', 'placeholder'=>'Description...']) !!}
                </div>
                <button type="submit" id="sub" class="addqu" style="cursor: pointer;  position:absolute; left:27px;  top:67%; width:1265px; height:254px;">{!! Html::image('img/create_course.png','Error404',['class'=>'addqu','style'=>' position:absolute; left:0%; top:0%;  width:1265px; height:254px;']) !!}</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
{!!Form::close()!!}
@endsection
@section('footer')
    @if (count($errors) > 0)
        <script>swal("Whoops!!","There were some problems with your input.<?php foreach ($errors->all() as $error)
    {
        echo e($error);
    }
    ?>","error")</script>
    @endif
<script>
    $('#tag_list').select2({
        placeholder:'Choose tags'
    });
    $(".js-example-theme-multiple").select2({
        theme: "classic"
    });
</script>
    <script>
        $('#sub').on('click',function(e){
            e.preventDefault();
            var form = $(this).parents('form');
            swal({
                        title: "Are you sure?",
                        text: "You will not be able to edit the course until it is published",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, create course!",
                        allowEscapeKey: true,
                        allowOutsideClick:false
                    },
                    function(isConfirm){
                        if (isConfirm)
                        {
                            form.submit()
                        }
                    });})
    </script>
</body>
@stop