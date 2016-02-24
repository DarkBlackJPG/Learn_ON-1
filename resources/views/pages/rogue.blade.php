@extends('app')

@section('content')
    <body style="overflow: hidden">
    <div id="gornjalinija"></div>
    <div id="learn"><a href="/main">LEARN_ON</a></div>
    <div id="podvucena"></div>
    <div style="width:80%; left:18.7%; text-align:center; position:absolute;">
        <section style="font-size:2em; font-family: Exo_Bold"> - {{$lecture->lecture_title}} - </section>
    </div>
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
            <div class="width" style="margin-top:15px; position:relative; width: 80%;  height: 2px; background-color: red; ">VIDEO</div>
            <div style="position: relative; left:342px; margin-top:15px"><iframe width="650" height="366" src="{{$lecture->video}}" frameborder="0" allowfullscreen></iframe></div>
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