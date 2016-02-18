@extends('app')

@section('content')
    <body>
        <div id="gornjalinija"></div>
        <div id="learn"><a href="{{ url('main') }}">LEARN_ON</a></div>
        <div id="podvucena"></div>
        <!--<input type="text" style="width:35%; left:35%; top:1.5%; position:absolute;"/> -->
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