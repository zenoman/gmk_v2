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
                    <h1 class="page-header">Kategori Artikel</h1>

                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">

                <div class="col-lg-8">
                    @if (session('status'))
                    <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ session('status') }}
                    </div>
                    @endif
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            List Data   
                        </div>
                        <!-- /.panel-heading -->

                        <div class="panel-body">

                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;?>
                                    @foreach($kategori as $row)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$row->nama}}</td>
                                        <td class="text-center">
                                        
                                      <form method="post" action="{{url('kategori-artikel/'.$row->id)}}">
                                            <input type="hidden" name="_method" value="DELETE">
                                            {{csrf_field()}}
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal{{$row->id}}">
                                                <i class="fa fa-wrench"></i> Edit
                                            </button>
                                            <button type="submit" onclick="return confirm('Hapus Data ?')" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> Hapus</button>
                                        </form>
                                                     
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
                <div class="col-lg-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Tambah Data
                        </div>
                        <!-- /.panel-heading -->

                        <div class="panel-body">
                            <form action="{{url('kategori-artikel')}}" method="POST">
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <input class="form-control" name="nama" placeholder="isikan nama kategori" required>
                                </div>
                                <div class="form-group">
                                    <label>Edit Data</label>
                                    <select class="form-control" name="status">
                                        <option value="Y">ya</option>
                                        <option value="N">tidak</option>
                                    </select>
                                </div>
                                {{csrf_field()}}
                                <button type="submit" class="btn btn-success btn-block">Simpan</button>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
        @foreach($kategori as $row)
        <div class="modal fade" id="myModal{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" id="myModalLabel">Edit Data</h4>
                                        </div>
                                        <div class="modal-body">
                                <form action="{{url('kategori-artikel/'.$row->id)}}" method="POST">
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <input class="form-control" name="nama" placeholder="isikan nama kategori" value="{{$row->nama}}" required>
                                  
                                </div>
                                <div class="form-group">
                                    <label>Edit</label>
                                    <select class="form-control" name="status">
                                        <option value="Y" @php if($row->edit=='Y'){ echo "selected";} @endphp >ya</option>
                                        <option value="N" @php if($row->edit=='N'){ echo "selected";} @endphp >tidak</option>
                                    </select>
                                </div>
                                <input type="hidden" name="_method" value="PUT">
                                        {{csrf_field()}}
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <button type="reset" class="btn btn-danger">Reset</button>
                            </form>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                        @endforeach
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