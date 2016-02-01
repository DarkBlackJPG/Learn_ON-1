@extends('app')

@section('content')
    <body>
    <div id="gornjalinija"></div>
    <div id="learn"><a href="{{ url('main') }}">LEARN_ON</a></div>
    <div id="podvucena"></div>
    {!! Form::text('requirement',null,['class' => 'form-control','placeholder'=> 'Search courses','id'=>'search_bar','onkeydown'=>'down()','onkeyup'=>'up()']) !!}
    {!! Form::hidden('tag',$tag->id,['id'=>'tag']) !!}
    @include('partials/_levi_meni')
        <a href="{{URL('main')}}"><div id="mainlibrary" class="nav"  style="z-index:2; border-bottom: solid 9px red ;">
            <div style="position:relative;padding-top:6.5px;">
                <b>COURSE LIBRARY</b>
            </div>
        </div>
    </a>
    <a href="{{URL('categories')}}"><div id="categories"><div style="position:relative;padding-top:6.5px;">
                <b>CATEGORIES</b>
            </div></div></a>
    <div id="polje">
    </div>
    <div id="polje2">
        @if (count($courses) === 0)
            <div style="margin-left:37%;position: relative;max-width:1000px;padding-left:2%; padding-top: 2%; " >
                <h3 id="search_error1"> Whoops! </h3>
                <h4 id="search_error2">No courses found</h4>
            </div>
        @elseif (count($courses) >= 1)
            @foreach ($courses as $course)
                <div style="position: relative;max-width:1000px;padding-left:2%; padding-top: 2%; " >
                    <course >
                        <div id="video_" style="float: left;">{!! Html::image('img/courses/'.$course->thumbnail,null,['style'=>'width:300px; height:200px;left:2%;padding-top:1%; position:relative;']) !!}</div>
                        <div style="align: left;" >
                            <div class="maintitl{{ $course->id }}" id="imev"><b> <a class="link" href="{{url('courses', $course->id) }}">{{$course->title}}</a></b></div>
                            <div class="mainopis{{ $course->id }}" id="opisv">{{$course->body}}</div>
                            <div id="datumv">Published {{$course->published_at->diffForHumans()}}</div>
                            <div id="opisv">by {{\App\User::find($course->user_id)->username}}</div>
                            <div id="categoryv"><i>Category: @foreach($course->tags as $tag)<a class="btn btn-link" id="tag_button" style=" font-size: 21pt;bottom: 0px;font-family: 'Exo'; text-decoration: none;" href="{{url('/tags/')}}/{{$tag->name}}"><b>{{$tag->name}}</b></a> @endforeach </i>
                                @if(\Auth::User()->level==1) <a href="courses/{{$course->id}}/edit">{!! Html::image('img/edit.png',null,['style'=>'height:30px; position: absolute; left: 900px; top:6px; width:30px']) !!}<div style="position: absolute; color: red; top: 0px;left:940px ">EDIT</div> </a></div> @endif
                        </div>
                    </course>
                    <br>
                </div>
                <script>
                    $(document).ready(function() {
                        $(".mainopis{{ $course->id }}").dotdotdot();
                        $(".maintitl{{ $course->id }}").dotdotdot();
                    });
                </script>
            @endforeach
                @if ($courses->lastPage() > 1)
                    <div style="position: relative; margin-top: 30px; margin-bottom: 30px;">
                        <a href="{{ $courses->url($courses->currentPage()-1) }}" id="page[{{$courses->currentPage()-1}}]" style="color: red; font-family: Intro_Bold; position: absolute; left:20px;" @if($courses->currentPage() == 1) onclick="return false" @endif>{!! Html::image('img/prev.png','error 404',['style'=>'width:30px; height:30px; top:10px']) !!} PREVIOUS</a>
                        <a href="{{ $courses->url($courses->currentPage()+1) }}" id="page[{{$courses->currentPage()+1}}]" style="color: red; font-family: Intro_Bold; position: absolute; right:20px;" @if($courses->currentPage() == $courses->lastPage()) onclick="return false" @endif >NEXT {!! Html::image('img/next.png','error 404',['style'=>'width:30px; height:30px;  top:10px']) !!}</a>
                    </div>
                @endif
        @endif
    </div>
    </body>
    <script>
        var timer;
        function up()
        {
            timer = setTimeout(function()
            {
                var keywords = $('#search_bar').val();
                var tag = $('#tag').val();

                $.post('/searchTags', {keywords: keywords, tag:tag}, function(markup)
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
@endsection