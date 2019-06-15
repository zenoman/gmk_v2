@extends('layout.master')
@foreach($websettings as $webset)
@section('title',$webset->webName)
@section('favicon')
<link rel="shortcut icon" type="image" href="{{asset('img/setting/'.$webset->ico)}}">
@endsection
@endforeach

@section('css')
<!-- DataTables CSS -->
    <link href="{{asset('assets/vendor/datatables-plugins/dataTables.bootstrap.css')}}" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{{asset('assets/vendor/datatables-responsive/dataTables.responsive.css')}}" rel="stylesheet">
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
                    <h1 class="page-header">Detail Pembelian</h1>

                </div>
            </div>
            <div class="row">
                
                <div class="col-lg-12">
                    @foreach($kode as $kd)
                    <div class="well well-sm">
                        <h4>Faktur : {{$kd->faktur}}</h4>
                        <table>
                            <tr>
                                <td>Tanggal Beli</td>
                                <td>&nbsp;:&nbsp;{{$kd->tgl}}</td>
                            </tr>
                            <tr>
                               <td>Pembeli</td>
                                <td>&nbsp;:&nbsp;
                                  <span id="username_asli">
                                      @php
                                 $datauser = DB::table('tb_users')
                                 ->where('id',$kd->iduser)
                                 ->get();
                                 @endphp
                                 @foreach($datauser as $usr)
                                    {{$usr->username}}
                                 @endforeach
                                  </span>
                               
                                </td>
                            </tr>
                            <tr>
                                <td>Metode Pembayaran</td>
                                <td>&nbsp;:&nbsp;
                                    @php
                                 $databank = DB::table('tb_bank')
                                 ->where('id',$kd->pembayaran)
                                 ->get();
                                 @endphp
                                 @foreach($databank as $bank)
                                    {{$bank->nama_bank}}
                                 @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td>No Telp</td>
                                <td>&nbsp;:&nbsp;
                                  <span id="telp_asli">
                                    {{$kd->telp}}
                                  </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Alamat Tujuan</td>
                                <td>&nbsp;:&nbsp;
                                  <span id="alamat_asli">
                                    {{$kd->alamat_tujuan}}
                                  </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Keterangan</td>
                                <td>&nbsp;:&nbsp;{{$kd->keterangan}}</td>
                            </tr>
                        </table>
                    </div>
                    @endforeach
                    @if (session('status'))
                    <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ session('status') }}
                    </div>
                    @endif
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            List barang yang dibeli
                        </div>
                        <div class="panel-body">

                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Warna</th>
                                        <th>Jumlah</th>
                                        <th>harga</th>
                                        <th>diskon</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                     $no =1;
                                    @endphp
                                    @foreach($data as $row)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$row->kode_barang}}</td>
                                        <td>{{$row->barang}}</td>
                                        <td>{{$row->varian}}</td>
                                        <td>{{$row->jumlah}} Pcs</td>
                                        <td class="text-right">{{"Rp ". number_format($row->harga,0,',','.')}}</td>
                                        <td>{{$row->diskon}}%</td>
                                        <td class="text-right">
                                            {{"Rp ". number_format($row->total,0,',','.')}}
                                        </td>
                                    </tr>
                                     @endforeach
                                </tbody>
                              </table>
                            <div class="well well-sm text-right">

                                <h4><b>Subtotal</b> : {{"Rp ". number_format($kd->total,0,',','.')}}</h4>
                                <h4><b>Potongan</b> : {{"Rp ". number_format($kd->potongan,0,',','.')}}</h4>
                                <h4><b>Ongkir</b> : {{"Rp ". number_format($kd->ongkir,0,',','.')}}</h4>
                                <h3><b>Total Akhir</b> : {{"Rp ". number_format($kd->total_akhir,0,',','.')}}</h3>
                             </div>
                              <button id="btncetak" class="btn btn-primary">
                                cetak nota
                             </button>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        Cetak lembar pengiriman
                        </div>
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#home" data-toggle="tab" aria-expanded="true">Pembeli Biasa</a>
                                </li>
                                <li class=""><a href="#profile" data-toggle="tab" aria-expanded="false">Reseller</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="home">
                                    <h4>Lembar Pengiriman Pembeli Biasa</h4>
                                    <div class="form-group">
                                            <label>Penerima</label>
                                            <input class="form-control" id="penerima">
                                            <p class="help-block">Opsional, bila kosong data penerima akan di isi oleh nama pembeli.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Telfon Penerima</label>
                                            <input class="form-control" id="telfonpenerima" onkeypress="return isNumberKey(event)">
                                            <p class="help-block">Opsional, bila kosong data telfon penerima akan di isi oleh telfon akun pembeli.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat Penerima</label>
                                            <textarea class="form-control" rows="3" id="alamat"></textarea>
                                             <p class="help-block">Opsional, bila kosong data alamat penerima akan di isi oleh alamat yang di isi pembeli saat melakukan pembelian.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Keterangan Paket</label>
                                            <textarea class="form-control" rows="3" id="keterangan"></textarea>
                                             <p class="help-block">Sangat berguna bagi pihak pengiriman barang untuk mengerti isi paket, agar paket diperlakukan lebih berhati-hati.</p>
                                        </div>
                                             
                             <button class="btn btn-success" id="btncetakpengiriman">
                                 cetak lembar pengiriman
                             </button>
                             <button class="btn btn-warning" id="btnbersih">
                                bersih
                             </button>
                             <a onclick="window.history.go(-1);" class="btn btn-danger pull-right">Kembali</a>
                                </div>
                                <div class="tab-pane fade" id="profile">
                                    <h4>Lembar Pengiriman Reseller</h4>
                                    <div class="row">
                                     <div class="form-group col-md-6">
                                            <label>Pengirim</label>
                                            <input class="form-control" id="r_pengirim">
                                            <p class="help-block">Opsional, bila kosong data penerima akan di isi oleh nama pembeli.</p>
                                        </div>
                                     <div class="form-group col-md-6">
                                            <label>Penerima</label>
                                            <input class="form-control" id="r_penerima">
                                            <p class="help-block">*Wajib di isi</p>
                                        </div>
                                    <div class="form-group col-md-6">
                                            <label>Telfon Pengirim</label>
                                            <input class="form-control" id="r_telfonpengirim" onkeypress="return isNumberKey(event)">
                                            <p class="help-block">bila kosong data telfon penerima di isi dengan telfon akun pembeli.</p>
                                        </div>
                                      <div class="form-group col-md-6">
                                            <label>Telfon Penerima</label>
                                            <input class="form-control" id="r_telfonpenerima" onkeypress="return isNumberKey(event)">
                                            <p class="help-block">*Wajib di isi</p>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Alamat Pengirim</label>
                                            <textarea class="form-control" rows="3" id="r_alamatpengirim"></textarea>
                                             <p class="help-block">bila kosong data alamat penerima akan di isi oleh alamat yang di isi pembeli saat melakukan pembelian.</p>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Alamat Penerima</label>
                                            <textarea class="form-control" rows="3" id="r_alamatpenerima"></textarea>
                                             <p class="help-block">Opsional, bila kosong data alamat penerima akan di isi oleh alamat yang di isi pembeli saat melakukan pembelian.</p>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Keterangan Paket</label>
                                            <textarea class="form-control" rows="3" id="r_keterangan"></textarea>
                                             <p class="help-block">Sangat berguna bagi pihak pengiriman barang untuk mengerti isi paket, agar paket diperlakukan lebih berhati-hati.</p>
                                        </div>
                                             
                             
                                    </div>
                                    <button class="btn btn-success" id="r_btncetakpengiriman">
                                 cetak lembar pengiriman
                             </button>
                             <button class="btn btn-warning" id="r_btnbersih">
                                bersih
                             </button>
                             <a onclick="window.history.go(-1);" class="btn btn-danger pull-right">Kembali</a> 
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="hidden_div_reseller" style="display: none;">
            <div style="border-style: solid;">
                <br>
                @foreach($kode as $kd)
                <table width="100%">
                    <tr>
                        <td width="20%">
                            <b>
                                Pengirim
                            </b>
                        </td>
                        <td width="3%">&nbsp;:&nbsp;</td>
                        <td id="r_cetakpengirim">
                             @php
                                 $datauser = DB::table('tb_users')
                                 ->where('id',$kd->iduser)
                                 ->get();
                                 @endphp
                                 @foreach($datauser as $usr)
                                    {{$usr->username}}
                                 @endforeach
                        </td>
                        
                    </tr>
                    <tr>
                        <td width="20%"><b>Alamat Pengirim</b></td>
                        <td width="3%">&nbsp;:&nbsp;</td>
                        <td id="r_cetakalamatpengirim">{{$kd->alamat_tujuan}}</td>
                    </tr>
                    <tr>
                        <td width="20%">
                        <b>No.Telpon Pengirim</b>
                        </td>
                        <td width="3%">&nbsp;:&nbsp;</td>
                        <td id="r_cetaktelppengirim">{{$kd->telp}}</td>
                    </tr>
                </table>
                @endforeach
                <hr>
                  <table width="100%">
                    <tr>
                        <td width="20%">
                            <b>
                              Penerima
                            </b>
                        </td>
                        <td width="3%">&nbsp;:&nbsp;</td>
                        <td id="r_cetakpenerima">
                            
                        </td>
                        
                    </tr>
                    <tr>
                        <td width="20%"><b>Alamat Penerima</b></td>
                        <td width="3%">&nbsp;:&nbsp;</td>
                        <td id="r_cetakalamatpenerima"></td>
                    </tr>
                    <tr>
                        <td width="20%">
                        <b>No.Telpon Penerima</b>
                        </td>
                        <td width="3%">&nbsp;:&nbsp;</td>
                        <td id="r_cetaktelppenerima"></td>
                    </tr>
                </table>
                <p id="r_cetakketerangan"></p>
            </div>
        </div>
        <div id="hidden_div_pengiriman" style="display: none;">
            <div style="border-style: solid;">
                <br>
                @foreach($kode as $kd)
                <table width="100%">
                    <tr>
                        <td width="15%">
                            <b>
                                Kepada
                            </b>
                        </td>
                        <td width="3%">&nbsp;:&nbsp;</td>
                        <td id="cetakpenerima">
                             @php
                                 $datauser = DB::table('tb_users')
                                 ->where('id',$kd->iduser)
                                 ->get();
                                 @endphp
                                 @foreach($datauser as $usr)
                                    {{$usr->username}}
                                 @endforeach
                        </td>
                        
                    </tr>
                    <tr>
                        <td width="15%"><b>Alamat</b></td>
                        <td width="3%">&nbsp;:&nbsp;</td>
                        <td id="cetakalamat">{{$kd->alamat_tujuan}}</td>
                    </tr>
                    <tr>
                        <td width="15%">
                        <b>No.Telpon</b>
                        </td>
                        <td width="3%">&nbsp;:&nbsp;</td>
                        <td id="cetaktelp">{{$kd->telp}}</td>
                    </tr>
                </table>
                @endforeach
                <hr>
                <p id="cetakketerangan"></p>
               
                @foreach($websettings as $webset)
                <p align="center">
                <b>{{$webset->webName}}</b><br>
                <b>Pusat Grosir pakaian Terbaru, Termurah & Berkwalitas</b><br>
                <b>{{$webset->alamat}}</b><br>
                 kontak 1&nbsp;:&nbsp;{{$webset->kontak1}} ||
                 kontak 2&nbsp;:&nbsp;{{$webset->kontak2}} ||
                 kontak 3&nbsp;:&nbsp;{{$webset->kontak3}} 
                </p>
                @endforeach
                
            </div>
        </div>
        <div id="hidden_div" style="display: none;">
                    @foreach($kode as $kd)
                        <table width="100%">
                            <tr>
                                <td><b>Faktur</b></td>
                                <td>&nbsp;:&nbsp;</td>
                                <td>{{$kd->faktur}}</td>
                                <td align="right">
                                    <b>Pencetak</b>
                                </td>
                                <td>&nbsp;:&nbsp;</td>
                                <td align="right">{{Session::get('username')}}</td>
                            </tr>
                            <tr>
                                <td><b>Tanggal Beli</b></td>
                                <td>&nbsp;:&nbsp;</td>
                                <td>{{$kd->tgl}}</td>
                                <td align="right">
                                    <b>Pembayaran</b>
                                </td>
                                <td>&nbsp;:&nbsp;</td>
                                <td align="right">
                                    @php
                                 $databank = DB::table('tb_bank')
                                 ->where('id',$kd->pembayaran)
                                 ->get();
                                 @endphp
                                 @foreach($databank as $bank)
                                    {{$bank->nama_bank}}
                                 @endforeach
                                </td>
                            </tr>
                            <tr>
                               <td><b>Pembeli</b></td>
                                <td>&nbsp;:&nbsp;</td>
                                <td>
                                 @php
                                 $datauser = DB::table('tb_users')
                                 ->where('id',$kd->iduser)
                                 ->get();
                                 @endphp
                                 @foreach($datauser as $usr)
                                    {{$usr->username}}
                                 @endforeach
                                </td>
                                <td align="right"><b>No.telp</b></td>
                                <td>&nbsp;:&nbsp;</td>
                                <td align="right">{{$kd->telp}}</td>                            </tr>
                            
                            <tr>
                                <td><b>Alamat Tujuan</b></td>
                                <td>&nbsp;:&nbsp;</td>
                                <td colspan="3">{{$kd->alamat_tujuan}}</td>
                                
                            </tr>
                            <tr>
                                <td><b>Keterangan</b></td>
                                <td>&nbsp;:&nbsp;</td>
                                <td colspan="3">{{$kd->keterangan}}</td>
                                
                            </tr>
                        </table>
                    @endforeach
                            <table width="100%" border="1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Warna</th>
                                        <th>Jumlah</th>
                                        <th>harga</th>
                                        <th>diskon</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                     $no =1;
                                    @endphp
                                    @foreach($data as $row)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$row->kode_barang}}</td>
                                        <td>{{$row->barang}}</td>
                                        <td>{{$row->varian}}</td>
                                        <td>{{$row->jumlah}} Pcs</td>
                                        <td class="text-right">{{"Rp ". number_format($row->harga,0,',','.')}}</td>
                                        <td>{{$row->diskon}}%</td>
                                        <td class="text-right">
                                            {{"Rp ". number_format($row->total,0,',','.')}}
                                        </td>
                                    </tr>
                                     @endforeach
                                </tbody>
                              </table>
                            <div align="right">
                            
                                <b>
                                <br>
                                Subtotal : {{"Rp ". number_format($kd->total,0,',','.')}}
                                <br>
                                Ongkir : {{"Rp ". number_format($kd->ongkir,0,',','.')}}
                                <br>
                                Total Akhir : {{"Rp ". number_format($kd->total_akhir,0,',','.')}}</b>
                             </div>
                             <hr>
                             @foreach($kode as $kd)
                         <table width="100%">
                            <tr>
                                <td><b>Faktur</b></td>
                                <td>&nbsp;:&nbsp;</td>
                                <td>{{$kd->faktur}}</td>
                                <td align="right">
                                    <b>Pencetak</b>
                                </td>
                                <td>&nbsp;:&nbsp;</td>
                                <td align="right">{{Session::get('username')}}</td>
                            </tr>
                            <tr>
                                <td><b>Tanggal Beli</b></td>
                                <td>&nbsp;:&nbsp;</td>
                                <td>{{$kd->tgl}}</td>
                                <td align="right">
                                    <b>Pembayaran</b>
                                </td>
                                <td>&nbsp;:&nbsp;</td>
                                <td align="right">
                                    @php
                                 $databank = DB::table('tb_bank')
                                 ->where('id',$kd->pembayaran)
                                 ->get();
                                 @endphp
                                 @foreach($databank as $bank)
                                    {{$bank->nama_bank}}
                                 @endforeach
                                </td>
                            </tr>
                            <tr>
                               <td><b>Pembeli</b></td>
                                <td>&nbsp;:&nbsp;</td>
                                <td>
                                 @php
                                 $datauser = DB::table('tb_users')
                                 ->where('id',$kd->iduser)
                                 ->get();
                                 @endphp
                                 @foreach($datauser as $usr)
                                    {{$usr->username}}
                                 @endforeach
                                </td>
                                <td align="right"><b>No.telp</b></td>
                                <td>&nbsp;:&nbsp;</td>
                                <td align="right">{{$kd->telp}}</td>                            </tr>
                            
                            <tr>
                                <td><b>Alamat Tujuan</b></td>
                                <td>&nbsp;:&nbsp;</td>
                                <td colspan="3">{{$kd->alamat_tujuan}}</td>
                                
                            </tr>
                            <tr>
                                <td><b>Keterangan</b></td>
                                <td>&nbsp;:&nbsp;</td>
                                <td colspan="3">{{$kd->keterangan}}</td>
                                
                            </tr>
                        </table>
                    @endforeach
                            <table width="100%" border="1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Warna</th>
                                        <th>Jumlah</th>
                                        <th>harga</th>
                                        <th>diskon</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                     $no =1;
                                    @endphp
                                    @foreach($data as $row)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$row->kode_barang}}</td>
                                        <td>{{$row->barang}}</td>
                                        <td>{{$row->varian}}</td>
                                        <td>{{$row->jumlah}} Pcs</td>
                                        <td class="text-right">{{"Rp ". number_format($row->harga,0,',','.')}}</td>
                                        <td>{{$row->diskon}}%</td>
                                        <td class="text-right">
                                            {{"Rp ". number_format($row->total,0,',','.')}}
                                        </td>
                                    </tr>
                                     @endforeach
                                </tbody>
                              </table>
                            <div align="right">
                            
                                <b>
                                <br>
                                Subtotal : {{"Rp ". number_format($kd->total,0,',','.')}}
                                <br>
                                Ongkir : {{"Rp ". number_format($kd->ongkir,0,',','.')}}
                                <br>
                                Total Akhir : {{"Rp ". number_format($kd->total_akhir,0,',','.')}}</b>
                             </div>
                             <hr>
        </div>
        @endsection
        @section('js')
        <!-- DataTables JavaScript -->
        <script src="{{asset('assets/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('assets/vendor/datatables-plugins/dataTables.bootstrap.min.js')}}"></script>
        <script src="{{asset('assets/vendor/datatables-responsive/dataTables.responsive.js')}}"></script>
        <script>
        //==================================================
        $('#btncetak').click(function(){
        
        var print_div = document.getElementById("hidden_div");
var print_area = window.open();
print_area.document.write(print_div.innerHTML);
print_area.document.close();
print_area.focus();
print_area.print();
print_area.close();
        
        });
        $('#btncetakpengiriman').click(function(){
        var foo = "bar";
        if(foo=="bar"){
        var isgood = confirm('Apakah data lembar pengiriman benar ?');
        if(isgood){
            if($('#penerima').val()!=''){
              $('#cetakpenerima').html($('#penerima').val());
            }else{
              $('#cetakpenerima').html($('#username_asli').html());
            }
            if($('#telfonpenerima').val()!=''){
                $('#cetaktelp').html($('#telfonpenerima').val());
            }else{
              $('#cetaktelp').html($('#telp_asli').html());
            }
            if($('#alamat').val()!=''){
              $('#cetakalamat').html($('#alamat').val());
            }else{
              $('#cetakalamat').html($('#alamat_asli').html());
            }
            if($('#keterangan').val()!=''){
              $('#cetakketerangan').html('<b>Keterangan : </b>'+$('#keterangan').val()+' <hr>');
            }else{
              $('#cetakketerangan').html('');
            }
         var print_div = document.getElementById("hidden_div_pengiriman");
var print_area = window.open();
print_area.document.write(print_div.innerHTML);
print_area.document.close();
print_area.focus();
print_area.print();
print_area.close();
        }
        }});

        $('#r_btncetakpengiriman').click(function(){
        var foo = "bar";
        if(foo=="bar"){
        var isgood = confirm('Apakah data lembar pengiriman benar ?');
        if(isgood){
          if($('#r_penerima').val()==''||$('#r_alamatpenerima').val()==''||$('#r_telfonpenerima').val()==''){
            alert('Maaf, Data Penerima Tidak Boleh Kosong !');
          }else{
            if($('#r_pengirim').val()!=''){
              $('#r_cetakpengirim').html($('#r_pengirim').val());
            }else{
              $('#r_cetakpengirim').html($('#username_asli').html());
            }
            if($('#r_telfonpengirim').val()!=''){
                $('#r_cetaktelppengirim').html($('#r_telfonpengirim').val());
            }else{
              $('#r_cetaktelppengirim').html($('#telp_asli').html());
            }
            if($('#r_alamatpengirim').val()!=''){
              $('#r_cetakalamatpengirim').html($('#r_alamatpengirim').val());
            }else{
              $('#r_cetakalamatpengirim').html($('#alamat_asli').html());
            }
            if($('#r_keterangan').val()!=''){
              $('#r_cetakketerangan').html('<hr> <b>Keterangan : </b>'+$('#r_keterangan').val());
            }else{
              $('#r_cetakketerangan').html('');
            }
            $('#r_cetakpenerima').html($('#r_penerima').val());
            $('#r_cetakalamatpenerima').html($('#r_alamatpenerima').val());
            $('#r_cetaktelppenerima').html($('#r_telfonpenerima').val());
            var print_div = document.getElementById("hidden_div_reseller");
            var print_area = window.open();
            print_area.document.write(print_div.innerHTML);
            print_area.document.close();
            print_area.focus();
            print_area.print();
            print_area.close();
          }
            
        }
        }});
        $('#btnbersih').click(function(){
            $('#penerima').val('');
            $('#telfonpenerima').val('');
            $('#alamat').val('');
        });
        $('#r_btnbersih').click(function(){
            $('#r_penerima').val('');
            $('#r_telfonpenerima').val('');
            $('#r_alamatpenerima').val('');
            $('#r_pengirim').val('');
            $('#r_telfonpengirim').val('');
            $('#r_alamatpengirim').val('');
            $('#r_keterangan').val('');
        });
        </script>
        @endsection