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
<body>
<div id="gornjalinija"></div>
<div id="learn"><a href="{{ url('main') }}">LEARN_ON</a></div>
<div id="podvucena"></div>
@include('partials._levi_meni')
<div id="content_wrapper">
<div id="poljeF"  style="font-family: Exo">


    {!! Form::open(['url'=>'admin_delete_user', 'method'=>'POST']) !!}
    {!! Form::hidden('id', $user->id) !!}
        <button type="submit" class="addqu" id="del" style="cursor: pointer;  height:30px; width:100px">{!! Html::image('img/delete.png','Error404',['class'=>'addqu','style'=>'  height:100%; width:100%; ']) !!}</button>
        {!! Form::close() !!}

    <img src="/img/users/{{$user->profile}}" alt="ERROR-404" style="border-radius: 50%; object-fit: cover; width:200px; height:200px; margin:auto; top:20px;display:block ">
        <div style="display:block;margin:auto;text-align:center">
    <div id="text4">E-mail:{{$user->email}}<a href="#" id="p_link1" style="font-size:15px" class="link"> [edit]</a>
        {!! Form::open(['url'=>'admin_edit_email',  'method'=>'POST','id'=>'f_1']) !!}
        {!! Form::hidden('id', $user->id) !!}
        {!! Form::text('email',null,['class' => 'form-control','placeholder'=> 'Enter new email']) !!}
        {!! Form::text('email_confirmation',null,['class' => 'form-control','placeholder'=> 'Re-Enter new email']) !!}
        {!! Form::submit('Edit', ['class'=>'btn1','style'=>'width:30px;']) !!}
        {!! Form::close() !!}
    </div>
    <div id="text4">Username:{{$user->username}} <a href="#" id="p_link2" style="font-size:15px" class="link"> [edit]</a>
        {!! Form::open(['url'=>'admin_edit_username',  'method'=>'POST','id'=>'f_2']) !!}
        {!! Form::hidden('id', $user->id) !!}
        {!! Form::text('username',null,['class' => 'form-control','placeholder'=> 'Enter new username']) !!}
        {!! Form::text('username_confirmation',null,['class' => 'form-control','placeholder'=> 'Re-Enter new username']) !!}
        {!! Form::submit('Edit', ['class'=>'btn1','style'=>'width:30px;']) !!}
        {!! Form::close() !!}
    </div>
    <div id="text4">
        Password <a href="#" id="p_link3" style="font-size:15px" class="link"> [edit]</a>
        {!! Form::open(['url'=>'admin_edit_pass',  'method'=>'POST','id'=>'f_3']) !!}
        {!! Form::hidden('id', $user->id) !!}
        {!! Form::password('password',['class' => 'form-control','placeholder'=> 'Enter new password']) !!}
        {!! Form::password('password_confirmation',['class' => 'form-control','placeholder'=> 'Re-enter new password']) !!}
        {!! Form::submit('Edit', ['class'=>'btn1','style'=>'width:30px;']) !!}
        {!! Form::close() !!}
    </div>
            @if($user->level==0)
                {!! Form::open(['url'=>'admin_user', 'method'=>'POST']) !!}
                {!! Form::hidden('id', $user->id) !!}
                {!! Form::submit('Make Admin',['class'=>'btn1','id'=>'make_admin']) !!}
                {!! Form::close() !!}
            @else
                {!! Form::open(['url'=>'user_admin', 'method'=>'POST']) !!}
                {!! Form::hidden('id', $user->id) !!}
                {!! Form::submit('Make User',['class'=>'btn1','id'=>'make_user']) !!}
                {!! Form::close() !!}
            @endif
    </div>
    <div id="text4" style=" overflow:hidden; width: 450px; height: 200px; left:65%;top:3%; position:absolute">
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
@include('partials._edit_all_users_swal')



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
</body>
</html>