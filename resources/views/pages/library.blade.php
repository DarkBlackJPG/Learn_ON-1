@extends('app')
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

    {!! Form::text('requirement',null,['class' => 'form-control','placeholder'=> 'Search library','id'=>'search_bar','onkeydown'=>'down()','onkeyup'=>'up()']) !!}
</div>
@include('partials._levi_meni')
<div id="content_wrapper">
<a href="#" onclick="showHide('polje2')">
    <div id="my_coursess" class="nav" style="z-index:2; border-bottom: solid 7px red ;">
        <div>
            <b>LIBRARY</b>
        </div>
    </div>
</a>

<div id="polje2"  style="font-family: Calibri; padding-top:20px;">
    @foreach($lectures as $lecture)
        <div style="margin-bottom: 40px">
            <lecture>
                <div id="pdf_linija1"></div>
                <div id="pdf_container">
                {!! Html::image('img/paper.png','ERROR 404',['style'=>'width:70px;margin-left:20px']) !!}
                <div style="margin-left:10px;display: inline-block">
                <div id="pdf1"><a href="{{url('library', $lecture->id) }}" class="link"> {{$lecture->lecture_title}} </a></div><br/>

                <div id="pdf_opis">Course:<a class="link" href="{{url('courses', $lecture->course_id)}}">
                  {{ App\Course::find($lecture->course_id)->title }}</a>
                   <br>by: {{ App\User::find(App\Course::find($lecture->course_id)->user_id)->username }}
                   <br>{{ $lecture->created_at->diffForHumans() }}</div></div>
                @if(\Auth::User()->level==1)
                <a style="display:flex; margin-left: 20px" href="/lectures/{{$lecture->id}}/edit">
                  {!! Html::image('img/edit.png',null,['style'=>'height:1.5em; width:1.5em;position:relative;top:3px']) !!}
                  <div style=" font-size: 1.5em; color: red;  ">
                    EDIT
                  </div>
                </a>
              </div>
               @endif
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
  </div>
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
