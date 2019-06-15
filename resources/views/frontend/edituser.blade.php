<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @foreach($websettings as $webset)
    <title>{{$webset->webName}}</title>
    
    <link rel="shortcut icon" type="image" href="{{asset('img/setting/'.$webset->ico)}}">
    @endforeach
    
    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>
    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{asset('user_aset/css/bootstrap.min.css')}}">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('user_aset/css/font-awesome.min.css')}}">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('user_aset/css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('user_aset/style.css')}}">
    <link rel="stylesheet" href="{{asset('user_aset/css/responsive.css')}}">

  </head>
  <body>
   <style>
        input[type="submit"], button[type=submit] {
    background: none repeat scroll 0 0 #5a88ca;
    border: medium none;
    color: #fff;
    padding: 11px 20px;
    text-transform: uppercase;
}
input[type="submit"]:hover, button[type=submit]:hover {background-color: #222}
.single-sidebar input[type="text"] {
    margin-bottom: 10px;
    width: 100%;
}
    </style>
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
                                    <li><a href="#">Edit Profile</a></li>
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
                    
     @foreach($websettings as $webset)
     <h1><a href="{{url('/')}}"><img src="{{asset('img/setting/'.$webset->logo)}}"></a></h1>
    @endforeach
                    </div>
                </div>
                
                <div class="col-sm-6">
                  @if(Session::get('user_name'))
    @if($totalkeranjang > 0)
    <div class="shopping-item">
        <a href="{{url('/keranjang')}}">Keranjang - 
            <span class="cart-amunt">
            @foreach($totalbayar as $tb)
            {{"Rp ". number_format($tb->newtotal,0,',','.')}}
            @endforeach
            </span> 
        <i class="fa fa-shopping-cart"></i> 
            @if($totalkeranjang>0)
            <span class="product-count">{{$totalkeranjang}}</span>
            @endif
        </a>
    </div>
    @endif
    @endif
                </div>
            </div>
        </div>
    </div> <!-- End site branding area -->
    
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
                    <ul class="nav navbar-nav">
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li><a href="{{url('/semuaproduk')}}">Semua Produk</a></li>
                        <li><a href="{{url('/hubungikami')}}">Hubungi Kami</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#exampleModal">Peraturan Belanja</a></li>

                    </ul>
                </div>  
            </div>
        </div>
    </div> <!-- End mainmenu area -->
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Edit Profile User</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                
                
                <div class="col-md-12">
                     @if (session('status'))
                    <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ session('status') }}
                    </div>
                    @elseif(session('statuserror'))
                    <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ session('statuserror') }}
                    </div>
                    @endif
                    <div class="product-content-right">
                        <div class="woocommerce">
                            @foreach($users as $user)
                            <form id="login-form-wrap" class="login" method="post" action="{{url('/editprofileuser')}}" enctype="multipart/form-data">
                            <p>Edit data diri dengan valid dan dapat di pertanggung jawabkan.</p>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p class="form-row form-row-first">
                                    <label>Nama
                                    </label>
                                    <input type="text" name="nama" class="form-control" style="width: 100%" value="{{$user->nama }}" required>
                                     @if($errors->has('nama'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('nama')}}
                                         </div>
                                        @endif
                                </p>
                                
                                <p class="form-row form-row-first">
                                    <label>Email
                                    </label>
                                    <input type="email" name="email" class="form-control" style="width: 100%" value="{{$user->email}}" required>
                                      @if($errors->has('email'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('email')}}
                                         </div>
                                        @endif
                                </p>
                                 <p class="form-row form-row-first">
                                    <label>No Telfon
                                    </label>
                                    <input type="text" name="no_telfon" class="form-control" style="width: 100%" value="{{$user->telp}}" required>
                                  @if($errors->has('no_telfon'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('no_telfon')}}
                                         </div>
                                        @endif
                                </p>
                                <p class="form-row form-row-first">
                                    <label>Alamat
                                    </label>
                                    <input type="text" name="alamat" class="form-control" style="width: 100%" value="{{$user->alamat}}" required>
                                      @if($errors->has('alamat'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('alamat')}}
                                         </div>
                                        @endif
                                </p>
                                    </div>
                                    <div class="col-sm-6">
                                         <p class="form-row form-row-first">
                                    <label>Kota
                                    </label>
                                    <input type="text" name="kota" class="form-control" style="width: 100%" value="{{ $user->kota}}" required>
                                      @if($errors->has('kota'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('kota')}}
                                         </div>
                                        @endif
                                </p>
                                <p class="form-row form-row-first">
                                    <label>Provinsi
                                    </label>
                                   <select class="form-control"name="provinsi">
                                        <option value="aceh" @if($user->provinsi=="aceh")selected @endif>Aceh</option>

                                        <option value="sumatera utara" @if($user->provinsi=="sumatera utara")selected @endif>Sumatera Utara</option>

                                        <option value="sumatera barat" @if($user->provinsi=="sumatera barat")selected @endif>Sumatera Barat</option>

                                        <option value="riau" @if($user->provinsi=="riau")selected @endif>Riau</option>

                                        <option value="kepuluan riau" @if($user->provinsi=="kepuluan riau")selected @endif>Kepulauan Riau</option>

                                        <option value="jambi" @if($user->provinsi=="jambi")selected @endif>Jambi</option>

                                        <option value="sumatera selatan" @if($user->provinsi=="sumatera selatan")selected @endif>Sumatera Selatan</option>

                                        <option value="bangka belitung" @if($user->provinsi=="bangka belitung")selected @endif>Bangka Belitung</option>

                                        <option value="bengkulu" @if($user->provinsi=="bengkulu")selected @endif>Bengkulu</option>

                                        <option value="lampung" @if($user->provinsi=="lampung")selected @endif>Lampung</option>

                                        <option value="jakarta" @if($user->provinsi=="jakarta")selected @endif>DKI Jakarta</option>

                                        <option value="jawa barat" @if($user->provinsi=="jawa barat")selected @endif>Jawa Barat</option>

                                        <option value="banten" @if($user->provinsi=="banten")selected @endif>Banten</option>

                                        <option value="jawa tengah" @if($user->provinsi=="jawa tengah")selected @endif>Jawa Tengah</option>

                                        <option value="yogyakarta" @if($user->provinsi=="yogyakarta")selected @endif>Yogyakarta</option>

                                        <option value="jawa timur" @if($user->provinsi=="jawa timur")selected @endif>Jawa Timur</option>

                                        <option value="bali" @if($user->provinsi=="bali")selected @endif>Bali</option>

                                        <option value="NTB" @if($user->provinsi=="NTB")selected @endif>NTB</option>

                                        <option value="NTT" @if($user->provinsi=="NTT")selected @endif>NTT</option>

                                        <option value="kalimantan utara" @if($user->provinsi=="kalimantan utara")selected @endif>Kalimantan Utara</option>

                                        <option value="kalimantan barat" @if($user->provinsi=="kalimantan barat")selected @endif>Kalimantan Barat</option>

                                        <option value="kalimantan tengah" @if($user->provinsi=="kalimantan tengah")selected @endif>Kalimantan Tengah</option>

                                        <option value="kalimantan selatan" @if($user->provinsi=="kalimantan selatan")selected @endif>Kalimantan Selatan</option>

                                        <option value="kalimantan timur" @if($user->provinsi=="kalimantan timur")selected @endif>Kalimantan Timur</option>

                                        <option value="sulawesi utara" @if($user->provinsi=="sulawesi utara")selected @endif>Sulawesi Utara</option>

                                        <option value="sulawesi barat" @if($user->provinsi=="sulawesi barat")selected @endif>Sulawesi Barat</option>

                                        <option value="sulawesi tengah" @if($user->provinsi=="sulawesi tengah")selected @endif>Sulawesi Tengah</option>

                                        <option value="sulawesi tenggara" @if($user->provinsi=="sulawesi tenggara")selected @endif>Sulawesi Tenggara</option>

                                        <option value="sulawesi selatan" @if($user->provinsi=="sulawesi selatan")selected @endif>Sulawesi Selatan</option>

                                        <option value="gorontalo" @if($user->provinsi=="gorontalo")selected @endif>Gorontalo</option>

                                        <option value="maluku"  @if($user->provinsi=="maluku")selected @endif>Maluku</option>

                                        <option value="maluku utara" @if($user->provinsi=="maluku utara")selected @endif>Maluku Utara</option>

                                        <option value="papua barat" @if($user->provinsi=="papua barat")selected @endif>Papua Barat</option>

                                        <option value="papua" @if($user->provinsi=="papua")selected @endif>Papua</option>
                                            </select>
                                              @if($errors->has('provinsi'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('provinsi')}}
                                         </div>
                                        @endif
                                </p>
                                <p class="form-row form-row-first">
                                    <label>Kode Pos
                                    </label>
                                    <input type="text" name="kode_pos" class="form-control" style="width: 100%" value="{{ $user->kodepos}}" required>
                                      @if($errors->has('kode_pos'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('kode_pos')}}
                                         </div>
                                        @endif
                                </p>
                                <p class="form-row form-row-first">
                                    <img src="{{asset('img/user/'.$user->ktp_gmb)}}" style="width: 30%;">
                                    <label>Ganti Foto
                                    </label>
                                    <input type="file" name="gambar_ktp">
                                     @if($errors->has('gambar_ktp'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('gambar_ktp')}}
                                         </div>
                                        @endif
                                </p>
                                <p class="form-row pull-right">
                                    {{csrf_field()}}
                                    <input type="submit" value="Simpan" class="button">
                                    <button type="button" class="tombol-merah" onclick="window.history.go(-1);" > kembali</button>
                                </p>
                                    </div>
                                </div>
                                
                                

                                <div class="clear"></div>
                            </form>
                            @endforeach
                        </div>                       
                    </div>                    
                </div>
            </div>
        </div>
    </div>

    

 <div class="footer-bottom-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="copyright">
                        <p>&copy; 2018 <a class="llink">TASTORE</a>. All Rights Reserved. <a href="#" target="_blank">Joyoboyo Intermedia</a></p>
                    </div>
                </div>
                
               
            </div>
        </div>
    </div>
   <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Peraturan Belanja</h5>
      </div>
      <div class="modal-body">
        @foreach($websettings as $webset)
            {!! $webset->peraturan !!}
    
        @endforeach
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
    
  </body>
</html>