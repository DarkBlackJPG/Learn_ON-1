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


    </div>
        @include('partials/_levi_meni')
        <div id="content_wrapper">
        <div id="link_container">
        <a href="{{ url('main') }}">
            <div id="mainlibrary" style="z-index:2;">
                
                    <b>COURSE LIBRARY</b>
        
            </div>
        </a>
        <a href="#" onclick="showHide('polje')"><div id="categories" style="border-bottom:9px solid red;color:#ee2033; ">
                    <b>CATEGORIES</b>
                </div></a></div>

        <div id="polje2">
            @include('partials._cats_slike')

        </div></div>
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