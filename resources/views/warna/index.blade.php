@extends('layout.master')

@foreach($websettings as $webset)
@section('title',$webset->webName)
@section('favicon')
<link rel="shortcut icon" type="image" href="{{asset('img/setting/'.$webset->ico)}}">
@endsection
@endforeach

@section('css')
<link href="{{asset('assets/vendor/datatables-plugins/dataTables.bootstrap.css')}}" rel="stylesheet">

<link href="{{asset('assets/vendor/datatables-responsive/dataTables.responsive.css')}}" rel="stylesheet">
@endsection
@section('content')
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Warna</h1>

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
                            List Data Warna
                        </div>
                        <div class="panel-body table-responsive">
                            <a href="{{url('warna/create')}}" class="btn btn-primary">Tambah Data</a><br><br>
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Kode</th>
                                        <th>Warna</th>
                                        <th>Hex</th>
                                        @if(Session::get('level') != 'admin')
                                        <th class="text-center">Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;?>
                                    @foreach($data as $row)
                                    <?php $no = $i++;?>
                                    <tr>
                                    	<td>{{$no}}</td>
                                       <td>{{$row->kode_v}}</td>
                                        <td>{{$row->varian}}</td>
                                        <td>
                                        <span class="label label-default" style="background-color:{{$row->hex}};">
                                            {{$row->hex}}
                                        </span>
                                            
                                        </td>
                                        @if(Session::get('level') != 'admin')
                                        <td class="text-center">
                                       
                                        <form method="post" action="{{url('warna/'.$row->id)}}">
                                            <input type="hidden" name="_method" value="DELETE">
                                            {{csrf_field()}}
                                            <a href="{{url('warna/'.$row->id)}}" class="btn btn-success">
                                        <i class="fa fa-wrench"></i> Edit</a>
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