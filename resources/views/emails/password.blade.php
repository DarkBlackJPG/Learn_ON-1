
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Password recovery</h2>

<div>
    Visit the following page to recover your password:
    {{ url('password/reset/'.$token) }}

</div>

</body>
</html>