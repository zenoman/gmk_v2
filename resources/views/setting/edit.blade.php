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
                    <h1 class="page-header">Edit Data Setting</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                     @if (session('status'))
                    <div class="alert alert-success alert-dismissable">
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
                                    @foreach($setting as $row)
                                    <form action="/setting/{{$row->idsettings}}" role="form" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Nama Web</label>
                                            <input type="text" class="form-control" name="webname" value="{{$row->webName}}">
                                        </div>
                                         @if($errors->has('webname'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('webname')}}
                                         </div>
                                       @endif
                                      <div class="row">
                                           <div class="col-md-4 form-group">
                                            <label>Kontak1</label>
                                            <div class="form-group input-group">
                                            <span class="input-group-addon">+62</span>
                                            <input 
                                            type="text" 
                                            class="form-control" 
                                            name="kontak1" 
                                            value="{{substr($row->kontak1,3)}}" 
                                            onkeypress="return isNumberKey(event)" 
                                            required>

                                            </div>
                                            
                                         @if($errors->has('kontak1'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('kontak1')}}
                                         </div>
                                       @endif
                                        </div>

                                        <div class="col-md-4 form-group">
                                            <label>Kontak2</label>
                                            <div class="form-group input-group">
                                            <span class="input-group-addon">+62</span>
                                            <input 
                                            type="text" 
                                            class="form-control" 
                                            name="kontak2" 
                                            value="{{substr($row->kontak2,3)}}" 
                                            onkeypress="return isNumberKey(event)" 
                                            required>

                                            </div>
                                             @if($errors->has('kontak2'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('kontak2')}}
                                         </div>
                                       @endif
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label>Kontak3</label>
                                            <div class="form-group input-group">
                                            <span class="input-group-addon">+62</span>
                                            <input 
                                            type="text" 
                                            class="form-control" 
                                            name="kontak3" 
                                            value="{{substr($row->kontak3,3)}}" 
                                            onkeypress="return isNumberKey(event)" 
                                            required>
                                            </div>
                                            @if($errors->has('kontak3'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('kontak3')}}
                                         </div>
                                       @endif
                                        </div>
                                       </div>
                                         <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control" name="email" value="{{$row->email}}">
                                        </div>
                                         @if($errors->has('email'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('email')}}
                                         </div>
                                       @endif
                                       <div class="form-group">
                                            <label>Meta</label>
                                            <input type="text" class="form-control" name="meta" value="{{$row->meta}}">
                                        </div>
                                         @if($errors->has('meta'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('meta')}}
                                         </div>
                                       @endif

                                       <div class="form-group">
                                            <label>Batas hari Pemesana</label>
                                            <input type="text" class="form-control" name="kadaluarsa" value="{{$row->max_tgl}}" onkeypress="return isNumberKey(event)">
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <input type="text" class="form-control" name="alamat" value="{{$row->alamat}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Deskripsi</label>
                                            <textarea class="form-control" name="keterangan" rows="4">
                                                {{$row->keterangan}}
                                            </textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Peraturan Belanja</label>
                                            <textarea class="form-control" name="peraturan" rows="8" id="editor">
                                                {{$row->peraturan}}
                                            </textarea>
                                        </div>
                                             <div class="form-group">
                                            <label>Ganti Icon</label><p>
                                            <img src="{{asset('img/setting/'.$row->ico)}}" width="10%">
                                            <input type="file" name="ico" accept="image/*">
                                        </div>
                                        @if($errors->has('ico'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('ico')}}
                                         </div>
                                       @endif
                                             <div class="form-group">
                                            <label>Ganti Logo</label><p>
                                            <img src="{{asset('img/setting/'.$row->logo)}}" width="30%">
                                            <input type="file" name="logo" accept="image/*">
                                        </div>
                                          @if($errors->has('logo'))
                                       <div class="alert alert-danger">
                                        {{ $errors->first('logo')}}
                                         </div>
                                       @endif


                                         {{csrf_field()}}
                                      <div class="text-left">
                                        <input type="hidden" name="_method" value="PUT">
                                        <input class="btn btn-primary" type="submit" name="submit" value="simpan">
                                      
                          <a onclick="window.history.go(-1);" class="btn btn-danger">Kembali</a>  
                        </div>
                                    </form>
                                    @endforeach
                                </div>
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection
        @section('js')
        <script src="{{asset('assets/js/ckeditor.js')}}"></script>
  <script>
    ClassicEditor
    .create( document.querySelector('#editor'),{
        toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
            ]
        }
    })
    .catch( error => {
        console.log( error );
    } );
    </script>
        @endsection