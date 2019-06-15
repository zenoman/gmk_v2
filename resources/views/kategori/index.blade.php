@extends('layout.master')

@foreach($websettings as $webset)
@section('title',$webset->webName)
@section('favicon')
<link rel="shortcut icon" type="image" href="{{asset('img/setting/'.$webset->ico)}}">
@endsection
@endforeach

@section('css')
<!-- DataTables CSS -->
    <link href="{{asset('assets/vendor/datatables-plugins/dataTables.bootstrap.css')}}" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{{asset('assets/vendor/datatables-responsive/dataTables.responsive.css')}}" rel="stylesheet">
@endsection
@section('content')
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Kategori</h1>

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
                   <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-pencil"></i> Tambah Data
                        </div>
                        <div class="panel-body">
                        	<div class="row">
                        		<div class="col-lg-12">
                        			<form role="form" method="POST" action="/kategori" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Kategori</label>
                                            <input class="form-control" name="kategori" type="text" required>

                                            <p class="help-block">*Kategori Tidak Boleh Kosong</p>
                                        </div>

                                        <div class="form-group">
                                        	<label>Gambar Kategori</label>
                                            <input class="form-control" name="gambar_kategori" type="file" required accept="image/*">

                                            <p class="help-block">*Gambar Kategori Tidak Boleh Kosong</p>
                                        </div>
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </form>
                                </div>
                        		
                        	</div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            List Data Kategori
                        </div>
            
                        <div class="panel-body table-responsive">

                            <table width="100%" class="table" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Kategori</th>
                                        <th>Gambar</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;?>
                                    @foreach($kategori as $row)
                                    <?php $no = $i++;?>
                                    <tr>
                                    	<td>{{$no}}</td>
                                       <td>{{$row->kategori}}</td>
                                        <td>{{$row->gambar}}</td>
                                        <td class="text-center">
                                       
                                        <button class="btn btn-success" data-toggle="modal" data-target="#myModal{{$row->id}}">
                                        <i class="fa fa-wrench"></i> Edit</button>

                                        <div class="modal fade" id="myModal{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Edit Data</h4>
                                        </div>
                                        <form role="form" method="POST" action="/kategori/{{$row->id}}/update" enctype="multipart/form-data">

                                        <div class="modal-body">
                                            <div class="row">
                                            	<div class="col-md-12">
                                        <div class="form-group">
                                            <label>Kategori</label>
                                            <input class="form-control" name="kategori" type="text" required value="{{$row->kategori}}">

                                            <p class="help-block">*Kategori Tidak Boleh Kosong</p>
                                        </div>

                                        <br>

                                        <img src="{{asset('img/kategori/'.$row->gambar)}}" style="width: 20%;">
                                         <br>
                                        <div class="form-group">
                                        	<label>Ganti Gambar</label>
                                            <input class="form-control" name="gambar_kategori" type="file" accept="image/*">

                                        </div>
                                        {{ csrf_field() }}
                                       <input type="hidden" name="_method" value="PUT">
                                   			</div>
                                   		</div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                        </form>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                                        <a onclick="return confirm('Hapus Data ?')" href="{{url('kategori/'.$row->id.'/delete')}}" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash-o"></i> Hapus</a>                                        
                                        </td>
                                    </tr>
                                   @endforeach
                                </tbody>
                            </table>
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
        @endsection
         @section('js')
        <!-- DataTables JavaScript -->
        <script src="{{asset('assets/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('assets/vendor/datatables-plugins/dataTables.bootstrap.min.js')}}"></script>
        <script src="{{asset('assets/vendor/datatables-responsive/dataTables.responsive.js')}}"></script>
        <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>
        @endsection