@extends('app')
@section('content')
    <body style="overflow: hidden">
    <div id="gornjalinija"></div>
    <div id="learn"><a href="{{ url('main') }}">LEARN_ON</a></div>
    <div id="podvucena"></div>
    @include('partials/_levi_meni')
    <a href="#" onclick="showHide('polje2')">
        <div id="mainlibrary" class="nav" style="z-index:2; border-bottom: solid 9px red ;">
            <div style="position:relative;padding-top:6.5px;">
                <b>MY COURSES</b>
            </div>
        </div>
    </a>
    <div id="polje2">
        <!-- UNDONE -->
        @if(\Auth::user()->courses()->undone()->exists())
            <div style="position: relative; left: 20px; top: 50px; width: 90%; border-bottom: 2px solid red; border-top: 2px solid red">
                <b style="font-size: 20px; color: red; font-family: Exo_Bold">NOT FINISHED</b>
                @foreach (\Auth::user()->courses()->undone()->get() as $course)
                    <div style="position: relative;max-width:1000px;" >
                        <course >
                            <div id="video_" style="float: left;">{!! Html::image('img/courses/'.$course->thumbnail,null,['style'=>'width:300px; height:200px;left:2%;padding-top:1%; position:relative;']) !!}</div>
                            <div style="align: left;" >
                                <div class="maintitl{{ $course->id }}" id="imev"><b> <a class="link" href="{{url('redirecting', $course->id) }}">{{$course->title}}</a></b></div>
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
            </div>
            @endif

        <!-- UNPUBLISHED -->
        @if(\Auth::user()->courses()->done()->unpublished()->exists())
        <div style="position: relative; left: 20px; top: 50px; width: 90%; border-bottom: 2px solid red; border-top: 2px solid red">
        <b style="font-size: 20px; color: red; font-family: Exo_Bold">NOT PUBLISHED</b>
        @foreach (\Auth::user()->courses()->done()->unpublished()->get() as $course)
            <div style="position: relative;max-width:1000px;" >
                <course >
                    <div id="video_" style="float: left;">{!! Html::image('img/courses/'.$course->thumbnail,null,['style'=>'width:300px; height:200px;left:2%;padding-top:1%; position:relative;']) !!}</div>
                    <div style="align: left;" >
                        <div class="maintitl{{ $course->id }}" id="imev"><b> <a class="link" href="#">{{$course->title}}</a></b></div>
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
        </div>
        @endif

        <!-- DONE COURSES -->
        @if(\Auth::user()->courses()->done()->published()->exists())
        <div style="position: relative; left: 20px; top: 50px; width: 90%; border-bottom: 2px solid red; border-top: 2px solid red">
           <b style="font-size: 20px; color: red; font-family: Exo_Bold">DONE</b>
        @foreach (\Auth::user()->courses()->done()->published()->get() as $course)
            <div style="position: relative;max-width:1000px;" >
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
        </div>
        @endif

    </div>
    </body>
@endsection