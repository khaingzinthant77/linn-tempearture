<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact us</title>
    
    @include('head')


</head>

<body style="background-color: #F4F7FC">
    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner">
                <div class="double-bounce1"></div>
                <div class="double-bounce2"></div>
            </div>
        </div>
    </div>
    <!-- Loader -->

    <!-- Navigation Bar-->
    <header id="topnav" class="defaultscroll scroll-active" style="background-color: #3498DB;">
        <!-- Tagline STart -->
        @include('header')
        <!--end container-->
        <!--end end-->
    </header>
    <!--end header-->
    <!-- Navbar End -->

    <!-- MAP START -->
    <section class="section pt-0 ">
        <div class="container-fluid">

        </div>


    </section>
    <!-- CONTACT END -->

    <section style="margin: 50px">
        <h4 style="font-weight: bold;">Head Office</h4>
        <div class="row" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);background-color: white">
            <div class="col-md-4"
                style="text-align: center;padding-top: 40px;padding-bottom: 30px;border-right: 2px solid #B3B8C1;">
                <img src="{{ asset('uploads/images/address.png') }}" alt="photo" width="40px" height="40px"><br><br>
                <h3 style="font-weight: bold;">Address</h3>
                <p style="padding-top: 10px">No. 14/585, 4th Street, Paung Laung Quarter, Pyinmana.</p>
            </div>
            <div class="col-md-4"
                style="text-align: center;padding-top: 40px;padding-bottom: 30px;border-right: 2px solid #B3B8C1;">
                <img src="{{ asset('uploads/images/phone.png') }}" alt="photo" width="40px" height="40px"><br><br>
                <h3 style="font-weight: bold;">Call Us</h3>
                <p style="padding-top: 10px">067-22884,23884,24884</p>
            </div>
            <div class="col-md-4" style="text-align: center;padding-top: 40px;padding-bottom: 30px">
                <img src="{{ asset('uploads/images/email.png') }}" alt="photo" width="50px" height="40px"><br><br>
                <h3 style="font-weight: bold;">Mail Us</h3>
                <p style="padding-top: 10px">info@linncomputer.com</p>
            </div>
        </div><br>

        <div>
            <h4 style="font-weight: bold;">Branches</h4>
            <div class="row">
                <div
                    style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);background-color: #185BA9;padding-top: 40px;padding-bottom: 30px;width: 48%;margin-right: 4%;padding-left: 20px">
                    <p style="color: white"><i class="mdi mdi-map-marker"></i> No.117, Thapyagone Quarter, Naypyitaw</p>
                    <p style="color: white"><i class="mdi mdi-cellphone-iphone"></i><span>
                            067-414884,414885,432884</span></p>
                    <p style="color: white"><i class="mdi mdi-email"></i><span> info@linncomputer.com</span></p>
                </div>

                <div
                    style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);background-color: #185BA9;padding-top: 40px;padding-bottom: 30px;width: 48%;padding-left: 20px">
                    <p style="color: white"><i class="mdi mdi-map-marker"></i> No.11/7, Bogyoke Road, Pyinmana</p>
                    <p style="color: white"><i class="mdi mdi-cellphone-iphone"></i><span> 067-24488,26884</span></p>
                    <p style="color: white"><i class="mdi mdi-email"></i><span> info@linncomputer.com</span></p>
                </div>
            </div>
        </div>



    </section>
    <div style="margin-left: 43px;margin-right: 43px;margin-top: 43px;box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2)">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3755.336957395618!2d96.2027726147721!3d19.740833486709946!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c8ba2f4e0cd0c1%3A0x371a6ba88980820f!2sLinn%20IT%20%26%20Mobile!5e0!3m2!1sen!2sde!4v1621188728715!5m2!1sen!2sde"
            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>

    <footer class="footer">
        @include('footer')
    </footer>
     <!-- footer end -->
    <hr>
    <footer class="footer footer-bar">
        @include('footerbar')
    </footer>

    <!-- Back to top -->
    <a href="#" class="back-to-top rounded text-center" id="back-to-top">
        <i class="mdi mdi-chevron-up d-block"> </i>
    </a>
    <!-- Back to top -->
    <!-- javascript -->
    <script src="{{ asset('js/jquerys.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/plugins.js') }}"></script>

    <!-- selectize js -->
    <script src="{{ asset('js/selectize.min.js') }}"></script>

    <script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
    <!-- CONTACT -->
    <script src="{{ asset('js/contact.js') }}"></script>

    <script src="{{ asset('js/apps.js') }}"></script>

</body>

</html>
