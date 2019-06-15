<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
    @yield('header')
    
    <link rel="stylesheet" href="{{asset('user_aset/css/bootstrap.min.css')}}">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('user_aset/css/font-awesome.min.css')}}">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('user_aset/css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('user_aset/style.css')}}">
    <link rel="stylesheet" href="{{asset('user_aset/css/responsive.css')}}">
    @yield('csspage')
  </head>
  <body>
   
    <div class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="user-menu">
                        <ul>
                            @if(!Session::get('user_name'))
                            <li><a href="{{url('/loginUser')}}" class="link-merah"><i class="fa fa-user"></i> Login</a></li>
                            @else
                            <li><a href="{{url('/keranjang')}}" class="link-merah"><i class="fa fa-shopping-cart"></i>Keranjang Saya</a></li>
                             <li><a href="{{url('/transaksisaya')}}" class="link-merah"><i class="fa fa-file"></i>Transaksi Saya</a></li>
                            <li><a href="{{url('/transaksigagal')}}" class="link-merah"><i class="fa fa-trash"></i>Transaksi Gagal</a></li>
                            @endif
                           
                        </ul>
                    </div>
                </div>
                
                <div class="col-md-4">
                    @if(Session::get('user_name'))
                    <div class="header-right">
                        <ul class="list-unstyled list-inline">
                            <li class="dropdown dropdown-small">
                                <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle link-merah" href="#"><span class="key">{{Session::get('user_name')}}</span><b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{url('/editprofileuser')}}">Edit Profile</a></li>
                                    <li><a href="{{url('/login/logoutuser')}}">Logout</a></li>
                                </ul>
                            </li>

                        </ul>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div> <!-- End header area -->
    
    <div class="site-branding-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="logo">
                        @yield('logo')
                       
                    </div>
                </div>
                
                <div class="col-sm-6">
                    @yield('cart')
                </div>
            </div>
        </div>
    </div>
    
    <div class="mainmenu-area">
        <div class="container">
            <div class="row">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div> 
                <div class="navbar-collapse collapse">
                    @yield('navigation')
                </div>  
            </div>
        </div>
    </div>

   @yield('content')
    
    <div class="footer-bottom-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="copyright">
                        <p>&copy; 2018 <a class="llink">TASTORE</a>. All Rights Reserved. <a href="#">Joyoboyo Intermedia</a></p>
                    </div>
                </div>
                
               
            </div>
        </div>
    </div>
   
    <!-- Latest jQuery form server -->
    <script src="{{asset('user_aset/js/jquery.min.js')}}"></script>
    
    <!-- Bootstrap JS form CDN -->
    <script src="{{asset('user_aset/js/bootstrap.min.js')}}"></script>
    
    <!-- jQuery sticky menu -->
    <script src="{{asset('user_aset/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('user_aset/js/jquery.sticky.js')}}"></script>
    
    <!-- jQuery easing -->
    <script src="{{asset('user_aset/js/jquery.easing.1.3.min.js')}}"></script>
    
    <!-- Main Script -->
    <script src="{{asset('user_aset/js/main.js')}}"></script>
    
    <!-- Slider -->
    <script type="text/javascript" src="{{asset('user_aset/js/bxslider.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('user_aset/js/script.slider.js')}}"></script>
    @yield('jspage')
  </body>
</html>