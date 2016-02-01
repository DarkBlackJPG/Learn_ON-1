@extends('app')

@section('content')
    <body style="overflow: hidden">
    <div id="gornjalinija"></div>
    <div id="learn"><a href="/main">LEARN_ON</a></div>
    <div id="podvucena"></div>
    <div style="width:80%; left:18.7%; text-align:center; position:absolute;">
        <section style="font-size:2em; font-family: Exo_Bold"> - TEST EDITOR - </section>
    </div>
    @include('partials._levi_meni')
    <div id="polje4" style="overflow-x:hidden ">
        @foreach($questions as $question)
            <div style="position:relative; height: 390px">
                {!! Form::model($question, (['method'=>'PATCH' , 'url'=>['/questionUpdate/'.$question->id]]))!!}
                {!! Form::hidden('id',$question->id) !!}

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
                <button type="submit" class="addqu" style="cursor: pointer;  position:absolute; left:100px; bottom:15px; width:270px; height:65px;">{!! Html::image('img/save.png','Error404',['class'=>'addqu','style'=>' position:absolute; left:0%; top:0%;  width:270px; height:65px;']) !!}</button>
                {!! Form::close() !!}
                {!! Form::open(['url'=>'/delete_question/'.$question->id, 'method'=>'POST']) !!}
                <button type="submit" class="addqu" id="del" style="cursor: pointer; position:absolute; height:45px; width:150px; left:1150px; top:55px; ">{!! Html::image('img/delete.png','Error404',['class'=>'addqu','style'=>' position:absolute; height:45px; width:150px; left:0; top:0%;  ']) !!}</button>
                {!! Form::close() !!}
                <div id="kraj_odgovora_linija" style="top: 385px"></div>
            </div>
            <br>
            <br>
        @endforeach
            <div style="padding-top: 10px;text-align:center; overflow: visible ">
                {!! Form::open(['url'=>'/getQuestion/'.$question->test()->first()->course()->first()->id,'method'=>'GET']) !!}
                <button type="submit" class="addqu" id="enroll" style="cursor: pointer;  position:relative; bottom: 10px; width:1265px; height:254px;">{!! Html::image('img/addqu.png','Error404',['class'=>'addqu','style'=>' position:absolute; left:0%; top:0%;  width:1265px; height:254px;']) !!}</button>
                {!! Form::close() !!}
            </div>
    </div>
    </body>
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
        $(document).ready(function() {
            $("#titl").dotdotdot();
        });
    </script>

    @if (Session::has('qu_add'))<script>swal({
            title:"Good job!",
            text:"You successfully added a question",
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
                        text: "You will not be able to recover this question",
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
@stop