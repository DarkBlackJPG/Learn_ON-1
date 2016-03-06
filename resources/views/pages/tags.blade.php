@extends('app')

@section('content')
    <body>
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

        {!! Form::text('requirement',null,['class' => 'form-control','placeholder'=> 'Search courses','id'=>'search_bar','onkeydown'=>'down()','onkeyup'=>'up()']) !!}
    </div>
    {!! Form::hidden('tag',$tag->id,['id'=>'tag']) !!}
    @include('partials/_levi_meni')
    <div id="content_wrapper">
        <div id="link_container">
            <a href="#" onclick="showHide('polje2')">

                <div id="mainlibrary" class="nav" style="z-index:2; border-bottom: solid 9px red ;color:#ee2033;">

                    <b>COURSE LIBRARY</b>

                </div>
            </a>
            <a href="{{ url('categories') }}">
                <div id="categories">
                    <b>CATEGORIES</b>
                </div></a></div>

        <div id="polje2">
        @if (count($courses) == 0)
            <div style="width: 100%;height: auto;text-align: center">
                <h3 id="search_error1" style="text-align: center"> Whoops! </h3>
                <h4 id="search_error2">No courses found</h4>
            </div>
        @elseif (count($courses) >= 1)
            @foreach ($courses as $course)
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
                            @else
                        </div>
                        @endif

                    </course>
                </div>
                <br>
    </div>
    <script>
        $(document).ready(function() {
            $(".mainopis{{ $course->id }}").dotdotdot();
            $(".maintitl{{ $course->id }}").dotdotdot();
        });
    </script>
    <div style="height: 5px; background-color:#EBEBEB; width: 100%"></div>
            @endforeach
        @endif
    </div>
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
