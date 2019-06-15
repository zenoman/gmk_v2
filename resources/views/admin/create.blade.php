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
</script>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tambah Data Admin</h1>
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
                                    <form action="{{url('/admin')}}" role="form" method="POST">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" class="form-control" placeholder="contoh : deva satrio" name="nama" value="{{ old('nama') }}" required>
                                        </div>

                                        @if($errors->has('nama'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('nama')}}
                                         </div>
                                        @endif


                                        <div class="form-group">
                                            <label>Username</label>
                                            <input type="text" class="form-control" placeholder="contoh : devasatrio" name="username" value="{{ old('username') }}" required pattern=".{8,}">
                                            <p class="help-block">*Minimal 8 karakter</p>
                                        </div>
                                        @if($errors->has('username'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('username')}}
                                         </div>
                                        @endif

                                        <label>Password</label>
                                        <div class="form-group input-group">
                                            
                                            <input type="password" class="form-control" name="password" required id="myPassword" pattern=".{8,}">
                                           <span class="input-group-addon" onmouseover="mouseoverPass();" onmouseout="mouseoutPass();"><i class="fa fa-eye"></i></span>
                                        </div>
                                         <p class="help-block">*Minimal 8 karakter</p>
                                        @if($errors->has('password'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('password')}}
                                         </div>
                                        @endif
                                        <label>Konfirmasi Password</label>
                                        <div class="form-group input-group">
                                            
                                            <input type="password" class="form-control" name="konfirmasi_password"  required id="myPassword1" pattern=".{8,}"> 
                                            <span class="input-group-addon" onmouseover="mouseoverPass1();" onmouseout="mouseoutPass1();"><i class="fa fa-eye"></i></span>
                                        </div>
                                        <p class="help-block">*Minimal 8 karakter</p>
                                        @if($errors->has('konfirmasi_password'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('konfirmasi_password')}}
                                         </div>
                                        @endif


                                        <div class="form-group">
                                            <label>No. Telfon</label>
                                            <input type="text" class="form-control" placeholder="Contoh : 085222333XXX" name="no_telfon" value="{{ old('no_telfon') }}" onkeypress="return isNumberKey(event)">
                                        </div required>
                                        @if($errors->has('no_telfon'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('no_telfon')}}
                                         </div>
                                        @endif

                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" placeholder="Contoh : email@example.com" name="email" value="{{ old('email') }}" required>
                                        </div>
                                        <div class="form-group">
                                        	<label>Level </label>
                                        	<select name="level" class="form-control">
                                        		<option value="admin">admin</option>
                                        		<option value="super_admin">super admin</option>
                                        		<option value="programer">programer</option>
                                        	</select>
                                        </div>
                                       @if($errors->has('email'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('email')}}
                                         </div>
                                       @endif
                                        {{csrf_field()}}
                                        <!--div class="form-group">
                                            <label>Selects</label>
                                            <select class="form-control">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div-->
                                        
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