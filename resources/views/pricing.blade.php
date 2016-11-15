@extends('layouts.front')

@section('content')
    @if(Session::has('plan_type'))
        {{Session::forget('plan_type')}}
    @endif
    <div class="msg">
        @if(Session::has('success'))
            <div class="alert alert-success">
                <strong>{{Session::pull('success')}}</strong>
            </div>
        @elseif(Session::has('error'))
            <div class="alert alert-danger">
                <strong>{{Session::pull('error')}}</strong>
            </div>
        @endif        
    </div>

    <section class="pricing-wrap">
    <div class="pricing-list">
        <div class="row">
        <div class="col-md-12">
            <h3>Your all-in-one Practice Solution</h3>
            <h4>Get started with your cloud-based, hassle-free plan today.</h4>
            <div class="main pricingPage">
                <div  class="inner">
                    <div class="freeProfile">
                        <h2>FREE</h2>
                        <b>$0</b>
                        <span>per month</span>
                        <ul>
                            <li class="listCheck"><span class="listY"></span>Public Practitioner Profile</li>
                            <li class="listCheck"><span class="listY"></span>Practitioner Referral Program</li>
                            <li class="listCross"><span class="listX"></span>Social Media Management</li>
                            <li class="listCross"><span class="listX"></span>Personal Blogging</li>
                            <li class="listCross"><span class="listX"></span>Merchant Account</li>
                            <li class="listCross"><span class="listX"></span>Office Statistics</li>
                            <li class="listCross"><span class="listX"></span>Comprehensive Calendar</li>
                            <li class="listCross"><span class="listX"></span>Email Marketing</li>
                            <li class="listCross"><span class="listX"></span>Patient Management</li>
                            <li class="listCross"><span class="listX"></span>Profitable Wellness Modules</li>
                            <li class="listCross"><span class="listX"></span>Secure Cloud Storage</li>
                            <li class="listCross"><span class="listX"></span>Secure Patient Portal</li>
                        </ul>
                        <form action="{{url('/registration/account')}}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="pricing_plan_type" value="1">
                            <input type="submit" class="btn" value="GET STARTED" />
                        </form>
                    </div>

                    <div class="premiumProfile">
                        <img class="popularBadge" src="http://s1.busteco.ro/arthur_prtab_git/public/images/popular-badge.svg" alt="">
                        <h2>PREMIUM</h2>
                        <b>$89.95</b>
                        <span>per month</span>
                        <ul>
                            <li class="listCheck"><span class="listY"></span>Public Practitioner Profile</li>
                            <li class="listCheck"><span class="listY"></span>Practitioner Referral Program</li>
                            <li class="listCheck"><span class="listY"></span>Social Media Management</li>
                            <li class="listCheck"><span class="listY"></span>Personal Blogging</li>
                            <li class="listCheck"><span class="listY"></span>Merchant Account</li>
                            <li class="listCheck"><span class="listY"></span>Office Statistics</li>
                            <li class="listCheck"><span class="listY"></span>Comprehensive Calendar</li>
                            <li class="listCheck"><span class="listY"></span>Email Marketing</li>
                            <li class="listCheck"><span class="listY"></span>Patient Management</li>
                            <li class="listCheck"><span class="listY"></span>Profitable Wellness Modules</li>
                            <li class="listCheck"><span class="listY"></span>Secure Cloud Storage</li>
                            <li class="listCheck"><span class="listY"></span>Secure Patient Portal</li>
                        </ul>

                        <form action="{{url('/registration/account')}}" method="POST" >
                            {{ csrf_field() }}
                            <input type="hidden" name="pricing_plan_type" value="2">
                            <input type="submit" class="btn" value="BUY PLAN" />
                        </form>
                    </div>

                    <div class="liteProfile">
                        <h2>LITE</h2>
                        <b>$19.95</b>
                        <span>per month</span>
                        <ul>
                            <li class="listCheck"><span class="listY"></span>Public Practitioner Profile</li>
                            <li class="listCheck"><span class="listY"></span>Practitioner Referral Program</li>
                            <li class="listCheck"><span class="listY"></span>Social Media Management</li>
                            <li class="listCheck"><span class="listY"></span>Personal Blogging</li>
                            <li class="listCross"><span class="listX"></span>Merchant Account</li>
                            <li class="listCross"><span class="listX"></span>Office Statistics</li>
                            <li class="listCross"><span class="listX"></span>Comprehensive Calendar</li>
                            <li class="listCross"><span class="listX"></span>Email Marketing</li>
                            <li class="listCross"><span class="listX"></span>Patient Management</li>
                            <li class="listCross"><span class="listX"></span>Profitable Wellness Modules</li>
                            <li class="listCross"><span class="listX"></span>Secure Cloud Storage</li>
                            <li class="listCross"><span class="listX"></span>Secure Patient Portal</li>
                        </ul>

                        <form action="{{url('/registration/account')}}" method="POST" >
                            {{ csrf_field() }}
                            <input type="hidden" name="pricing_plan_type" value="3">
                            <input type="submit" class="btn" value="BUY PLAN" />
                        </form>
                    </div>
                </div>
            </div>
            <div class="footnotes">
                <p>* $199.95 Initial setup fee for Premium account holders. This one-time cost includes data transfer, merchant account setup fee and merchant account equipment.</p>
                <p>* Save 10% with annual pre-paymentt</p>
                <p>* Save 5% with semi-annual pre-payment</p>
                <p>† Secure cloud storage - 5GB included in Premium plan.</p>
                <p>‡ Email marketing includes up to 5,000 emails per month.</p>
            </div>

            <div class="footerCTA">
                <p class="questionsCTA">Call <b>(800) 446-6152</b> or <a href="#"><b>Contact Us</b></a> with your questions.</p>
                <p class="questionsCTA2">Customer service included with all plans.</p>
            </div>
        </div>
    </div>
    </div>
    </section>
@endsection