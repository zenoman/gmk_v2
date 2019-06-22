@extends('layout/masteruser')

    @section('header')
    @foreach($websettings as $webset)
    <title>{{$webset->webName}}</title>
    <link rel="shortcut icon" type="image" href="{{asset('img/setting/'.$webset->ico)}}">
    @endforeach
    @endsection
   
    
    
    @section('content')
<div class="banner">
<div class="container"> 
          <div class="wmuSlider example1">
               <div class="wmuSliderWrapper">
             <article style="position: absolute; width: 100%; opacity: 0;"> 
                    <div class="banner-wrap">
                    
                        <div class="banner-top">
                        <a href="single.html">
                        <div class="banner-top-in">
                            <img src="images/ba.png" class="img-responsive" alt="">
                        </div></a>
                        <div class="cart-at grid_1 simpleCart_shelfItem">
                                <div class="item_add"><span class="item_price" >123 $ <i> </i> </span></div>
                            <div class="off">
                                <label>35% off !</label>
                                <p>White Blended Cotton "still fresh" t-shirt</p>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                        
                        </div>
                        
                         
                          <div class="banner-top banner-bottom">
                         <a href="single.html">
                        <div class="banner-top-in at">
                            <img src="images/ba2.png" class="img-responsive" alt="">
                        </div></a>
                        <div class="cart-at grid_1 simpleCart_shelfItem">
                                <div class="item_add"><span class="item_price" >123 $ <i> </i> </span></div>
                            <div class="off">
                                <label>35% off !</label>
                                <p>White Blended Cotton "still fresh" t-shirt</p>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                        
                        </div>
                        
                         <div class="clearfix"> </div>
                         
                     </div>
            </article>
             <article style="position: absolute; width: 100%; opacity: 0;"> 
                        <div class="banner-wrap">
                        
                        <div class="banner-top">
                        <a href="single.html">
                        <div class="banner-top-in">
                            <img src="images/ba11.png" class="img-responsive" alt="">
                        </div></a>
                        <div class="cart-at grid_1 simpleCart_shelfItem">
                                <div class="item_add"><span class="item_price" >123 $ <i> </i> </span></div>
                            <div class="off">
                                <label>35% off !</label>
                                <p>White Blended Cotton "still fresh" t-shirt</p>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                        
                        </div>
                        
                        
                          <div class="banner-top banner-bottom">
                          <a href="single.html">
                        <div class="banner-top-in at">
                            <img src="images/ba21.png" class="img-responsive" alt="">
                        </div></a>
                        <div class="cart-at grid_1 simpleCart_shelfItem">
                                <div class="item_add"><span class="item_price" >123 $ <i> </i> </span></div>
                            <div class="off">
                                <label>35% off !</label>
                                <p>White Blended Cotton "still fresh" t-shirt</p>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                        
                        </div>
                        
                         <div class="clearfix"> </div>
                        
                     </div>
            </article>
             <article style="position: absolute; width: 100%; opacity: 0;"> 
                        <div class="banner-wrap">
                        
                        <div class="banner-top">
                        <a href="single.html">
                        <div class="banner-top-in">
                            <img src="images/ba12.png" class="img-responsive" alt="">
                        </div></a>
                        <div class="cart-at grid_1 simpleCart_shelfItem">
                                <div class="item_add"><span class="item_price" >123 $ <i> </i> </span></div>
                            <div class="off">
                                <label>35% off !</label>
                                <p>White Blended Cotton "still fresh" t-shirt</p>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                        
                        </div>
                        
                         
                           <div class="banner-top banner-bottom">
                          <a href="single.html">
                        <div class="banner-top-in at">
                            <img src="images/ba22.png" class="img-responsive" alt="">
                        </div></a>
                        <div class="cart-at grid_1 simpleCart_shelfItem">
                                <div class="item_add"><span class="item_price" >123 $ <i> </i> </span></div>
                            <div class="off">
                                <label>35% off !</label>
                                <p>White Blended Cotton "still fresh" t-shirt</p>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                        
                        </div>
                         <div class="clearfix"> </div>
                        
                     </div>
            </article>
            </div>
             <ul class="wmuSliderPagination">
                    <li><a href="#" class="">0</a></li>
                    <li><a href="#" class="">1</a></li>
                    <li><a href="#" class="wmuActive">2</a></li>
                </ul>
        </div>
        <!---->
          <script src="{{asset('user_aset/js/jquery.wmuSlider.js')}}"></script> 
              <script>
                $('.example1').wmuSlider({
                     pagination : true,
                     nav : false,
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
                             <a href="#" > <img src="{{asset('img/kategori/'.$row->gambar)}}" class="img-responsive" alt="">
                                <div class="zoom-icon">
                                    <h5 class="text-center">
                                        Lihat Kategori {{$row->kategori}}</h5>
                                    <!-- <ul class="in-by">
                                        <li><h5>sizes:</h5></li>                     
                                        <li><span>S</span></li>
                                        <li><span>XS</span></li>
                                        <li><span>M</span></li>
                                        <li><span> L</span></li>
                                        <li><span>XL</span></li>
                                        <li><span> XXL</span></li>
                                    </ul> -->
                    
                    
                        <!-- <ul class="in-by-color">
                            <li><h5>colors:</h5></li>                   
                            <li><span > </span></li>
                            <li><span class="color"> </span></li>
                            <li><span class="color1"> </span></li>
                            <li><span class="color2"> </span></li>
                            <li><span class="color3"> </span></li>
                            
                        </ul> -->
                    
                        </div> </a>     
                   </div>
                    <!---->
                        <div class="grid_1 simpleCart_shelfItem">
                            <a href="#" class="cup item_add"><span class=" item_price" >{{$row->kategori}}</span></a>                  
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
            <div class="col-md-3 box-in-at">
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
                                    <ul class="in-by">
                            <li><h5>Stok :</h5></li>
                            <li>{{$row->total}} Pcs</li>
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
                            <a href="#" class="cup item_add"><span class=" item_price" >
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
            <div class="content-bottom">

                <div class="col-md-12 latter">
                    <h6>NEWSLETTER</h6>
                    <br><br>
                    <p>sign up now to our newsletter discount! to get the Welcome discount sign up now to our newsletter discount! to get the Welcome discount sign up now to our newsletter discount! to get the Welcome discount sign up now to our newsletter discount! to get the Welcome discount</p>
                    
                    <div class="clearfix"> </div>
                </div>
                
                    <div class="clearfix"> </div>
            </div>
            <div class="col-md-12">
                <br>
                    <button class="tombol">
                        Lihat Semua
                    </button>
                </div>
   @endsection
    
    