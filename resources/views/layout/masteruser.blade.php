<!DOCTYPE html>
<html>
<head>
@yield('header')
<link href="{{asset('user_aset/css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all" />
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{asset('user_aset/js/jquery.min.js')}}"></script>
<!-- Custom Theme files -->
<!--theme-style-->
<link href="{{asset('user_aset/css/style.css')}}" rel="stylesheet" type="text/css" media="all" />  
<!--//theme-style-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Markito Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
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
 @yield('csspage')
</head>
<body> 
<!--header-->   
<div class="header" >
    <div class="top-header" >       
        <div class="container">
        <div class="top-head" >
            <div class="header-para">
                <ul class="social-in">
                    <li><a href="#"><i> </i></a></li>                       
                    <li><a href="#"><i class="ic"> </i></a></li>
                    <li><a href="#"><i class="ic1"> </i></a></li>
                    
                </ul>           
            </div>  
            
            <ul class="header-in">
                <li ><a href="products.html" >  brands</a></li>
                <li><a href="404.html">about us</a> </li>
                <li><a href="contact.html">   contact us</a></li>
                <li ><a href="#" >   how to use</a></li>
            </ul>
            <div class="search-top">
                <div class="search">
                    <form>
                        <input type="text" value="Cari Barang Berdasarkan Nama" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Cari Barang Berdasarkan Nama';}" >
                        <input type="submit" value="" >
                    </form>
                </div>
                
                <div class="clearfix"> </div>
            </div>
                <div class="clearfix"> </div>
        </div>
        </div>
    </div>
    <div class="header-top">
        <div class="container">
        <div class="head-top">
            <div class="logo">
                <a href="index.html"><img src="images/logo.png" alt="" ></a>
            </div>
        <div class="top-nav text-center">       
              <ul class="megamenu skyblue">
                  <li class="grid">
                    <a href="health.html">Home</a>
                </li>
                <li class="grid">
                    <a href="health.html">Semua Produk</a>
                </li> 
                <li class="grid">
                    <a href="health.html">Artikel</a>
                </li>
                <li class="grid">
                    <a href="health.html">Testimoni</a>
                </li>
                <li class="grid">
                    <a href="health.html">Hubungi Kami</a>
                </li>         
                <!-- <li><a  href="#">tvs, gaming & cameras</a>
                  <div class="megapanel">
                        <div class="row">
                            <div class="col1">
                                <div class="h_nav">
                                    <ul>
                                        <li><a href="mobile.html">Lenovo Tablets</a></li>
                                        <li><a href="mobile.html">Motorola</a></li>
                                        <li><a href="mobile.html">Samsung </a></li>
                                        <li><a href="mobile.html">Htc Tab</a></li>
                                        <li><a href="mobile.html">Dell & Compaq</a></li>
                                        <li><a href="mobile.html">Asus Tablets</a></li>
                                        <li><a href="mobile.html">Microsoft</a></li>
                                        <li><a href="mobile.html">Moto E & Moto G</a></li>
                                        <li><a href="mobile.html">Intex</a></li>
                                        <li><a href="mobile.html">Hauwei Lumia</a></li>
                                        <li><a href="mobile.html">Loungewear</a></li>
                                    </ul>   
                                </div>                          
                            </div>
                            <div class="col1">
                                <div class="h_nav">
                                    <ul>
                                        <li><a href="mobile.html">Asus Zenfone 2</a></li>
                                        <li><a href="mobile.html">Nikon & Sony</a></li>
                                        <li><a href="mobile.html">Shorts</a></li>
                                        <li><a href="mobile.html">Olymplus</a></li>
                                        <li><a href="mobile.html">Sunglasses</a></li>
                                        <li><a href="mobile.html">Samsung Nx</a></li>
                                        <li><a href="mobile.html">Printers & Monitors</a></li>
                                        <li><a href="mobile.html">Routers</a></li>
                                        <li><a href="mobile.html">Data Cards</a></li>
                                        <li><a href="mobile.html">Mouse & Keyboard</a></li>
                                        <li><a href="mobile.html">Ink Cartridges</a></li>
                                    </ul>   
                                </div>                          
                            </div>
                          </div>
                        </div></li> -->
            
                
              </ul> 
                </div>
                    
        
                <div class="clearfix"> </div>
        </div>
        </div>
    </div>
</div>
        @yield('content')
    <div class="bottom-content">
    
            <div class="col-md-4">
                <img src="images/ad1.png" class="img-responsive" alt="">
            </div>
            <div class="col-md-4">
                <img src="images/ad1.png" class="img-responsive" alt="">
            </div>
            <div class="col-md-4">
                <img src="images/ad1.png" class="img-responsive" alt="">
            </div>
            <div class="clearfix"> </div>
        </div>
    
    </div>
</div>
    <!--footer-->
    <div class="footer">
        <div class="container">
            <div class="col-md-12 text-center">
                <a href="index.html"><img src="images/logo.png" alt=""></a>
                <p class="footer-class">© 2015 Markito All Rights Reserved | Template by  <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>
            </div>
            
            
            <div class="clearfix"> </div>
        </div>
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


