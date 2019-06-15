@extends('layout.master')
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
                    <h1 class="page-header">Tambah Stok Barang</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Isi Data Dibawah Ini Sesuai Perintah !
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    @foreach($barang as $row)
                                    <form action="/barang/tambahstok" role="form" method="POST">
                                        <div class="form-group">
                                            <label>Kode Barang</label>
                                            <input type="text" class="form-control" placeholder="contoh : deva satrio" name="kode_barang" value="{{$row->kode}}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Barang</label>
                                            <input type="text" name="nama_barang" class="form-control" value="{{$row->barang}}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Warna</label>
                                            <input type="text" name="warna" class="form-control" value="{{$row->warna}}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Stok saat ini</label>
                                            <input type="text" name="stok_lama" class="form-control" value="{{$row->stok}}" readonly>
                                        </div>
                                        <input type="hidden" name="idbarang" value="{{$row->idbarang}}">
                                        <hr>
                                        <div class="form-group">
                                            <label>Tambahkan Stok</label>
                                            <input type="text" name="stok" class="form-control" onkeypress="return isNumberKey(event)" required>
                                        </div>
                                        <input type="hidden" name="harga" value="{{$row->harga}}">
                                        {{csrf_field()}}
                                        <input class="btn btn-primary" type="submit" name="submit" value="simpan">
                                        <a onclick="window.history.go(-1);" class="btn btn-danger">Kembali</a>
                                    </form>
                                    @endforeach
                                </div>
                              
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
        @endsection