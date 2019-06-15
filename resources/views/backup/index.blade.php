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
                    <h1 class="page-header">Pilih Bulan Backup</h1>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Pilih bulan data yang akan di backup
                        </div> 
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form action="/tampilbackup" role="form" method="GET">
                                        
                                        <div class="form-group">
                                        	<label>Bulan </label>
                                        	<select name="bulan" class="form-control">
                                        		@php

                                                for($i=1;$i<=12;$i++){
                                                echo "<option value='$i'>$i</option>";
                                                }
                                                @endphp
                                        	</select>
                                        </div>
                                        <div class="form-group">
                                            <label>Tahun </label>
                                            <select name="tahun" class="form-control">
                                @php
                                    for($ii=2019;$ii<(int)date('Y')+2;$ii++){
                                        echo"<option value='".$ii."'>".$ii."</option>";
                                    }
                                @endphp
                                
                                </select>
                                        </div>
                                       @if($errors->has('email'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('email')}}
                                         </div>
                                       @endif
                                        {{csrf_field()}}
                                        <input class="btn btn-primary" type="submit" name="submit" value="Lanjut">
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