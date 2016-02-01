@extends('app')

@section('content')
    <body>
    <div id="gornjalinija"></div>
    <div id="learn"><a href="{{ url('main') }}">LEARN_ON</a></div>
    <div id="podvucena"></div>
    @include('partials/_levi_meni')
    <a href="{{ url('users') }}">
        <div id="mainlibrary" class="nav" style="z-index:2;">
            <div style="position:relative;padding-top:6.5px;">
                <b>USERS</b>
            </div>
        </div>
    </a>
    <a href="#" onclick="showHide('polje')"><div id="categories"><div style="position:relative;padding-top:6.5px; padding-bottom: 3px;  border-bottom: solid 9px red ;">
                <b>ADD USER</b>
            </div></div></a>
        <div id="poljeF"  style="font-family: Exo; margin-top:52px; padding-bottom: 5px;">
            <img src="img/users/avatar.png" alt="ERROR-404" style="border-radius: 50%; object-fit: cover; width:200px; height:200px; left:5%; top:15px;  position:relative;">
            <div id="text4" style="padding-left: 25px; left:20%;top:3%; position:absolute">E-mail &#9660;
                {!! Form::open(['url'=>'admin_add_user',  'method'=>'POST']) !!}
                {!! Form::text('email',null,['class' => 'form-control','placeholder'=> 'Enter email']) !!}
                {!! Form::text('email_confirmation',null,['class' => 'form-control','placeholder'=> 'Re-Enter email']) !!}
            </div>
            <div id="text4" style="padding-left: 25px; left:20%;top:35%; position:absolute">Username &#9660; <br>
                {!! Form::text('username',null,['class' => 'form-control','placeholder'=> 'Enter username']) !!}
                {!! Form::text('username_confirmation',null,['class' => 'form-control','placeholder'=> 'Re-Enter username']) !!}
            </div>
            <div style="top: 0.1%; left: 0.1%;position: absolute" id="text4">
                {!! Form::checkbox('administrator') !!} Admin
            </div>
            <div id="text4" style="padding-left: 25px; left:20%;top:66%; position:absolute">
                Password &#9660; <br>
                {!! Form::password('password',['class' => 'form-control','placeholder'=> 'Enter password']) !!}
                {!! Form::password('password_confirmation',['class' => 'form-control','placeholder'=> 'Re-enter password']) !!}
                {!! Form::submit('Create', ['class'=>'btn1', 'style' => 'margin-left:8px']) !!}
                {!! Form::close() !!}
            </div>
            <div id="text4" style=" overflow-y:scroll; width: 450px; height: 200px; left:65%;top:3%; position:absolute">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong style="color:red;">Whoops!!</strong> There were some problems with your input.<br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            </div>
    </div>
    </body>

@endsection