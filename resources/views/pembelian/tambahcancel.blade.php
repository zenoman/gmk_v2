@extends('layout.master')

@foreach($websettings as $webset)
@section('title',$webset->webName)
@section('favicon')
<link rel="shortcut icon" type="image" href="{{asset('img/setting/'.$webset->ico)}}">
@endsection
@endforeach
@section('css')
<link href="{{asset('assets/js/select2.min.css')}}" rel="stylesheet">
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
                    <h1 class="page-header">Tambah Data Cancel Barang</h1>
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
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Isi Data Dibawah Ini Sesuai Perintah !
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form action="{{url('/pembelian/tambahcancel')}}" role="form" method="POST">
                                        <div class="form-group">
                                            <label>Pembuat</label>
                                            <input type="text" class="form-control" value="{{Session::get('username')}}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Cari Barang</label>
                                            <!-- <input type="text" class="form-control" placeholder="contoh : deva satrio" name="nama" value="{{ old('nama') }}" required> -->
                                            <select class="form-control" id="caribarang" name="caribarang" autofocus>
                                                @foreach($barangs as $brg)
                                                <option value="{{$brg->barang_jenis}}-{{$brg->kode}}-{{$brg->idbarang}}">{{$brg->barang_jenis}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Jumlah</label>
                                            <input type="text" class="form-control" name="jumlah" required onkeypress="return isNumberKey(event)">
                                        </div>
                                        
                                        {{csrf_field()}}
                                        <input class="btn btn-primary" type="submit" name="submit" value="simpan">
                                        <a onclick="window.history.go(-1);" class="btn btn-danger">Kembali</a>
                                    </form>
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
    @section('js')
    <script src="{{asset('assets/js/select2.min.js')}}"></script>
    <script type="text/javascript">
        $("#caribarang").select2();
        </script>

    @endsection