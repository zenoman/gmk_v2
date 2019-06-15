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
                    <h1 class="page-header">Edit Data Admin</h1>
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
                            Edit Data Dibawah Ini Sesuai Perintah !
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form action="{{url('/admin/'.$dataadmin->id)}}" role="form" method="POST">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" class="form-control" name="nama" value="{{$dataadmin->nama}}" required>
                                        </div>
                                        @if($errors->has('nama'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('nama')}}
                                         </div>
                                        @endif
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input type="text" class="form-control" value="{{$dataadmin->username}}" name="username" required pattern=".{8,}">
                                            <input type="hidden" value="{{$dataadmin->username}}" name="oldusername">
                                            <p class="help-block">*Minimal 8 karakter</p>
                                        </div>
                                        @if($errors->has('username'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('username')}}
                                         </div>
                                        @endif

                                        
                                        <div class="form-group">
                                            <label>No. Telfon</label>
                                            <input type="text" class="form-control" value="{{$dataadmin->telp}}" name="no_telfon" onkeypress="return isNumberKey(event)" required>
                                        </div>
                                        @if($errors->has('no_telfon'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('no_telfon')}}
                                         </div>
                                        @endif

                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email" value="{{$dataadmin->email}}" required>
                                        </div>
                                       @if($errors->has('email'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('email')}}
                                         </div>
                                        @endif
                                        <div class="form-grop">
                                            <label>Level</label>
                                            <select class="form-control" name="level">
                                                <option value="admin" @if($dataadmin->level=="admin")selected @endif>admin</option>
                                                <option value="super_admin" @if($dataadmin->level=="super_admin")selected @endif >super admin</option>
                                                <option value="programer" @if($dataadmin->level=="programer")selected @endif >programer</option>
                                            </select>
                                        </div>
                                        {{csrf_field()}}
                                        <br>
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