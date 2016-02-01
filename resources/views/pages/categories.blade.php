@extends('app')

@section('content')
    <body>
        <div id="gornjalinija"></div>
        <div id="learn"><a href="{{ url('main') }}">LEARN_ON</a></div>
        <div id="podvucena"></div>
        <!--<input type="text" style="width:35%; left:35%; top:1.5%; position:absolute;"/> -->
        @include('partials/_levi_meni')
        <a href="{{ url('main') }}">
            <div id="mainlibrary" class="nav" style="z-index:2;">
                <div style="position:relative;padding-top:6.5px;">
                    <b>COURSE LIBRARY</b>
                </div>
            </div>
        </a>
        <a href="#" onclick="showHide('polje')"><div id="categories"><div style="position:relative;padding-top:6.5px;padding-bottom: 5.5px ; border-bottom: solid 9px red ;">
                    <b>CATEGORIES</b>
                </div></div></a>
        <div id="polje">
            @include('partials._cats_slike')

        </div>
    </body>

@endsection