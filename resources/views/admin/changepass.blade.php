@extends('layout.master')

@foreach($websettings as $webset)
@section('title',$webset->webName)
@section('favicon')
<link rel="shortcut icon" type="image" href="{{asset('img/setting/'.$webset->ico)}}">
@endsection
@endforeach

@section('content')
<script>
    function mouseoverPass(obj) {
  var obj = document.getElementById('myPassword');
  obj.type = "text";
}
function mouseoutPass(obj) {
  var obj = document.getElementById('myPassword');
  obj.type = "password";
}
 function mouseoverPass1(obj) {
  var obj = document.getElementById('myPassword1');
  obj.type = "text";
}
function mouseoutPass1(obj) {
  var obj = document.getElementById('myPassword1');
  obj.type = "password";
}
 function mouseoverPass2(obj) {
  var obj = document.getElementById('myPassword2');
  obj.type = "text";
}
function mouseoutPass2(obj) {
  var obj = document.getElementById('myPassword2');
  obj.type = "password";
}
</script>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Ganti Password Admin</h1>
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
                                    <form action="{{url('/admin/'.$dataadmin->id.'/changepass')}}" role="form" method="POST">
                                        
                                        <div class="form-group">
                                            <label>Konfirmasi Username</label>

                                            <input type="hidden" name="username" value="{{$dataadmin->username}}">

                                            <input type="text" class="form-control" name="konfirmasi_username" required>
                                            
                                            <p class="help-block">*Masukan Username user yang akan di ganti passwordnya</p>
                                        
                                        </div>
                                        @if($errors->has('konfirmasi_username'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('konfirmasi_username')}}
                                         </div>
                                        @endif

                                        <label>Konfirmasi Password</label>
                                        <div class="form-group input-group">
                                            
                                            <input type="hidden" name="password" value="{{$dataadmin->password}}" required>
                                       
                                            <input type="password" class="form-control" name="konfirmasi_password" required id="myPassword">
                                         <span class="input-group-addon" onmouseover="mouseoverPass();" onmouseout="mouseoutPass();"><i class="fa fa-eye"></i></span>
                                          
                                            
                                        </div>
                                          <p class="help-block">*Masukan password lama user yang akan diganti passwordnya</p>
                                          @if (session('errorpass1'))
                    <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ session('errorpass1') }}
                    </div>
                    @endif
                                        @if($errors->has('konfirmasi_password'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('konfirmasi_password')}}
                                         </div>
                                        @endif
                                        <hr>
                                         <label>Password Baru</label>
                                        <div class="form-group input-group">
                                           
                                            <input type="password" class="form-control" name="password_baru" required id="myPassword1" pattern=".{8,}">
                                              <span class="input-group-addon" onmouseover="mouseoverPass1();" onmouseout="mouseoutPass1();"><i class="fa fa-eye"></i></span>
                                        </div>
                                        <p class="help-block">*Minimal 8 karakter</p>
                                       @if($errors->has('password_baru'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('password_baru')}}
                                         </div>
                                        @endif
                                        <label>Konfirmasi Password Baru</label>
                                        <div class="form-group input-group">
                                            
                                            <input type="password" name="konfirmasi_password_baru" class="form-control" required id="myPassword2" pattern=".{8,}">
                                            <span class="input-group-addon" onmouseover="mouseoverPass2();" onmouseout="mouseoutPass2();"><i class="fa fa-eye"></i></span>
                                        </div>
                                        <p class="help-block">*Minimal 8 karakter</p>
                                        @if($errors->has('konfirmasi_password_baru'))
                                            <div class="alert alert-danger">
                                                {{$errors->first('konfirmasi_password_baru')}}
                                            </div>
                                            @endif
                                            @if (session('errorpass2'))
                    <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ session('errorpass2') }}
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