<div class="panel" data-sortable-id="form-stuff-3">


        <div class="panel panel-inverse" data-sortable-id="ui-general-1">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload" data-original-title="" title=""><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Upcomming Appointments</h4>
            </div>
            <div class="panel-body" id="notificationArea">

            </div>
        </div>

</div>
<script type="text/javascript" src="/practicetab/public/dashboard/plugins/jquery/jquery-1.9.1.min.js"></script>
<script type="text/javascript">
    getNotification('notificationArea');
    var returningData;
    function getNotification(id)
    {
        $.ajax({
            type: "POST",
            url: '{{ URL::to('/patient/index/getNotification')}}',
            data: {
                reqDate : getDate()
            },
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function (result) {
                $('#'+id).html('');
                $('#'+id).html(result);
                returningData = result;
            },
            error:function (error) {
                alert('error');
            }
        });
    }
    function getDate()
    {
        var m_names = new Array("Jan", "Feb", "Mar",
                "Apr", "May", "Jun", "Jul", "Aug", "Sep",
                "Oct", "Nov", "Dec");

        var d = new Date();
        var curr_date = d.getDate();
        var curr_month = d.getMonth();
        var curr_year = d.getFullYear();
        var finaleDate = curr_date + "/" + m_names[curr_month] + "/" + curr_year;
        finaleDate = curr_year +"-"+ (curr_month+1) +"-"+ curr_date;
        var formatedDate = (curr_month+1)+"/"+curr_date+"/"+curr_year;
        return formatedDate;
    }
    function hide(scheduleId)
    {
        $.ajax({
            type: "POST",
            url: '{{ URL::to('/patient/index/hideNotification')}}',
            data: {
                scheduleId : scheduleId
            },
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function (result) {

            },
            error:function (error) {
            }
        });
    }

</script>
<!-- panel end -->