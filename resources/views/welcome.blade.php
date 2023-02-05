<?php
   $logo = \App\Models\Setting::where('id',7)->first();
?>
للحجز ومتابعة الفحوصات
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dr.Germaine Alfred</title>
    <link rel="stylesheet" href="https://germainealfred.com/assets-landing/css/color/color-1.css">
    <link rel="stylesheet" href="https://germainealfred.com/assets-landing//css/style.css">
    <link rel="stylesheet" href="https://germainealfred.com/assets-landing/css/responsive.css">
    <!--animation-->
    <link rel="stylesheet" href="https://germainealfred.com/assets-landing/animation/animate.css">
    <!--logo-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- <link rel="icon" type="image/png" sizes="16x16" href="https://germainealfred.com/Icon.png"> --}}
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets-landing/images/icons/Icon.png')}}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300&display=swap" rel="stylesheet">
    <script type="text/javascript" src="https://gc.kes.v2.scr.kaspersky-labs.com/7EA5E9BB-55E1-4C31-9C21-4943DDFED2E4/main.js?attr=NaGlJI5wwT5zEiT_MZ6LDZjI4X_XUyUmf_VlLbQ_9zOgJngmO3oPdgDhgcsKQloq" charset="UTF-8"></script><script src="https://kit.fontawesome.com/8c2459f9f4.js" crossorigin="anonymous"></script>
    <style>
        iframe {
		width: 100% !important;
        height: 300px !important;
    }
    /* .footer-space-container {
		height: 400px;
	} */
    </style>
</head>

