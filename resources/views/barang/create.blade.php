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
                    <h1 class="page-header">Tambah Data Barang</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Isi Data Dibawah Ini Sesuai Perintah !
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
                                <div class="col-lg-12">
                                    <form action="/barang" role="form" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Kode Barang</label>
                                            <input type="text" class="form-control" name="kode_barang" value="{{$kode}}" readonly>
                                        </div>

                                        @if($errors->has('kode_barang'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('kode_barang')}}
                                         </div>
                                        @endif


                                        <div class="form-group">
                                            <label>Nama Barang</label>
                                            <input type="text" class="form-control" name="nama_barang" value="{{ old('nama_barang') }}" required>
                                        </div>
                                        @if($errors->has('nama_barang'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('nama_barang')}}
                                         </div>
                                        @endif
                                        <div class="form-group">
                                        <label>Kategori</label>
                                        <select class="form-control" name="kategori">
                                                @foreach($kategori as $kat)
                                                <option value="{{$kat->id}}-{{$kat->kategori}}">{{$kat->kategori}}</option>
                                                @endforeach
                                            </select>
                                               
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Deskripsi Barang</label>
                                            <textarea class="form-control" name="deskripsi" id="editor" rows="5"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Foto</label>
                                            <input type="file" class="form-control" name="photo[]" multiple required accept="image/*" id="photo">
                                            <p class="help-block">*Foto Tidak Lebih Dari 4 File dan berukuran kurang dari 3Mb</p> 
                                        </div>
                                         @if (session('errorfoto'))
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ session('errorfoto') }}
                    </div>
                    @endif      <label>Harga Jual Barang</label>
                                        <div class="form-group input-group">
                                            
                                            <span class="input-group-addon">Rp.</span>
                                            <input type="text" onkeypress="return isNumberKey(event)" class="form-control" name="harga_barang" value="{{ old('harga_barang') }}" required>

                                        </div>

                                        @if($errors->has('harga_barang'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('harga_barang')}}
                                         </div>
                                        @endif

                                         <label>Harga Jual Barang Reseller</label>
                                        <div class="form-group input-group">
                                        <span class="input-group-addon">Rp. </span>
                                        <input type="text" onkeypress="return isNumberKey(event)" class="form-control" name="harga_reseller" value="{{ old('harga_reseller')}}" required>
                                        </div>
                                        
                                        @if(Session::get('level')!='admin')
                                        
                                        
                                        <label>Harga Beli Barang</label>
                                        <div class="form-group input-group">
                                            
                                            <span class="input-group-addon">Rp.</span>
                                            <input type="text" onkeypress="return isNumberKey(event)" class="form-control" name="harga_beli" value="{{ old('harga_beli') }}" required>

                                        </div>
                                        @else
                                        <input type="hidden" name="harga_beli" value="0" required>
                                        @endif
                                        <label>Diskon Barang</label>
                                        <div class="form-group input-group">
                                            
                                            <input type="number" min="0" max="99" onkeypress="return isNumberKey(event)" class="form-control" name="diskon_barang" value="0" required>
                                            <span class="input-group-addon">%</span>
                                        </div>
                                        
                                        @if($errors->has('diskon_barang'))
                                        <div class="alert alert-danger">
                                        {{ $errors->first('diskon_barang')}}
                                         </div>
                                        @endif
                                        
                                        <hr>
                                       <div id="newlink">
                                        <div class="row">
                                        <div class="col-md-4 form-group">
                                        <label>Ukuran</label>
                                        <input type="text" name="warna[]" value="" class="form-control" required>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                        <label>Warna</label>
                                        <select class="form-control" name="variasi[]">
                                                @foreach($warna as $war)
                                                <option value="{{$war->kode_v}}">{{$war->kode_v}}-{{$war->varian}}</option>
                                                @endforeach
                                            </select>
                                               
                                        </div>
                                        </div>
                                        <div class="col-md-4 form-group">
                                        <label>Stok</label>
                                        <input type="text" onkeypress="return isNumberKey(event)" name="stok[]" value="" class="form-control" required>

                                        </div>
                                        </div>
                                         </div>


                                        {{csrf_field()}}
                                        <div id="addnew">
                                            <br>
                                            <div>
                                        <a href="javascript:new_link()" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Variasi</a>
                                    </div>
                                        </div>

                                        <br>
                                        <hr>
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
        <div id="newlinktpl" style="display:none" class="form-group">
            <hr>
             <div class="row">
                <div class="col-md-4 form-group">
                    <label>Ukuran</label>
                    <input type="text" name="warna[]" value="" class="form-control" required>
                </div>
            <div class="col-md-4">
                <div class="form-group">
                        <label>Warna</label>
                        <select class="form-control" name="variasi[]">
                        @foreach($warna as $war)
                            <option value="{{$war->kode_v}}">{{$war->kode_v}}-{{$war->varian}}</option>
                        @endforeach
                        </select>
                </div>
            </div>
                                        <div class="col-md-4 form-group">
                                        <label>Stok</label>
                                        <input type="text" onkeypress="return isNumberKey(event)" name="stok[]" value="" class="form-control" required>
                                        </div>
                                        </div>
        </div>
        @endsection

        @section('js')
         <script src="{{asset('assets/js/ckeditor.js')}}"></script>
        <script type="text/javascript">
         
var ct = 1;
function new_link()
{
    ct++;
    var div1 = document.createElement('div');
    div1.id = ct;
    // link to delete extended form elements
    var delLink = '<a href="javascript:delIt('+ ct +')" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus Variasi</a><br>';
    div1.innerHTML = document.getElementById('newlinktpl').innerHTML + delLink;
    document.getElementById('newlink').appendChild(div1);
}
// function to delete the newly added set of elements
function delIt(eleId)
{
    d = document;
    var ele = d.getElementById(eleId);
    var parentEle = d.getElementById('newlink');
    parentEle.removeChild(ele);
}
function validate(frm)
{
    var ele = frm.elements['feedurl[]'];
    if (! ele.length)
    {
        alert(ele.value);
    }
    for(var i=0; i<ele.length; i++)
    {
        alert(ele[i].value);
    }
    return true;
}
function add_feed()
{
    var div1 = document.createElement('div');
    div1.innerHTML = document.getElementById('newlinktpl').innerHTML;
    document.getElementById('newlink').appendChild(div1);
}

</script>
<script>
      ClassicEditor
    .create( document.querySelector( '#editor' ), {
        toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
            ]
        }
    } )
    .catch( error => {
        console.log( error );
    } );
    $('input[type="file"]').change(function(){
    var imageSizeArr = 0;
    var imageSize = document.getElementById('photo');
    var imageCount = imageSize.files.length;
    var jumlah = 0;
    for (var i = 0; i < imageSize.files.length; i++)
    {
        jumlah +=1;
         var imageSiz = imageSize.files[i].size;
         var imagename = imageSize.files[i].name;
         if (imageSiz > 3000000) {
             $('#test').text('3');
             var imageSizeArr = 1;
         }
         if (imageSizeArr == 1)
         {
             alert('Maaf, gambar "'+imagename+'" terlalu besar / memiliki ukuran lebih dari 3MB');
             $('#photo').val('');
         }
     }
     if (jumlah > 4){
        alert('Maaf, gambar lebih dari 4 file');
             $('#photo').val('');
     }
 }); 
    </script>
        @endsection



