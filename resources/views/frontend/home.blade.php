@extends('layout/masteruser')

    @section('header')
    @foreach($websettings as $webset)
    <title>{{$webset->webName}}</title>
    <link rel="shortcut icon" type="image" href="{{asset('img/setting/'.$webset->ico)}}">
    @endforeach
    @endsection
   
    @section('logo')
    @foreach($websettings as $webset)
    <a href="{{url('/')}}"><img src="{{asset('img/setting/'.$webset->logo)}}" alt="" style="width:70%;"></a>

    @endforeach
    @endsection
    
    @section('content')
<div class="banner">
<div class="container"> 
          <div class="wmuSlider example1">
               <div class="wmuSliderWrapper">
                @foreach($sliders as $sld)
             <article style="position: absolute; width: 100%; opacity: 0;"> 
                    <div class="banner-wrap">
                    <div class="banner-top banner-bottom">
                         <a href="single.html">
                        <div class="banner-top-in at">
                            <img src="{{asset('img/slider/'.$sld->foto)}}" class="img-responsive" alt="">

                        </div></a>
                        <div class="cart-at grid_1 simpleCart_shelfItem">
                                <!-- <div class="item_add"><span class="item_price" >123 $ <i> </i> </span></div> -->
                            <div class="off">
                                <label>{{$sld->judul}}</label>
                                <p>{{$sld->deskripsi}}</p>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                        
                        </div>
                        
                         <div class="clearfix"> </div>
                         
                     </div>
            </article>
            @endforeach
            </div>
        </div>
        <!---->
          <script src="{{asset('user_aset/js/jquery.wmuSlider.js')}}"></script> 
              <script>
                $('.example1').wmuSlider({
                     pagination : false,
                     nav : false,
                     paginationControl:false,
                });         
             </script>  
        
        </div>   
    </div>
<div class="content">
    <div class="container">
        <div class="content-top">
        <h2 class="new text-center">KATEGORI</h2>
        <div class="pink">
            <!-- requried-jsfiles-for owl -->
        <link href="{{asset('user_aset/css/owl.carousel.css')}}" rel="stylesheet">
        <script src="{{asset('user_aset/js/owl.carousel.js')}}"></script>
            <script>
                $(document).ready(function() {
                    $("#owl-demo").owlCarousel({
                        items : 4,
                        lazyLoad : true,
                        autoPlay : true,
                        pagination : true,
                    });
                });
            </script>
        <!-- //requried-jsfiles-for owl -->
            <div id="owl-demo" class="owl-carousel text-center">
                @foreach($kategori as $row)
            <div class="item">
                <div class=" box-in">
            <div class=" grid_box">     
                        <a> <img src="{{asset('img/kategori/'.$row->gambar)}}" class="img-responsive" alt="">
                                <div class="zoom-icon">
                                    <h5 class="text-center">
                                        Lihat Kategori {{$row->kategori}}</h5>
                                    
                    
                        </div> </a>     
                   </div>
                    <!---->
                        <div class="grid_1 simpleCart_shelfItem">
                            <a href="{{url('/semuaproduk/'.$row->id.'/kategori')}}" class="cup item_add"><span class=" item_price" >{{$row->kategori}}</span></a>                  
                        </div>
                    <!---->
                </div>
            </div>
            @endforeach
                <div class="clearfix"> </div>
            </div>
            
        </div>
        
         </div>
    
        <!---->
    <div class="content-middle">
       <div class="product">
        <h2 class="new text-center">PRODUK TERBARU</h2>
        <div class="pink">
            @foreach($barangbaru as $row)
            <div class="col-md-4 box-in-at">
            <div class=" grid_box portfolio-wrapper">       
                    <a> 
                        @php
                        $fotos = DB::table('gambar')
                        ->where('kode_barang',$row->kode_barang)
                        ->limit(1)
                        ->get();
                        @endphp
                        @foreach($fotos as $foto)
                                <img src="{{asset('img/barang/'.$foto->nama)}}" class="img-responsive" alt="">
                        @endforeach
                                <div class="zoom-icon">
                                    <ul class="in-by" style="padding-bottom:5px;">
                            <li><h5><b>{{$row->barang}} - {{$row->total}} Pcs</b></h5></li>
                        </ul>
                                    <ul class="in-by">
                                        <li><h5>Ukuran :</h5></li>
                                        @php
                                        $detail = DB::table('tb_barangs')
                                        ->where('kode',$row->kode_barang)
                                        ->get();
                                        @endphp
                                        @foreach($detail as $dtl)                   
                                        <li><span>{{$dtl->warna}}</span></li>
                                        @endforeach
                                    </ul>
                    
                    
                        <ul class="in-by-color">
                            <li><h5>Warna :</h5></li>   
                            @php
                                        $detail = DB::table('tb_barangs')
                                        ->select(DB::raw('tb_barangs.kode,tb_varian.hex'))
                                        ->leftjoin('tb_varian','tb_varian.kode_v','=','tb_barangs.kode_v')
                                        ->where('kode',$row->kode_barang)
                                        ->get();
                                        @endphp
                                        @foreach($detail as $dtl)                   
                                        <li><span class="color" style="background-color: {{$dtl->hex}};"> </span></li>
                                        @endforeach
                            
                        </ul>

                        </div> </a>     
                   </div>
                <!---->
                        <div class="grid_1 simpleCart_shelfItem">
                            <a href="{{url('/detailbarang/'.$row->id)}}" class="cup item_add"><span class=" item_price" >
                             @if($row->diskon > 0)
                                @php
                                $hargadiskon = $row->harga_barang - ($row->diskon/100*$row->harga_barang); 
                                @endphp
                                {{"Rp ". number_format($hargadiskon,0,',','.')}}
                            @else
                                {{"Rp ". number_format($row->harga_barang,0,',','.')}}
                            @endif</span></a>                  
                        </div>
                    <!---->
                </div>
                @endforeach
                <div class="clearfix"> </div>
        </div>
        </div>
    </div>
    <!---->
        <h2 class="new text-center">ARTIKEL TERBARU</h2>
        <br>
        @foreach($artikel as $art)
        <div class="col-md-4">
            <div class="content-bottom">
                <div class="col-md-12 latter">
                    <img src="{{asset('img/artikel/'.$art->gambar)}}" alt="" width="100%">
                    <br><br>
                    <h6>{{$art->judul}}</h6>
                    <br><br>

                    <p>{!!substr($art->isi,0,200)!!}</p>
                    <br>
                    <span class="label label-primary" style="background-color: #fa7455;">
                        <i class="fa fa-eye"></i> {{$art->dilihat}}
                    </span>&nbsp;
                    <span class="label label-primary" style="background-color: #fa7455;">
                        <i class="fa fa-calendar"></i> {{$art->tgl}}
                    </span>
                    &nbsp;
                    <span class="label label-primary" style="background-color: #fa7455;">
                        <i class="fa fa-tag"></i> {{$art->nama}}
                    </span>
                    
                    <br>
                    <div class="text-center">
                        <button class="btn btn-block tombol">
                        Lanjut Baca
                    </button>
                        
                    </div>
                    <div class="clearfix"> </div>
                </div>
         
                    <div class="clearfix"> </div>
            </div>
        </div>
                   @endforeach
            <div class="col-md-12 col-sm-12 text-center">
                <br>
                    <button class="tombol">
                        Lihat Semua Artikel
                    </button>
                </div>
   @endsection
    
    