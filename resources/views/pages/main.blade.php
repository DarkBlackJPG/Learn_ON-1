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

    {!! Form::text('requirement',null,['class' => 'form-control','placeholder'=> 'Search courses','id'=>'search_bar','onkeydown'=>'down()','onkeyup'=>'up()']) !!}
        </div>
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
                            <br/>
                            <span><button id="like_button"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="100%" viewBox="0 0 1024 1024" enable-background="new 0 0 1024 1024" xml:space="preserve" >

  <path id="like_svg"  d="M972.971813 484.449527c0.335644 4.287653 0.029676 8.689916-1.090844 13.083993l-80.485079 369.814674c-1.127683 4.426823-2.990101 8.451486-5.352915 12.024871-8.621355 17.920138-21.729907 33.768081-39.160905 45.302789-18.35402 12.148691-38.861076 17.813714-59.111283 17.778922l0-0.233314-516.984524-0.225127c-1.813299 0.284479-3.6399 0.467651-5.523807 0.467651-1.888 0-3.721765-0.187265-5.545296-0.475837L122.20425 941.931866c-1.933025 0.319272-3.898797 0.531096-5.921873 0.531096-20.568455 0-37.247322-17.353227-37.247322-38.764885l0.338714-465.487663c0-21.411659 16.679891-38.764885 37.252439-38.764885 1.535983 0 3.044336 0.122797 4.53427 0.319272l123.609249-0.305969 0-0.723477c113.734344-8.478092 203.854874-105.536638 207.074196-225.282906-0.293689-3.360538-0.49835-6.753821-0.49835-10.199293 0-62.291718 48.511877-112.796996 108.364033-112.796996 51.430346 0 94.390787 37.332257 105.488543 87.35351l0.547469-0.077771c6.105045 28.558429 9.426697 58.20054 9.426697 88.667435 0 46.970778-7.705496 92.052532-21.798469 134.008087l207.89898 0.234337c1.916653 0 3.77907 0.204661 5.622044 0.493234 35.495422 1.455141 69.682036 20.476357 89.821725 54.270021C969.535551 436.893418 974.638779 461.034235 972.971813 484.449527M153.563468 864.400049l74.491575 0.033769 0.277316-387.388934-74.426083 0.173962L153.563468 864.400049 153.563468 864.400049 153.563468 864.400049 153.563468 864.400049 153.563468 864.400049zM893.846708 455.917704c-7.154957-12.019755-19.800975-18.332531-32.479739-17.618263l0-0.118704-0.094144 0-262.790148-0.289596c-20.564361 0-37.240159-17.366529-37.240159-38.778188 0-6.158257 1.418302-11.977799 3.8814-17.149589l-0.396019-0.339738c14.877849-28.834722 25.704428-60.271712 31.838126-93.430926l0.465604 0.017396c0 0 4.951779-20.939915 4.891404-61.101613-0.049119-31.807427-5.622044-60.848856-5.622044-60.848856l-0.282433 0c0.025583-0.561795 0.085958-1.115404 0.085958-1.688455 0-20.025079-15.59621-36.256762-34.836413-36.256762-19.228947 0-34.82925 16.23066-34.82925 36.256762 0 0.837064 0.073678 1.662873 0.122797 2.487657l-0.48607 0.004093c0 0 0.592494 30.271444-5.213745 61.666478-2.468215 13.31219-5.929036 25.737174-9.083889 35.576263-0.064468-0.038886-0.118704-0.064468-0.184195-0.093121-31.347962 99.771331-110.174262 177.112814-208.695113 203.169259l-0.356111 397.081691 485.399155 0.204661c1.642406 0 3.247974 0.144286 4.824889 0.37453 4.846378-0.676405 9.626241-2.420119 14.026458-5.330402 6.239098-4.125971 10.766205-9.987468 13.422707-16.587793l0.098237 0.055259 77.490885-356.051205-0.293689-0.094144C900.605645 476.964042 899.628388 465.603297 893.846708 455.917704" />


</svg></button>Ovde upis brojeva </span>
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
        <script type="text/javascript">
            $(document).ready(function() {
                var x = document.getElementById("like_svg");
                if(!x.hasAttribute('style')){
                    $('#like_button').click(function(){
                        $(this).attr('style','fill:blue')
                    })}
                else
                {
                    $('#like_button').click(function(){
                        x.setAttribute('style','fill:black')
                    })
                }
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


    </body>
@endsection