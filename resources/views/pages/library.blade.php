@extends('app')
@section('content')
<body style="overflow: hidden">
<div id="gornjalinija"></div>
<div id="learn"><a href="{{ url('main') }}">LEARN_ON</a></div>
<div id="podvucena"></div>
{!! Form::text('requirement',null,['class' => 'form-control','placeholder'=> 'Search lectures','id'=>'search_bar','onkeydown'=>'down()','onkeyup'=>'up()']) !!}
@include('partials._levi_meni')
<a href="#" onclick="showHide('polje2')">
    <div id="mainlibrary" class="nav" style="z-index:2; border-bottom: solid 9px red ;">
        <div style="position:relative;padding-top:6.5px;">
            <b>LIBRARY</b>
        </div>
    </div>
</a>
<div id="polje2"  style="font-family: Calibri">
    @foreach($lectures as $lecture)
        <div style="position: relative;max-width:1000px;padding-left:2%; padding-top: 2%; " >
            <lecture>
                {!! Html::image('img/paper.png','ERROR 404',['style'=>'position:absolute; top:29%; left:3%; width:5.2%;']) !!}
                <div id="pdf1"><a href="{{url('library', $lecture->id) }}" class="link"> {{$lecture->lecture_title}} </a></div>
                <div id="pdf_linija1"></div>
                <div id="pdf_opis">Course:<a class="link" href="{{url('courses', $lecture->course_id)}}">{{ App\Course::find($lecture->course_id)->title }}</a> <br>by: {{ App\User::find(App\Course::find($lecture->course_id)->user_id)->username }}<br>{{ $lecture->created_at->diffForHumans() }}</div>
                @if(\Auth::User()->level==1) <a href="/lectures/{{$lecture->id}}/edit">{!! Html::image('img/edit.png',null,['style'=>'height:30px; position: absolute; left: 780px; top:50px; width:30px']) !!}<div style="position: absolute; font-size: 32px; color: red; top: 42px;left:815px ">EDIT</div> </a> @endif
            </lecture>
        </div>
   @endforeach
        @if ($lectures->lastPage() > 1)
            <div style="position: relative; margin-top: 30px; margin-bottom: 30px;">
                <a href="{{ $lectures->url($lectures->currentPage()-1) }}" id="page[{{$lectures->currentPage()-1}}]" style="color: red; font-family: Intro_Bold; position: absolute; left:20px;" @if($lectures->currentPage() == 1) onclick="return false" @endif >{!! Html::image('img/prev.png','error 404',['style'=>'width:30px; height:30px; top:10px']) !!} PREVIOUS</a>
                <a href="{{ $lectures->url($lectures->currentPage()+1) }}" id="page[{{$lectures->currentPage()+1}}]" style="color: red; font-family: Intro_Bold; position: absolute; right:20px;" @if($lectures->currentPage() == $lectures->lastPage()) onclick="return false" @endif >NEXT {!! Html::image('img/next.png','error 404',['style'=>'width:30px; height:30px;  top:10px']) !!}</a>
            </div>
        @endif
    </div>
</body>
@endsection
@section('footer')
    <script>
        var timer;
        function up()
        {
            timer = setTimeout(function()
            {
                var keywords = $('#search_bar').val();

                $.post('search_lectures', {keywords: keywords}, function(markup)
                {
                    $('#polje2').html(markup);
                });

            }, 500);
        }
        function down()
        {
            clearTimeout(timer);
        }
    </script>
@stop