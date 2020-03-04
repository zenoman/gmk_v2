<!DOCTYPE html>
<html>
<head>
@yield('header')
<link href="{{asset('user_aset/css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all" />
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{asset('user_aset/js/jquery.min.js')}}"></script>
<!-- Custom Theme files -->
<!--theme-style-->
<link href="{{asset('assets/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('user_aset/css/style.css')}}" rel="stylesheet" type="text/css" media="all" />  
<!--//theme-style-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="grosir, online shop, kemeja, kaos, 
baju, jaket, parka, kediri, kota kediri, kab kediri,gmk,grosir murah kediri,grosir murah" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

<script type="text/javascript" src="{{asset('user_aset/js/move-top.js')}}"></script>
<script type="text/javascript" src="{{asset('user_aset/js/easing.js')}}"></script>
<script type="text/javascript">
                    jQuery(document).ready(function($) {
                        $(".scroll").click(function(event){     
                            event.preventDefault();
                            $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
                        });
                    });
                </script>
<!-- start menu -->
<link href="{{asset('user_aset/css/megamenu.css')}}" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="{{asset('user_aset/js/megamenu.js')}}"></script>
<script>$(document).ready(function(){$(".megamenu").megamenu();});</script>
<script src="{{asset('user_aset/js/simpleCart.min.js')}}"> </script>
</head>
<body> 
<!--header-->   
<div class="header" >
    <div class="top-header">       
        <div class="container">
        <div class="top-head text-center">
            <a href="https://www.facebook.com/grosir.murah.kediri.07/" target="blank"><span class="fa fa-facebook fa-lg" style="color:white;"> </span></a>&nbsp;&nbsp;
            <a href="https://www.instagram.com/grosir.murah.kediri/" target="blank()"><span class="fa fa-instagram fa-lg" style="color:white;"> </span></a>
             
        </div>
        </div>
    </div>
    <div class="header-top">
        <div class="container">
        <div class="head-top">
            <div class="logo">
                @yield('logo')
            </div>
        <div class="top-nav text-center">       
              <ul class="megamenu skyblue">
                  <li class="grid">
                    <a href="{{url('/')}}">Home</a>
                </li>
                <li class="grid">
                    <a href="{{url('/semuaproduk')}}">Semua Produk</a>
                </li> 
                <li class="grid">
                    <a href="{{url('/list-artikel')}}">Artikel</a>
                </li>
                <li class="grid">
                    <a href="{{url('/list-testimoni')}}">Testimoni</a>
                </li>
                <li class="grid">
                    <a href="{{url('/cara-belanja')}}">Cara Belanja</a>

                </li>
                <li class="grid">
                    <a href="{{url('/hubungikami')}}">Hubungi Kami</a>
                </li>         
                <li class="grid">
                    <a href="{{url('/privacy-policy')}}">Privacy Policy</a>
                </li>
              </ul> 
                </div>
                    
        
                <div class="clearfix"> </div>
        </div>
        </div>
    </div>
</div>
        @yield('content')
   
    
    </div>
</div>
    <!--footer-->
    <div class="footer">
        <!-- <div class="container">
            <div class="col-md-12 text-center">
                <a href="index.html"><img src="images/logo.png" alt=""></a>
                <p class="footer-class">© 2015 Markito All Rights Reserved | Template by  <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>
            </div>
            
            
            <div class="clearfix"> </div>
        </div> -->
        <script type="text/javascript">
                        $(document).ready(function() {
                            /*
                            var defaults = {
                                containerID: 'toTop', // fading element id
                                containerHoverID: 'toTopHover', // fading element hover id
                                scrollSpeed: 1200,
                                easingType: 'linear' 
                            };
                            */
                            
                            $().UItoTop({ easingType: 'easeOutQuart' });
                            
                        });
                    </script>
                <a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>

    </div>

</body>
</html>


