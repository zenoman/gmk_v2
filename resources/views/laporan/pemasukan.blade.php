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
                    <h1 class="page-header">Laporan Pemasukan Bulan {{$bulan}} Tahun {{$tahun}} </h1>

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
                    <a href="{{url('/cetakpemasukan/'.$bulan.'/'.$tahun)}}" class="btn btn-primary" target="_blank()"><i class="fa fa-print"></i> Print</a>

                    <a href="{{url('/exsportpemasukan/'.$bulan.'/'.$tahun)}}" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Exsport Excel</a>
                    <br><br>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            List Data Pengeluaran
                        </div>

                        <div class="panel-body">

                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>tanggal</th>
                                        <th>Faktur</th>
                                        <th>Pembeli</th>
                                        <th>Alamat Tujuan</th>
                                        <th>Metode Bayar</th>
                                        <th>Ongkir</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php 
                                    $i=1;
                                    @endphp
                                    @foreach($data as $row)
                                  <tr>
                                      <td>{{$i++}}</td>
                                      <td>{{$row->tgl}}</td>
                                      <td>{{$row->faktur}}</td>
                                      <td>{{$row->username}}</td>
                                      <td>{{$row->alamat_tujuan}}</td>
                                      <td>{{$row->nama_bank}}</td>
                                      <td>
                                          {{"Rp ".number_format($row->ongkir,0,',','.')}}
                                      </td>
                                      <td>
                                        {{"Rp ".number_format($row->total_akhir,0,',','.')}}
                                        </td>
                                  </tr>
                                  @endforeach
                                </tbody>
                            </table>
                            {{ $data->links() }}
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
        <script src="{{asset('assets/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('assets/vendor/datatables-plugins/dataTables.bootstrap.min.js')}}"></script>
        <script src="{{asset('assets/vendor/datatables-responsive/dataTables.responsive.js')}}"></script>
        <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true,
            'paging':false
        });
    });
    </script>
        @endsection