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
                    <h1 class="page-header">Edit Data Artikel</h1>
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
                                    @foreach($artikel as $row)
                                    <form action="{{url('artikel/'.$row->id)}}" role="form" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Judul</label>
                                            <input type="text" class="form-control" name="judul" value="{{$row->judul}}" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Isi Artikel</label>
                                            <textarea name="isi" id="editor">{{$row->isi}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Kategori</label>
                                            <select class="form-control" name="kategori">
                                                @foreach($kategori as $row2)
                                                <option value="{{$row2->id}}" <?php if($row->id_kategori==$row2->id){echo "selected"; } ?>>{{$row2->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <img src="{{url('img/artikel/'.$row->gambar)}}" alt="">
                                        </div>
                                        <div class="form-group">
                                            <label>Ganti Gambar</label>
                                            <input type="file" name="foto" accept="image/*">
                                        </div>

                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="PUT">
                                        <input type="hidden" name="fotolama" value="{{$row->gambar}}">
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
        @section('js')
        <!-- DataTables JavaScript -->
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