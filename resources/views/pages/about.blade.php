@extends('app')
@section ('content')
    <script type="text/javascript" src="{!! asset('ckeditor/ckeditor.js') !!}"></script>
    <body style="overflow: hidden">
	<div id="gornjalinija"></div>
	<div id="learn"><a href="{{ url('main') }}">LEARN_ON</a></div>
	<div id="podvucena"></div>
	@include ('partials/_levi_meni')
    <div id="content_wrapper">
        <!-- Area for logo -->
        <div id="about_us_flex" >
            <div id="cont_elements">
                <div id="about_left_text">
                    <div id="top_text">
                        <div class="about-texts">THE SITE</div>
                    </div>
                    <hr size="3" color="black">
                    <div id="of_text">
                        <div class="about-texts"> OF</div>
                    </div>
                </div>
                <div id="svg_logo_anim">
                    <img src="brain_transparent.svg" style="width: 200px">
                </div>
                <div id="right_text">
                    <div class="about-texts">- LEARNING -</div>
                </div>
            </div>
        </div>
        <!-- Area for content with CK Editor -->
            @if(\Auth::User()->level==1)
                <div id="about_us_content">
                     {!! Form::open(['url'=>'about', 'method'=>'POST']) !!}
                     {!! Form::textarea('static_content',$page->content,['id'=>'about_content','style'=>'min-height: 200px;width: 99%;position: relative;']) !!}
                     {!! Form::hidden('id',$page->id) !!}
                     {!! Form::submit('Save',['class'=>'btn1', 'id'=>'static_save']) !!}
                     {!! Form::close() !!}
                </div>
            @else
                <div id="about_us_content" contenteditable="false" >{!! $page->content !!}</div>
            @endif
        </div>
         @if(\Auth::User()->level==1)
            <script type="text/javascript">
                CKEDITOR.replace ('about_content');
            </script>
        @endif
        
    </body>
@stop