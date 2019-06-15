@extends('layout.master')
@foreach($websettings as $webset)
@section('title',$webset->webName)
@section('favicon')
<link rel="shortcut icon" type="image" href="{{asset('img/setting/'.$webset->ico)}}">
@endsection
@endforeach

@section('css')
@endsection

@section('content')
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Backup Data	Bulan {{$bulan}} Tahun {{$tahun}} </h1>

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
                            Backup Data
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        	<div class="row">
                @if($totalpengeluaran>0)
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                               <div class="col-xs-12 text-center">
                                    <div class="huge">{{$totalpengeluaran}}</div>
                                    <div>Total Pengeluaran</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <div class="row">
                               <div class="col-xs-12 text-center">
                                    <div class="huge">{{$totalpengeluaran}}</div>
                                    <div>Total Pengeluaran</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if($totalpemasukan>0)
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                               
                                <div class="col-xs-12 text-center">
                                    <div class="huge">{{$totalpemasukan}}</div>
                                    <div>Total Pemasukan</div>
                                </div>
                            </div>
                        </div>
                     
                    </div>
                </div>
                @else
                 <div class="col-lg-4 col-md-6">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <div class="row">
                               
                                <div class="col-xs-12 text-center">
                                    <div class="huge">{{$totalpemasukan}}</div>
                                    <div>Total Pemasukan</div>
                                </div>
                            </div>
                        </div>
                     
                    </div>
                </div>
                @endif
                @if($totaldetailpemasukan>0)
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                               
                                <div class="col-xs-12 text-center">
                                    <div class="huge">{{$totaldetailpemasukan}}</div>
                                    <div>Total Detail Pemasukan</div>
                                </div>
                            </div>
                        </div>
                     
                    </div>
                </div>
                @else
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <div class="row">
                               
                                <div class="col-xs-12 text-center">
                                    <div class="huge">{{$totaldetailpemasukan}}</div>
                                    <div>Total Detail Pemasukan</div>
                                </div>
                            </div>
                        </div>
                     
                    </div>
                </div>
                @endif
                @if($totalpemasukanlain>0)
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                               
                                <div class="col-xs-12 text-center">
                                    <div class="huge">{{$totalpemasukanlain}}</div>
                                    <div>Total Pemasukan Lain</div>
                                </div>
                            </div>
                        </div>
                     </div>
                </div>
                @else
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <div class="row">
                               
                                <div class="col-xs-12 text-center">
                                    <div class="huge">{{$totalpemasukanlain}}</div>
                                    <div>Total Pemasukan Lain</div>
                                </div>
                            </div>
                        </div>
                     </div>
                </div>
                @endif
                 @if($totaltransaksi>0)
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                               
                                <div class="col-xs-12 text-center">
                                    <div class="huge">{{$totaltransaksi}}</div>
                                    <div>Total Transaksi Langsung</div>
                                </div>
                            </div>
                        </div>
                     </div>
                </div>
                @else
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <div class="row">
                               
                                <div class="col-xs-12 text-center">
                                    <div class="huge">{{$totaltransaksi}}</div>
                                    <div>Total Transaksi Langsung</div>
                                </div>
                            </div>
                        </div>
                     </div>
                </div>
                @endif
                 @if($totaldetailtransaksi>0)
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                               <div class="col-xs-12 text-center">
                                    <div class="huge">{{$totaldetailtransaksi}}</div>
                                    <div>Total Detail Transaksi Langsung</div>
                                </div>
                            </div>
                        </div>
                     </div>
                </div>
                @else
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <div class="row">
                               <div class="col-xs-12 text-center">
                                    <div class="huge">{{$totaldetailtransaksi}}</div>
                                    <div>Total Detail Transaksi Langsung</div>
                                </div>
                            </div>
                        </div>
                     </div>
                </div>
                @endif
                 @if($totalcancel>0)
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                               <div class="col-xs-12 text-center">
                                    <div class="huge">{{$totalcancel}}</div>
                                    <div>Total List Cancel</div>
                                </div>
                            </div>
                        </div>
                     </div>
                </div>
                @else
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <div class="row">
                               <div class="col-xs-12 text-center">
                                    <div class="huge">{{$totalcancel}}</div>
                                    <div>Total List Cancel</div>
                                </div>
                            </div>
                        </div>
                     </div>
                </div>
                @endif
            </div>
            <hr>
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#home" data-toggle="tab" aria-expanded="false">Pengeluaran</a>
                                </li>
                                <li class=""><a href="#profile" data-toggle="tab" aria-expanded="false">Pemasukan</a>
                                </li>
                                <li class=""><a href="#messages" data-toggle="tab" aria-expanded="false">Detail Pemasukan</a>
                                </li>
                                <li class=""><a href="#settings" data-toggle="tab" aria-expanded="true">Pemasukan Lain</a>
                                </li>
                                <li class=""><a href="#tl" data-toggle="tab" aria-expanded="true">Transaksi Langsung</a>
                                </li>
                                <li class=""><a href="#dtl" data-toggle="tab" aria-expanded="true">Detail Transaksi Langsung</a>
                                </li>
                                <li class=""><a href="#lc" data-toggle="tab" aria-expanded="true">List Cancel</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="home">
                                    <h4>Backup Data Pengeluaran</h4>
                                    <a href="{{url('/cetakpengeluaran/'.$bulan.'/'.$tahun)}}" onclick="return confirm('Cetak data pengeluaran ?')" class="btn btn-warning" target="_blank()">
                                       <i class="fa fa-print"></i> Print
                                    </a>
                                    <a href="{{url('/exsportpengeluaran/'.$bulan.'/'.$tahun)}}" class="btn btn-success" onclick="return confirm('Export data pengeluaran ?')">
                                       <i class="fa fa-file-excel-o"></i> Export Excel
                                    </a>
                                    <a href="{{url('/hapuspengeluaran/'.$bulan.'/'.$tahun)}}" class="btn btn-danger" onclick="return confirm('Hapus data pengeluaran ?')">
                                       <i class="fa fa-trash"></i> Hapus Data
                                    </a>
                                </div>
                                <div class="tab-pane fade" id="profile">
                                    <h4>Backup Data Pemasukan</h4>
                                    <a href="{{url('/cetakpemasukan/'.$bulan.'/'.$tahun)}}" class="btn btn-warning" onclick="return confirm('Cetak data pemasukan ?')" target="_blank()">
                                       <i class="fa fa-print"></i> Print
                                    </a>
                                    <a href="{{url('/exsportpemasukan/'.$bulan.'/'.$tahun)}}" class="btn btn-success" onclick="return confirm('Export data pemasukan ?')">
                                       <i class="fa fa-file-excel-o"></i> Export Excel
                                    </a>
                                    <a href="{{url('/hapuspemasukan/'.$bulan.'/'.$tahun)}}" class="btn btn-danger" onclick="return confirm('Hapus data pemasukan ?')">
                                       <i class="fa fa-trash"></i> Hapus Data
                                    </a>
                                </div>
                                <div class="tab-pane fade" id="messages">
                                    <h4>Backup Data Detail Pemasukan</h4>
                                    <a href="{{url('/cetakdetailpemasukan/'.$bulan.'/'.$tahun)}}" class="btn btn-warning" onclick="return confirm('Cetak detail pemasukan ? ')" target="_blank()">
                                       <i class="fa fa-print"></i> Print
                                    </a>
                                    <a href="{{url('/exsportdetailpemasukan/'.$bulan.'/'.$tahun)}}" class="btn btn-success" onclick="return confirm('Export detail pemasukan ?')">
                                       <i class="fa fa-file-excel-o"></i> Export Excel
                                    </a>
                                    <a href="{{url('/hapusdetailpemasukan/'.$bulan.'/'.$tahun)}}" class="btn btn-danger" onclick="return confirm('Hapus data detail pemasukan ?')">
                                       <i class="fa fa-trash"></i> Hapus Data
                                    </a>
                                </div>
                                <div class="tab-pane fade" id="settings">
                                    <h4>Backup Data Pemasukan Lain</h4>
                                    <a href="{{url('/cetakpemasukanlain/'.$bulan.'/'.$tahun)}}" onclick="return confirm('Cetak data pemasukan lain ?')" class="btn btn-warning" target="_blank()">
                                       <i class="fa fa-print"></i> Print
                                    </a>
                                    <a href="{{url('/exsportpemasukanlain/'.$bulan.'/'.$tahun)}}" class="btn btn-success" onclick="return confirm('Export pemasukan lain ?')">
                                       <i class="fa fa-file-excel-o"></i> Export Excel
                                    </a>
                                    <a href="{{url('/hapuspemasukanlain/'.$bulan.'/'.$tahun)}}" class="btn btn-danger" onclick="return confirm('Hapus data pemasukan lain ?')">
                                       <i class="fa fa-trash"></i> Hapus Data
                                    </a>
                                </div>
                                <div class="tab-pane fade" id="tl">
                                    <h4>Backup Data Transaksi Langsung</h4>
                                    <a href="{{url('/cetaktransaksilangsung/'.$bulan.'/'.$tahun)}}" onclick="return confirm('Cetak data Transaksi Langsung ?')" class="btn btn-warning" target="_blank()">
                                       <i class="fa fa-print"></i> Print
                                    </a>
                                    <a href="{{url('/exsporttransaksilangsung/'.$bulan.'/'.$tahun)}}" class="btn btn-success" onclick="return confirm('Export data Transaksi Langsung ?')">
                                       <i class="fa fa-file-excel-o"></i> Export Excel
                                    </a>
                                    <a href="{{url('/hapustransaksilangsung/'.$bulan.'/'.$tahun)}}" class="btn btn-danger" onclick="return confirm('Hapus data transaksi langsung ?')">
                                       <i class="fa fa-trash"></i> Hapus Data
                                    </a>
                                </div>
                                <div class="tab-pane fade" id="dtl">
                                    <h4>Backup Data Detail Transaksi Langsung</h4>
                                    <a href="{{url('/cetakdetailtransaksilangsung/'.$bulan.'/'.$tahun)}}" onclick="return confirm('Cetak data Detail Transaksi Langsung ?')" class="btn btn-warning" target="_blank()">
                                       <i class="fa fa-print"></i> Print
                                    </a>
                                    <a href="{{url('/exsportdetailtransaksi/'.$bulan.'/'.$tahun)}}" class="btn btn-success" onclick="return confirm('Export data detail Transaksi Langsung ?')">
                                       <i class="fa fa-file-excel-o"></i> Export Excel
                                    </a>
                                    <a href="{{url('/hapusdetailtransaksilangsung/'.$bulan.'/'.$tahun)}}" class="btn btn-danger" onclick="return confirm('Hapus data detail transaksi langsung ?')">
                                       <i class="fa fa-trash"></i> Hapus Data
                                    </a>
                                </div>
                                <div class="tab-pane fade" id="lc">
                                    <h4>Backup Data List Cancel</h4>
                                    
                                    <a href="{{url('/hapuslistcancel/'.$bulan.'/'.$tahun)}}" class="btn btn-danger" onclick="return confirm('Hapus data detail transaksi langsung ?')">
                                       <i class="fa fa-trash"></i> Hapus Data
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
            </div>
        </div>
        @endsection
        @section('js')
        @endsection