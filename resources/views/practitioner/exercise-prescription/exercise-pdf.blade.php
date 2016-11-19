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
        width: 16px;
        height: 16px;
        display: inline;
        font-size: 12px;
        text-align: right;
        float: left;
    }
    .tbl-calendar td {
        font-size: 10px;
        text-align: center;
    }
    .footer {
        position: fixed;
        bottom: 24px;
        font-size: 10px;
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
    <div style="margin-bottom: 5px;">
        <span style="width: 20%; float: left; padding: 5px; text-align: center;">
            @if(isset($pra_info->clinic_logo) && (!empty($pra_info->clinic_logo)))
                <img src="{{public_path(). '/practitioners/'.$pra_info->directory.'/'.$pra_info->clinic_logo}}" style="max-height: 64px;" />
            @else
                <img src="{{public_path().'/img/no_image_64x64.jpg'}}" style="max-height: 64px;" />
            @endif
        </span>
        <span style="width: 80%; float: left; font-size: 12px;">
            {!! $pra_info->clinic_doc_head !!}
        </span>
    </div>
    <div style="clear: both;"></div>
    <hr/>
    @foreach($data as $item)
        <div>
            <div style="width: 44%; float: left;">
                <div>
                <span>
                    @if(isset($item->image1) && (!empty($item->image1)))
                        <img src="{{asset('public/img/exercise/'.$item->image1)}}" />
                    @else
                        <img src="{{asset('public/img/no_image_64x64.jpg')}}" />
                    @endif
                </span>
                <span>
                    @if(isset($item->image2) && (!empty($item->image2)))
                        <img src="{{asset('public/img/exercise/'.$item->image2)}}" />
                    @else
                        <img src="{{asset('public/img/no_image_64x64.jpg')}}" />
                    @endif
                </span>
                </div>
                <div class="mt-5">
                    <div style="width: 40%; float: left;">
                    <table style="width: 100%; font-size: 12px; text-align: center; border: 1px solid #000000; border-collapse: collapse;" border="1">
                        <tr>
                            <td>Sets:</td>
                            <td>{{$item->sets}}</td>
                        </tr>
                        <tr style="background-color: #dddddd;">
                            <td>Reps:</td>
                            <td>{{$item->reps}}</td>
                        </tr>
                        <tr>
                            <td style="width: 50px;">Weight:</td>
                            <td style="">{{$item->weight}}</td>
                        </tr>
                        <tr style="background-color: #dddddd;">
                            <td>Hold:</td>
                            <td>{{$item->hold}}</td>
                        </tr>
                        <tr>
                            <td>Rest:</td>
                            <td>{{$item->rest}}</td>
                        </tr>
                        <tr style="background-color: #dddddd;">
                            <td colspan="2">{{$item->duration}}</td>
                        </tr>
                    </table>
                    </div>
                    <div style="width: 40%; float: right; margin-right: 16px;">
                    <table style="width: 100%;" class="tbl-calendar">
                        <tr>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                            <td>5</td>
                            <td>6</td>
                            <td>7</td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>9</td>
                            <td>10</td>
                            <td>11</td>
                            <td>12</td>
                            <td>13</td>
                            <td>14</td>
                        </tr>
                        <tr>
                            <td>15</td>
                            <td>16</td>
                            <td>17</td>
                            <td>18</td>
                            <td>19</td>
                            <td>20</td>
                            <td>21</td>
                        </tr>
                        <tr>
                            <td>22</td>
                            <td>23</td>
                            <td>24</td>
                            <td>25</td>
                            <td>26</td>
                            <td>27</td>
                            <td>28</td>
                        </tr>
                        <tr>
                            <td>29</td>
                            <td>30</td>
                            <td>31</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>
                    </div>
                </div>
                <!--table style="width: 100%;border-collapse: collapse;">
                    <tr>
                        <td style="width: 90px; height: 90px; text-align: center;">

                        </td>
                        <td style="width: 90px; height: 90px; text-align: center;">

                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">

                        </td>
                    </tr>
                </table-->
            </div>
            <div style="width: 26%; float: left; border-right: 1px solid #dddddd; margin-right: 1%;">
                <div style="background-color: #dddddd; font-weight: bold; padding: 2px;">{{$item->heading}}</div>
                <p>{{$item->description}}</p>
            </div>
            <div style="width: 29%; float: left;">
                <div style="background-color: #dddddd; font-weight: bold; padding: 2px;">Notes</div>
                <p>{{$item->notes}}</p>
            </div>
        </div>
        <div style="clear: both;"></div>
        <hr/>
    @endforeach

    <div class="footer">
        <hr/>
        {!! $pra_info->clinic_doc_footer !!}
    </div>
</div>
<script type="text/php">
 if (isset($pdf)) {
    // v.0.7.0 and greater
    $x = 300;
    $y = 750;
    $text = "Page {PAGE_NUM} of {PAGE_COUNT}";
    $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
    $size = 6;
    $color = array(255,0,0);
    $word_space = 0.0;  //  default
    $char_space = 0.0;  //  default
    $angle = 0.0;   //  default
    $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
 }
</script>
</body>
</html>