<body class="header_sticky" style="font-family: 'Cairo', sans-serif;" oncontextmenu="return false">
    <!-- Preloader -->
    <div id="loading-overlay">
        <div class="loader"></div>
    </div>
    <div class="wrapper">
        <div id="page">
            <header class="header clearfix">
                <div id="header">
                    <div id="site-header">
                        <div class="logo  w-100 d-flex justify-content-center">
                            <a>
                                @if($logo->image)
                                <img src="{{$logo->image}}" alt="image" style="height:65px; object-fit:contain;">

                                @else
                                <img src="{{$logo->value}}" alt="image" style="height:65px; object-fit:contain;">
                                 @endif
                                {{-- <img src="https://germainealfred.com/Web-Logo.png" alt="image" style="height:65px; object-fit:contain;"> --}}
                            </a>
                        </div>
                        <!-- //mobile menu button -->

                        <!-- /#mainnav -->
                        <div class="contact">
                            <div class="top-bar-right">
                                <div class="call-us">

                                    <div class="content-call-us">
                                        <p class="text-center"> <i style="backgroung-color:#4ec0e7;"></i> اتصل بنا </p>
                                        <a href="tel:+20 01207721212" class="font-bold text-color-title-sidebar">
                                            01207721212</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <div id="header-baner" style="background-image: url('https://germainealfred.com/9.png');">
                <div class="container" style="background-image: url('https://germainealfred.com/9.png');">
                    <div class="text-banner wow fadeInDown" style="background-image: url('https://germainealfred.com/9.png');">
                        <div class="baner-tittle">
                            <h3 class="text-center" style="font-family: 'Cairo', sans-serif;color:#57371c"> د. چيرمين
                                ألفريد</h3>
                        </div>
                        <div class="baner-content">
                            <p class="text-center" style="color:#57371c">
                                إستشاري طب الأطفال وحديثي الولادة
                                <br>
                                ماچيستير طب الأطفال - جامعة القاهرة

                                <br>
                                مستشفي مركز الحياة الطبي - الكوربة
                                <br>
                                عضو الجمعية المصرية لرعاية حديثي الولادة والمبتسرين
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div id="main-content" class="site-main clearfix">
                <div id="content-wrap">
                    <div id="site-content" class="site-content clearfix">
                        <div id="inner-content" class="inner-content-wrap">
                            <div class="page-content">


                                <section class="contact my-5" style="margin-bottom: 0 !important">
                                    <div class="container">



                                        <div class="row">
                                            <div class="col-12">
                                                <div class="box-contact-top">


                                                    <div class="box-icon-contact d-flex">

                                                        <div class="fl-icon-box wow fadeInDown">
                                                            <div class="themesflat-spacer clearfix" data-desktop="90"
                                                                data-mobile="30" data-smobile="30"></div>
                                                            <div class="icon-wrap">
                                                                <i style="backgroung-color:#4ec0e7;"
                                                                    class="fas fa-map"></i>
                                                            </div>
                                                            <div class="themesflat-spacer clearfix" data-desktop="35"
                                                                data-mobile="30" data-smobile="30"></div>
                                                            <h4 class="text-color-title-sidebar"
                                                                style="font-family: 'Cairo', sans-serif;"> العنوان</h4>
                                                            <div class="themesflat-spacer clearfix" data-desktop="8"
                                                                data-mobile="8" data-smobile="8"></div>
                                                            <ul>
                                                                <li class="sub-box">
                                                                    ١١ ش جلال حجاج متفرع من أحمد تيسير ، كلية البنات -
                                                                    مصر الجديدة ، القاهرة مصر
                                                                </li>
                                                            </ul>
                                                            <div class="themesflat-spacer clearfix" data-desktop="85"
                                                                data-mobile="85" data-smobile="0"></div>
                                                        </div>

                                                        <div class="fl-icon-box wow fadeInDown">
                                                            <div class="themesflat-spacer clearfix" data-desktop="90"
                                                                data-mobile="30" data-smobile="30"></div>
                                                            <div class="icon-wrap">
                                                                <i style="backgroung-color:#4ec0e7;"
                                                                    class="fas fa-phone"></i>
                                                            </div>
                                                            <div class="themesflat-spacer clearfix" data-desktop="35"
                                                                data-mobile="30" data-smobile="30"></div>
                                                            <h4 class="text-color-title-sidebar"
                                                                style="font-family: 'Cairo', sans-serif;"> رقم التليفون
                                                            </h4>
                                                            <div class="themesflat-spacer clearfix" data-desktop="8"
                                                                data-mobile="8" data-smobile="8"></div>
                                                            <ul>
                                                                <li class="sub-box">
                                                                    العيادة : 24198224
                                                                </li>
                                                                <li class="sub-box">
                                                                    الموبيل : 01207721212
                                                                </li>
                                                            </ul>
                                                            <div class="themesflat-spacer clearfix" data-desktop="85"
                                                                data-mobile="85" data-smobile="0"></div>
                                                        </div>

                                                        <div class="fl-icon-box wow fadeInDown">
                                                            <div class="themesflat-spacer clearfix" data-desktop="90"
                                                                data-mobile="30" data-smobile="30"></div>
                                                            <div class="icon-wrap">
                                                                <i style="backgroung-color:#4ec0e7;"
                                                                    class="fas fa-envelope"></i>
                                                            </div>
                                                            <div class="themesflat-spacer clearfix" data-desktop="35"
                                                                data-mobile="30" data-smobile="30"></div>
                                                            <h4 class="text-color-title-sidebar"
                                                                style="font-family: 'Cairo', sans-serif;">البريد الإلكتروني</h4>
                                                            <div class="themesflat-spacer clearfix" data-desktop="8"
                                                                data-mobile="8" data-smobile="8"></div>
                                                            <ul>
                                                                <li class="sub-box">
                                                                    <a
                                                                        href="mailto:germainemakar@hotmail.com">germainemakar@hotmail.com</a>
                                                                </li>

                                                            </ul>
                                                            <div class="themesflat-spacer clearfix" data-desktop="85"
                                                                data-mobile="85" data-smobile="85"></div>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="themesflat-spacer clearfix" data-desktop="280" data-mobile="280"
                                                data-smobile="280"></div>
                                        </div>

                                    </div>
                                </section>
                                <section class="contact ">
                                    <div class="container">


                                        <div class="row">
                                            <div class="themesflat-spacer clearfix" data-desktop="120" data-mobile="0"
                                                data-smobile="0"></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="box-contact-top">



                                                    <div class="box-wrap-contact ">

                                                        <div class="themesflat-spacer clearfix" data-desktop="12"
                                                            data-mobile="12" data-smobile="12"></div>
                                                        <div class="title-heading text-color-title-sidebar"
                                                            style="font-family: 'Cairo', sans-serif; text-align:right; font-size:20px !important; ">
                                                            صور المركز
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                </section>
                                <section class="fl-row intro-middle ">
                                    <div class="container">

                                        <div class="owl-carousel owl-theme">

                                            <div class="item">
                                                <div class="box-item">
                                                    <div class="img">
                                                        <img src="https://germainealfred.com/01.jpeg" alt="image" class="rounded"
                                                            style="bject-fit:cover;">
                                                    </div>

                                                </div>
                                                <div class="themesflat-spacer clearfix" data-desktop="25"
                                                    data-mobile="8" data-smobile="8"></div>
                                            </div>
                                            <div class="item">
                                                <div class="box-item">
                                                    <div class="img">
                                                        <img src="https://germainealfred.com/03.jpeg" alt="image" class="rounded"
                                                            style="bject-fit:cover;">
                                                    </div>

                                                </div>
                                                <div class="themesflat-spacer clearfix" data-desktop="25"
                                                    data-mobile="8" data-smobile="8"></div>
                                            </div>

                                            <div class="item">
                                                <div class="box-item">
                                                    <div class="img">
                                                        <img src="https://germainealfred.com/04.jpeg" alt="image" class="rounded"
                                                            style="bject-fit:cover;">
                                                    </div>

                                                </div>
                                                <div class="themesflat-spacer clearfix" data-desktop="25"
                                                    data-mobile="8" data-smobile="8"></div>
                                            </div>

                                            <div class="item">
                                                <div class="box-item">
                                                    <div class="img">
                                                        <img src="https://germainealfred.com/05.jpeg" alt="image" class="rounded"
                                                            style="bject-fit:cover;">
                                                    </div>

                                                </div>
                                                <div class="themesflat-spacer clearfix" data-desktop="25"
                                                    data-mobile="8" data-smobile="8"></div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <section class="contact ">
                                    <div class="container">


                                        <div class="row">
                                            <div class="themesflat-spacer clearfix" data-desktop="120" data-mobile="0"
                                                data-smobile="0"></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="box-contact-top">



                                                    <div class="box-wrap-contact ">

                                                        <div class="themesflat-spacer clearfix" data-desktop="12"
                                                            data-mobile="12" data-smobile="12"></div>
                                                        <div class="title-heading text-color-title-sidebar"
                                                            style="font-family: 'Cairo', sans-serif; text-align:right; font-size:20px !important;">
                                                            صور اخرى
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                </section>
                                <section class="fl-row intro-middle ">
                                    <div class="container">

                                        <div class="owl-carousel owl-theme">

                                            <div class="item">
                                                <div class="box-item">
                                                    <div class="img">
                                                        <img src="https://germainealfred.com/06.jpeg" alt="image" class="rounded"
                                                            style="bject-fit:cover;">
                                                    </div>

                                                </div>
                                                <div class="themesflat-spacer clearfix" data-desktop="25"
                                                    data-mobile="8" data-smobile="8"></div>
                                            </div>
                                            <div class="item">
                                                <div class="box-item">
                                                    <div class="img">
                                                        <img src="https://germainealfred.com/07.jpeg" alt="image" class="rounded"
                                                            style="bject-fit:cover;">
                                                    </div>

                                                </div>
                                                <div class="themesflat-spacer clearfix" data-desktop="25"
                                                    data-mobile="8" data-smobile="8"></div>
                                            </div>

                                            <div class="item">
                                                <div class="box-item">
                                                    <div class="img">
                                                        <img src="https://germainealfred.com/08.jpeg" alt="image" class="rounded"
                                                            style="bject-fit:cover;">
                                                    </div>

                                                </div>
                                                <div class="themesflat-spacer clearfix" data-desktop="25"
                                                    data-mobile="8" data-smobile="8"></div>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <section class="contact-bot">
                                    <div class="">

                                        <div class=" mt-3" style="margin-bottom: 0px !important">
                                            <div class="">
                                                <div class="box-contact-top">



                                                    <div class="box-wrap-contact ">

                                                        <div class="themesflat-spacer clearfix" data-desktop="12"
                                                            data-mobile="12" data-smobile="12"></div>
                                                        <div class="title-heading text-color-title-sidebar text-center"
                                                            style="font-family: 'Cairo', sans-serif; text-align:right; font-size:20px !important;">
                                                            خريطة الوصول
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="">
                                            <div class="">
                                                <div class="box-map-contact wow fadeInDown  map-google">
                                                    <iframe
                                                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13809.781915239066!2d31.3259731!3d30.0814256!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x9b722e06f1b70239!2z2LnZitin2K_YqSDYr9mD2KrZiNix2Ycg2KzZitix2YXZitmGINij2YTZgdix2YrYryDYt9io2YrYqNipINij2LfZgdin2YQ!5e0!3m2!1sar!2seg!4v1645286530096!5m2!1sar!2seg"
                                                        width="1200" height="450" style="border:0;" allowfullscreen=""
                                                        loading="lazy"></iframe>
                                                </div>
                                            </div>



                                        </div>

                                        <div class="row">
                                            <div class="themesflat-spacer clearfix" data-desktop="235" data-mobile="200"
                                                data-smobile="100"></div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                            <!--.page-content-->
                        </div>
                        <!--#inner-content-->
                    </div>
                    <!--site-content-->
                </div>
                <!--#content-wrap-->
            </div>
            <!--#main-content-->


            <footer id="footer">
                <div class="container footer-space-container">
                    <div class="row">
                        <div class="col-12 w-100 text-center mobile-links">
                            <div class="box-sr w-100 text-center">
                                <div class="text-subscribe w-100 text-center ">
                                    <div class="themesflat-spacer clearfix" data-desktop="60" data-mobile="60"
                                        data-smobile="20"></div>
                                    <h1 class="text-color-white text-center" style="font-family: 'Cairo', sans-serif;">
                                        للحجز ومتابعة الفحوصات <br> ! حمل
                                        التطبيق الان
                                    </h1>
                                    <br>
                                    <div class="w-100 d-flex justify-content-center ">
                                        <a href="https://play.google.com/store/apps/details?id=com.promina.drgermeen"
                                            target="_blank" class="mx-2"><span><img src="https://germainealfred.com/Google-Web.png"
                                                    width="150" height="100"> </span></a>
                                        <a href="https://apps.apple.com/app/id1633419065" class="d-block mr-5" target="_blank"><span><img
                                                    src="https://germainealfred.com/Apple-Web.png" width="150"
                                                    height="100" ></span></a>

                                    </div>
                                    <div class="themesflat-spacer clearfix" data-desktop="58" data-mobile="58"
                                        data-smobile="0"></div>
                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="themesflat-spacer clearfix" data-desktop="95" data-mobile="95" data-smobile="25">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="box-list-footer">


                                <div class="box-list box-useful w-50">
                                    <div class="title-footer text-color-white"><a>Dr. Germaine Alfred</a></div>
                                    <ul class="one-half first">
                                        <li><a title=""><span><i style="backgroung-color:#4ec0e7;"
                                                        class="fa fa-square"></i></span>Pediatrician & Neonatologist</a>
                                        </li>
                                        <li><a title=""><span><i style="backgroung-color:#4ec0e7;"
                                                        class="fa fa-square"></i></span>M.B.ch., M.sc., Cairo
                                                University</a></li>
                                        <li><a title=""><span><i style="backgroung-color:#4ec0e7;"
                                                        class="fa fa-square"></i></span>Hayat Medical Center - El
                                                Korba</a></li>
                                        <li><a title=""><span><i style="backgroung-color:#4ec0e7;"
                                                        class="fa fa-square"></i></span>Member of the Egyptian Society
                                                for Neonatal and Preterm care (ESNPC)</a></li>
                                                <li>


                                                    <a target="_blank"
                                                        href="https://www.facebook.com/DrGermaine-Alfred-%D8%AF-%D8%AC%D9%8A%D8%B1%D9%85%D9%8A%D9%86-%D8%A7%D9%84%D9%81%D8%B1%D9%8A%D8%AF-112341868016280"
                                                        title=""><i style="backgroung-color:#4ec0e7;font-size:20px"
                                                            class="fab fa-facebook-f"></i></a>
                                                    <a target="_blank"
                                                        href="https://www.youtube.com/channel/UC7XBT0XoM9eMDVKUuq-ygxw" title=""
                                                        class="mx-3"><i style="backgroung-color:#4ec0e7;font-size:20px"
                                                            class="fab fa-youtube"></i></a>
                                                    <a target="_blank" href="https://www.instagram.com/drgermainealfred.clinic"
                                                        title=""><i style="backgroung-color:#4ec0e7;font-size:20px"
                                                            class="fab fa-instagram"></i></a>


                                                </li>
                                    </ul><!-- /.one-half -->
                                </div><!-- /.widget-services -->


                                <div class="box-list box-contact w-50">
                                    <div class="title-footer text-color-white">Contact Us</div>
                                    <ul class="one-half first">
                                        <li>
                                            <span><i style="backgroung-color:#4ec0e7;"
                                                    class="fas fa-map-marker-alt flat-icon-footer "></i></span>
                                            <span>Clinic : 11 Gala Hagag St. From Ahmed Tayseer St., Girls College -
                                                Heliopolis - Cairo, Egypt<br>Hospital : Hayat Medical Center - El Korba
                                            </span>



                                        </li>
                                        <li>
                                            <span><i style="backgroung-color:#4ec0e7;"
                                                    class="fa fa-phone-alt flat-icon-footer"></i></span>
                                            <span><a> (202)24198224 - 01207721212</a></span>
                                        </li>
                                        <li>
                                            <span><i style="backgroung-color:#4ec0e7;"
                                                    class="fas fa-envelope flat-icon-footer"></i></span>
                                            <span><a
                                                    href="mailto:germainemakar@hotmail.com">germainemakar@hotmail.com</a></span>
                                            <br>


                                        </li>
                                    </ul><!-- /.one-half -->
                                </div><!-- /.widget-services -->

                            </div><!-- /widget-box -->
                        </div>
                    </div>
                    <div class="row footer-space">
                        <div class="themesflat-spacer clearfix" data-desktop="95" data-mobile="50" data-smobile="40">
                        </div>
                    </div>
                </div>
                <div class="footer-bottom">
                    <div class="container">
                        <div class="row">

                            <h3 class="copyright w-100 text-center"
                                style="color:#4ec0e7;margin-bottom:5px;margin-top:1px; font-size:12px;">Copyright 2022
                                <i style="backgroung-color:#4ec0e7;" class="far fa-copyright"></i> <a
                                    href="https://prominaagency.com/" target="_blank"> <img src="https://germainealfred.com/Icon2.png"
                                        style="display: inline-block;width: 20px;margin: 0 5px; ">ProMina Agency</a> All Rights Reserved
                            </h3>
                        </div>
                    </div>
                </div>
                <!--/.footer-bottom-->
            </footer>

            <div class="button-go-top">
                <a href="#" title="" class="go-top">
                    <i style="backgroung-color:#4ec0e7;" class="fa fa-chevron-up"></i>
                </a>
            </div>

        </div>
        <!--#page-->
    </div>
    <!--#wrapper-->
    <!-- Javascript -->
    <script type="text/javascript" src="https://germainealfred.com/assets-landing/javascript/jquery.min.js"></script>
    <script type="text/javascript" src="https://germainealfred.com/assets-landing/javascript/jquery-validate.js"></script>
    <script type="text/javascript" src="https://germainealfred.com/assets-landing/javascript/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://germainealfred.com/assets-landing/javascript/jquery.easing.js"></script>
    <!--animation-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://germainealfred.com/assets-landing/animation/wow.min.js"></script>
    <script src="https://germainealfred.com/assets-landing/javascript/animation.js"></script>
    <script type="text/javascript" src="https://germainealfred.com/assets-landing/javascript/main.js"></script>
    <script>
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: false,
            responsive: {
                0: {
                    stagePadding: 0,
                    loop: true,
                    responsiveClass: true,
                    dots: false,
                    nav: false,
                    autoHeight: true,
                    items: 1,
                    rtl: true
                },
                // breakpoint from 768 up
                768: {
                    items: 3
                },
                // breakpoint from 992 up
                992: {
                    items: 4
                },
                // breakpoint from 1200 up
                1200: {
                    items: 2
                }
            }
        })

    </script>
</body>

</html>
