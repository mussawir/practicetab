<footer class="clearfix">
    <div class="footer-right hidden">
        <div class="inside">
            <div class="newsletter">
                <form>
                    <fieldset>
                        <label>Subscribe to our newsletter, to be up to date with all the latest news.</label>
                        <input id="newlsetterEmail" name="email"  type="email" placeholder="Your Email">
                        <button id="newsletterSubscribe">Subscribe</button>
                    </fieldset>
                </form>
                <div id="newsletterSucces"></div>
            </div>
        </div>
    </div>
    <div class="footer-left">
        <div class="inside">
            <div class="footer-main-menu">
                <a href="#"><img src="{{asset('public/front/images/logo.svg')}}" class="logo" alt="" width="142" height="53"/></a>
                <div class="social">
                    <a href="#" title="Twitter"><i class="fa fa-twitter-square"></i></a>
                    <a href="#" title="Facebook"><i class="fa fa-facebook-square"></i></a>
                    <a href="#" title="Google Plus"><i class="fa fa-google-plus-square"></i></a>
                    <a href="#" title="Youtube"><i class="fa fa-youtube-square"></i></a>
                    <a href="#" title="Linkedin"><i class="fa fa-linkedin-square"></i></a>
                    <p>&copy;2016, All Rights Reserved.</p>
                </div>

            </div>

            <div class="footer-right-social">
                <ul>
                    <li>
                        <h3>Practitioners</h3>
                        <ul class="inner-list">
                            <li><a href="{{url('users/practitioner/login')}}">Login</a></li>
                            <li><a href="{{url('pricing')}}">Register</a></li>
                            <li><a href="#">Referral Program</a></li>
                            <li><a href="#">Terms of Use</a></li>
                            <li><a href="{{url('info/privacy-policy')}}" target="_blank">Merchandise, Refund, Privacy &amp; Security Policies</a></li>
                            <li><a href="#">Security Policy</a></li>
                            <li><a href="#">Cancellation Policy</a></li>
                        </ul>
                    </li>
                    <li>
                        <h3>Patients</h3>
                        <ul class="inner-list">
                            <li><a href="{{url('users/patient/login')}}">Login</a></li>
                            <li><a href="#">Register</a></li>
                            <li><a href="#">Terms of Use</a></li>
                            <li><a href="{{url('info/privacy-policy')}}" target="_blank">Merchandise, Refund, Privacy &amp; Security Policies</a></li>
                            <li><a href="#">Security Policy</a></li>
                        </ul>
                    </li>
                    <li>
                        <h3>Company</h3>
                        <ul class="inner-list">
                            <li><a href="{{url('about')}}">About Us</a></li>
                            <li><a href="{{url('contact')}}">Contact Us</a></li>
                            <li><a href="#">News + Updates</a></li>
                            <li><a href="#">Press</a></li>
                            <li><a href="#">Testimonials</a></li>
                            <li><a href="{{url('info/privacy-policy')}}" target="_blank">Merchandise, Refund, Privacy &amp; Security Policies</a></li>
                        </ul>
                    </li>
                    <li>
                        <h3>Partners</h3>
                        <ul class="inner-list">
                            <li><a href="#">Connect with Us</a></li>
                        </ul>
                        <h3>Support</h3>
                        <ul class="inner-list">
                            <li><a href="#">Report a Bug</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

            <div class="copyright">

            </div>
        </div>
    </div>
</footer>

@section('page-scripts')
    <script type="text/javascript">
        $('#newsletterSubscribe').click(function(){

            var email = $('#newlsetterEmail').val();
            if(checkemail() === false)
            {
                $('#newsletterSucces').html('Please input a valid email address!').show().delay(2000).fadeOut('slow');
            }
            else
            {
                $.ajax( {
                    type: "POST",
                    url : "<?php echo ''; ?>admin/members/subscribe",
                    data : { email: email },

                    success : function(data) {
                        $('#newsletterSucces').html(data).show().delay(2000).fadeOut('slow');
                    }
                });
            }

        });

        function checkemail(){
            var testresults;
            var str= $('#newlsetterEmail').val();
            var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
            if (filter.test(str))
                testresults=true;
            else{
                testresults=false;
            }
            return (testresults);
        }
    </script>
@endsection