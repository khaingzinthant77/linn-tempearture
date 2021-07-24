<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About</title>
    @include('head')

</head>

<body>
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
       @include('header')
    </header>
    <!--end header-->
    <!-- Navbar End -->


    <!-- ABOUT US START -->
    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="section-title text-center mb-4 pb-2">
                        <h4 class="title title-line pb-5" style="margin-top: 30px !important;">About Us</h4>
                    </div>
                </div>
            </div>
            <div class="row ">


                <div class="col-lg-7 col-md-8">
                    <div class="about-desc ml-lg-4">
                        <!-- <h4 class="text-dark">About us</h4> -->

                        <p style="text-align: justify;">ကျွန်တော်များ Linn IT Solution Co., Ltd. သည် (၅.၅.၂၀၀၅)
                            ရက်နေ့တွင် ဗိုလ်ချုပ်လမ်း၊ ပျဉ်းမနားမြို့တွင် Linn IT Solution Center အဖြစ်
                            စတင်ဖွင့်လှစ်ခဲ့ပြီး ဝန်ကြီးရုံးများ၊ စစ်ရုံးများနှင့် ပုဂ္ဂလိက ကုမ္ပဏီများ အတွက် လိုအပ်သော
                            IT နှင့်ပတ်သက်သည့် လုပ်ငန်းများကို အချိန်နှင့် တပြေးညီ ဆောင်ရွက်ပေးခဲ့ပါသည်။ထို့အပြင်
                            Computer နှင့် ဆက်စပ်ပစ္စည်းများရောင်းချခြင်း နှင့် Computer နှင့် ပက်သက်သည့်
                            သင်တန်းများကိုလည်း ဖွင့်လှစ်သင်ကြားပေးခဲ့ပါသည်။</p><br>
                        <p style="text-align: justify;">
                            နေပြည်တော်ကောင်စီနယ်မြေအတွင်းရှိ ဝန်ကြီးရုံးများ၊ ဟိုတယ်များ၊ စစ်ရုံးများနှင့်
                            ကုမ္ပဏီများတွင်လည်း လိုအပ်သော Network, CCTV Camera နှင့် WiFi များအား Installation
                            ဆောင်ရွက်မှုများကိုလည်း တပ်ဆင်ဆောင်ရွက်ပေး လျက်ရှိပါသည်။ ဝန်ကြီးဌာနများတွင်လည်း E-Government
                            စနစ်အကောင်အထည်ဖော်ဆောင်နိုင်ရန်အတွက် Network Infrastructure အား
                            လိုက်လံတပ်ဆင်ဆောင်ရွက်ပေးလျှက်ရှိပါသည်။</p>

                        <!--  <p class="text-muted">Maecenas tempus tellus eget as that condimentum rhoncus sem quam semper libero amete adipiscing sem neque sed ipsum Nam quam nunce blandit at luctus pulvinar hendrerit id lorem Maecenas nec et ante tincidunt tempus.</p>

                        <p class="text-muted">Sed consequat leo eget bibendum sodales augue at velit cursus nunc.</p> -->

                        <!--  <a href="javascript:void(0)" class="btn btn-primary">Apply now</a> -->
                    </div>
                </div>
                <div class="col-lg-5 col-md-4 text-center" style="text-align: center">
                    <img src="{{ asset('linn.png') }}" alt="" style="margin: auto; width:80%">
                </div>
            </div>
        </div>
    </section>
    <!-- ABOUT US END -->

    <!-- COUNTER START -->
    <div style="background-color: #0d4091">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6" style="border-right: 5px solid #061985;">
                    <div class="widget clearfix" style="text-align: center;padding-top: 50px;padding-bottom: 50px">
                        <h5 style="color: white">Our Mission</h5><br>
                        <p style="color: white;">စည်းကမ်းလိုက်နာပြီး အရည်အချင်းပြည်စုံသော ဝန်ထမ်းကောင်းများနှင့်
                            ပူးပေါင်းဆောင်ရွက်မည်။ ၂၀၂၀ ပြည့်နှစ်တွင် ISO Standard ရရှိအောင်ဆောင်ရွက်ပြီး
                            ဝန်ဆောင်မှုအကောင်းဆုံးဖြစ်အောင်လုပ်ဆောင်ပါမည်။</p>
                    </div><!-- end widget -->
                </div><!-- end col -->

                <div class="col-md-6 col-sm-6">
                    <div class="widget clearfix" style="text-align: center;padding-top: 50px;padding-bottom: 50px">
                        <i class="fa fa-bar-chart" aria-hidden="true"></i>
                        <h5 style="color: white">Our Vision</h5><br>
                        <p style="color: white;">ကျွန်တော်တို့ Linn IT Solution Co.,Ltd သည်
                            မြန်မာနိုင်ငံတော်တစ်ဝန်းလုံးတွင် ဝန်ဆောင်မှုအကောင်းဆုံးကုမ္ပဏီဖြစ်ရမည်။</p>
                    </div><!-- end widget -->
                </div><!-- end col -->


            </div><!-- end row -->
        </div><!-- end container -->
    </div><br><!-- end primary-footer -->
    <!-- COUNTER END -->
    <div>
        <div style="margin:30px;">
            <h3>Our History</h3>
            <p style="text-align: justify;">
                ကျွန်တော်များ Linn IT Solution Co., Ltd. သည် (၅.၅.၂၀၀၅) ရက်နေ့တွင် ဗိုလ်ချုပ်လမ်း၊ ပျဉ်းမနားမြို့တွင်
                Linn IT Solution Center အဖြစ် စတင်ဖွင့်လှစ်ခဲ့ပြီး ဝန်ကြီးရုံးများ၊ စစ်ရုံးများနှင့် ပုဂ္ဂလိက
                ကုမ္ပဏီများ အတွက် လိုအပ်သော IT နှင့်ပတ်သက်သည့် လုပ်ငန်းများကို အချိန်နှင့် တပြေးညီ ဆောင်ရွက်ပေးခဲ့ပါသည်။
                ထို့အပြင် Computer နှင့် ဆက်စပ်ပစ္စည်းများရောင်းချခြင်း နှင့် Computer နှင့် ပက်သက်သည့်
                သင်တန်းများကိုလည်း ဖွင့်လှစ်သင်ကြားပေးခဲ့ပါသည်။

                ကျွန်တော်များ Linn IT Solution Co.,Ltd သည်ဝန်ကြီးဌာနများမှလိုအပ်သည်များကို ပိုမိုလျင်မြန်စွာ
                ဝန်အောင်မှုပေးနိုင်ရန်အတွက် ၂၀၀၈ ခုနှစ်တွင် အမှတ် (၁၁၇) ၊ သပြေကုန်းရပ်ကွက်၊ နေပြည်တော်တွင် Linn IT
                Solution Center – 2 (သပြေကုန်း) အားဖွင့်လှစ်ခဲ့ပြီး ဝန်ဆောင်မှု များပေးခဲ့ပါသည်။
                ၂၀၁၀ ခုနှစ်တွင် Linn IT Solution Co.,Ltd. အဖြစ် စတင်ပြောင်းလဲဖွဲ့စည်းခဲ့ပြီး ပျဉ်းမနား နှင့် နေပြည်တော်
                ဆိုင်ခွဲများအား Linn IT & Mobile Shop အဖြစ်ပြောင်းလဲ ကာ Mobile Phone နှင့်ပါတ်သက်သော ပစ္စည်းများ
                ရောင်းချခဲ့ ပါသည်။

                Linn IT Solution Co., Ltd. သည် နေပြည်တော် ကောင်စီနယ်မြေရှိ ပျဉ်းမနားတွင် Linn IT & Mobile Mart အဖြစ်
                ၂၀၁၅ ခုနှစ်၊ ဧပြီလ (၅) ရက်နေ့တွင် အောင်မြင်စွာ ဖွင့်လှစ်နိုင် ခဲ့ပါသည်။

                USA, Japan, China နှင့် Taiwan နိုင်ငံများမှ အရေအသွေးမြင့် ပစ္စည်းများအား တင်သွင်းပြီး ပစ္စည်းမှန်
                စျေးနှုန်းမှန်ဖြင့် ရောင်းချ ပေးလျက်ရှိသလို လိုအပ်သော ဝန်ဆောင်မှု အားလုံးကိုလည်း အချိန်နှင့် တပြေးညီ
                ဆောင်ရွက်လျက် ရှိပါသည်။ ဝန်ကြီးဌာနများ၊ စစ်ရုံးများမှ ခေါ်ယူခဲ့သော တင်ဒါများတွင် ဝင်ရောက်
                ယှဉ်ပြိုင်ခဲ့ပြီး လိုအပ်သော ပစ္စည်းများကိုလည်း တင်သွင်းပေးနိုင်ခဲ့ပါသည်။

                (၅.၅.၂၀၀၅) ရက်နေ့မှ စတင် ဖွင့်လှစ်ခဲ့သော ကျွန်တော်တို့ Linn IT Solution Co., Ltd. သည် ယနေ့ အချိန်ထိ
                ဝန်ထမ်းပေါင်း ၂၉၀ ကျော်နှင့် လည်ပတ် လျက်ရှိပြီး IT နှင့် ဆက်စပ်သော ပစ္စည်းများ၊ ဝန်ဆောင်မှု များကို
                အချိန်နှင့် တစ်ပြေးညီ ဆောင်ရွက် ပေးလျက် ရှိပါသည်။
            </p>
        </div>
    </div>
    <div class="row" style="background-color: red;margin: 25px">
        <div class="col-md-6" style="background-color: white">
            <img src="{{ asset('img1.png') }}" alt="" width="100%">
        </div>
        <div class="col-md-6" style="background-color: white">
            <p style="text-align: justify;">ကျွန်တော်များ Linn IT Solution Co., Ltd. အတွက်
                သမိုင်းဝင်မှတ်တမ်းတစ်ခုအနေဖြင့် ၂၀၁၃ ခုနှစ်တွင်မြန်မာနိုင်ငံမှ အိမ်ရှင်အဖြစ် လက်ခံကျင်းပခဲ့သည့် (၂၇)
                ကြိမ်မြောက် အရှေ့တောင်အာရှအားကစားပြိုင်ပွဲကြီးတွင် WiFi Internet တပ်ဆင်ခြင်း၊ Network တည်ဆောက်ခြင်း
                လုပ်ငန်းများအား မြန်မာ့ဆက်သွယ်ရေးလုပ်ငန်း၏ လမ်းညွှန်မှုများဖြင့် ဂုဏ်ယူစွာဆောင်ရွက်နိုင်ခဲ့သည့်အပြင် (၇)
                ကြိမ်မြောက် အာဆီယံ မသန်စွမ်းသူများ အားကစားပြိုင်ပွဲ၊ အာဆီယံလူငယ်အားကစားပြိုင်ပွဲများတွင်လည်း
                ဆက်ဆက်ဆောင်ရွက်နိုင်ခဲ့ပါသည်။</p><br>

            <p style="text-align: justify;">
                ၂၀၁၄ ခုနှစ်၊ မတ်လတွင် Myanmar International Convention တွင်ကျင်းပခဲ့သော THIRD BIMSTEC SUMMIT & ITS
                RELATED MEETINGS တွင်လည်း Wireless Internet Access နှင့်ပတ်သက်၍ တပ်ဆင်ခြင်း၊ ထိန်းသိမ်းခြင်းနှင့် Media
                User Complain ဖြေရှင်းခြင်းလုပ်ငန်းများကိုလည်း အောင်မြင်စွာ လုပ်ဆောင်နိုင်ခဲ့ပါသည်။ ၂၀၁၄ ခုနှစ်၊
                ဩဂုတ်လအတွင်း MYANMAR INTERNATIONAL CONVENTION CENTER တွင် ကျင်းပခဲ့သော 47th AMM/PMC/ 15th APT FMM/ 4th
                EAS FMM အစည်းအဝေးများအပြင် 46th ASEAN ECONOMIC MINISTER’S (AEM) MEETING များတွင်လည်း Wireless Internet
                Access နှင့်ပတ်သက်၍ တပ်ဆင်ခြင်း၊ ထိန်းသိမ်းခြင်းနှင့် Media သမားများနှင့် User Complain
                ဖြေရှင်းပေးခြင်းလုပ်ငန်းများကိုလည်း အောင်မြင်စွာလုပ်ဆောင်နိုင်ခဲ့ပါသည်။
            </p><br>
            <p style="text-align: justify;">
                ၂၀၁၄ ခုနှစ်အတွင်း နောက်ဆုံးအနေနှင့် 25th ASEAN SUMMIT AND RELATED SUMMITS အခမ်းအနားတွင်လည်း Wireless
                Internet Access နှင့်ပတ်သက်၍ တပ်ဆင်ခြင်း၊ ထိန်းသိမ်းခြင်းနှင့် Media သမားများနှင့် User Complain
                ဖြေရှင်းပေးခြင်းလုပ်ငန်းများကိုလည်း အောင်မြင်စွာလုပ်ဆောင်နိုင်ခဲ့သည်မှာ
                ထပ်မံကဗ္ဗည်းမော်ကွန်းတင်နိုင်ခဲ့ပါသည်။
            </p>
        </div>
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
    <script type="text/javascript" src="{{ asset('js/jquerys.min.js') }}"></script>


    <script type="text/javascript" src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.easing.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/selectize.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/counter.int.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/apps.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/home.js') }}"></script>
    <script type="text/javascript" src="{{ asset('toastermin.js') }}"></script>

</body>

</html>
