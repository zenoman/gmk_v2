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
                <h1 class="page-header">Omset</h1>
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
                    <button id="btncetak" class="btn btn-primary">
                        <i class="fa fa-print"></i> Print
                    </button>

                    <a href="{{url('/omset/export')}}" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Exsport Excel</a>

                    <br><br>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        List Data Omset
                        </div>
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Pemasukan Online</th>
                                        <th>Pemasukan Offline</th>
                                        <th>Pemasukan Lain</th>
                                        <th>Pengeluaran</th>
                                        <th>Laba</th>
                                        <th>bulan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;?>
                                    @foreach($data as $row)
                                    <?php $no = $i++;?>
                                    <tr>
                        <td>{{$no}}</td>
                        <td>{{"Rp ". number_format($row->pemasukan_online,0,',','.')}}</td>
                        <td>{{"Rp ". number_format($row->pemasukan_offline,0,',','.')}}</td>
                        <td>{{"Rp ". number_format($row->pemasukan_lain,0,',','.')}}</td>
                        <td class="text-danger">{{"Rp ". number_format($row->pengeluaran,0,',','.')}}</td>
                        <td>{{"Rp ". number_format($row->omset,0,',','.')}}</td>
                        <td>{{$row->bulan}}-{{$row->tahun}}</td>
                    </tr>
                                   @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="hidden_div" style="display:none;">
            <h3 align="center">
                Omset Bulanan
            </h3>
            <table width="100%" border="1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pemasukan Online</th>
                        <th>Pemasukan Offline</th>
                        <th>Pemasukan Lain</th>
                        <th>Pengeluaran</th>
                        <th>Laba</th>
                        <th>Bulan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;?>
                    @foreach($data as $row)
                    <?php $no = $i++;?>
                    <tr>
                        <td>{{$no}}</td>
                        <td>{{"Rp ". number_format($row->pemasukan_online,0,',','.')}}</td>
                        <td>{{"Rp ". number_format($row->pemasukan_offline,0,',','.')}}</td>
                        <td>{{"Rp ". number_format($row->pemasukan_lain,0,',','.')}}</td>
                        <td>{{"Rp ". number_format($row->pengeluaran,0,',','.')}}</td>
                        <td>{{"Rp ". number_format($row->omset,0,',','.')}}</td>
                        <td>{{$row->bulan}}-{{$row->tahun}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endsection
        @section('js')
        <script src="{{asset('assets/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('assets/vendor/datatables-plugins/dataTables.bootstrap.min.js')}}"></script>
        <script src="{{asset('assets/vendor/datatables-responsive/dataTables.responsive.js')}}"></script>
        
        <script>
            $(document).ready(function(){
                $('#dataTables-example').DataTable({
                responsive: true });
            });
        //==================================================
        $('#btncetak').click(function(){
        var divToPrint=document.getElementById('hidden_div');
        var newWin=window.open('','Print-Window');
        newWin.document.open();
        newWin.document.write('<html><body onload="window.print();window.close()">'+divToPrint.innerHTML+'</body></html>');
        newWin.document.close();
        });
        </script>
        @endsection