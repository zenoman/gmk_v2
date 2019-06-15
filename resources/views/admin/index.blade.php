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
                    <h1 class="page-header">Admin</h1>

                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">

                <div class="col-lg-12">
                    @if (session('status'))
                    <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ session('status') }}
                    </div>
                    @endif
                    <a href="{{url('admin/create')}}" class="btn btn-primary"><i class="fa fa-pencil"></i> Tambah Data</a>
                    <br><br>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            List Data Admin
                        </div>
                        <!-- /.panel-heading -->

                        <div class="panel-body">

                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>No. Telfon</th>
                                        <th>Level</th>
                                        <th class="text-center">Aksi</th>
                                        <!--th>Level</th-->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;?>
                                    @foreach($admin as $row)
                                    <?php $no = $i++;?>
                                    @if(Session::get('iduser')!=$row->id)
                                    <tr>
                                        <td>{{$no}}</td>
                                        <td>{{$row->nama}}</td>
                                        <td>{{$row->email}}</td>
                                        <td>{{$row->telp}}</td>
                                        <td>{{$row->level}}</td>
                                        <td class="text-center">
                                        	
                                        @if(Session::get('level') == 'super_admin')
                                            @if($row->level=='programer')
                                            -
                                        @else
                                        
                                        <a href="{{url('admin/'.$row->id.'/changepass')}} " class="btn btn-warning btn-sm">
                                        <i class="fa fa-key"></i> Ganti Password</a>

                                        <a href="{{url('admin/'.$row->id)}}" class="btn btn-success btn-sm">
                                        <i class="fa fa-wrench"></i> Edit</a>

                                        <a onclick="return confirm('Hapus Data ?')" href="{{url('admin/'.$row->id.'/delete')}}" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash-o"></i> Hapus</a>                  @endif                      @else
                                        <a href="{{url('admin/'.$row->id.'/changepass')}} " class="btn btn-warning btn-sm">
                                        <i class="fa fa-key"></i> Ganti Password</a>

                                        <a href="{{url('admin/'.$row->id)}}" class="btn btn-success btn-sm">
                                        <i class="fa fa-wrench"></i> Edit</a>

                                        <a onclick="return confirm('Hapus Data ?')" href="{{url('admin/'.$row->id.'/delete')}}" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash-o"></i> Hapus</a>
                                                     @endif
                                                     
                                        </td>
                                    </tr>
                                    @endif
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