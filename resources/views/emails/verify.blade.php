<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Email verification</h2>

<div>
    Thank you for becoming a part of the Learn ON crew.
   Please go to the following link to verify the existence of your email address!
    {{ URL::to('register/verify/' . $confirmation_code) }}.

</div>

</body>
</html>