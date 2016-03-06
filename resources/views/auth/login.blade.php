@extends('app')

@section('content')
   <body id="jquery_body" style="background-color: #000000; margin: 0px;opacity:.95;overflow:auto;  width:100%" id="abc" onresize="resize()">
    <div id="Container" style="background-color: #ee2033">
        <div id="Hhh" style="background-color: #5e5e5e;border-bottom: solid #ee2033 10px; " >

            <div class="header" style="padding-top: 10px;font-family: 'Porter', cursive; margin:0 20px 0 0;">
                <div style="bottom:0px; position: relative;">
                    <a class="btn btn-link" href="{{ url('/auth/register') }}" style=" font-size: 14pt; margin-left:20px; margin-top:20px; bottom: 0px;float: left; font-family: 'Porter', cursive; text-decoration: none;" id="botmz">Register</a>
                </div>
                <div id="about_us" style="float:right; background-color: transparent;" >

                    <nav>
                        <ul>
                            <li id="login">
                                <a id="login-trigger" >
                                    Log in
                                </a>
                                <div id="login-content">
                                    @if (session('status'))
                                        <div class="alert alert-success">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong style="color:red;">Whoops!!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                            <form method="post"  action="{{ url('/auth/login') }}" role="form">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <fieldset id="inputs" style="border-style: none; padding: 0px;">
                                    <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Your email address"  required>
                                    <input id="password" type="password" name="password" placeholder="Password" required>
                                </fieldset>
                                <fieldset id="actions" style="text-align:center;" >
                                    <input type="submit" id="submit" class="btn btn-primary" value="Log In" style="margin-left: 60px;">
                                    <br/>
                                    <label style="text-align: center"><input type="checkbox" style="margin-left:30px;"> Remember me</label>
                                    <br/>

                                </fieldset>
                                <nav class="cl-effect-1" style="text-align: center">
                                    <a class="btn btn-link" href="{{ url('/password/email') }}" id="F_pass"">Forgot Password</a>

                                </nav>

                            </form>
                                </div>
                            </li>
                            <li id="abut">
                                <a id="about-trigger">Help</a>
                                <div id="about-content" style="max-width:250px;white-space:normal">
                                    <h1>Learn and... STUFF</h1>
                                    <br/>
                                    If you wish to log in you simply have to input your email address and your password in the log in tab and click LOG IN. If you wish to register your account click on the register button on the left and follow the next step there.
                                </div>


                            </li>
                            <li>

                            </li>
                        </ul>
                    </nav>

                </div>
            </div>

    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <h1>
        <div id="mext">
            <div style="margin-left: 9%;font-size: 80pt;">
                LEARNING<br/>
            </div>
            <div style="margin-left: 9%; font-size: 60pt">
                IS <u><i>FUN</i></u><br/>
            </div>
            <div style="margin-left: 9%;font-size: 55pt;color: #ffffff">
                WHY <span style="font-size: 50pt">NOT</span>
            </div>
            <div style="margin-left: 9%;font-size: 65pt;color: #ffffff">
                MAKE IT<br/>
            </div>
            <div style="margin-left: 9%;font-size: 80pt; color:#ee2033; display: box; ">
                EASIER?
            </div>
        </div>
    </h1>
    <div id="logo" style="top:5%;margin-top:8%;right:0;position: fixed" align="top">
        {!!Html::image('img/Owl.svd')!!}
    </div>
            <div id="logo3" style="top:60px;right:0;position: fixed" align="top">
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
        var wf=window.innerWidth;
        var hf=window.innerHeight;
        var nwf=wf;
        var nhf=hf-100;
        document.getElementById("footer").style.height=nhf+"px";
        document.getElementById("footer").style.width=nwf+"px";
        var sendButton=document.getElementById("send")
        sendButton.disabled=true;
        function resize(){
            var w=window.innerWidth;
            var h=window.innerHeight;
            var nw=w;
            var nh=h-10;
            document.getElementById("Hhh").style.height=nh+"px";
            document.getElementById("Hhh").style.width=nw+"px";
            var wf=window.innerWidth;
            var hf=window.innerHeight;
            var nwf=wf  ;
            var nhf=hf-100;
            document.getElementById("footer").style.height=nhf+"px";
            document.getElementById("footer").style.width=nwf+"px";
        }

    </script>
    <script type="text/javascript">

        $(document).ready(function(){
            $('#login-trigger').click(function(){
                $(this).next('#login-content').slideToggle();
                $(this).toggleClass('active');
                //$('#about-trigger').click();
                if($('#about-content').css('display')=='block')
                {
                   // $('#about-trigger').click();
                    $('#about-content').css('display','none');
                    $('#about-trigger').removeClass('active');
                }


            })
        });
    </script>
    <script type="text/javascript">

        $(document).ready(function(){
            $('#about-trigger').click(function(){
                $(this).next('#about-content').slideToggle();
                $(this).toggleClass('active');
                if($('#login-content').css('display')=='block')
                {
                   /* $('#login-content').css('display','none');
                    $('#login-trigger').removeClass('active'); */
                    $('#login-content').css('display','none');
                    $('#login-trigger').removeClass('active');
                }
            })
        });
    </script>
    @if (Session::has('flash_message'))<script>swal("Email verification!", "We sent you an email to verify the existence of your email address")</script>@endif
    @if (Session::has('acc_deleted'))<script>swal("Good job!", "You successfully deleted your account", "success")</script>@endif
    @if (Session::has('success'))<script>swal("Good job!", "You successfully became a member of the Learn ON crew", "success")</script>@endif
    </body>
@endsection


