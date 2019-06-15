@extends('layout.master')

@foreach($websettings as $webset)
@section('title',$webset->webName)
@section('favicon')
<link rel="shortcut icon" type="image" href="{{asset('img/setting/'.$webset->ico)}}">
@endsection
@endforeach

@section('css')
<link href="{{asset('assets/js/select2.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/js/loading.css')}}" rel="stylesheet">
@endsection

@section('content')
<script type="text/javascript">
function isNumberKey(evt)
{
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
    return false;

    return true;
}
</script>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Transaksi Langsung</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                     @if (session('status'))
                    <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ session('status') }}
                    </div>
                    @endif
                    <div class="panel panel-default" >
                        <div class="panel-heading">
                            Isi Data Dibawah Ini Sesuai Perintah !
                        </div>
                        <div class="panel-body">
                            <div class="row loading-div" id="panelnya">
                                <div class="col-lg-12">
                                    <div class="row">
                                            <div class="col-md-6">
                                    <h3>Faktur : <span id="noresi"></span> </h3>
                                    </div>

                                    <div class="col-md-6">
                                    <div class="form-group">
                                            <label>Status Pembeli</label>
                                    <select class="form-control" id="s_pembeli">
                                        <option value="pb">Pembeli Biasa</option>
                                        <option value="rs">Reseller</option>
                                    </select>
                                        </div>
                                    </div>
                                    </div>
                                       <hr>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                            <label>Cari Barang</label>
                                    <select class="form-control" id="caribarang" autofocus>
                                    </select>
                                        </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                            <label>Cari Warna</label>
                                    <select class="form-control" id="carivarian">
                                        <option value="pw" data-stok="" selected disabled hidden>pilih Warna</option>
                                    </select>
                                        </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                            <label>Cari Ukuran</label>
                                    <select class="form-control" id="cariwarna">
                                        <option value="ph" data-stok="" selected disabled hidden>pilih Ukuran</option>
                                    </select>
                                        </div>
                                            </div>
                                            <div class="col-md-2">
                                                <label>Jumlah</label>
                                                <div class="form-group input-group">
                                            
                                            <input type="text" class="form-control" id="jumlah" onkeypress="return isNumberKey(event)">
                                        </div>
                                            </div>
                                            <div class="col-md-2">
                                                <label>&nbsp;</label>
                                                <div class="form-group input-group">
                                            
                                            <button class="btn btn-primary btn-sm" id="tambahbarang">Tambah</button>&nbsp;
                                             <button class="btn btn-danger btn-sm" type="button" id="bersihbtn">Bersih</button>
                                        </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                            <label>Nama Barang</label>
                                            <input type="text" class="form-control" readonly id="nama_barang">
                                        </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                            <label>Harga(Rp)</label>
                                            <input type="text" class="form-control" readonly id="harga">
                                        </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                            <label>Stok(Pcs)</label>
                                            <input type="text" class="form-control" readonly id="stok">
                                        </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                            <label>Diskon(%)</label>
                                            <input type="text" class="form-control" readonly id="diskon">
                                            <input type="hidden" id="kodebarangnya">
                                             <input type="hidden" id="barangjenis">
                                        </div>
                                            </div>
                                        </div>
                                       

                                        <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Nama Barang</th>
                                        <th class="text-center">Ukuran</th>
                                        <th class="text-center">Warna</th>
                                        <th class="text-right">Harga</th>
                                        <th class="text-center">Jumlah</th>
                                        <th class="text-center">Diskon</th>
                                        <th class="text-right">Subtotal</th>
                                    </tr>
                                </thead>
                                    <tbody id="tubuh">
                                        
                                    </tbody>
                                    <tfoot>
                                       <tr>
                                        <th colspan="7" class="text-right">
                                        <h4>
                                            total
                                        </h4>
                                        </th>
                                        <th class="text-right">
                                            <h4>
                                               <strong id="totalnya">
                                            -
                                        </strong> 
                                            </h4>
                                    </th>
                                    </tr> 
                                    </tfoot>
                                    
                                </table>
                            </div>
                             <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                            <label>Potongan Harga</label>
                                            <input type="text" class="form-control" id="potongan" value="0" onkeypress="return isNumberKey(event)">
                                        </div>
                                            </div>
                                        </div>
                            <input type="hidden" id="realtotal">
                            <button class="btn btn-success" id="btncetak">Cetak Nota</button>
                                       <button class="btn btn-primary" id="btnsimpan">Simpan</button>
                                        <a onclick="window.history.go(-1);" class="btn btn-danger">Kembali</a>
                                </div>
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="hidden_div" style="display: none;">
            <table width="100%">
                <tr>
                    <td width="49%">
                        <table width="100%" style="margin-bottom: 5px;">
                            <tr>
                                @foreach($websettings as $webset)
                                <td width="60%">
                                
                                <img width="65%" src="{{asset('img/setting/'.$webset->logo)}}">
                                
                                </td>
                                <td style="border: 1px solid black;" width="40%">
                                    <p style="font-size: 10;margin-left: 2%;margin-top: 2%;">Tgl :{{date('d/m/Y')}}</p>
                                    <p style="font-size: 10;margin-left: 2%;margin-bottom: 2%;">Tuan/Toko : {{$webset->webName}}</p>
                                </td>
                                @endforeach   
                            </tr>
                        </table>
                        <table width="100%" style="border-collapse:collapse;border: 1px solid black;margin-bottom: 5px;">
                            <tr>
                                @foreach($websettings as $webset)
                                <td align="center" bgcolor="#000000">
                                    <p style="color:white; font-size: 10;">{{$webset->kontak1}} || {{$webset->kontak2}} ||
                                    {{$webset->kontak3}}</p>
                                    
                                </td>
                                @endforeach
                                
                            </tr>
                        </table>
                        <table width="100%" style="border-collapse:collapse;border: 1px solid black;margin-bottom: 5px;">
                            <thead>
                                <td align="center" style="border: 1px solid black;">
                                    No
                                </td>
                                <td align="center" style="border: 1px solid black;">
                                    Banyak
                                </td>
                                <td align="center" style="border: 1px solid black;">
                                    Nama Barang
                                </td>
                                <td align="center" style="border: 1px solid black;">
                                    Harga
                                </td>
                                <td align="center" style="border: 1px solid black;">
                                    Jumlah
                                </td>
                            </thead>
                            <tbody id="datacetak">
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" style="border: 1px solid black;" align="center">subtotal</td>
                                    <td align="right" style="border: 1px solid black;"><span id="datatotal"></span></td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="border: 1px solid black;" align="center">Potongan</td>
                                    <td align="right" style="border: 1px solid black;"><span id="datapotongan"></span></td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="border: 1px solid black;" align="center">Total</td>
                                    <td align="right" style="border: 1px solid black;"><span id="datatotalakhir"></span></td>
                                </tr>
                            </tfoot>
                        </table>
                        <table width="100%">
                            <tr>
                                <td width="50%" align="center">
                                    <p style="font-size: 10;">Penerima</p>
                                    <br>
                                    <p style="font-size: 10;">.....................</p>
                                </td>
                                <td width="50%" align="center">
                                     <p style="font-size: 10;">Hormat Kami</p>
                                    <br>
                                    <p style="font-size: 10;">Yuni</p>
                                </td>
                                
                            </tr>
                        </table>
                        <table width="100%" style="border-collapse:collapse;border: 1px solid black;margin-bottom: 5px;">
                            <tr>
                                <td align="center" bgcolor="#000000">
                                    <p style="color: white; font-size: 8;">GROSIR|ECER|DROPSHIP|PUSAT PAKAIAN TERMURAH, TERBARU & BERKUALITAS DI TULUNGAGUNG</p>
                                    
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td width="2%">
                    <hr width="1" size="100%">
                    </td>
                    <td width="49%" bgcolor="#ffff99">
                         <table width="100%" style="margin-bottom: 5px;">
                            <tr>
                                @foreach($websettings as $webset)
                                <td width="60%">
                                
                                <img width="65%" src="{{asset('img/setting/'.$webset->logo)}}">
                                
                                </td>
                                <td style="border: 1px solid black;" width="40%">
                                    <p style="font-size: 10;margin-left: 2%;margin-top: 2%;">Tgl :{{date('d/m/Y')}}</p>
                                    <p style="font-size: 10;margin-left: 2%;margin-bottom: 2%;">Tuan/Toko : {{$webset->webName}}</p>
                                </td>
                                @endforeach  
                            </tr>
                        </table>
                        <table width="100%" style="border-collapse:collapse;border: 1px solid black;margin-bottom: 5px;">
                            <tr>
                                @foreach($websettings as $webset)
                                <td align="center" bgcolor="#000000">
                                    <p style="color:white; font-size: 10;">{{$webset->kontak1}} || {{$webset->kontak2}} ||
                                    {{$webset->kontak3}}</p>
                                    
                                </td>
                                @endforeach
                                
                            </tr>
                        </table>
                        <table width="100%" style="border-collapse:collapse;border: 1px solid black;margin-bottom: 5px;">
                            <thead>
                                <td align="center" style="border: 1px solid black;">
                                    No
                                </td>
                                <td align="center" style="border: 1px solid black;">
                                    Banyak
                                </td>
                                <td align="center" style="border: 1px solid black;">
                                    Nama Barang
                                </td>
                                <td align="center" style="border: 1px solid black;">
                                    Harga
                                </td>
                                <td align="center" style="border: 1px solid black;">
                                    Jumlah
                                </td>
                            </thead>
                            <tbody id="datacetak1">
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" style="border: 1px solid black;" align="center">total</td>
                                    <td align="right" style="border: 1px solid black;"><span id="datatotal1"></span></td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="border: 1px solid black;" align="center">Potongan</td>
                                    <td align="right" style="border: 1px solid black;"><span id="datapotongan1"></span></td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="border: 1px solid black;" align="center">Total</td>
                                    <td align="right" style="border: 1px solid black;"><span id="datatotalakhir1"></span></td>
                                </tr>
                            </tfoot>
                        </table>
                        <table width="100%">
                            <tr>
                                <td width="50%" align="center">
                                    <p style="font-size: 10;">Penerima</p>
                                    <br>
                                    <p style="font-size: 10;">.....................</p>
                                </td>
                                <td width="50%" align="center">
                                     <p style="font-size: 10;">Hormat Kami</p>
                                    <br>
                                    <p style="font-size: 10;">Yuni</p>
                                </td>
                                
                            </tr>
                        </table>
                        <table width="100%" style="border-collapse:collapse;border: 1px solid black;margin-bottom: 5px;">
                            <tr>
                                <td align="center" bgcolor="#000000">
                                    <p style="color: white; font-size: 8;">GROSIR|ECER|DROPSHIP|PUSAT PAKAIAN TERMURAH, TERBARU & BERKUALITAS DI TULUNGAGUNG</p>
                                    
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        @endsection
        @section('js')
        <script src="{{asset('assets/js/select2.min.js')}}"></script>
        <script src="{{asset('assets/js/loading.js')}}"></script>
        <script type="text/javascript">
        $("#caribarang").select2();
        </script>
        <script src="{{asset('assets/js/pembelianlangsung.js')}}"></script>
        @endsection