@extends('layout/masteruser')
    
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
    @section('cart')
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
    @endsection
                
    @section('navigation')
    <ul class="nav navbar-nav">
        <li><a href="{{url('/')}}">Home</a></li>
        <li><a href="{{url('/semuaproduk')}}">Semua Produk</a></li>
        <li><a href="{{url('/hubungikami')}}">Hubungi Kami</a></li>
        <li><a href="#" data-toggle="modal" data-target="#exampleModal">Peraturan Belanja</a></li>
    </ul>
    @endsection
              
    @section('content')
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        @if($status=='nama')
                        <h2>Hasil Cari "{{$keynya}}"</h2>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="single-sidebar">
                        <h2 class="sidebar-title">Cari Produk</h2>
                        <form action="{{url('/cari')}}" method="get">
                            <input type="text" placeholder="Cari Berdasarkan Nama" name="cari" required>
                            {{csrf_field()}}
                            <input type="submit" value="Cari">
                        </form>
                    </div>
                    
                    
                    <div class="single-sidebar">
                        <h2 class="sidebar-title">Kategori</h2>
                        <ul>
                           @foreach($kategoris as $kategori)
                            <li><a href="{{url('/semuaproduk/'.$kategori->id.'/kategori')}}">{{$kategori->kategori}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                
                <div class="col-md-9">
                
                 <div class="row">
                    @foreach($barangs as $barang)
                <div class="col-md-4 col-sm-6">
                    <div class="single-shop-product">
                        @php
                        $fotos = DB::table('gambar')
                        ->where('kode_barang',$barang->kode_barang)
                        ->limit(1)
                        ->get();
                        @endphp
                        @foreach($fotos as $foto)
                        <div class="product-upper">
                                <img src="{{asset('img/barang/'.$foto->nama)}}" alt="">
                        </div>
                        @endforeach
                        <h2><a href="">{{$barang->barang}}</a></h2>
                        <div class="product-carousel-price">
                            @if(!Session::get('user_level'))
                                 @if($barang->diskon > 0)
                                    @php
                                    $hargadiskon = $barang->harga_barang - ($barang->diskon/100*$barang->harga_barang); 
                                    @endphp
                                    <ins>{{"Rp ". number_format($hargadiskon,0,',','.')}}</ins>
                                    <del>{{"Rp ". number_format($barang->harga_barang,0,',','.')}}</del>
                                    <p>{{"Stok : ".$barang->total}}</p>
                                    @else
                                    <ins>{{"Rp ". number_format($barang->harga_barang,0,',','.')}}</ins>
                                    <p>{{"Stok : ".$barang->total}}</p>
                                @endif
                            @elseif(Session::get('user_level')=='reseller')
                            <ins>{{"Rp ". number_format($barang->harga_reseller,0,',','.')}}</ins>
                            <p>{{"Stok : ".$barang->total}}</p>
                            @else
                             @if($barang->diskon > 0)
                                    @php
                                    $hargadiskon = $barang->harga_barang - ($barang->diskon/100*$barang->harga_barang); 
                                    @endphp
                                    <ins>{{"Rp ". number_format($hargadiskon,0,',','.')}}</ins>
                                    <del>{{"Rp ". number_format($barang->harga_barang,0,',','.')}}</del>
                                    <p>{{"Stok : ".$barang->total}}</p>
                                    @else
                                    <ins>{{"Rp ". number_format($barang->harga_barang,0,',','.')}}</ins>
                                    <p>{{"Stok : ".$barang->total}}</p>
                                @endif
                            @endif
                            
                        </div>  
                        
                        <div class="product-option-shop">
                            <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="{{url('/detailbarang/'.$barang->id)}}">Detail Produk</a>
                        </div>                       
                    </div>
                </div>
               @endforeach
            </div>
            <div class="text-center">
            <br><button type="button" onclick="window.history.go(-1);" class="tombol-merah">Kembali</button>
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