<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<strong>Hi {{$data['first_name'].' '.$data['last_name']}},</strong>
<br/>
<br/>
<div>
    <p>
        Thank you for joining us on Practicetabs.com.
    </p>
    <p>
        <strong>Name: </strong>{{$data['first_name'].' '.$data['last_name']}}<br/>
        <strong>Phone: </strong>{{$data['phone']}}<br/>
        <strong>Email: </strong>{{$data['email']}}<br/>
        <strong>Password: </strong>{{$data['password']}}
    </p>
    <p>
        Use the following link to login:
        <a href="{{url('/users/member/login')}}">Login</a>
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