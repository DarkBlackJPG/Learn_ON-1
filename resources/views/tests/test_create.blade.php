@extends('app')
@section('content')
    {!! Form::open(['url'=>'/question/'.$id]) !!}
<body style="font-family: Intro_Bold; overflow: hidden">
<div id="gornjalinija"></div>
<div id="learn"><a href="{{url('main')}}"><div>LEARN</div><div style="position:absolute; top:0; left:100%;">_ON</div></a></div>
<div id="podvucena"></div>
<div style="width:35%; left:48.4%; position:absolute;">
    <section style="font-size:2em; font-family: Intro_Bold"> - TEST EDITOR - </section>
</div>
@include('partials._levi_meni')
<div id="box">
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
    {!! Form::checkbox('correct5',1,null,['style'=>'position:relative; left:450px; top:-148px']) !!}
    <div id="kraj_odgovora_linija"></div>
    <div id="kraj_linija"></div>
</div>
<button type="submit" class="addqu" style="cursor: pointer;  position:absolute; left:20.2%; top:41.5%; width:1293px; height:254px;">{!! Html::image('img/Addqu.png','Error404',['class'=>'addqu','style'=>' position:absolute; left:0%; top:0%;  width:1293px; height:254px;']) !!}</button>
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
@endif
</body>
@stop