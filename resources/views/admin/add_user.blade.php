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
    <a href="{{ url('users') }}">

      <a href="{{ url('users') }}" onclick="showHide('polje2')">

          <div id="mainlibrary" class="nav" style="z-index:2;">

                  <b>ALL USERS</b>

              </div>
      </a>
      <a href="#" style="color:#ee2033;">
      <div id="categories" style="border-bottom: solid 9px red ;">
                  <b>CREATE USER</b>
              </div></a></div>
        <div id="polje2"  style="font-family: Exo; padding-bottom: 5px;text-align:center;overflow-y:scroll">

            <img src="img/users/avatar.png" alt="ERROR-404" style="border-radius: 50%; object-fit: cover; width:200px; height:200px;margin-top:10px">
            <div id="text4" style="padding-left: 25px;margin-bottom:20px;">E-mail &#9660;
                {!! Form::open(['url'=>'admin_add_user',  'method'=>'POST']) !!}
                {!! Form::text('email',null,['class' => 'form-control','placeholder'=> 'Enter email']) !!}
                {!! Form::text('email_confirmation',null,['class' => 'form-control','placeholder'=> 'Re-Enter email']) !!}
            </div>
            <div id="text4" style="padding-left: 25px;margin-bottom:20px;">Username &#9660; <br>
                {!! Form::text('username',null,['class' => 'form-control','placeholder'=> 'Enter username']) !!}
                {!! Form::text('username_confirmation',null,['class' => 'form-control','placeholder'=> 'Re-Enter username']) !!}
            </div>
            <div style="margin-bottom:20px;" id="text4">
                {!! Form::checkbox('administrator') !!} Admin
            </div>
            <div id="text4" style="padding-left: 25px;margin-bottom:20px;">
                Password &#9660; <br>
                {!! Form::password('password',['class' => 'form-control','placeholder'=> 'Enter password']) !!}
                {!! Form::password('password_confirmation',['class' => 'form-control','placeholder'=> 'Re-enter password']) !!}
                <br/>
                {!! Form::submit('Create', ['class'=>'btn1', 'style' => 'margin-left:8px']) !!}
                {!! Form::close() !!}
            </div>
            <div id="text4" style=" width: 450px;margin:auto;margin-bottom:20px;">
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
          </div>
    </div>
    </body>

@endsection
