@extends('app')
@section('content')
    {!! Form::open(['url'=>'/question/'.$id]) !!}
<body style="font-family: Intro_Bold; overflow: hidden">
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


    <section class="header_text" > - TEST EDITOR - </section>

</div>
@include('partials/_levi_meni')
<div id="content_wrapper">
<div id="polje4">
    {!! Form::text('question',null,['id'=>'pitanje','placeholder'=>'THE QUESTION...','autocomplete'=>'off','style'=>'border:none']) !!}
    <div id="pitanje_linija"></div>
    <div id="prvi">1.</div>
    {!! Form::text('answer1',null,['id'=>'prvi_odgovor','autocomplete'=>'off','placeholder'=>'answer']) !!}
    <div id="prvi_odgovor_linija"></div>
    {!! Form::checkbox('correct1',1,null,['style'=>'position:relative; left:450px; top:-25px']) !!}

    <div id="drugi">2.</div>
    {!! Form::text('answer2',null,['id'=>'drugi_odgovor','autocomplete'=>'off','placeholder'=>'answer']) !!}
    <div id="drugi_odgovor_linija"></div>
    {!! Form::checkbox('correct2',1,null,['style'=>'position:relative; left:450px; top:-55px']) !!}

    <div id="treci">3.</div>
    {!! Form::text('answer3',null,['id'=>'treci_odgovor','autocomplete'=>'off','placeholder'=>'answer']) !!}
    <div id="treci_odgovor_linija"></div>
    {!! Form::checkbox('correct3',1,null,['style'=>'position:relative; left:450px; top:-85px']) !!}

    <div id="cetvrti">4.</div>
    {!! Form::text('answer4',null,['id'=>'cetvrti_odgovor','autocomplete'=>'off','placeholder'=>'answer']) !!}
    <div id="cetvrti_odgovor_linija"></div>
    {!! Form::checkbox('correct4',1,null,['style'=>'position:relative; left:450px; top:-115px']) !!}

    <div id="peti">5.</div>
    {!! Form::text('answer5',null,['id'=>'peti_odgovor','autocomplete'=>'off','placeholder'=>'answer']) !!}
    <div id="peti_odgovor_linija"></div>
    {!! Form::checkbox('correct5',1,null,['style'=>'position:relative; left:450px; top:-145px']) !!}
    <div id="kraj_odgovora_linija"></div>
    <div style="width:100%;height: auto;text-align: center">
    <button id="button" type="submit" class="addqu" style="cursor: pointer;  width:60%;">{!! Html::image('img/Addqu.png','Error404',['class'=>'addqu','style'=>'width:100%; height:100%;']) !!}</button>
    </div>

</div>

{!! Form::close() !!}
@endsection
@section('footer')
    @if (count($errors) > 0)
        <script>swal("Whoops!!","There were some problems with your input.<?php foreach ($errors->all() as $error)
    {
        echo e($error);
    }
    ?>","error")</script>
    @endif
@if(Session::has('question_or_finish'))
    <script>
    swal({
                title: "You successfully made a question!",
                text: "Do you want to make another question, or do you wish to finish the test and make a course?",
                type: "success",
                showCancelButton: true,
                cancelButtonText: "Make another question!",
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Finish course!",
                allowEscapeKey: false,
                allowOutsideClick:false
            },
            function(isConfirm){
                if (isConfirm)
                {
                    <?php
                        $course=App\Course::findorFail($id);
                    ?>
                    window.location = "{{ url('/finish/'.$course->id) }}";
                }
            });
    </script>
    <script>
        $(document).ready(function(){
        var x1=$('#button')
        x1.height(x1.width()%4)
        $(window).resize(function(){
            x1.height(x1.width()%4)
        });
        });
    </script>
@endif
</div>
</body>
@stop