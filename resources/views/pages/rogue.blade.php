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
    <div id="polje4" style="overflow-x:hidden ">
        <div style="position: relative; left:360px; top: 7px; max-width: 630px; font-size: 25px; font-family: Calibri; text-align: center">{{ $lecture->body }}</div>
        <div class="width" style="margin-top:15px; position:relative; width: 80%;  height: 2px; background-color: red; "></div>
        <div style="position: relative; left:325px; margin-top:15px"><iframe width="700" height="845" src="/pdf/{{$lecture->pdf}}" frameborder="0"></iframe></div>
        @if($lecture->video)
            <div class="width" style="margin-top:15px; position:relative; width: 80%;  height: 2px; background-color: red; "></div>
            <div style="position: relative; left:342px; margin-top:15px"><iframe width="650" height="366" src="{{$lecture->video}}" frameborder="0" allowfullscreen></iframe></div>
        @endif
    </div>
    </body>
@stop