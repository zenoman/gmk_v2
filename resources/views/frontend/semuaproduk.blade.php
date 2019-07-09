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
   <div class="container">
        <div class="product">
        <h2 class="new text-center">SEMUA PRODUK</h2>
        <div class="col-md-10">
           <div class="pink">
               @foreach($barangs as $barang)
            <div class="col-md-4 box-in-at">
            <div class=" grid_box portfolio-wrapper">       
                             <a> 
                                 @php
                        $fotos = DB::table('gambar')
                        ->where('kode_barang',$barang->kode_barang)
                        ->limit(1)
                        ->get();
                        @endphp
                        @foreach($fotos as $foto)
                        <img src="{{asset('img/barang/'.$foto->nama)}}" class="img-responsive" alt="">
                        @endforeach
                                <div class="zoom-icon">
                                    <ul class="in-by" style="padding-bottom: 5px;">
                                        <li><h5>{{$barang->barang}} - {{$barang->total}} Pcs</h5></li>
                                    </ul>
                                    <ul class="in-by">
                                        <li><h5>Ukuran :</h5></li>
                                        @php
                                        $detail = DB::table('tb_barangs')
                                        ->where('kode',$barang->kode_barang)
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
                                        ->where('kode',$barang->kode_barang)
                                        ->get();
                                        @endphp
                                        @foreach($detail as $dtl)                   
                                        <li><span class="color" style="background-color: {{$dtl->hex}};"> </span></li>
                                        @endforeach
                            
                        </ul>
                    
                        </div> </a>     
                   </div>
                        <div class="grid_1 simpleCart_shelfItem">
                            <a href="{{url('/detailbarang/'.$barang->id)}}" class="cup item_add"><span class=" item_price" >
                                @if($barang->diskon > 0)
                                @php
                                $hargadiskon = $barang->harga_barang - ($barang->diskon/100*$barang->harga_barang); 
                                @endphp
                                {{"Rp ". number_format($hargadiskon,0,',','.')}}
                            @else
                                {{"Rp ". number_format($barang->harga_barang,0,',','.')}}
                            @endif
                            </span></a>                  
                        </div>
                </div>
                @endforeach
                <div class="col-md-12 text-center">
                {{ $barangs->links() }}
                <br>
                <button class="tombol" onclick="history.go(-1)"> <i class="fa fa-arrow-left"></i> Kembali</button>
            </div>
                <div class="clearfix"> </div>
        </div> 
        </div>
        <div class="col-md-2">
            <div class="single-bottom">
                        <h4>Cari Produk</h4>
                        <br>
                        <form action="">
                            <div class="form-group text-center">
                                <input type="text" class="form-control" required>
                                 <button class="tombol"><i class="fa fa-search"></i> Cari</button>
                            </div>
                        </form>
                    </div>
            <div class="single-bottom">
                        <h4>Kategori</h4>
                        <ul>
                             @foreach($kategoris as $kategori)
                            <li>
                                <a href="{{url('/semuaproduk/'.$kategori->id.'/kategori')}}">
                                    <label for="brand"><span></span>{{$kategori->kategori}}</label>
                                </a></li>
                            @endforeach
                            
                        </ul>
                    </div>
        </div>
        </div>
        <!----> 
</div>
    @endsection