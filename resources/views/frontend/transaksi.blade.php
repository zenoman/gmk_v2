@extends('layout.masteruser')
@section('header')
    @foreach($websettings as $webset)
    <title>{{$webset->webName}}</title>
    <link rel="shortcut icon" type="image" href="{{asset('img/setting/'.$webset->ico)}}">
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
    @section('logo')
     @foreach($websettings as $webset)
     <h1><a href="{{url('/')}}"><img src="{{asset('img/setting/'.$webset->logo)}}"></a></h1>
    @endforeach
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
                        <h2>Beli Sekarang</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h3 id="order_review_heading">Daftar Belanja</h3>
                        <table class="shop_table">
                                        <thead>
                                            <tr>
                                                <th class="product-name">Product</th>
                                                <th class="product-total">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($barangs as $barang)
                                            <tr class="cart_item">
                                                <td class="product-name">
                                                    {{$barang->barang}} <strong class="product-quantity">× {{$barang->jumlah}} Pcs</strong> </td>
                                                <td class="product-total">
                                                    <span class="amount">{{"Rp ". number_format($barang->total,0,',','.')}}</span> </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>

                                            <tr class="cart-subtotal">
                                                <th>Subtotal</th>
                                                <td>
                                                    @foreach($subtotal as $st)
                                                    <strong>
                                                    <span class="amount">{{"Rp ". number_format($st->total,0,',','.')}}</span>    
                                                    </strong>
                                                    @endforeach
                                                </td>
                                            </tr>

                                            <tr class="shipping">
                                                <th>Ongkir</th>
                                                <td>
                                                    -
                                                </td>
                                            </tr>


                                            <tr class="order-total">
                                                <th>Total</th>
                                                <td>
                                                    -
                                                </td>
                                            </tr>

                                        </tfoot>
                                    </table>
                            <div class="woocommerce-info">NB: Estimasi ongkir akan di inputkan oleh admin setelah pengajuan pembelian diterima
                            </div>

                </div>
                
                <div class="col-md-4">
                    <div class="product-content-right">
                        <div class="woocommerce">
                            @foreach($datauser as $user)
                       <form enctype="multipart/form-data" action="{{url('aksibeli')}}" class="checkout" method="post" name="checkout">

                                <div id="customer_details" class="col2-set">
                                   
                                    <div class="col-2">
                                        <div class="woocommerce-shipping-fields">
                                            <h3 id="ship-to-different-address">
                        <label class="checkbox" for="ship-to-different-address-checkbox">Data Pembelian</label>
                        </h3>
                                            <div class="shipping_address" style="display: block;">
                                                 <p id="shipping_first_name_field" class="form-row form-row-first validate-required">
                                                    <label class="" for="shipping_first_name">Nama Pembeli
                                                    </label>
                                                    <input type="text" value="{{$user->nama}}" name="nama" class="input-text" readonly>
                                                </p>
                                                <p id="shipping_first_name_field" class="form-row form-row-first validate-required">
                                                    <label class="" for="shipping_first_name">Alamat Tujuan
                                                    </label>
                                                   <textarea cols="5" rows="2" id="order_comments" class="input-text " name="alamat">{{$user->alamat}}</textarea>
                                                </p>
                                                <p id="shipping_country_field" class="form-row form-row-wide address-field update_totals_on_change validate-required woocommerce-validated">
                                                    <label class="" for="shipping_country">Metode Pembayaran
                                                    </label>
                                                    <select class="country_to_state country_select" id="shipping_country" name="pembayaran">
                                                        @foreach($rekening as $rek)
                                                    <option value="{{$rek->id}}">{{$rek->nama_bank}}</option>
                                                        @endforeach
                                                        
                                                    </select>
                                                </p>

                                                 @foreach($subtotal as $stot)
                                            <input type="hidden" name="total" value="{{$stot->total}}">
                                            @endforeach
                                            </div>
                                           
                                            {{@csrf_field()}}
                                                <p id="order_comments_field" class="form-row notes">
                                                <label class="" for="order_comments">Keterangan(wajib di isi)</label>
                                                <textarea cols="5" rows="2" id="order_comments" class="input-text " name="keterangan" required="required" onfocus="this.value='';">
                                                </textarea>
                                            </p>
                                        </div>

                                    </div>

                                </div>

                                
                                <div id="order_review" style="position: relative;">
                                    <div id="payment">
                                       <div class="form-row place-order">
                                        @if($jumlah>0)
                                            <input type="submit" data-value="Place order" value="Ajukan Pembelian" id="place_order" name="woocommerce_checkout_place_order" class="button alt" onclick="return confirm('Apakah Data Sudah Benar ?')">
                                            @endif
                                            <button type="button" class="tombol-merah" onclick="window.history.go(-1);">
                                                Kembali
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            @endforeach
                        </div>                       
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
    @endsection