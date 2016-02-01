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
    <title>Learn_ON</title>
</head>

<div class="container">

    @yield('content')
</div>
<script type="text/javascript" src="{!! asset('select2-4.0.1-rc.1\dist\js\select2.min.js') !!}"></script>
{!! Html::script('Bootstrap/js/bootstrap.min.js') !!}
{!! Html::script('jQuery/jqbar.js') !!}
{!! Html::script('jQuery/jquery.circle-diagram.js') !!}
{!! Html::script('jQuery/jquery.dotdotdot.min.js') !!}
{!! Html::script('jQuery/main.js') !!}

@yield('footer')

</html>