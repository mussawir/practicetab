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
    <table style="border-collapse: collapse; border: 1px solid #000;" border="1">
        <tr>
            <th colspan="2" style="background-color: #d6d8dd; padding: 5px;">Login Information: </th>
        </tr>
        <tr><td style="padding: 5px;">Email: </td><td>{{$email}}</td></tr>
        <tr><td style="padding: 5px;">Password: </td><td>{{$password}}</td></tr>
    </table>
    <br/>
    <table style="border-collapse: collapse; border: 1px solid #000;" border="1">
        <tr style="background-color: #d6d8dd;">
            <th style="padding: 5px;">Selected Plan</th>
            <th style="padding: 5px;">Amount</th>
        </tr>
        <tr>
            <td style="padding: 5px;">{{$plan_type}}</td>
            <td style="text-align: right; padding: 5px;">{{$package_payment}}</td>
        </tr>
    </table>
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