@extends('layouts.afidash')
@section('head')
        <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<link href="{{ asset('public/dashboard/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.css') }}" rel="stylesheet">
<!-- ================== END PAGE LEVEL STYLE ================== -->
@endsection
@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/member')}}">Dashboard</a></li>
    <li><a href="{{url('/member/affiliate')}}">Practitioners List</a></li>
    <li class="active">New</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">New <small>Send Invitation to New Practitioner(s)</small></h1>
<!-- end page-header -->

<!-- begin row -->
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-info"><strong>Invite as many Practitioners as you wish to PracticeTabs and receive $75 per Premium-Plan sign ups</strong></div>
    </div>
    <div class="col-md-12 msg">
        @if(Session::has('success'))
            <div class="alert alert-success fade in">
                <strong>Success!</strong>
                <strong>{{Session::pull('success')}}</strong>
                <span class="close" data-dismiss="alert">×</span>
            </div>
        @elseif(Session::has('error'))
            <div class="alert alert-danger fade in">
                <strong>Error!</strong>
                <strong>{{Session::pull('error')}}</strong>
                <span class="close" data-dismiss="alert">×</span>
            </div>
        @endif
    </div>

    <!-- begin col-6 -->
    <div class="col-md-5">
        <!-- begin panel -->
        <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">New Invitation</h4>
            </div>
            <div class="panel-body">
                <div class="row">
                <div class="col-md-12">
                    <h4 class="text-primary">Your Information:</h4>
                    First Name: {{$my_info->first_name}}<br/>
                    Last Name: {{$my_info->last_name}}<br/>
                    Email: {{$my_info->email}}
                </div>
                </div>
                <hr/>
                {!! Form::open(array('url'=>'/member/affiliate/createList', 'class'=> 'form-horizontal')) !!}
                <h4 class="text-primary">Practitioner Information:</h4>

                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('first_name','First Name *:', array('class'=>'col-md-4 control-label')) !!}
                        <div class="col-md-8">
                            {!! Form::text('first_name', null, array('class'=>'form-control', 'id'=>'first_name', 'placeholder'=> 'First Name', 'required' => 'required')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('last_name','Last Name *:', array('class'=>'col-md-4 control-label')) !!}
                        <div class="col-md-8">
                            {!! Form::text('last_name', null, array('class'=>'form-control', 'id'=>'last_name', 'placeholder'=> 'Last Name', 'required' => 'required')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('phone','Phone *:', array('class'=>'col-md-4 control-label')) !!}
                        <div class="col-md-8">
                            {!! Form::text('phone', null, array('class'=>'form-control', 'id'=>'phone', 'placeholder'=> 'Phone', 'required' => 'required')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('email','Email *:', array('class'=>'col-md-4 control-label')) !!}
                        <div class="col-md-8">
                            {!! Form::text('email', null, array('class'=>'form-control', 'id'=>'email', 'placeholder'=> 'Email', 'required' => 'required')) !!}
                        </div>
                    </div>
                </div>
                <hr/>
                <div class="col-md-12">
                    {!! Form::submit('Add', array('class'=>'btn btn-info pull-right')) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- end panel -->
    </div>
    <!-- end col 6 -->

    <div class="col-md-7">
        {!! Form::open(array('url'=>'/member/affiliate/store', 'class'=> 'form-horizontal', 'id'=>'frm-affiliate')) !!}

        <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Added Practitioner(s)</h4>
            </div>
            <div class="panel-body">
                <div class="row">
                <div class="col-md-12">
                    {!! Form::textarea('message', setDefaultTemplate(), array('class'=>'ckeditor','id'=>'message', 'rows'=>'3')) !!}
                </div>
                </div>
                <hr/>
                <table id="data-table" class="table table-striped table-hover" style="table-layout: fixed;">
                    <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list as $item)
                        <tr>
                            <td>
                                <input type="hidden" name="first_name[]" value="{{$item['first_name']}}" />
                                {{$item['first_name']}}
                            </td>
                            <td>
                                <input type="hidden" name="last_name[]" value="{{$item['last_name']}}" />
                                {{$item['last_name']}}
                            </td>
                            <td>
                                <input type="hidden" name="phone[]" value="{{$item['phone']}}" />
                                {{$item['phone']}}
                            </td>
                            <td style="word-wrap: break-word;">
                                <input type="hidden" name="email[]" value="{{$item['email']}}" />
                                {{$item['email']}}
                            </td>
                            <td>
                                <a href="javascript:void(0);" class="text-danger" onclick="removeRow(this, '{{$item['email']}}')"><i class="fa fa-times"></i> Remove</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <hr/>
                <div class="col-md-12">
                    <div class="footer-msg"></div>
                    {!! Form::submit('Save', array('class'=>'btn btn-success pull-right')) !!}
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
<!-- end row -->
@endsection
@section('bottom')
        <!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script type="text/javascript" src="{{asset('public/dashboard/plugins/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/plugins/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/js/form-wysiwyg.demo.min.j')}}s"></script>
@endsection
@section('page-scripts')
    <script type="text/javascript">
        var dataTable = '';
        $(document).ready(function() {
            FormWysihtml5.init();

            var roxyFileman = '{{asset('public/dashboard/plugins/fileman/index.html')}}';
            CKEDITOR.replace('message',
                    {
                        filebrowserBrowseUrl:roxyFileman,
                        filebrowserImageBrowseUrl:roxyFileman+'?type=image',
                        removeDialogTabs: 'link:upload;image:upload',
                        enterMode	: Number(2),
                        height: 150
                    });

            dataTable = $('#data-table').DataTable({
                responsive: true,
                "aaSorting": [[0, "asc"]],
                "iDisplayLength": 10,
                "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                "aoColumnDefs": [{'bSortable': false, 'aTargets': [4]}]
            });

        });

        function removeRow(elm, email) {
            $.get("{{url('/member/affiliate/removeAddedMember')}}", { email: email}, function(data) {
                $('#page-loader').removeClass('hide');
                if(data == 'success') {
                    /*$(elm).closest('tr').remove();

                     var rowCount = $('#dt-sup-selected tbody tr').length;
                     if (rowCount == 0) {
                     $("#dt-sup-selected tbody").append('<tr class="odd"><td valign="top" colspan="4" class="dataTables_empty">No data available in table</td></tr>');
                     }*/
                    window.location.reload();
                }
                $('#page-loader').addClass('hide');
            });
            return false;
        }

        $("#frm-affiliate").on('submit', function(e){

            if($('#data-table').find('td').hasClass('dataTables_empty')){
                $('.footer-msg').html('<div class="alert alert-warning"><strong>Please first add practitioner(s).</strong></div>').show().delay(5000).hide('slow');
                return false;
            }

            dataTable.$('input[type="hidden"]').each(function(){

                if(!$.contains(document, this)){
                    $("#frm-affiliate").append(
                            $('<input>')
                                    .attr('type', 'hidden')
                                    .attr('name', this.name)
                                    .val(this.value)
                    );
                }
            });
        });
    </script>
@endsection
<?php
function setDefaultTemplate()
{
    return "<p>Hey, check this website out <a href='".url('/pricing')."' target='_blank'>PracticeTabs</a></p>
            <p>&nbsp;</p>
            <p>If you register, you will get the exiting features that makes your life easier.</p>
            <p>Thanks, in advance</p>";
}
?>