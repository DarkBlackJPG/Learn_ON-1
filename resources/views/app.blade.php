<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('img/tab.ico') }}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <link href="{!! asset('CSS.css') !!}" media="all" rel="stylesheet" type="text/css" />
    <link href="{!! asset('jqbar.css') !!}" media="all" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="{!! asset('jQuery/jquery-2.1.4.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('jQuery/jquery-ui-1.11.4.custom/jquery-ui.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('sweetalert/sweetalert.min.js') !!}"></script>
    <link href="{!! asset('sweetalert/sweetalert.css') !!}" media="all" rel="stylesheet" type="text/css" />
    <link href="{!! asset('select2-4.0.1-rc.1\dist\css\select2.min.css') !!}" media="all" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="//js.pusher.com/3.0/pusher.min.js"></script>
    <title>Learn_ON</title>
</head>
<script type="text/javascript">
    $(document).ready(function(){

        var width = $('#desnimeni').width()+20;
        $('#content_wrapper').width($(window).width() - width);
        $('#content_wrapper').height($(window).height()-80);
        $(window).resize(function(){
            $('#content_wrapper').height($(window).height()-80);
            $('#content_wrapper').width($(window).width() - width);
        });
        if ($(window).width() <= 800)
        {
            $('#content_wrapper').width($(window).width() - 20);
            $('#content_wrapper').height($(window).height()-80);


            $(window).resize(function () {
                $('#content_wrapper').height($(window).height() - 80);
                $('#content_wrapper').width($(window).width() - 20);
            });


        }
        $(window).resize(function () {
            if ($(window).width() <= 800)
            {
                $('#content_wrapper').width($(window).width() - 20);
                $('#content_wrapper').height($(window).height()-80);


                $(window).resize(function () {
                    $('#content_wrapper').height($(window).height() - 80);
                    $('#content_wrapper').width($(window).width() - 20);
                });


            }
            if ($(window).width() > 800)
            {
                var width = $('#desnimeni').width()+20;
                $('#content_wrapper').width($(window).width() - width);
                $('#content_wrapper').height($(window).height()-80);
                $(window).resize(function(){
                    $('#content_wrapper').height($(window).height()-80);
                    $('#content_wrapper').width($(window).width() - width);
                });


            }
        });


    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#nav-icon3').click(function(){
            $(this).toggleClass('open');
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#hamburger_menu').click(function () {
            $('#desnimeni').toggleClass('open');

        });
    });
</script>
<div class="container">

    @yield('content')
</div>

@if(\Auth::user())
    <?php $notifications= \App\Notification::where('to','=',\Auth::user()->id)->get(); ?>
    @foreach($notifications as $notification)
        <script>
            toastr.options.showMethod = 'slideDown';
            toastr.options.timeOut = 15000;
            toastr.options.onclick =function(){window.location="{{URL::to('/chat')}}";};
            toastr.info("{{ \App\User::findOrFail($notification->from)->username }} sent you a new message {{ $notification->created_at }}", null, {"positionClass": "toast-bottom-left"});
        </script>
        <?php $notification->delete(); ?>
    @endforeach

    <script>
        function notificationz(data) {
            if(data.username != "{{ \Auth::user()->username }}")
            {
                toastr.options.showMethod = 'slideDown';
                toastr.options.timeOut = 15000;
                toastr.options.onclick = function () {
                    window.location = "{{URL::to('/chat')}}";
                };
                toastr.info(data.username + " sent you a new message", null, {"positionClass": "toast-bottom-left"});
                $.post('/chat/drop');
            }
        }

        var pusher = new Pusher('{{env("PUSHER_KEY")}}', {
            authEndpoint: '/chat/auth',
            auth: {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }
        });

        <?php
        \App\User::writeScriptz();
        ?>

    </script>
@endif

<script type="text/javascript" src="{!! asset('select2-4.0.1-rc.1\dist\js\select2.min.js') !!}"></script>
{!! Html::script('Bootstrap/js/bootstrap.min.js') !!}
{!! Html::script('jQuery/jqbar.js') !!}
{!! Html::script('jQuery/jquery.circle-diagram.js') !!}
{!! Html::script('jQuery/jquery.dotdotdot.min.js') !!}
{!! Html::script('jQuery/main.js') !!}

@yield('footer')

</html>