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
                    <h1 class="page-header">List Cancel</h1>

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
                            List Data Barang Di Cancel
                        </div>
                        <div class="panel-body">
                            <a href="{{url('/pembelian/tambahcancel')}}" class="btn btn-primary">Tambah Data</a>
                            <a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-warning">Cetak Data</a>

                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" id="myModalLabel">Cetak Data</h4>
                                        </div>
                                        <div class="modal-body">
                                        <form action="{{url('/cetaklistcancel')}}" role="form" method="POST">
                                        <div class="form-group">
                                            <label>Bulan</label>
                                            <select name="bulan" class="form-control">
                                               @foreach($datatgl as $tgl)
                                                <option value="{{$tgl->bulan}}-{{$tgl->tahun}}">{{$tgl->bulan}}-{{$tgl->tahun}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        {{csrf_field()}}
                                        <button type="submit" class="btn btn-success">
                                            Cetak
                                        </button>
                                        </form>
                                        </div>
                                    </div>
                                    </div>
                                    </div>  
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Total</th>
                                        <th>Tanggal</th>
                                        <th>Pembatal</th>
										
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;?>
                                    @foreach($listcancel as $row)
                                    <?php $no = $i++;?>
                                    <tr>
                                        <td>{{$no}}</td>
                                         
                                        <td>
                                        {{$row->barang_jenis}}
                                        </td>
                                        <td>
                                            {{$row->jumlah}} Pcs
                                        </td>
                                        <td>
                                            {{$row->harga}}
                                        </td>
                                        <td>
                                            {{$row->total}}
                                        </td>
                                        <td>{{$row->tgl}}</td>
                                        <td>{{$row->username}}</td>
                                        
                                    </tr>
                                   @endforeach
                                </tbody>
                            </table>
                            {{ $listcancel->links() }}
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
            responsive: true,
            "paging":false
        });
    });
  
    </script>
        @endsection
