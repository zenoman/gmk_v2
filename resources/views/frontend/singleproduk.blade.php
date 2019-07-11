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
    <link rel="stylesheet" href="{{asset('user_aset/css/etalage.css')}}">
<script src="{{asset('user_aset/js/jquery.etalage.min.js')}}"></script>
        <script>
            jQuery(document).ready(function($){

                $('#etalage').etalage({
                    thumb_image_width: 330,
                    thumb_image_height: 400,
                    source_image_width: 900,
                    source_image_height: 1200,
                    show_hint: true,
                    click_callback: function(image_anchor, instance_id){
                        alert('Callback example:\nYou clicked on an image with the anchor: "'+image_anchor+'"\n(in Etalage instance: "'+instance_id+'")');
                    }
                });
            });
        </script>
    <div class="content">
    <div class="container">
        <div class="single">
            @foreach($databarang as $barang)
                <div class="col-md-9 top-in-single">
                    <div class="col-md-5 single-top">   
                        <ul id="etalage">
                            @php
                            $foto = DB::table('gambar')
                                    ->where('kode_barang', $barang->kode_barang)
                                   ->get();
                            $ii=0;
                            @endphp
                            @foreach($foto as $ft)
                            <li>

                                <img class="etalage_thumb_image img-responsive" src="{{asset('img/barang/'.$ft->nama)}}"  alt="" >
                                <img class="etalage_source_image img-responsive" src="{{asset('img/barang/'.$ft->nama)}}" alt="" >
                            </li>
                            @endforeach
                        </ul>

                    </div>  
                    <div class="col-md-7 single-top-in">
                        <div class="single-para">
                            <h4>{{ $barang->barang }}</h4>
                            <p>{!!$barang->deskripsi!!}</p>
                            
                                @if($barang->diskon > 0)
                                       <label  class="add-to">{{"Rp ". number_format(($barang->harga_barang-($barang->diskon/100*$barang->harga_barang)),0,',','.')}}</label>
                                        @else
                                        <label  class="add-to">{{"Rp ". number_format($barang->harga_barang,0,',','.')}}</label>
                                        @endif
                                
                            
                            <div class="available">
                                <h6>Stok : {{$barang->total}} Pcs</h6>
                                <table>
                                    <tr>
                                        <td>Diskon</td>
                                        <td>&nbsp;:&nbsp;</td>
                                        <td>{{$barang->diskon}}%</td>
                                    </tr>
                                    <tr>
                                        <td>Warna</td>
                                        <td>&nbsp;:&nbsp;</td>
                                        <td>
                                            @php
                                        $detail = DB::table('tb_barangs')
                                        ->select(DB::raw('tb_barangs.kode,tb_varian.hex'))
                                        ->leftjoin('tb_varian','tb_varian.kode_v','=','tb_barangs.kode_v')
                                        ->where('kode',$barang->kode_barang)
                                        ->get();
                                        @endphp
                                        @foreach($detail as $dtl)                   
                                        <span class="label label-primary" style="background-color: {{$dtl->hex}};"> </span>&nbsp;
                                        @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ukuran</td>
                                        <td>&nbsp;:&nbsp;</td>
                                        <td>
                                            @php
                                        $detail = DB::table('tb_barangs')
                                        ->where('kode',$barang->kode_barang)
                                        ->get();
                                        @endphp
                                        @foreach($detail as $dtl)                   
                                        <span>{{$dtl->warna}} &nbsp;</span>
                                        @endforeach
                                        </td>
                                    </tr>
                                </table>
                        </div>
                            
                                <a href="#" class="cart">Download Gambar</a>
                            
                        </div>
                    </div>
                <div class="clearfix"> </div>
                  <!----- tabs-box ---->
        <div class="sap_tabs">  
                     <div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">         
                            <div class="resp-tabs-container">
                                <h2 class="resp-accordion resp-tab-active" role="tab" aria-controls="tab_item-0"><span class="resp-arrow"></span>Product Description</h2><div class="tab-1 resp-tab-content resp-tab-content-active" aria-labelledby="tab_item-0" style="display:block">
                                    <div class="facts text-center">
                                      <p>Semua transaksi dapat dilakukan di aplikasi android, website ini berfungsi sebagai katalok. anda dapat menginstall aplikasi android melalui link di bawah ini.</p>
                                      <a href="#" class="tombol" style="color:white;">Download Aplikasi GMK</a>         
                                    </div>
                             
                                </div>                                  
                                
                             </div>
                          </div>
                     </div>   
</div>
                </div>
                @endforeach
                <div class="col-md-3 at-single">
                    
                    <div class="single-bottom">
                        <h4>Produk Lainya</h4>
                        @foreach($baranglain as $lain)
                            <div class="product-go">
                                 @php
                                    $kode_barang = $lain->kode_barang;
                                    $foto = DB::table('gambar')
                                    ->where('kode_barang', $kode_barang)
                                    ->limit(1)
                                    ->get();
                                    @endphp
                                    @foreach($foto as $ft)
                                <img class="img-responsive fashion" src="{{asset('img/barang/'.$ft->nama)}}" alt="">
                                @endforeach
                            <div class="grid-product">
                                <a href="#" class="elit">{{$lain->barang}}</a>
                                <span class=" price-in">
                                @if($lain->diskon > 0)
                                    {{"Rp ". number_format(($lain->harga_barang-($lain->diskon/100*$lain->harga_barang)),0,',','.')}}
                                    @else
                                    {{"Rp ". number_format($lain->harga_barang,0,',','.')}}
                                    @endif</span>
                                    <span class="label label-primary" style="background-color: #fa7455;">
                                        {{$lain->kategori}} 
                                    </span>
                            </div>
                            <div class="clearfix"> </div>
                            </div>
                            @endforeach
                </div>
                </div>
                <div class="clearfix"> </div>       
        </div>


    </div>
</div>
    @endsection
  