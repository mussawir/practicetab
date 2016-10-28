<style type="text/css">
    body {
        font-family: Helvetica !important;
        margin: 0;
        padding: 0;
        font-size: 14px;
    }
    .mt-5 {
        margin-top: 5px;
    }
    .mt-20 {
        margin-top: 20px;
    }
    .ml-20 {
        margin-left: 20px;
    }
    .ml-50 {
        margin-left: 50px;
    }
    .table {
        width: 100%;
    }
    .table td {
        font-weight: bold;
        font-size: 14px;
    }
    .calendar {
        width: 18px;
        display: inline-block;
        font-size: 12px;
        text-align: right;
        float: left;
    }
    .footer {
        position: fixed;
        bottom: 120px;
        text-align: center;
        font-size: 14px;
        color: #aaaaaa;
        line-height: 1.3;
    }
    .footer span {
        display: block;
    }
    .page-break {
        page-break-after: always;
    }
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercise Prescription</title>
</head>
<body>
    <div class="page-wrapper">
        <hr/>
        @foreach($data as $item)
            <table style="width: 100%;border-collapse: collapse;">
                <tr>
                    <td style="width: 90px; height: 90px; text-align: center;">
                        @if(isset($item->image1) && (!empty($item->image1)))
                            <img src="{{asset('public/img/exercise/'.$item->image1)}}" />
                        @else
                            <img src="{{asset('public/img/no_image_64x64.jpg')}}" />
                        @endif
                    </td>
                    <td style="width: 90px; height: 90px; text-align: center;">
                        @if(isset($item->image2) && (!empty($item->image2)))
                            <img src="{{asset('public/img/exercise/'.$item->image2)}}" />
                        @else
                            <img src="{{asset('public/img/no_image_64x64.jpg')}}" />
                        @endif
                    </td>
                    <td style="">
                        <div style="margin-left: 5px;">
                        <strong>{{$item->heading}}</strong><br/>
                        <p style="margin-top: 5px;">{{$item->description}}</p>
                        </div>
                    </td>
                    <td style="width: 130px;">
                        <table style="width: 100%; font-size: 12px; text-align: center; border: 1px solid #000000; border-collapse: collapse;" border="1">
                            <tr>
                                <td>Sets:</td>
                                <td>{{$item->sets}}</td>
                            </tr>
                            <tr>
                                <td>Reps:</td>
                                <td>{{$item->reps}}</td>
                            </tr>
                            <tr>
                                <td style="width: 50px;">Weight:</td>
                                <td style="">{{$item->weight}}</td>
                            </tr>
                            <tr>
                                <td>Hold:</td>
                                <td>{{$item->hold}}</td>
                            </tr>
                            <tr>
                                <td>Rest:</td>
                                <td>{{$item->rest}}</td>
                            </tr>
                            <tr>
                                <td colspan="2">{{$item->duration}}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        Notes: <br/>
                        <p style="margin-top: 5px;">{{$item->notes}}</p>
                    </td>
                    <td>
                        <table>
                            <tr>
                                <td colspan="2">
                                    @for($i=1; $i<=31; $i++)
                                        <span class="calendar">{{$i}}</span>
                                        @if($i==7 || $i==14 || $i==21 || $i==28)
                                            <br/>
                                        @endif
                                    @endfor
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <hr/>
        @endforeach
    </div>
</body>
</html>