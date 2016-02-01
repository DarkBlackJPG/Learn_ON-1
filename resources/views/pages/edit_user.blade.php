<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <link href="{!! asset('CSS.css') !!}" media="all" rel="stylesheet" type="text/css" />
    <link href="{!! asset('jqbar.css') !!}" media="all" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="{!! asset('jQuery/jquery-2.1.4.js') !!}"></script>
    {!! Html::script('jQuery/jqbar.js') !!}
    {!! Html::script('jQuery/jquery.circle-diagram.js') !!}
    {!! Html::script('jQuery/main.js') !!}
    <script type="text/javascript" src="{!! asset('sweetalert/sweetalert.min.js') !!}"></script>
    <link href="{!! asset('sweetalert/sweetalert.css') !!}" media="all" rel="stylesheet" type="text/css" />
    <title>Learn_ON</title>
</head>
    <body style="overflow: hidden;">
    <div id="gornjalinija"></div>
    <div id="learn"><a href="{{ url('main') }}">LEARN_ON</a></div>
    <div id="podvucena"></div>
    <div id="desnimeni" style="overflow: hidden">
        <div id="avatar">{!! Html::image('img/users/'.\Auth::user()->profile,'Error404',['style'=>'border-radius: 50%; object-fit: cover; width:75px; height:75px; left:30%; top:20px;  position:relative;']) !!}</div>
        {!! Form::open(['url'=>'edit_img','files'=>true, 'method'=>'POST']) !!}
        <div class="form-group" style="font-family:Intro;left:20%;position:relative;margin-top:6%;font-size:130%;margin-bottom: -4%;">
            {!! Form::label('User Image') !!}
            {!! Form::file('image',null,['accept'=>'image/*']) !!}
            {!! Form::submit('Upload Image', ['class'=>'btn1']) !!}
        </div>
        {!! Form::close() !!}
        <div style="text-align: center;  width: 100%; margin-top:25px; margin-bottom:-30px"><b class="link" style="color:red; font-family:Intro_Bold; text-decoration: underline; text-decoration-color: red; font-size:26pt; margin-left:-15%;">{{\Auth::user()->username}}</b></div>
        <div style="position:relative;">
            <div style="position:relative;">
                <div id="account">{!! Html::image('img/acount.png','alt',['style'=>'width:18px; height:18px; left:17%;top:45px;  position:relative;']) !!}</div>
                <div id="ac"><a class="link" href="{{ url('account') }}">Account</a></div>
            </div>
            @if(\Auth::User()->level==1)
                <div style="position:relative;">
                    <div id="user">{!! Html::image('img/users.png','alt',['style'=>'width:18px; height:18px; left:17%;top:45px;  position:relative;']) !!}</div>
                    <div id="users"><a class="link" href="{{ url('users') }}">All Accounts</a></div>
                </div>
            @endif
            <div style="position:relative;">
                <div id="lb">{!! Html::image('img/library.png','alt',['style'=>'margin-top:-1%; width:25px; height:25px; left:17%;top:35px;  position:relative;']) !!}</div>
                <div id="library"><a class="link" href="{{ url('library') }}">Library</a></div>
            </div>
            @if(\Auth::User()->level==1)
                <div style="position:relative;">
                    <div id="plus">{!! Html::image('img/add.png','alt',['style'=>'margin-top:-2%; width:18px; height:18px; left:17%;top:45px;  position:relative;']) !!}</div>
                    <div id="users"><a class="link" href="{{ url('courses/create') }}">Add new course</a></div>
                </div>
                @if(\Auth::user()->courses()->exists())
                    <div style="position:relative;">
                        <div >{!! Html::image('img/mycourses.png','alt',['style'=>'width:25px; left:47px; top:30px; height:25px;  position:relative;']) !!}</div>
                        <div style="font-family:Intro;left:30%;position:relative;font-size:130%;"><a href="{{URL('/mycourses')}}" class="link">My courses</a></div>
                    </div>
                @endif
            @endif
            <div style="position:relative;" >
                <div id="hr">{!! Html::image('img/history.svg','alt',['style'=>'width:18px; height:18px; left:17%; top:28px;  position:relative;']) !!}</div>
                <div id="logout"><a class="link"  href="{{ url('auth/logout') }}">Log out</a></div>
            </div>
        </div>
        <div id="linija"></div>
        <div id="static">
            <div style="position:relative; margin-top: -23px">
                <div id="about_img">{!! Html::image('img/about.png','alt',['style'=>'margin-top:-1%; width:25px; height:25px; left:17%;top:35px;  position:relative;']) !!}</div>
                <div id="about" style="padding-left: 90px; padding-top: 5px"><a class="link" href="about">About us</a></div>
            </div>
            <div style="position:relative; margin-top: -13px;">
                <div id="contact_img">{!! Html::image('img/contact.png','alt',['style'=>'margin-top:-1%; width:25px; height:25px; left:17%;top:35px;  position:relative;']) !!}</div>
                <div id="contact" style="padding-left: 90px; padding-top: 5px"><a class="link" href="contact">Contacts</a></div>
            </div>
            <div style="position:relative; margin-top: -13px;">
                <div id="help_img">{!! Html::image('img/help.png','alt',['style'=>'margin-top:-1%; width:25px; height:25px; left:17%;top:35px;  position:relative;']) !!}</div>
                <div id="help" style="padding-left: 90px; padding-top: 5px"><a class="link" href="help">Help</a></div>
            </div>
            <div style="position:relative; margin-top: -13px;">
                <div id="t&c_img">{!! Html::image('img/t&c.svg','alt',['style'=>'margin-top:-1%; width:25px; height:25px; left:17%;top:35px;  position:relative;']) !!}</div>
                <div id="t&c" style="padding-left: 90px; padding-top: 5px"><a class="link" href="terms&conditions">Terms & Conditions</a></div>
            </div>
        </div>
    </div>
    <div id="poljeF"  style="font-family: Exo;">
        {!! Form::open(['url'=>'delete_account', 'method'=>'POST']) !!}
        <button type="submit" class="addqu" id="del" style="cursor: pointer; position:absolute; height:30px; width:100px; left:0.5%; top:1%; ">{!! Html::image('img/delete.png','Error404',['class'=>'addqu','style'=>' position:absolute; height:30px; width:100px; left:0; top:0%;  ']) !!}</button>
        {!! Form::close() !!}
        <img src="img/users/{{$user->profile}}" alt="ERROR-404" style="border-radius: 50%; object-fit: cover; width:200px; height:200px; left:5%; top:15px;  position:relative;">
        <div id="text4" style="padding-left: 25px; left:20%;top:3%; position:absolute">E-mail:{{$user->email}}<a href="#" class="link" id="p_link1" style="font-size:15px"> [edit]</a>
            {!! Form::open(['url'=>'edit_email',  'method'=>'POST' ,'id'=>'f_1']) !!}
            {!! Form::text('email',null,['class' => 'form-control','placeholder'=> 'Enter new email']) !!}
            {!! Form::text('email_confirmation',null,['class' => 'form-control','placeholder'=> 'Re-Enter new email']) !!}
            {!! Form::submit('Edit', ['class'=>'btn1','style'=>'width:30px;']) !!}
            {!! Form::close() !!}
        </div>
        <div id="text4" style="padding-left: 25px; left:20%;top:35%; position:absolute">Username:{{$user->username}} <a href="#" class="link" id="p_link2" style="font-size:15px"> [edit]</a>
            {!! Form::open(['url'=>'edit_username',  'method'=>'POST', 'id'=>'f_2']) !!}
            {!! Form::text('username',null,['class' => 'form-control','placeholder'=> 'Enter new username']) !!}
            {!! Form::text('username_confirmation',null,['class' => 'form-control','placeholder'=> 'Re-Enter new username']) !!}
            {!! Form::submit('Edit', ['class'=>'btn1','style'=>'width:30px;']) !!}
            {!! Form::close() !!}
        </div>
        <div id="text4" style="padding-left: 25px; left:20%;top:66%; position:absolute">
            Password <a href="#" class="link" id="p_link3" style="font-size:15px"> [edit]</a>
            {!! Form::open(['url'=>'edit_pass',  'method'=>'POST', 'id'=>'f_3']) !!}
            {!! Form::password('old_pass',['class' => 'form-control','placeholder'=> 'Enter current password']) !!}
            {!! Form::password('password',['class' => 'form-control','placeholder'=> 'Enter new password']) !!}
            {!! Form::password('password_confirmation',['class' => 'form-control','placeholder'=> 'Re-enter new password']) !!}
            {!! Form::submit('Edit', ['class'=>'btn1','style'=>'width:30px;']) !!}
            {!! Form::close() !!}
        </div>
        <div id="text4" style=" overflow-x:hidden; width: 450px; height: 200px; left:65%;top:3%; position:absolute">
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
    <div id="poljeF2"  style="font-family:Intro_Bold; min-height: 375px;"><br>
        <b style="padding-left: 25px; color:red; font-size:2em">-ONGOING COURSES: {{ App\Enroll::where('user_id',$user->id)->ongoing()->count()}}</b>
        <?php
            $enrolls=App\Enroll::where('user_id',$user->id)->ongoing()->get();
        ?>
        <ul style="margin-left:30px; font-size:2em">
            @foreach($enrolls as $ongoing)
                <li><a href="courses/{{ $ongoing->course_id }}" class="link">{{ App\Course::find($ongoing->course_id)->title }}</a></li>
            @endforeach
        </ul>
        <b style="padding-left: 25px; color:red; font-size:2em;">-COURSES FINISHED: {{ App\Enroll::where('user_id',$user->id)->finished()->count()}}</b>
        <?php
        $enrolls=App\Enroll::where('user_id',$user->id)->finished()->get();
        ?>
            @foreach($enrolls as $finished)
                <div id="bar-{{ $finished->id }}" style="top:0; left:25px; position:relative;"></div>
                <script type="text/javascript">
                    $(document).ready(function () {
                        $('#bar-{{ $finished->id }}').jqbar({ label: '{{ App\Course::find($finished->course_id)->title }}', value: @if($finished->points == 0) {{ 0 }} @else {{ 100/( App\Course::find($finished->course_id)->test()->first()->points / $finished->points ) }} @endif, barColor: 'red', orientation: 'h', barWidth: 20});
                    });
                </script>
            @endforeach

    </div>
    <div style="position: absolute; font-family:Intro_Bold; color:red; font-size:30px; left:1114px; top:345px">SUCCESS RATE</div>

    <?php
            $count=App\Enroll::where('user_id',$user->id)->finished()->count();
            $percent=0;
            foreach($enrolls as $finished)
            {
                if($finished->points == 0)
                    $percent+=0;
                else
                    $percent+=100/( App\Course::find($finished->course_id)->test()->first()->points / $finished->points );
            }
            if($count == 0)
                $percent=0;
            else
                $percent/=$count;
                $percent=round($percent, 1);
    ?>
    <div id="diagram-id-2" class="diagram" style="left:1070px; font-family:Intro_Bold; top:370px; position:absolute;"
         data-circle-diagram='{
			"percent": "{{ $percent }}%",
			"size": "280",
			"borderWidth": "4",
			"bgFill": "#cacaca",
			"frFill": "red",
			"textSize": "90",
			"textColor": "red"
			}'>

    </div>
    </body>
