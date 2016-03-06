@extends('app')

@section('content')
    <body style="background-color: #000000; margin: 0px;opacity:.95;overflow:auto" id="abc" onresize="resize()">
    <div id="Container1" style="background-color: red">
        <div id="Hhh" style="background-color: #5e5e5e;border-bottom: solid #ee2033 10px" >
            <div class="header" style="padding-top: 10px;font-family: 'Porter', cursive; margin:0 20px 0 0;">
                <div id="logo2"  align="top">
                    {!!Html::image('img/Owl.svd')!!}
                </div>
                <div id="about_us" style="float:right; background-color: transparent;" >
                    <nav>
                        <ul>
                            <li id="login">
                                <a class="btn btn-link" href="{{ url('/auth/login') }}" id="login-trigger" >
                                    Log in
                                </a>
                            </li>
                            <li id="abut">
                                <a id="about-trigger">Help</a>
                                <div id="about-content" style="max-width:250px;white-space:normal">
                                    <h1>Learn and... STUFF</h1>
                                    <br/>
                                    To register simply fill out this form and click the register button, then check your inbox to verify your email address.
                                </div>
                            </li>
                        </ul>
                    </nav>

                </div>
            </div>
            <br/>
            <div id="form_password_rex">


                            <form action="#" id="form2" method="post" name="form">
                                <h2>REGISTER</h2>
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <strong style="color:red;">Whoops!</strong> There were some problems with your input.<br><br>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <hr>
                                <input type="text" class="Text" id="username" name="username" placeholder="Username" value="{{ old('username') }}" >
                                <br/>
                                <input type="email" class="Text" id="email" name="email" placeholder="Email" value="{{ old('email') }}" >
                                <br/>

                                <input type="password" class="Text" id="password" name="password" placeholder="Password"oninput="check()" >
                                <br/>
                                <input type="password" class="Text" id="password_confirmation" name="password_confirmation" placeholder="Re-Password" oninput="check()"  >
                                <br/>
                                <br/><br/>
                                <div align="center">
                                    <button type="submit" name="register" id="register" class="btn1"> Register </button>
                                </div>
                            </form>
            </div>
            <div id="logo" style="top:5%;margin-top:8%;right:0;position: fixed" align="top">
                {!!Html::image('img/Owl.svd')!!}
            </div>
        </div>
        </div>
        <script type="text/javascript">
            var w=window.innerWidth;
            var h=window.innerHeight;
            var nw=w;
            var nh=h-10;
            document.getElementById("Hhh").style.height=nh+"px";
            document.getElementById("Hhh").style.width=nw+"px";
            function resize(){
                var w=window.innerWidth;
                var h=window.innerHeight;
                var nw=w;
                var nh=h-10;
                document.getElementById("Hhh").style.height=nh+"px";
                document.getElementById("Hhh").style.width=nw+"px";
            }

        </script>
        <script type="text/javascript">

            $(document).ready(function(){
                $('#login-trigger').click(function(){
                    $(this).next('#login-content').slideToggle();
                    $(this).toggleClass('active');
                })
            });
        </script>
        <script type="text/javascript">

            $(document).ready(function(){
                $('#about-trigger').click(function(){
                    $(this).next('#about-content').slideToggle();
                    $(this).toggleClass('active');
                })
            });
        </script>

    </body>
@endsection