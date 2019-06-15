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
                    <h1 class="page-header">Rekening Toko</h1>

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
                   @if(Session::get('level') != 'admin')
                   <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-pencil"></i> Tambah Data
                        </div>
                        <div class="panel-body">
                        	<div class="row">
                        		<div class="col-lg-12">
                        			<form role="form" method="POST" action="bank">
                                        <div class="form-group">
                                            <label>Nama Bank</label>
                                            <input class="form-control" name="bank" type="text" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Rekening</label>
                                            <input class="form-control" name="rekening" type="text" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Atas Nama</label>
                                            <input class="form-control" name="atasnama" type="text" required>
                                        </div>
                                        {{csrf_field()}}
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </form>
                                </div>
                        	</div>
                        </div>
                    </div>
                   @endif
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            List Data Rekening
                        </div>
                        <div class="panel-body table-responsive">
                        <table width="100%" class="table" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Bank</th>
                                        <th>Rekening</th>
                                        <th>Atas Nama</th>
                                        @if(Session::get('level') != 'admin')
                                        <th class="text-center">Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;?>
                                    @foreach($databank as $row)
                                    <?php $no = $i++;?>
                                    <tr>
                                    	<td>{{$no}}</td>
                                       <td>{{$row->nama_bank}}</td>
                                        <td>{{$row->rekening}}</td>
                                        <td>{{$row->atasnama}}</td>
                                        @if(Session::get('level') != 'admin')
                                        <td class="text-center">
                                       <div class="modal fade" id="myModal{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Edit Data</h4>
                                        </div>
                                        <form method="POST" action="bank/{{$row->id}}">

                                        <div class="modal-body">
                                            <div class="row">
                                            	<div class="col-md-12">
                                        <div class="form-group">
                                            <label>Nama Bank</label>
                                            <input class="form-control" name="bank" type="text" required value="{{$row->nama_bank}}">
                                        </div>
                                        <br><br>
                                        </div>
                                        <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Rekening</label>
                                            <input class="form-control" name="rekening" type="text" required value="{{$row->rekening}}">
                                        </div>
                                        
                                        {{ csrf_field() }}
                                       <input type="hidden" name="_method" value="PUT">
                                       <br><br>
                                   			</div>
                                            <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Atas Nama</label>
                                            <input class="form-control" name="atasnama" type="text" required value="{{$row->atasnama}}">
                                        </div>
                                        </div>
                                   		</div>
                                        </div>
                                        <div class="modal-footer">

                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </div>
                                        </form>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                                        <form method="post" action="bank/{{$row->id}}">
                                            <input type="hidden" name="_method" value="DELETE">
                                            {{csrf_field()}}
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal{{$row->id}}">
                                        <i class="fa fa-wrench"></i> Edit</button>
                                            <button type="submit" onclick="return confirm('Hapus Data ?')" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> Hapus</button>
                                        </form>
                                        </td>
                                        @endif
                                    </tr>
                                   @endforeach
                                </tbody>
                            </table>
                            <div class="text-right">
                          <a onclick="window.history.go(-1);" class="btn btn-danger">Kembali</a>  
                        </div>
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