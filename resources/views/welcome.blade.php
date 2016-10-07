@extends('layouts.front')

@section('content')
    <section>
    <div id="pt-Carousel" class="carousel slide" data-ride="carousel">

        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="{{asset('public/front/img/homeslider/slide1.jpg')}}" alt="slide 1" >
            </div>

            <div class="item">
                <img src="{{asset('public/front/img/homeslider/slide2.jpg')}}" alt="slide 1">
            </div>

            <div class="item">
                <img src="{{asset('public/front/img/homeslider/slide3.jpg')}}" alt="slide 1">
            </div>
        </div>

        <!-- Left and right controls -->
        {{--<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="fa fa-chevron-left" aria-hidden="true" style="margin-top: 300px;"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="fa fa-chevron-right" aria-hidden="true" style="margin-top: 300px;"></span>
            <span class="sr-only">Next</span>
        </a>--}}
        <div class="layer"></div>
    </div>
        <div id="slider-heading">
            <h1>Boost Your Revenue</h1>
            <h2>Generate profit through our wellness programs.</h2>
        </div>
        <div class="reg-box">
            <h3>Sign up for your free profile today</h3>
            <form onsubmit="return validateForm();" action="{{url('/register/newPractitioner')}}" method="POST">
                {{ csrf_field() }}
                <ul class="clearfix">
                    <li><i class="fa fa-user"></i>
                        <input type="text" name="full_name" id="full_name" placeholder="Full Name" class="inp" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Full Name'">
                        <div style="display: none;" class="text-danger name-err"></div>
                    </li>
                    <li><i class="fa fa-envelope-o"></i>
                        <input type="email" name="email" id="email" placeholder="Email" class="inp" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'">
                        <div style="display: none;" class="text-danger email-err"></div>
                    </li>
                </ul>
                <div class="btn-wrap">
                    <button type="submit" class="submit"><i class="fa fa-paper-plane"></i>Sign up</button>
                </div>
            </form>
            <div class="more">
                <a href="#learn-more" class="learn-more"><i class="fa fa-chevron-down"></i><p>Learn more</p></a>
            </div>
        </div>
    </section>
@endsection

@section('page-scripts')
    <script type="text/javascript">
        $( document ).ready(function() {

            $("#pt-Carousel").on('slide.bs.carousel', function(evt) {
                var step = $(evt.relatedTarget).index();

                if(step==0)
                {
                    $('#slider-heading').html('<h1>Boost Your Revenue</h1><h2>Generate profit through our wellness programs.</h2>');
                }

                if(step==1)
                {
                    $('#slider-heading').html('<h1>Promote Your Practice</h1><h2>Market yourself to millions on social media.</h2>');
                }

                if(step==2)
                {
                    $('#slider-heading').html('<h1>Stay Connected</h1><h2>Communicating with patients made simple.</h2>');
                }
            });
        });

        function isEmpty(str) {
            return (!str || 0 === str.length);
        }

        function validateForm()
        {
            var email = document.getElementById("email").value;
            var name = document.getElementById("full_name").value;

            var ok = true;

            if(isEmpty(email))
            {
                $('.email-err').text("Email is required").show();
                document.getElementById("email").focus();

                ok = false;
            }

            if(!isEmail(email)) {
                $('.email-err').text("Invalid email address").show();
                document.getElementById("email").focus();

                ok = false;
            }

            if(isEmpty(name))
            {
                $('.name-err').text("Full Name is required").show();
                document.getElementById("full_name").focus();

                ok = false;
            }

            return ok;
        }

        function isEmail(email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
        }

        $('#full_name').keydown(function () {
            $('.name-err').hide();
        });

        $('#email').keydown(function () {
            $('.email-err').hide();
        });
    </script>
@endsection