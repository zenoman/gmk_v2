@extends('layout/masteruser')
	
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
     <h1><a href="{{url('/')}}"><img src="{{asset('img/setting/'.$webset->logo)}}" style="width:70%;"></a></h1>
    @endforeach
    @endsection
    @section('content')
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Transaksi Saya</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
               <div class="col-md-12">
                    <div class="product-content-right">
                        <div class="woocommerce">
                                <table cellspacing="0" class="shop_table cart">
                                    <thead>
                                        <tr>
                                            <th class="product-name">Faktur</th>
                                            <th class="product-thumbnail">Tanggal</th>
                                            <th class="product-price">Total Harga</th>
                                            <th class="product-quantity">Status</th>
                                            <th class="product-quantity">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	@foreach($transaksis as $transaksi)
                                        <tr class="cart_item">
                                            
                                            <td class="product-name">
                                            	
                                                    <a href="#" data-toggle="modal" data-target="#myModal{{$transaksi->id}}" style="color:#d9534f;" class="text-primary">
                                                       {{$transaksi->faktur}} 
                                                    </a>
                            <div class="modal fade" id="myModal{{$transaksi->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" id="myModalLabel">Daftar Barang Yang Di beli</h4>
                                        </div>
                                        <div class="modal-body">
                                            @php
                                            $detailnya = DB::table('tb_details')
                                            ->select(DB::raw('tb_details.*,tb_barangs.warna,tb_varian.varian'))
                                            ->leftjoin('tb_barangs','tb_barangs.idbarang','=','tb_details.idwarna')
                                            ->leftjoin('tb_varian','tb_varian.kode_v','=','tb_details.kode_v')
                                            ->where('faktur',$transaksi->faktur)
                                            ->get();
                                            @endphp
                                    <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                            Nama Barang</th>
                                            <th class="text-center">
                                            Warna</th>
                                            <th class="text-center">
                                            Jumlah</th>
                                            <th class="text-center">Harga</th>
                                            <th class="text-center">Diskon</th>
                                            <th class="text-center">Total</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($detailnya as $brg)
                                        <tr>
                                            <td>
                                                {{$brg->barang}}
                                            </td>
                                            <td>
                                                {{$brg->varian}}
                                            </td>
                                            <td>
                                                {{$brg->jumlah}} Pcs
                                            </td>
                                            <td>
                                                {{"Rp ". number_format($brg->harga,0,',','.')}}
                                            </td>
                                            <td>
                                                @if($brg->diskon > 0)
                                                {{$brg->diskon}} %
                                                @else
                                                -
                                                @endif
                                            </td>
                                            <td>
                                                {{"Rp ". number_format($brg->total,0,',','.')}}
                                            </td>
                                        </tr>
                                    @endforeach
                                        @if($transaksi->total_akhir=='')
                                        <tr>
                                            <td colspan="5">Subtotal</td>
                                            <td><b>
                                                {{"Rp ". number_format($transaksi->total,0,',','.')}}
                                            </b></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5">Ongkir</td>
                                            <td> - </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5">Potongan</td>
                                            <td> - </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5">Total</td>
                                            <td> - </td>
                                        </tr>
                                        @else
                                        <tr>
                                            <td colspan="5">Subtotal</td>
                                            <td>
                                                <b>
                                                {{"Rp ". number_format($transaksi->total,0,',','.')}}
                                            </b>
                                        </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5">Ongkir</td>
                                            <td><b>
                                                {{"Rp ". number_format($transaksi->ongkir,0,',','.')}}
                                            </b></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5">Potongan</td>
                                            <td><b>
                                                {{"Rp ". number_format($transaksi->potongan,0,',','.')}}
                                            </b></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5">Total</td>
                                            <td><b>
                                                {{"Rp ". number_format($transaksi->total_akhir,0,',','.')}}
                                            </b></td>
                                        </tr>
                                        @endif
                                        
                                    </tbody>
                                        </table>
                                        
                                        </div>

                                    </div>
                                </div>
                            </div>
                                    
                                            </td>
                                    <td class="product-name">
                                            	{{$transaksi->tgl}}
                                            </td>
                                            <td class="product-quantity">
                                            	<span class="amount">
                                                @if($transaksi->total_akhir=='')
                                            	{{"Rp ". number_format($transaksi->total,0,',','.')}}
                                                @else
                                                {{"Rp ". number_format($transaksi->total_akhir,0,',','.')}}
                                                @endif
                                                </span>
                                            </td>
                                            <td class="product-price">
                                                <span class="amount">
                                                    @if($transaksi->status=='dibaca' || $transaksi->status=='terkirim')
                                                    Menunggu Persetujuan
                                                    @else
                                                    {{$transaksi->status}}
                                                    @endif
                                            	</span> 
                                            </td>
                                            <td>
                                                @if($transaksi->status=='terkirim' || $transaksi->status=='dibaca')
                                                <button data-toggle="modal" data-target="#Modal{{$transaksi->id}}" class="tombol-merah">Batal</button>
                            <div class="modal fade " id="Modal{{$transaksi->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" id="myModalLabel">Batalkan Pembelian</h4>
                                        </div>
                                        <div class="modal-body text-left">
                                            <form action="/transaksi/tolak" method="post">
                                                 <label>Keterangan</label>
                                            <textarea name="keterangan" class="form-control" rows="3" cols="75"></textarea>
                                             <input type="hidden" value="{{$transaksi->id}}" name="kode">
                                            <input type="hidden" value="{{Session::get('user_id')}}" name="iduser">
                                            <p class="help-block text-left">Masukan Keterangan Pembatalan Transaksi</p>
                                            {{csrf_field()}}
                                            <button type="submit" class="tombol" onclick="return confirm('Batalkan Transaksi ?')">Kirim</button>    
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                                                @elseif($transaksi->status=='diterima')

                                                <button data-toggle="modal" data-target="#Modalbayar{{$transaksi->id}}" class="tombol">
                                                    Cara Bayar
                                                </button>  
                                                <div class="modal fade " id="Modalbayar{{$transaksi->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" id="myModalLabel">Cara Bayar</h4>
                                        </div>
                                        <div class="modal-body text-left">
                                            @php
                                            $metodebayar = DB::table('tb_bank')
                                            ->where('id',$transaksi->pembayaran)
                                            ->get();
                                            @endphp
                                            @foreach($metodebayar as $mtd)
                                                @if($transaksi->pembayaran>1)
                                                <ol>
                                                    <li>Transfer ke bank <b>{{$mtd->nama_bank}}</b> dengan nomer rekening <b>{{$mtd->rekening}}</b> juga dengan atas nama <b>{{$mtd->atasnama}}</b></li>
                                                    <li>Tulis Faktur di berita transfer, yaitu <b>{{$transaksi->faktur}}</b>.</li>
                                                    <li>Konfirmasi pembayaran dengan salah satu admin cp kami di tab hubungi kami.</li>
                                                    <li>Setelah di cek tranferan anda, barang akan di kirim oleh admin kami.</li>
                                                    <li>Tunggu kedatangan barang & happy shoping</li>
                                                </ol>
                                                
                                                @else
                                                <ol>
                                                    <li>Pergi Ketoko</li>
                                                    <li>Tujukan Nomer Faktur Pembelian, Yaitu "<b>{{$transaksi->faktur}}</b>"</li>
                                                    <li>Bayar Sesuai Total Pembelian</li>
                                                    <li>Happy Shopping</li>
                                                </ol>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $transaksis->links() }}
                                <div class="woocommerce-info">NB: Pastikan Menyertakan Faktur Pada Berita Transfer. Jika Ada yang Keluhan Atau Kurang Jelas, Hubungi CP Kami Di Tab Hubungi Kami 
                            	</div>
                                 <div class="woocommerce-info">Info : Akun anda akan otomatis terkena banned / pembekuan akun apabila mencancel pesanan sejumlah 3 kali 
                                </div>
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