<script>
    $('#del').on('click',function(e){
        e.preventDefault();
        var form = $(this).parents('form');
    swal({
    title: "Are you sure?",
    text: "You will not be able to recover your account",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Yes, delete it!",
    allowEscapeKey: true,
    allowOutsideClick:false
    },
            function(isConfirm){
                if (isConfirm)
                {
                    form.submit();
                }
            });})
</script>
<script>
    $( "#p_link1" ).click(function() {
        $( "#f_1" ).slideToggle( "fast", function() {
        });
    });

    $( "#p_link2" ).click(function() {
        $( "#f_2" ).slideToggle( "fast", function() {
        });
    });

    $( "#p_link3" ).click(function() {
        $( "#f_3" ).slideToggle( "fast", function() {
        });
    });
</script>
@if (Session::has('email_edited'))<script>swal({
        title:"Good job!",
        text:"You successfully changed your email address",
        type:"success",
        timer:2000,
    })</script>
@endif

@if (Session::has('username_edited'))<script>swal({
        title:"Good job!",
        text:"You successfully changed your username",
        type:"success",
        timer:2000,
    })</script>
@endif

@if (Session::has('pass_edited'))<script>swal({
        title:"Good job!",
        text:"You successfully changed your password",
        type:"success",
        timer:2000,
    })</script>
@endif

@if (Session::has('img_edited'))<script>swal({
        title:"Good job!",
        text:"You successfully changed your profile image",
        type:"success",
        timer:2000,
    })</script>
@endif

</html>