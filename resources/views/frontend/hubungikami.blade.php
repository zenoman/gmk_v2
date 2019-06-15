@extends('layout.masteruser')

    @section('header')
    @foreach($websettings as $webset)
    <title>{{$webset->webName}}</title>
    <link rel="shortcut icon" type="image" href="{{asset('img/setting/'.$webset->ico)}}">
    @endforeach
    @endsection
    @section('logo')
     @foreach($websettings as $webset)
     <h1><a href="{{url('/')}}"><img src="{{asset('img/setting/'.$webset->logo)}}"></a></h1>
    @endforeach
    @endsection
   

    @section('navigation')
    <ul class="nav navbar-nav">
        <li><a href="{{url('/')}}">Home</a></li>
        <li><a href="{{url('/semuaproduk')}}">Semua Produk</a></li>
        <li class="active"><a href="{{url('/hubungikami')}}">Hubungi Kami</a></li>
        <li><a href="#" data-toggle="modal" data-target="#exampleModal">Peraturan Belanja</a></li>

    </ul>
    @endsection                
    
    @section('content')
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Hubungi Kami</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="single-product-area">
        <div class="container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126486.11387369903!2d112.03784828547029!3d-7.822487605206616!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7858fb7bf1947d%3A0x4027a76e3531190!2sGurah%2C+Kediri%2C+Jawa+Timur!5e0!3m2!1sid!2sid!4v1542003545581" width="1135" height="500" frameborder="0" style="border:0;max-width: 100%;" allowfullscreen></iframe>
            @foreach($websettings as $webs)
            <div class="promo-area">
        <div class="zigzag-bottom"></div>

            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="single-promo promo3">
                        <i class="fa fa-child"></i>
                        <p>Admin 1</p>
                        <p>{{$webs->kontak1}}</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="single-promo promo3">
                        <i class="fa fa-child"></i>
                        <p>Admin 2</p>
                        <p>{{$webs->kontak2}}</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="single-promo promo3">
                        <i class="fa fa-child"></i>
                        <p>Admin 3</p>
                        <p>{{$webs->kontak3}}</p>
                    </div>
                </div>
                
            </div>
    </div> <!-- End promo area -->
    <div class="row">
        <div class="jumbotron col-md-12" style="width: 100%;">
              <h2><b>Alamat</b></h2>
              <p class="lead">{{$webs->alamat}}</p>
              <hr class="my-4">
              <p>{{$webs->keterangan}}</p>
              
            </div>
    </div>
            
            @endforeach
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
<div class="footer-top-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="footer-about-us text-center">
                        <h2>Temukan <span>Kami</span></h2>
                        <p>Dapatkan versi android <a href="">disini</a>, atau kunjungi sosial media kami</p>
                        <div class="footer-social">
                            <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-youtube"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div> <!-- End footer top area -->
    @endsection
    