<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('img/tab.ico') }}">
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

    <body >
    <div id="gornjalinija" style="position:fixed;z-index:10000"></div>
    <div id="learn" style="position:fixed;z-index:10000"><a href="{{ url('main') }}">LEARN_ON</a></div>
    <div id="podvucena" style="position:fixed;z-index:10000"></div>


    <div id="desnimeni" style="position:fixed">
        <div id="avatar">{!! Html::image('img/users/'.\Auth::user()->profile,'Error 404') !!}</div>
        {!! Form::open(['url'=>'edit_img','files'=>true, 'method'=>'POST']) !!}
        <div class="form-group" style="font-family:Intro;margin-bottom:5px;text-align:center">
            {!! Form::label('User Image') !!}
            {!! Form::file('image',null,['accept'=>'image/*'],['style' => 'margin-left:50px']) !!}
            {!! Form::submit('Upload Image', ['class'=>'btn1']) !!}
        </div>
        {!! Form::close() !!}
        <div style="width:100%;text-align:center" ><b class="link" style="color:red; font-family:Intro_Bold; text-decoration: underline;  font-size:1.5em;">{{\Auth::user()->username}}</b></div>
        <div style="text-align:justify; padding-left:20px;margin-top:15px;margin-bottom:15px;">
            <div class="links" >
                <div id="account">{!! Html::image('img/acount.png','alt',['style'=>'width:18px;']) !!}</div>
                <div id="ac"><a href="{{URL('account')}}" class="link">Account</a></div>
            </div>
            @if(\Auth::User()->level==1)
                <div class="links">
                    <div id="user">{!! Html::image('img/users.png','alt',['style'=>'width:18px;']) !!}</div>
                    <div id="users"><a href="{{URL('users')}}" class="link">All Accounts</a></div>
                </div>
            @endif
            <div class="links">
                <div id="lb">{!! Html::image('img/library.png','alt',['style'=>'width:25px;']) !!}</div>
                <div id="library"><a href="{{URL('library')}}" class="link">Library</a></div>
            </div>
            @if(\Auth::User()->level==1)
                <div class="links">
                    <div id="plus">{!! Html::image('img/add.png','alt',['style'=>'width:18px;']) !!}</div>
                    <div id="users"><a href="{{URL('courses/create')}}" class="link">Add new course</a></div>
                </div>
                @if(\Auth::user()->courses()->exists())
                    <div class="links">
                        <div id="mc">{!! Html::image('img/mycourses.png','alt',['style'=>'width:25px;']) !!}</div>
                        <div id="my_courses"><a href="{{URL('/mycourses')}}" class="link">My courses</a></div>
                    </div>
                @endif
            @endif
            <div class="links" >
                <div id="hr">{!! Html::image('img/history.svg','alt',['style'=>'width:18px;']) !!}</div>
                <div id="logout"><a class="link"  href="{{ url('auth/logout') }}">Log out</a></div>
            </div>
        </div>
        <div id="linija"></div>
        <div id="static">
            <div >
                <div class="block" id="about_img">{!! Html::image('img/about.png','alt',['style'=>' width:25px; ']) !!}</div>
                <div class="block" id="about"><a href="{{URL('about')}}" class="link">About us</a></div>
            </div>
            <div>
                <div class="block" id="contact_img">{!! Html::image('img/contact.png','alt',['style'=>'width:25px;']) !!}</div>
                <div class="block" id="contact"><a href="{{URL('contact')}}" class="link">Contacts</a></div>
            </div>
            <div >
                <div class="block" id="help_img">{!! Html::image('img/help.png','alt',['style'=>' width:25px;']) !!}</div>
                <div class="block" id="help"><a class="link" href="help">Help</a></div>
            </div>
            <div >
                <div class="block" id="t&c_img">{!! Html::image('img/t&c.svg','alt',['style'=>'width:25px']) !!}</div>
                <div class="block" id="t&c"><a href="{{URL('terms&conditions')}}" class="link">Terms & Conditions</a></div>
            </div>
        </div>
    </div>
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
<div id="content_wrapper">
    <div id="poljeF"  style="font-family: Exo;">
        {!! Form::open(['url'=>'delete_account', 'method'=>'POST']) !!}
        <button type="submit" class="addqu" id="del" style="cursor: pointer;  height:30px; width:100px">{!! Html::image('img/delete.png','Error404',['class'=>'addqu','style'=>'  height:100%; width:100%; ']) !!}</button>
        {!! Form::close() !!}
        <img src="img/users/{{$user->profile}}" alt="ERROR-404" style="border-radius: 50%; object-fit: cover; width:200px; height:200px; margin:auto; top:20px;display:block ">
        <div style="display:block;margin:auto;text-align:center">
        <div id="text4">E-mail:{{$user->email}}<a href="#" class="link" id="p_link1" style="font-size:15px"> [edit]</a>
            {!! Form::open(['url'=>'edit_email',  'method'=>'POST' ,'id'=>'f_1']) !!}
            {!! Form::text('email',null,['class' => 'form-control','placeholder'=> 'Enter new email']) !!}
            {!! Form::text('email_confirmation',null,['class' => 'form-control','placeholder'=> 'Re-Enter new email']) !!}
            {!! Form::submit('Edit', ['class'=>'btn1','style'=>'width:30px;']) !!}
            {!! Form::close() !!}
        </div>
        <div id="text4">Username:{{$user->username}} <a href="#" class="link" id="p_link2" style="font-size:15px"> [edit]</a>
            {!! Form::open(['url'=>'edit_username',  'method'=>'POST', 'id'=>'f_2']) !!}
            {!! Form::text('username',null,['class' => 'form-control','placeholder'=> 'Enter new username']) !!}
            {!! Form::text('username_confirmation',null,['class' => 'form-control','placeholder'=> 'Re-Enter new username']) !!}
            {!! Form::submit('Edit', ['class'=>'btn1','style'=>'width:30px;']) !!}
            {!! Form::close() !!}
        </div>
        <div id="text4">
            Password <a href="#" class="link" id="p_link3" style="font-size:15px"> [edit]</a>
            {!! Form::open(['url'=>'edit_pass',  'method'=>'POST', 'id'=>'f_3']) !!}
            {!! Form::password('old_pass',['class' => 'form-control','placeholder'=> 'Enter current password']) !!}
            {!! Form::password('password',['class' => 'form-control','placeholder'=> 'Enter new password']) !!}
            {!! Form::password('password_confirmation',['class' => 'form-control','placeholder'=> 'Re-enter new password']) !!}
            {!! Form::submit('Edit', ['class'=>'btn1','style'=>'width:30px;']) !!}
            {!! Form::close() !!}
        </div>
      </div>
        <div id="text4">
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
    <br/>
    <div id="poljeF2"  style="font-family:Intro_Bold;">
      <div id="left_info" >
        <b style=" color:red; font-size:2em">-ONGOING COURSES: {{ App\Enroll::where('user_id',$user->id)->ongoing()->count()}}</b>
        <?php
            $enrolls=App\Enroll::where('user_id',$user->id)->ongoing()->get();
        ?>
        <ul style="margin-left:30px; font-size:2em">
            @foreach($enrolls as $ongoing)
                <li><a href="courses/{{ $ongoing->course_id }}" class="link">{{ App\Course::find($ongoing->course_id)->title }}</a></li>
            @endforeach
        </ul>
        <b style=" color:red; font-size:2em;">-COURSES FINISHED: {{ App\Enroll::where('user_id',$user->id)->finished()->count()}}</b>
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
            <div id="success_wrapper" >
            <div style=" font-family:Intro_Bold; color:red; font-size:30px;">SUCCESS RATE</div>

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
            <div style="height:auto;width:auto">
            <div id="diagram-id-2" class="diagram" style=" font-family:Intro_Bold;margin-top"
                 data-circle-diagram='{
              "percent": "{{ $percent }}%",
              "size": "250",
              "borderWidth": "5",
              "bgFill": "#cacaca",
              "frFill": "red",
              "textSize": "90",
              "textColor": "red"
              }'>
            </div>
          </div>
        </div>
    </div>

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
