@extends('app')
@section('content')
    <body style="overflow: hidden">
    <div id="gornjalinija"></div>
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
    <div id="learn"><a href="{{ url('main') }}">LEARN_ON</a></div>
    <div id="podvucena"></div>
    {!! Form::text('requirement',null,['class' => 'form-control','placeholder'=> 'Search courses','id'=>'search_bar','onkeydown'=>'down()','onkeyup'=>'up()']) !!}
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
         @if ($courses->lastPage() > 1)
             <div style="position: relative; margin-top: 30px; margin-bottom: 30px;">
                 <a href="{{ $courses->url($courses->currentPage()-1) }}" id="page[{{$courses->currentPage()-1}}]" style="color: red; font-family: Intro_Bold; position: absolute; left:20px;" @if($courses->currentPage() == 1) onclick="return false" @endif>{!! Html::image('img/prev.png','error 404',['style'=>'width:30px; height:30px; top:10px']) !!} PREVIOUS</a>
                 <a href="{{ $courses->url($courses->currentPage()+1) }}" id="page[{{$courses->currentPage()+1}}]" style="color: red; font-family: Intro_Bold; position: absolute; right:20px;" @if($courses->currentPage() == $courses->lastPage()) onclick="return false" @endif>NEXT {!! Html::image('img/next.png','error 404',['style'=>'width:30px; height:30px;  top:10px']) !!}</a>
             </div>
         @endif
    </div>
    @if (Session::has('course'))<script>swal({
            title:"Good job!",
            text:"Your course has been successfully created",
            type:"success",
            timer:2000,
        })</script>
    @endif

    @if (Session::has('course_deleted'))<script>swal({
            title:"Good job!",
            text:"The course has been successfully deleted",
            type:"success",
            timer:2000,
        })</script>
    @endif
</div>
    <script>
        var timer;
        function up()
        {
            timer = setTimeout(function()
            {
                var keywords = $('#search_bar').val();

                    $.post('search', {keywords: keywords}, function(markup)
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
    <script type="text/javascript">
$(document).ready(function(){
    var height = $('#gornjalinija').height();
        $('#desnimeni').height( $(window).height() - height )
        $(window).resize(function(){$('#slideshow').height( $(window).height() - height )
        $('#desnimeni').height( $(window).height() - height )});
        
        });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#nav-icon3').click(function(){
            $(this).toggleClass('open');
        });
    });
</script>
<script type="text/javascript">
   $(document).ready(function(){
       var width = $('#desnimeni').width()+20;
       $('#content_wrapper').width($(window).width() - width);
       $('#content_wrapper').height($(window).height()-119);
       $(window).resize(function(){
        $('#content_wrapper').height($(window).height()-119);
        $('#content_wrapper').width($(window).width() - width);});

    });
</script>
    </body>
@endsection