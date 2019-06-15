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
                        <h2>Keranjang Saya</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
     @if($jumlah > 0)
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="cart_totals">
                                <h2>Total</h2>

                                <table cellspacing="0">
                                    <tbody>
                                        <tr class="cart-subtotal">
                                            <th>Subtotal</th>

                                            <td>
                                            @foreach($subtotal as $totals)
                                                <span class="amount">
                                                {{"Rp ". number_format($totals->total,0,',','.')}}
                                                </span>
                                            @endforeach
                                            </td>
                                        </tr>

                                        <tr class="shipping">
                                            <th>Ongkir</th>
                                            <td>-</td>
                                        </tr>

                                        <tr class="order-total">
                                            <th>Total</th>
                                            <td><strong><span class="amount">-</span></strong> </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                </div>
                
                <div class="col-md-9">
                    <div class="product-content-right">
                         <h2>Daftar Barang</h2>
                        <div class="woocommerce">
                                <table cellspacing="0" class="shop_table cart">
                                    <thead>
                                        <tr>
                                            <th class="product-remove">&nbsp;</th>
                                            <th class="product-name">Nama</th>
                                            <th class="product-thumbnail">Warna</th>
                                            <th class="product-price">Harga</th>
                                            <th class="product-quantity">Jumlah</th>
                                            <th class="product-price">
                                                Diskon
                                            </th>
                                            <th class="product-subtotal">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($barangs as $barang)
                                        <tr class="cart_item">
                                            <td class="product-remove">
                                                <a title="Remove this item" class="remove" onclick="return confirm('hapus barang dari keranjang ?')" href="{{url('/hapuskeranjang/'.$barang->id)}}">×</a> 
                                            </td>


                                            <td class="product-name">
                                                {{$barang->barang}} 
                                            </td>
                                            <td class="product-name">
                                                {{$barang->varian}} 
                                            </td>
                                            <td class="product-price">
                                                <span class="amount">{{"Rp ". number_format($barang->harga,0,',','.')}}</span> 
                                            </td>

                                            <td class="product-quantity">
                                                {{$barang->jumlah." Pcs"}}
                                            </td>
                                            <td class="product-quantity">
                                                @if($barang->diskon > 0)
                                                {{$barang->diskon." %"}}
                                                @else
                                                -
                                                @endif
                                            </td>
                                            <td class="product-subtotal">
                                                {{"Rp ". number_format($barang->total,0,',','.')}} 
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td class="actions" colspan="7">
                                               
                                               <a href="{{url('/belisekarang')}}">
                                                   <button type="button" class="tombol">
                                                    Beli Sekarang
                                                </button>
                                               </a>
                                                

                                                <button onclick="window.history.go(-1);" type="button" class="tombol-merah">
                                                    Kembali
                                                </button>
                                                
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                        </div>                        
                    </div>                    
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2>Maaf, Keranjang Anda Kosong</h2>
                </div>
            </div>
        </div>
    </div>
    @endif
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
  