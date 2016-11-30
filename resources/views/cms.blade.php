@extends('layouts.front')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div style="background-color: #f1f1f2; padding: 10px 20px; min-height: 500px;">
                        <h1 class="text-primary">{{$table1->title}}</h1>
                        <div>
                            {!! $table1->contents !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection