@extends('layouts.padash')
@section('content')
<div class="row">
    <div class="col-md-12">
        @include('patient.index.top-ad')
    </div>
</div>
<!-- begin row -->
<div class="row">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">
                @include('patient.index.supplements-panel')
            </div>
            <div class="col-md-12">
                @include('patient.index.nutritions-panel')
            </div>
            <div class="col-md-12">
                @include('patient.index.exercises-panel')
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">
                @include('patient.index.articles-panel')
            </div>
            <div class="col-md-12">
                @include('patient.index.ad1')
            </div>
            <div class="col-md-12">
                @include('patient.index.articles-panel')
            </div>
        </div>
        <!-- row end -->

    </div>
</div>
<!-- end row -->
@endsection

@section('page-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            App.init();
            Dashboard.init();
        });
    </script>
@endsection