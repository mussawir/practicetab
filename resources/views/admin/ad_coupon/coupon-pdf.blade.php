
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Print Coupon</title>
    <style type="text/css">
        body{
            font-family:Helvetica !important;
        }
        .couponHeader{
            width: 100%;
            background-color: white;
            color: #00acac;
            font-size: 25px;
        }
        .couponLeft
        {
            background-color: #00acac;
            font-size: 20px;
            float: left;
            width: 60%;
            color : white;
            font-family:Helvetica !important;
            text-align: center;
        }
        .couponTitle
        {
            background-color:darkred;
            color:white;
            font-size: 25px;
            font-family:Helvetica !important;
            text-align: center;
        }
        .couponRight
        {
            background-color: white;
            font-size: 20px;
            float: right;
            width: 40%;
            font-family:Helvetica !important;
            text-align: center;
        }
        p{
            font-family:Helvetica !important;
        }
        .dotted {
            border: 1px dotted black;
            border-style: none none dotted;
            color: #fff;
            background-color: #fff;
        }
    </style>
</head>
<body>
@foreach($data as $item)
    @for($i=0;$i<$counter;$i++)
        <?php
        $couponCodes = explode(',',$item->cCode);
        ?>

<div class="couponHeader">
This Coupon entitles you to
</div>
    <div class="couponTitle">
        <span>{{$item->cTitle}}</span>
    </div>
        <div class="couponLeft">
            <b>
            Expiry Date : {{$item->expiryDate}}
            </b>
            <br/>
            <b>
            Discount : {{$item->discount}}
            {{$item->discountType == 1?'%':'Amount'}}
            </b>
        </div>
        <div class="couponRight">
            Coupon Code : <?php
                echo $couponCodes[$i];
                ?>
            <br/>
        </div>
        &nbsp;
        <br/>

        <br/>
        <div class="dotted">
            &nbsp;
        </div>
        &nbsp;

@endfor
@endforeach
</body>
</html>