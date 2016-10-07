@extends('layouts.front')

@section('content')
    <section class="main-section">
        <div class="inner" id="contact_frm">
            <div class="container-fluid">
                <h3 class="title-h3">Contact</h3>
                <div class="row">
                    <div class="col-md-4 no-padding" id="email-contact">
                        <span class="">Email:</span>
                        <span class=" mg-top">Support@practicetabs.com</span>
                    </div>
                    <div class="col-md-4 no-padding" id="phone-contact">
                        <span>Phone:</span>
                        <span class=" mg-top">(800) 446-6152</span>
                    </div>
                </div>
                <br/>
                <div class="row contact-wrap mg-top">
                    {!!Form::open(array('url'=>'/home/contact', 'class'=>'form-inline')) !!}
                        <div class="row">
                            <fieldset class="form-group col-md-4 no-padding-left mg-top">
                                <i class="fa fa-user key-i"></i>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="John">
                            </fieldset>
                            <fieldset class="form-group col-md-4 no-padding-left mg-top">
                                <i class="fa fa-user key-i"></i>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Smith">
                            </fieldset>
                        </div>
                        <div class="row">
                            <fieldset class="form-group col-md-4 no-padding-left mg-top email-i">
                                <i class="fa fa-envelope-o key-i"></i>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="mail@example.com">
                            </fieldset>
                        </div>
                        <div class="row ">
                            <fieldset class="form-group col-md-4 no-padding-left mg-top">
                                <textarea class="form-control" id="exampleTextarea" rows="3" placeholder="Your message here"></textarea>
                            </fieldset>
                        </div>
                    <br/>
                    <div class="mg-top">
                    <button type="submit" class="btn ">Submit</button>
                    </div>
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </section>
@endsection