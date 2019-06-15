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
                    <h1 class="page-header">Pilih Pemasukan</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Pilih bulan laporan yang akan di tampilkan
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form action="/tampilpemasukan" role="form" method="GET">
                                        
                                        <div class="form-group">
                                        	<label>Bulan </label>
                                        	<select name="bulan" class="form-control">
                                        		@foreach($data as $row)
                                                <option value="{{$row->bulan}}-{{$row->tahun}}">{{$row->bulan}}-{{$row->tahun}}</option>
                                        		@endforeach
                                        	</select>
                                        </div>
                                       @if($errors->has('email'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('email')}}
                                         </div>
                                       @endif
                                        {{csrf_field()}}
                                        <input class="btn btn-primary" type="submit" name="submit" value="lanjut">
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