@extends('layout.master')

@foreach($websettings as $webset)
@section('title',$webset->webName)
@section('favicon')
<link rel="shortcut icon" type="image" href="{{asset('img/setting/'.$webset->ico)}}">
@endsection
@endforeach

@section('content')
<script>
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
    return false;

    return true;
}
</script>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Data User</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
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
                            <form action="/user/{{$datauser->id}}" role="form" enctype="multipart/form-data" method="POST">
                                        <!-- action="{{ url('myform/myform/') }}" -->
                                        <!-- action="{{ url('user/').$datauser->id}}" -->
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" class="form-control" name="nama" value="{{$datauser->nama}}" required>
                                        </div>
                                        @if($errors->has('nama'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('nama')}}
                                         </div>
                                        @endif

                                        <div class="form-group">
                                            <label>Username</label>
                                            <input type="text" class="form-control" name="username" value="{{$datauser->username}}" required>
                                        </div>
                                        @if($errors->has('username'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('username')}}
                                         </div>
                                        @endif
                                         <div class="form-group">
                                            <label>No. Telfon</label>
                                            <input type="text" class="form-control" value="{{$datauser->telp}}" name="no_telfon" onkeypress="return isNumberKey(event)" required>
                                        </div>
                                        @if($errors->has('no_telfon'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('no_telfon')}}
                                         </div>
                                        @endif

                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email" value="{{$datauser->email}}" required>
                                        </div>
                                       @if($errors->has('email'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('email')}}
                                         </div>
                                        @endif

                                        <div class="form-group">
                                        <label>Alamat</label>
                                        <textarea class="form-control" rows="3" name="alamat">{{ $datauser->alamat}}</textarea>
                                        </div>
                                        @if($errors->has('alamat'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('alamat')}}
                                         </div>
                                       @endif

                                        <div class="form-group">
                                            <label>Kota</label>
                                            <input type="text" class="form-control" placeholder="Contoh : Kediri" name="kota" value="{{$datauser->kota}}" required>
                                        </div>
                                          @if($errors->has('kota'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('kota')}}
                                         </div>
                                       @endif
                                        
                                        <div class="form-group">
                                            <label>Provinsi</label>
                                            <select class="form-control" name="provinsi">
                                           
                                       <option value="aceh" @if($datauser->provinsi=="aceh")selected @endif>Aceh</option>

                                        <option value="sumatera utara" @if($datauser->provinsi=="sumatera utara")selected @endif>Sumatera Utara</option>

                                        <option value="sumatera barat" @if($datauser->provinsi=="sumatera barat")selected @endif>Sumatera Barat</option>

                                        <option value="riau" @if($datauser->provinsi=="riau")selected @endif>Riau</option>

                                        <option value="kepuluan riau" @if($datauser->provinsi=="kepuluan riau")selected @endif>Kepulauan Riau</option>

                                        <option value="jambi" @if($datauser->provinsi=="jambi")selected @endif>Jambi</option>

                                        <option value="sumatera selatan" @if($datauser->provinsi=="sumatera selatan")selected @endif>Sumatera Selatan</option>

                                        <option value="bangka belitung" @if($datauser->provinsi=="bangka belitung")selected @endif>Bangka Belitung</option>

                                        <option value="bengkulu" @if($datauser->provinsi=="bengkulu")selected @endif>Bengkulu</option>

                                        <option value="lampung" @if($datauser->provinsi=="lampung")selected @endif>Lampung</option>

                                        <option value="jakarta" @if($datauser->provinsi=="jakarta")selected @endif>DKI Jakarta</option>

                                        <option value="jawa barat" @if($datauser->provinsi=="jawa barat")selected @endif>Jawa Barat</option>

                                        <option value="banten" @if($datauser->provinsi=="banten")selected @endif>Banten</option>

                                        <option value="jawa tengah" @if($datauser->provinsi=="jawa tengah")selected @endif>Jawa Tengah</option>

                                        <option value="yogyakarta" @if($datauser->provinsi=="yogyakarta")selected @endif>Yogyakarta</option>

                                        <option value="jawa timur" @if($datauser->provinsi=="jawa timur")selected @endif>Jawa Timur</option>

                                        <option value="bali" @if($datauser->provinsi=="bali")selected @endif>Bali</option>

                                        <option value="NTB" @if($datauser->provinsi=="NTB")selected @endif>NTB</option>

                                        <option value="NTT" @if($datauser->provinsi=="NTT")selected @endif>NTT</option>

                                        <option value="kalimantan utara" @if($datauser->provinsi=="kalimantan utara")selected @endif>Kalimantan Utara</option>

                                        <option value="kalimantan barat" @if($datauser->provinsi=="kalimantan barat")selected @endif>Kalimantan Barat</option>

                                        <option value="kalimantan tengah" @if($datauser->provinsi=="kalimantan tengah")selected @endif>Kalimantan Tengah</option>

                                        <option value="kalimantan selatan" @if($datauser->provinsi=="kalimantan selatan")selected @endif>Kalimantan Selatan</option>

                                        <option value="kalimantan timur" @if($datauser->provinsi=="kalimantan timur")selected @endif>Kalimantan Timur</option>

                                        <option value="sulawesi utara" @if($datauser->provinsi=="sulawesi utara")selected @endif>Sulawesi Utara</option>

                                        <option value="sulawesi barat" @if($datauser->provinsi=="sulawesi barat")selected @endif>Sulawesi Barat</option>

                                        <option value="sulawesi tengah" @if($datauser->provinsi=="sulawesi tengah")selected @endif>Sulawesi Tengah</option>

                                        <option value="sulawesi tenggara" @if($datauser->provinsi=="sulawesi tenggara")selected @endif>Sulawesi Tenggara</option>

                                        <option value="sulawesi selatan" @if($datauser->provinsi=="sulawesi selatan")selected @endif>Sulawesi Selatan</option>

                                        <option value="gorontalo" @if($datauser->provinsi=="gorontalo")selected @endif>Gorontalo</option>

                                        <option value="maluku"  @if($datauser->provinsi=="maluku")selected @endif>Maluku</option>

                                        <option value="maluku utara" @if($datauser->provinsi=="maluku utara")selected @endif>Maluku Utara</option>

                                        <option value="papua barat" @if($datauser->provinsi=="papua barat")selected @endif>Papua Barat</option>

                                        <option value="papua" @if($datauser->provinsi=="papua")selected @endif>Papua</option>
                                            </select>
                                        
                                        </div>

                                        <div class="form-group">
                                            <label>Kode Pos</label>
                                            <input type="text" class="form-control" placeholder="Contoh : 06" name="kode_pos" value="{{$datauser->kodepos}}" required onkeypress="return isNumberKey(event)">
                                        </div>
                                        @if($errors->has('kode_pos'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('kode_pos')}}
                                         </div>
                                       @endif
                                        <div class="form-group">
                                            <label>Level</label>
                                            <select name="level" class="form-control">
                                                <option @if($datauser->level=='biasa') selected @endif value="biasa">Penguna Biasa</option>
                                                <option @if($datauser->level=='reseller') selected @endif value="reseller">Reseller</option>
                                            </select>
                                        </div>
                                       <div class="form-group">
                                            <label>Ganti Gambar</label>
                                            <p>
                                            @if($datauser->ktp_gmb!='')
                                            <img src="../img/user/{{$datauser->ktp_gmb}}" width="100">
                                            @endif
                                            <p>
                                            <input type="file" name="gambar_ktp" accept="image/*">
                                        </div>
                                          @if($errors->has('gambar_ktp'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('gambar_ktp')}}
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