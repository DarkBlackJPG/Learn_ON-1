@extends('app')

@section('content')
    <body  style="overflow: hidden">
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
            {!! Form::open(['url'=>'/delete_course/'.$course->id, 'method'=>'POST']) !!}
            <button type="submit" class="addqu" id="del" style="cursor: pointer; position:absolute; height:45px; width:150px; right:5px; top:0px; ">{!! Html::image('img/delete.png','Error404',['class'=>'addqu','style'=>' position:absolute; height:45px; width:150px; left:0; top:0%;  ']) !!}</button>
            {!! Form::close() !!}
            <div id="thumbnail" style="margin-top: 125px">
                {!! Html::image('img/courses/'.$course->thumbnail,'error404',['style'=>'height: 190px; width: 350px;']) !!}

            <div  style=" top:245px; left: 400px;">
                {!! Form::open(['url'=>'course_img','files'=>true, 'method'=>'POST']) !!}
                {!! Form::hidden('id',$course->id) !!}
                Change the thumbnail:<div style="width: 350px; overflow: hidden">{!! Form::file('thumbnail',null,['accept'=>'image/*','style'=>'width:200px']) !!}</div> {!! Form::submit('Upload Image', ['class'=>'btn1']) !!}
                {!! Form::close() !!}
            </div>
            </div>
            <div class="form-group" style="text-align: left">
                {!! Form::model($course, (['method'=>'PATCH' , 'action'=>['CoursesController@update', $course->id]]))!!}
                {!! Form::text('title',null,['class' => 'width','id'=>'course_title','placeholder'=>'COURSE TITLE HERE...','autocomplete'=>'off']) !!}
            </div>
            <div id="wrapping_content" >
                <div>

                    <section style="top:30px;display: inline">
                        <div class="form-group" style=" left: 5%;">
                            {!! Form::label('published_at','Publish on:') !!}
                            {!! Form::input('date','published_at',$course->published_at->format('Y-m-d'),['id'=>'filename','class'=>'form-control']) !!}
                        </div>
                        <div class="form-group" style="top:20px; left:5%;">
                            {!! Form::label('tag_list','Category:') !!}
                            {!! Form::select('tag_list[]',$tags,null,['id'=>'tag_list','class'=>'form-control','style'=>'font-family:Exo_bold; width:250px', 'placeholder' =>'Choose Category...']) !!}
                        </div>
                        <!-- AKO SE POMERI OVO SRANJE ONDA NE RADI UPLOAD!!!!!!!!!! --->


                    </section>
                </div>
            </div>

            <div >
                    <div class="form-group">
                        {!! Form::textarea('body',null,['class' => 'width','name' => 'body','id'=>'text_area', 'placeholder'=>'Description...']) !!}
                    </div>
<div>
                    <button type="submit" class="addqu" style="cursor: pointer;  width:250px">{!! Html::image('img/editco.png','Error404',['class'=>'addqu','style'=>' width:100%; ']) !!}</button>
                    {!! Form::close() !!}

                </div>
            </div>

        </div>
    </div>
        </div>
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

        @if (Session::has('img_edited'))<script>swal({
                title:"Good job!",
                text:"You successfully changed the thumbnail",
                type:"success",
                timer:2000,
            })</script>
        @endif

        <script>
            $('#del').on('click',function(e){
                e.preventDefault();
                var form = $(this).parents('form');
                swal({
                            title: "Are you sure?",
                            text: "You will not be able to recover this course",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Yes, delete it!",
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

    </body>
@stop