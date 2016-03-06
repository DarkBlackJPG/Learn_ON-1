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


    </div>
    @include('partials/_levi_meni')
    <div id="content_wrapper">
    <a href="#" onclick="showHide('polje2')">
        <div id="my_coursess" class="nav" style="z-index:2; border-bottom: solid 9px red ;">
            <div >
                <b>MY COURSES</b>
            </div>
        </div>
    </a>

    <div id="polje2">
        <!-- UNDONE -->
        @if(\Auth::user()->courses()->undone()->exists())
            <div style="position: relative; left: 20px; top: 50px; width: 90%; border-top: 2px solid red">
                <b style="font-size: 20px; color: red; font-family: Exo_Bold">NOT FINISHED</b>
                @foreach (\Auth::user()->courses()->undone()->get() as $course)
                <div class="course_wrapper" >
                    <course >
                        <div id="thumbnail">
                        {!! Html::image('img/courses/'.$course->thumbnail,null) !!}
                        </div>
                        <div id="course_info" >
                            <div class="maintitl{{ $course->id }}" id="imev">
                            <b> <a class="link" href="{{url('redirecting', $course->id) }}">{{$course->title}}</a></b></div>
                            <div class="mainopis{{ $course->id }}" id="opisv">{{$course->body}}</div>
                            <div id="datumv">Published {{$course->published_at->diffForHumans()}}</div>
                            <div id="opisv">by {{\App\User::find($course->user_id)->username}}</div>
                            <div id="categoryv">
                            <i>
                            Category: @foreach($course->tags as $tag)
                            <a class="btn btn-link" id="tag_button" href="{{url('/tags/')}}/{{$tag->name}}">
                            <b>{{$tag->name}}</b></a>
                             @endforeach
                            </i>
                            @if(\Auth::User()->level==1)
                            <br/>
                            <a href="courses/{{$course->id}}/edit" id="edit_button">
                            {!! Html::image('img/edit.png',null) !!}<div>EDIT</div></a>


                            </div>

                             @endif
                             </div>
                        </course>
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
        <div style="position: relative; left: 20px; top: 50px; width: 90%; border-top: 2px solid red">
        <b style="font-size: 20px; color: red; font-family: Exo_Bold">NOT PUBLISHED</b>
        @foreach (\Auth::user()->courses()->done()->unpublished()->get() as $course)
        <div class="course_wrapper" >
            <course >
                <div id="thumbnail">
                {!! Html::image('img/courses/'.$course->thumbnail,null) !!}
                </div>
                <div id="course_info" >
                    <div class="maintitl{{ $course->id }}" id="imev">
                    <b> <a class="link" href="{{url('courses', $course->id) }}">{{$course->title}}</a></b></div>
                    <div class="mainopis{{ $course->id }}" id="opisv">{{$course->body}}</div>
                    <div id="datumv">Published {{$course->published_at->diffForHumans()}}</div>
                    <div id="opisv">by {{\App\User::find($course->user_id)->username}}</div>
                    <div id="categoryv">
                    <i>
                    Category: @foreach($course->tags as $tag)
                    <a class="btn btn-link" id="tag_button" href="{{url('/tags/')}}/{{$tag->name}}">
                    <b>{{$tag->name}}</b></a>
                     @endforeach
                    </i>
                    @if(\Auth::User()->level==1)
                    <br/>
                    <a href="courses/{{$course->id}}/edit" id="edit_button">
                    {!! Html::image('img/edit.png',null) !!}<div>EDIT</div></a>


                    </div>

                     @endif
                     </div>
                </course>
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
        <div style="position: relative; left: 20px; top: 50px; width: 90%; border-top: 2px solid red">
           <b style="font-size: 20px; color: red; font-family: Exo_Bold">DONE</b>
        @foreach (\Auth::user()->courses()->done()->published()->get() as $course)
            <div class="course_wrapper" >
                <course >
                    <div id="thumbnail">
                    {!! Html::image('img/courses/'.$course->thumbnail,null) !!}
                    </div>
                    <div id="course_info" >
                        <div class="maintitl{{ $course->id }}" id="imev">
                        <b> <a class="link" href="{{url('courses', $course->id) }}">{{$course->title}}</a></b></div>
                        <div class="mainopis{{ $course->id }}" id="opisv">{{$course->body}}</div>
                        <div id="datumv">Published {{$course->published_at->diffForHumans()}}</div>
                        <div id="opisv">by {{\App\User::find($course->user_id)->username}}</div>
                        <div id="categoryv">
                        <i>
                        Category: @foreach($course->tags as $tag)
                        <a class="btn btn-link" id="tag_button" href="{{url('/tags/')}}/{{$tag->name}}">
                        <b>{{$tag->name}}</b></a>
                         @endforeach
                        </i>
                        @if(\Auth::User()->level==1)
                        <br/>
                        <a href="courses/{{$course->id}}/edit" id="edit_button">
                        {!! Html::image('img/edit.png',null) !!}<div>EDIT</div></a>


                        </div>
                         @endif
                         </div>
                    </course>



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
    </div>
    </body>
@endsection
