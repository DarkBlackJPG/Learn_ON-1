@extends('app')

@section('content')
	{!! Form::model($course=new \App\Course, ['url'=>'courses', 'files'=>true]) !!}
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


        <section class="header_text" > - COURSE EDITOR - </section>

</div>
@include('partials._levi_meni')
<div id="content_wrapper">
<div id="polje4">
    <div class="width" id="markup">
        <div class="form-group" style="text-align: center">
            {!! Form::text('title',null,['class' => 'width','id'=>'course_title','placeholder'=>'COURSE TITLE HERE...','autocomplete'=>'off']) !!}
        </div>
        <div id="wrapping_content">
            <div style="height: auto;overflow: auto;">
                <div id="thumbnail">
                    <img src="/img/courses/default.jpg" style="height: 55%; width: 100%;" alt="error"/>
                </div>
                <div id="qbox" style="float: left">
                <section>
                    <div class="form-group" style="left: 5%;">
                        {!! Form::label('published_at','Publish on:') !!}
                        {!! Form::input('date','published_at',$course->published_at->format('Y-m-d'),['id'=>'filename','class'=>'form-control']) !!}
                    </div>
                    <div style=" top: 10px; left:20px;">
                    Choose a thumbnail: {!! Form::file('thumbnail',null,['accept'=>'image/*']) !!}
                    </div>
                    <div class="form-group" style=" top:20px; left:5%;">
                        {!! Form::label('tag_list','Category:') !!}
                        {!! Form::select('tag_list[]',$tags,null,['id'=>'tag_list','class'=>'form-control','style'=>'font-family:Exo_bold; width:250px', 'placeholder' =>'Choose Category...']) !!}
                    </div>
                </section>
                    </div>
            </div>
        </div>
        <div id="bottom_content">
            <div>
               <div class="form-group">
                    {!! Form::textarea('body',null,['class' => 'width','id'=>'text_areaa', 'placeholder'=>'Description...']) !!}
               </div>
               </div>
                <button type="submit" id="sub" class="addqu" style="cursor: pointer; width:230px; height:54px;">{!! Html::image('img/create_course.png','Error404',['class'=>'addqu','style'=>'  height:54px;']) !!}</button>
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
    <style>


        #text_areaa
        {

            border: dashed red 2px  ;
            height: 175px;
            width:80%;
            left:10%;
            font-size: 1.5em;
            resize: none;
        }

        </style>

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