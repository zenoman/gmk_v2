@extends('layout.master')
@foreach($websettings as $webset)
@section('title',$webset->webName)
@section('favicon')
<link rel="shortcut icon" type="image" href="{{asset('img/setting/'.$webset->ico)}}">
@endsection
@endforeach
@section('content')
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Data Slider</h1>
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
                                    <form action="/slider/{{$slider->id}}" role="form" enctype="multipart/form-data" method="POST">
                                        
                                        <div class="form-group">
                                            <label>Judul</label>
                                            <input type="text" class="form-control" name="judul" value="{{ $slider->judul }}" required>
                                        </div>
                                        @if($errors->has('judul'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('judul')}}
                                         </div>
                                        @endif
                                        <img src="{{asset('img/slider/'.$slider->foto)}}" style="width:100%;height: 100%">
                                        <div class="form-group">
                                            <label>Ganti Gambar</label>
                                            <input type="file" name="gambar" accept="image/*">
                                        </div>
                                          @if($errors->has('gambar'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('gambar')}}
                                         </div>
                                       @endif
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="PUT">
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