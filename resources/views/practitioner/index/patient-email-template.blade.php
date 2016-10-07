<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<strong>Hi {{$name}},</strong>
<br/>
<br/>
<div>
    <p>
        Your account has been created on Practicetabs.com by <strong>{{$created_by}}</strong>
    </p>
    <p>
        Your login credentials are as follows<br/>
        <strong>Email: </strong>{{$email}}<br/>
        <strong>Password: </strong>{{$password}}
    </p>
    <p>
        Use the following to login:
        <a href="{{url('/users/patient/login')}}">Login</a>
    </p>
    <p>
        <strong>Note: You can change your password after login.</strong>
    </p>
    <br/>
    Kind Regards,
    <br/>
    <strong>The Practicetabs.com Team</strong>
</div>
</body>
</html>