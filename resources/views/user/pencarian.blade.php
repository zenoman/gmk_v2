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
                    <h1 class="page-header">Hasil Pencarian "{{$cari}}"</h1>

                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <a onclick="window.history.go(-1);" class="btn btn-danger">Kembali</a>
            <br><br>
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
                            List Data User
                        </div>
                        <!-- /.panel-heading -->

                        <div class="panel-body">

                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Kota</th>
                                        <th>No. Telfon</th>
										<th class="text-center">Status</th>
                                        <th class="text-center">Aksi</th>
                                        <!--th>Level</th-->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;?>
                                    @foreach($datauser as $row)
                                    <?php $no = $i++;?>
                                    <tr>
                                        <td>{{$no}}</td>
                                       <td>{{$row->username}}</td>
                                        <td>{{$row->nama}}</td>
                                        <td>{{$row->email}}</td>
                                        <td>{{$row->kota}}</td>
                                        <td>{{$row->telp}}</td>
                                         <td class="text-center">
                                            @if($row->cancel < 3)
                                            <span class="label label-success">Aktif</span>
                                            @else
                                            <span class="label label-danger">Banned</span>
                                            @endif
                                        </td>
                                        <td class="text-center tooltip-demo">
                                        @if($row->cancel < 3)
                                            <a href="{{url('user/'.$row->id.'/banned')}}" class="btn btn-primary btn-sm" onclick="return confirm('Banned User ?')">
                                           <i class="fa fa-lock"></i>
                                            </a> 
                                            @else
                                            <a href="{{url('user/'.$row->id.'/unbanned')}}" class="btn btn-primary btn-sm" onclick="return confirm('Aktifkan User Kembali ?')">
                                           <i class="fa fa-unlock"></i>
                                            </a> 
                                            @endif   

                                        <a href="{{url('user/'.$row->id.'/changepass')}}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ganti Password">
                                            <i class="fa fa-key"></i>
                                        </a>
                                        <a href="{{url('user/'.$row->id)}}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit data">
                                        <i class="fa fa-wrench"></i></a>

                                        <a onclick="return confirm('Hapus Data ?')" href="{{url('user/'.$row->id.'/delete')}}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Hapus Data">
                                        <i class="fa fa-trash-o"></i></a>                                        
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
         // tooltip demo
    $('.tooltip-demo').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    })
    // popover demo
    $("[data-toggle=popover]")
        .popover()
    });
    </script>
        @endsection
