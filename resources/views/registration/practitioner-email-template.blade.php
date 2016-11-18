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
        Thank you for registration on Practicetabs.com.
    </p>
    <p>
        <strong>Plan: </strong>{{$plan_type}}<br/>
        <strong>Name: </strong>{{$name}}<br/>
        <strong>Email: </strong>{{$email}}<br/>
        <strong>Password: </strong>{{$password}}
    </p>
    <p>
        Use the following link to login:
        <a href="{{url('/users/practitioner/login')}}">Login</a>
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