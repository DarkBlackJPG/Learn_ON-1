@extends('app')

@section('content')
    <body>
    <div id="gornjalinija"></div>
    <div id="learn"><a href="{{ url('main') }}">LEARN_ON</a></div>
    <div id="podvucena"></div>
    <!--<input type="text" style="width:35%; left:35%; top:1.5%; position:absolute;"/> -->
    {!! Form::text('requirement',null,['class' => 'form-control','placeholder'=> 'Search users','id'=>'search_bar','onkeydown'=>'down()','onkeyup'=>'up()']) !!}
    @include ('partials/_levi_meni')
    <div id="content_wrapper">
        <div id="link_container">
        <a href="#" onclick="showHide('polje2')">

            <div id="mainlibrary" class="nav" style="z-index:2; border-bottom: solid 9px red ;color:#ee2033;">

                    <b>ALL USERS</b>

                </div>
        </a>
        <a href="{{ url('add_user') }}">
        <div id="categories">
                    <b>CREATE USER</b>
                </div></a></div>
    <div id="polje2">

        @foreach ($users as $user)
            <div style="display:flex;margin:auto " >
                <user style="margin: auto">
                    <div style="float: left;margin-left:20px;margin-top:10px;">
                      <object data="img/users/{{$user->profile}}" type="image/png" style="border-radius: 50%; object-fit: cover; width:200px; height:200px;">
                            <img src="img/avatar.png" style="width:150px; height:150px;"/>
                        </object> </div>
                    <div id="object_float" ><br>
                        <div id="imev"><b> <a href="{{url('users', $user->id) }}" class="link">{{$user->username}}</a></b></div>
                        <div id="opisv">{{$user->email}}</div>
                        <div id="datumv">Created {{$user->created_at->diffForHumans()}}</div>
                        <div id="categoryv"><i>Level:</i><i id="tag_button" style=" font-size: 21pt;bottom: 0px;font-family: 'Exo'; text-decoration: none;" ><b>@if($user->level == '1'){{'Administrator'}}@else {{'User'}} @endif</b></i></div>
                    </div>
                </user>
            </div>
            <br/>
            <br/>
        @endforeach
            @if ($users->lastPage() > 1)
                <div style="position: relative; margin-top: 30px; margin-bottom: 30px;">
                    <a href="{{ $users->url($users->currentPage()-1) }}" id="page[{{$users->currentPage()-1}}]" style="color: red; font-family: Intro_Bold; position: absolute; left:20px;" @if($users->currentPage() == 1) onclick="return false" @endif >{!! Html::image('img/prev.png','error 404',['style'=>'width:30px; height:30px; top:10px']) !!} PREVIOUS</a>
                    <a href="{{ $users->url($users->currentPage()+1) }}" id="page[{{$users->currentPage()+1}}]" style="color: red; font-family: Intro_Bold; position: absolute; right:20px;" @if($users->currentPage() == $users->lastPage()) onclick="return false" @endif >NEXT {!! Html::image('img/next.png','error 404',['style'=>'width:30px; height:30px;  top:10px']) !!}</a>
                </div>
            @endif
    </div>
  </div>
    @if (Session::has('acc_deleted'))<script>swal({
            title:"Good job!",
            text:"You successfully deleted an account",
            type:"success",
            timer:2000,
        })</script>
    @endif

    @if (Session::has('acc_created'))<script>swal({
            title:"Good job!",
            text:"You successfully created an account",
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

                $.post('search_users', {keywords: keywords}, function(markup)
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
    </body>

@endsection
