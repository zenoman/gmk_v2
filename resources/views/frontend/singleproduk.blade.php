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
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Deskripsi Produk</h2>
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
                        <h2 class="sidebar-title">Produk Lain</h2>
                       @foreach($baranglain as $lain)
                        <div class="thubmnail-recent">
                             @php
                                    $kode_barang = $lain->kode_barang;
                                    $foto = DB::table('gambar')
                                    ->where('kode_barang', $kode_barang)
                                    ->limit(1)
                                    ->get();
                                    @endphp
                                    @foreach($foto as $ft)
                                    
                            <img src="{{asset('img/barang/'.$ft->nama)}}" class="recent-thumb" alt="">
                                    @endforeach
                            <h2><a href="{{url('/detailbarang/'.$lain->id)}}">{{$lain->barang}}</a></h2>
                            <div class="product-sidebar-price">
                                @if(!Session::get('user_level'))
                                    @if($lain->diskon > 0)
                                    <ins>{{"Rp ". number_format(($lain->harga_barang-($lain->diskon/100*$lain->harga_barang)),0,',','.')}}</ins> <del>{{"Rp ". number_format($lain->harga_barang,0,',','.')}}</del>
                                     @else
                                    <ins>{{"Rp ". number_format($lain->harga_barang,0,',','.')}}</ins>
                                    @endif
                                @elseif(Session::get('user_level')=='reseller')
                                    <ins>{{"Rp ". number_format($lain->harga_reseller,0,',','.')}}</ins>
                                @else
                                    @if($lain->diskon > 0)
                                    <ins>{{"Rp ". number_format(($lain->harga_barang-($lain->diskon/100*$lain->harga_barang)),0,',','.')}}</ins> <del>{{"Rp ". number_format($lain->harga_barang,0,',','.')}}</del>
                                     @else
                                    <ins>{{"Rp ". number_format($lain->harga_barang,0,',','.')}}</ins>
                                    @endif
                                @endif
                            </div>                             
                        </div>
                       @endforeach

                    </div>
                </div>
                
                <div class="col-md-8">
                    @foreach($databarang as $barang)
                    <div class="product-content-right">
                        
                        <div class="row">
                            <div class="col-sm-6">
                                    @php
                                    $kode_barang = $barang->kode_barang;
                                    $jumlahfoto = DB::table('gambar')
                                    ->where('kode_barang', $kode_barang)
                                   ->count();
                                   @endphp

                                   @if($jumlahfoto>1)
                                   <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                    @php
                                    
                                    $foto = DB::table('gambar')
                                    ->where('kode_barang', $kode_barang)
                                   ->get();
                                   
                                   $ii=0;
                                    @endphp
                                    @foreach($foto as $ft)
                                    @php
                                    $ii++;
                                    @endphp

                                    @if($ii == 1)
                                    <div class="item active">
                                        <img src="{{asset('img/barang/'.$ft->nama)}}" alt="" style="width: 100%">
                                      </div>
                                    @else
                                    <div class="item">
                                        <img src="{{asset('img/barang/'.$ft->nama)}}" alt="" style="width: 100%">
                                      </div>
                                    @endif
                                   
                                    
                                    @endforeach
                                      

                                    </div>

                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                      <span class="glyphicon glyphicon-chevron-left"></span>
                                      <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                      <span class="glyphicon glyphicon-chevron-right"></span>
                                     
                                    </a>
                                  </div>
                                
                                   @else
                                   @php
                                    $foto = DB::table('gambar')
                                    ->where('kode_barang', $kode_barang)
                                    ->limit(1)
                                    ->get();
                                    @endphp
                                    @foreach($foto as $ft)
                                    
                            <img src="{{asset('img/barang/'.$ft->nama)}}" alt="">
                                    @endforeach
                                   @endif
                                 
                         </div>
                            <div class="col-sm-6">
                                <h2 class="product-name">
                                
                                    {{ $barang->barang }}
                                </h2>
                                    <div class="product-inner-price" style="font-size: 20px;">
                                    @if(!Session::get('user_level'))
                                        @if($barang->diskon > 0)
                                        <ins>{{"Rp ". number_format(($barang->harga_barang-($barang->diskon/100*$barang->harga_barang)),0,',','.')}}</ins> <del>{{"Rp ". number_format($barang->harga_barang,0,',','.')}}</del>
                                        @else
                                        <ins>{{"Rp ". number_format($barang->harga_barang,0,',','.')}}</ins>
                                        @endif
                                    @elseif(Session::get('user_level')=='reseller')
                                        <ins>{{"Rp ". number_format($barang->harga_reseller,0,',','.')}}</ins>
                                    @else
                                     @if($barang->diskon > 0)
                                        <ins>{{"Rp ". number_format(($barang->harga_barang-($barang->diskon/100*$barang->harga_barang)),0,',','.')}}</ins> <del>{{"Rp ". number_format($barang->harga_barang,0,',','.')}}</del>
                                        @else
                                        <ins>{{"Rp ". number_format($barang->harga_barang,0,',','.')}}</ins>
                                        @endif
                                    @endif
                                    </div>    
                                    
                                    <form action="/tambahkeranjang" method="post" class="cart form-horizontal" >
                                         <div class="form-group">
                                            <label class="control-label col-sm-2">Warna </label>
                                            <div class="col-sm-10">
                                                <select name="varian" class="form-control" placeholder="pilih ukuran" id="warna">
                                                <option selected disabled hidden>pilih warna</option>
                                                @php 
                                                $war = DB::table('tb_barangs')
                ->select(DB::raw('tb_barangs.kode,tb_barangs.kode_v,tb_varian.varian'))
                ->leftjoin('tb_varian','tb_varian.kode_v','=','tb_barangs.kode_v')
                ->distinct()
                ->where('tb_barangs.kode','=',$barang->kode_barang)
                ->get();
                                                @endphp
                                                    @foreach($war as $warn)
                                                    <option value="{{$warn->kode_v}}">{{$warn->varian}}</option>
                                                    @endforeach
                                                
                                            </select></div>
                                            
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2">Ukuran </label>
                                            <div class="col-sm-10">
                                                <select name="warna" class="form-control" placeholder="pilih ukuran" id="ukuran">
                                                <option selected disabled hidden data-tag="pu">pilih ukuran</option>
                                                @php 
                                                $warnas = DB::table('tb_barangs')
                                                        ->where('kode',$barang->kode_barang)
                                                        ->get();
                                                @endphp
                                                    @foreach($warnas as $warna)
                                                    <option value="{{$warna->idbarang.'-'.$warna->stok}}" data-tag="{{$warna->kode_v}}">{{$warna->warna}}</option>
                                                    @endforeach
                                                
                                            </select></div>
                                            
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2">Stok</label>
                                            <div class="col-sm-10"><input type="number" id="stok" class="form-control" name="jumlah" required readonly></div>
                                            
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2">Jumlah</label>
                                            <div class="col-sm-10">
                                                <input type="number" id="jumlah" class="form-control" max="???" name="jumlah" min="1" required>
                                            </div>
                                            
                                        </div>
                                        <input type="hidden" name="kode_barang" value="{{$barang->kode_barang}}">
                                        {{ csrf_field() }}
                                        
                                        <div class="text-center">

                                        @if(Session::get('user_name'))
                                        <button type="submit">Masukan Keranjang</button>
                                        @else
                                        <button type="button" class="tombol" data-toggle="modal" data-target="#myModal">Masukan Keranjang</button>

                                         <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Peringatan</h4>
                                        </div>
                                        <div class="modal-body">
                                        Maaf, Anda Belum Login
                                    </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                                        @endif
                                        <button type="button" onclick="window.history.go(-1);" class="tombol-merah">Kembali</button>    
                                        </div>
                                        
                                    </form>   
                            </div> 
                           
                            <div class="col-sm-12">
                                 <br>
                            
                                <div class="product-inner">
                                    
                                    <div role="tabpanel">
                                      
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane fade in active" id="home">
                                                <h2>Deskripsi Produk</h2>  
                                                <p>
                                                    {!!$barang->deskripsi!!}
                                                </p>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        
                    </div> 
                    @endforeach                   
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
    @endsection
  
    @section('jspage')
    <script>
    $('#warna').on('change', function() {
        var selected = $(this).val();
        $("#ukuran option").each(function(item){
            var element =  $(this) ; 
            if(element.data("tag") !='pu'){
                if (element.data("tag") != selected){
                element.hide() ; 
            }else{
                element.show();
            }
            } 
            
        }) ; 
        $('#stok').val('');
        
        $("#ukuran").val($("#ukuran option:visible:first").val());
        
});
</script>
    <script type="text/javascript">
        $('#ukuran').on('change', function (e) {
            var optonselected = $("option:selected", this);
            var value = this.value;
            var datanya = value.split("-");
        $('#stok').val(datanya[1]);
        $('#jumlah').attr({
            "max":datanya[1]
        });
        })
    </script>
    @endsection
  