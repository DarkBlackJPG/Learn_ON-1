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


            <section class="header_text"> - {{$lecture->lecture_title}} - </section>


    @include('partials._levi_meni')
    <div id="content_wrapper">
        <a href="#" onclick="showHide('polje2')">
            <div id="my_coursess" class="nav" style="z-index:2; border-bottom: solid 2px red  ">
                <div>
                    <b style="font-size: 1.25em">{{$lecture->body}}</b>
                </div>
            </div>
        </a>

        <div id="polje4" style="overflow-x:hidden;text-align: center">

        <div id="iframe_container" style="margin: auto;width: auto;">
            <iframe width="100%" height="100%" src="/pdf/{{$lecture->pdf}}" frameborder="1" style="margin:auto">

            </iframe></div>
        @if($lecture->video)
            <div class="width" style="margin-top:15px;width: 80%;  height: auto; border-top:2px solid red; ">VIDEO</div>
            <div style="margin-top:15px"><iframe width="650" height="366" src="{{$lecture->video}}" frameborder="0" allowfullscreen></iframe></div>
        @endif
    </div>
        </div>
    <script>
        $(document).ready(function(){
            var height = $('#helloo').height();
            $('#iframe_container').height($('#polje4').height()-25);
            $(window).resize(function(){
                $('#iframe_container').height($('#polje4').height()-25);
            })

        });
    </script>
    </body>
@stop