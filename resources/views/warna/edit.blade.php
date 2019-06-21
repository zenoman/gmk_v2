@extends('layout.master')

@foreach($websettings as $webset)
@section('title',$webset->webName)
@section('favicon')
<link rel="shortcut icon" type="image" href="{{asset('img/setting/'.$webset->ico)}}">
@endsection
@endforeach

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
                    <h1 class="page-header">Tambah Data Warna</h1>
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
                                    @foreach($data as $row)
                                    <form action="{{url('warna/'.$row->id)}}" role="form" method="POST">
                                        <div class="form-group">
                                            <label>Kode Warna</label>
                                            <input type="text" class="form-control" placeholder="contoh : 01, 02 dll" name="kode" required value="{{$row->kode_v}}">
                                            <input type="hidden"name="kode2" value="{{$row->kode_v}}">
                                        </div>

                                        @if($errors->has('kode'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('kode')}}
                                         </div>
                                        @endif


                                        <div class="form-group">
                                            <label>Label Warna</label>
                                            <input type="text" class="form-control" placeholder="contoh : merah, biru dll" name="label_warna" value="{{$row->varian}}" required>
                                            
                                        </div>
                                        <div class="form-group">
                                            <label>Hex</label>
                                            <input type="color" name="hex" value="{{$row->hex}}" required>
                                            <p class="help-block">*Minimal 8 karakter</p>
                                        </div>
                                        <input type="hidden" name="_method" value="PUT">
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