<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login User</title>
    
    @foreach($websettings as $webset)
    <link rel="shortcut icon" type="image" href="{{asset('img/setting/'.$webset->ico)}}">
    @endforeach
    
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{asset('user_aset/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('user_aset/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('user_aset/css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('user_aset/style.css')}}">
    <link rel="stylesheet" href="{{asset('user_aset/css/responsive.css')}}">

  </head>
  <body>
   <script type="text/javascript">
function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
  </script>
    <style>
        input[type="submit"], button[type=submit] {
    background: none repeat scroll 0 0 #5a88ca;
    border: medium none;
    color: #fff;
    padding: 11px 20px;
    text-transform: uppercase;
}
    </style>
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
                  
                </div>
            </div>
        </div>
    </div> <!-- End site branding area -->
    
   
    
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Login User</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">

                <div class="col-md-4">
                    <div class="single-sidebar">
                        <h2 class="sidebar-title">Login </h2>
                        @if(session('errorlogin'))
                    <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ session('errorlogin') }}
                    </div>
                    @endif
                    @if ($errors->first('kodecap'))
                      <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Maaf, Kode Captcha Salah
                    </div>
                  @endif
                        <form action="{{url('/loginUser')}}" method="post">
                            <input type="text" placeholder="Masukan Username" class="input-text" name="username" required>

                            <input style="width: 100%" type="password" placeholder="Masukan Password" id="loginpass" name="password" class="input-text" required>

                            <p class="form-row">
                             <label class="inline" for="rememberme">
                                <input type="checkbox" onclick="tampilsandi()"> Tampilkan Sandi
                            </label>
                            </p>

                            <div class="captcha">
                            <span>{!! captcha_img() !!}</span>
                            <button type="button" class="btn btn-success" id="refresh"><i class="fa fa-refresh"></i></button>
                            </div>

                            <br>
                            <input type="text" placeholder="Masukan Kode Captcha" class="input-text" name="kodecap" required>
                          
                            {{ @csrf_field() }}
                            <input type="submit" value="Login" class="tombol-biru">
                            <button type="button" class="tombol-merah" onclick="window.history.go(-1);" > kembali</button>
                        </form>
                    </div>
                    
                </div>
                
                <div class="col-md-8">
                     @if (session('status'))
                    <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ session('status') }}

                    </div>
                    @endif
                     @if(session('errormultiuser'))
                    <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ session('errormultiuser') }}
                    </div>
                    @endif
                    @if($errors->has('email')||$errors->has('nama')||$errors->has('username')||$errors->has('password')||$errors->has('konfirmasi_password')||$errors->has('no_telfon')||$errors->has('alamat')||$errors->has('kota')||$errors->first('provinsi')||$errors->first('kode_pos'))
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        Maaf, Data Yang Anda Masukan Salah / Tidak valid
                    </div>
                    @endif
                    <div class="product-content-right">
                        <div class="woocommerce">
                            <div class="woocommerce-info">Belum Punya Akun ? <a class="showlogin link-merah" data-toggle="collapse" href="#login-form-wrap" aria-expanded="false" aria-controls="login-form-wrap">Klik disini untuk membuat</a>
                            </div>

                            <form id="login-form-wrap" class="login collapse" method="post" action="{{url('/login/register')}}" enctype="multipart/form-data">
                            <p>Isi data diri yang diminta di bawah ini, pastikan data diri tersebut valid dan dapat di pertanggung jawabkan.</p>
                                <p class="form-row form-row-first">
                                    <label>Nama
                                    </label>
                                    <input type="text" name="nama" class="form-control" style="width: 100%" value="{{ old('nama') }}" required>
                                     @if($errors->has('nama'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('nama')}}
                                         </div>
                                        @endif
                                </p>
                                <p class="form-row form-row-first">
                                    <label>Username
                                    </label>
                                    <input type="text" name="username" class="form-control" style="width: 100%" value="{{ old('username') }}" required pattern=".{8,}">
                                    <p class="help-block text-left">Minimal 8 Karakter alphanumerik</p>
                                     @if($errors->has('username'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('username')}}
                                         </div>
                                        @endif
                                </p>
                                <p class="form-row form-row-first">
                                    <label>Password
                                    </label>
                                    <input type="password" name="password" class="form-control" style="width: 100%" value="{{ old('password') }}" required pattern=".{8,}">
                                    <p class="help-block text-left">Minimal 8 Karakter</p>
                                     @if($errors->has('password'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('password')}}
                                         </div>
                                        @endif
                                </p>
                                <p class="form-row form-row-first">
                                    <label>Konfirmasi Password
                                    </label>
                                    <input type="password" name="konfirmasi_password" class="form-control" style="width: 100%" value="{{ old('konfirmasi_password') }}" required pattern=".{8,}">
                                     <p class="help-block text-left">Minimal 8 Karakter</p>
                                     @if($errors->has('konfirmasi_password'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('konfirmasi_password')}}
                                         </div>
                                        @endif
                                </p>
                                <p class="form-row form-row-first">
                                    <label>Email
                                    </label>
                                    <input type="email" name="email" class="form-control" style="width: 100%" value="{{ old('email') }}" required>
                                      @if($errors->has('email'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('email')}}
                                         </div>
                                        @endif
                                </p>
                                <p class="form-row form-row-first">
                                    <label>No Telfon
                                    </label>
                                    <input type="text" name="no_telfon" class="form-control" style="width: 100%" value="{{ old('no_telfon') }}" required onkeypress="return isNumberKey(event)">
                                  @if($errors->has('no_telfon'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('no_telfon')}}
                                         </div>
                                        @endif
                                </p>
                                <p class="form-row form-row-first">
                                    <label>Alamat
                                    </label>
                                    <input type="text" name="alamat" class="form-control" style="width: 100%" value="{{ old('alamat') }}" required>
                                      @if($errors->has('alamat'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('alamat')}}
                                         </div>
                                        @endif
                                </p>
                                <p class="form-row form-row-first">
                                    <label>Kota
                                    </label>
                                    <input type="text" name="kota" class="form-control" style="width: 100%" value="{{ old('kota') }}" required>
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
                                                <option value="aceh">Aceh</option>
                                        <option value="sumatera utara">Sumatera Utara</option>
                                        <option value="sumatera barat">Sumatera Barat</option>
                                        <option value="riau">Riau</option>
                                        <option value="kepuluan riau">Kepulauan Riau</option>
                                        <option value="jambi">Jambi</option>
                                        <option value="sumatera selatan">Sumatera Selatan</option>
                                        <option value="bangka belitung">Bangka Belitung</option>
                                        <option value="bengkulu">Bengkulu</option>
                                        <option value="lampung">Lampung</option>
                                        <option value="jakarta">DKI Jakarta</option>
                                        <option value="jawa barat">Jawa Barat</option>
                                        <option value="banten">Banten</option>
                                        <option value="jawa tengah">Jawa Tengah</option>
                                        <option value="yogyakarta">Yogyakarta</option>
                                        <option value="jawa timur">Jawa Timur</option>
                                        <option value="bali">Bali</option>
                                        <option value="NTB">NTB</option>
                                        <option value="NTT">NTT</option>
                                        <option value="kalimantan utara">Kalimantan Utara</option>
                                        <option value="kalimantan barat">Kalimantan Barat</option>
                                        <option value="kalimantan tengah">Kalimantan Tengah</option>
                                        <option value="kalimantan selatan">Kalimantan Selatan</option>
                                        <option value="kalimantan timur">Kalimantan Timur</option>
                                        <option value="sulawesi utara">Sulawesi Utara</option>
                                        <option value="sulawesi barat">Sulawesi Barat</option>
                                        <option value="sulawesi tengah">Sulawesi Tengah</option>
                                        <option value="sulawesi tenggara">Sulawesi Tenggara</option>
                                        <option value="sulawesi selatan">Sulawesi Selatan</option>
                                        <option value="gorontalo">Gorontalo</option>
                                        <option value="maluku">Maluku</option>
                                        <option value="maluku utara">Maluku Utara</option>
                                        <option value="papua barat">Papua Barat</option>
                                        <option value="papua">Papua</option>
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
                                    <input type="text" name="kode_pos" class="form-control" style="width: 100%" value="{{ old('kode_pos') }}" required onkeypress="return isNumberKey(event)">
                                      @if($errors->has('kode_pos'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('kode_pos')}}
                                         </div>
                                        @endif
                                </p>
                                <p class="form-row form-row-first">
                                    <label>Foto
                                    </label>
                                    <input type="file" name="gambar_ktp" required accept="image/*">
                                    <p class="help-block text-left">Foto wajib di isi</p>
                                     @if($errors->has('gambar_ktp'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('gambar_ktp')}}
                                         </div>
                                        @endif
                                </p>
                                <div class="clear"></div>
                                <p class="form-row">
                                    {{csrf_field()}}

                                    <input type="submit" value="Simpan" class="button">
                                </p>
                                

                                <div class="clear"></div>
                            </form>
                        </div>
                         <div class="woocommerce">
                            <div class="woocommerce-info">
                                <h3>
                                    <strong>
                                    Peraturan Berbelanja        
                                    </strong>
                                </h3>
                            @foreach($websettings as $webset)
                                {!! $webset->peraturan !!}
                            @endforeach
                            </div>
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
                        <p>&copy; 2018 <a class="llink" onclick="login()">TASTORE</a>. All Rights Reserved. <a href="#" target="_blank">Joyoboyo Intermedia</a></p>
                    </div>
                </div>
                
               
            </div>
        </div>
    </div>
   
     <!-- End footer bottom area -->
   
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
    <script type="text/javascript">
        function tampilsandi() {
    var x = document.getElementById("loginpass");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
$('#refresh').click(function(){
  $.ajax({
     type:'GET',
     url:'refreshcaptcha',
     success:function(data){
        $(".captcha span").html(data.captcha);
     }
  });
});
</script>
  </body>
</html>