@extends('layout.master')
@foreach($websettings as $webset)
@section('title',$webset->webName)
@section('favicon')
<link rel="shortcut icon" type="image" href="{{asset('img/setting/'.$webset->ico)}}">
@endsection
@endforeach
@section('content')
<div id="page-wrapper">
           <div class="row">
           
                <br>
                 @if (session('statuslogin'))
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session('statuslogin') }}
            </div>
            @endif
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">{{$jumlahtransaksi}}</div>
                                    <div>Transaksi bulan ini</div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-users fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
                                    {{$jumlahuser}}
                                    </div>
                                    <div>Pengguna</div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-cube fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
                                        {{$jumlahstok}}
                                    </div>
                                    <div>Total Stok Barang</div>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                </div>
                 <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-support fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">{{$jumlahtransaksig}}</div>
                                    <div>Transaksi gagal</div>
                                </div>
                            </div>
                        </div>
                     </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Penjualan Minggu Ini
                           
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div id="morris-area-chart"></div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
                
                <!-- <div class="col-lg-4">
                <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i>Kategori Terlaris Minggu Ini
                        </div>
                        <div class="panel-body">
                            <div id="morris-donut-chart"></div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
        @endsection
        @section('js')
        <!-- Morris Charts JavaScript -->
    <script src="{{asset('assets/vendor/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('assets/vendor/morrisjs/morris.min.js')}}"></script>
    <!--script src="{{asset('assets/data/morris-data.js')}}"></script-->
    @php
        $date = date('Y-m-d');
        $waktu = strtotime($date);
        
        $minus7 = strtotime("-7 days", $waktu);
        $hasil7 = date('Y-m-d',$minus7);
        $jumlah7 = DB::table('tb_transaksis')->where('tgl',$hasil7)->count();

        $minus6 = strtotime("-6 days", $waktu);
        $hasil6 = date('Y-m-d',$minus6);
        $jumlah6 = DB::table('tb_transaksis')->where('tgl',$hasil6)->count();

        $minus5 = strtotime("-5 days", $waktu);
        $hasil5 = date('Y-m-d',$minus5);
        $jumlah5 = DB::table('tb_transaksis')->where('tgl',$hasil5)->count();

        $minus4 = strtotime("-4 days", $waktu);
        $hasil4 = date('Y-m-d',$minus4);
        $jumlah4 = DB::table('tb_transaksis')->where('tgl',$hasil4)->count();

        $minus3 = strtotime("-3 days", $waktu);
        $hasil3 = date('Y-m-d',$minus3);
        $jumlah3 = DB::table('tb_transaksis')->where('tgl',$hasil3)->count();

        $minus2 = strtotime("-2 days", $waktu);
        $hasil2 = date('Y-m-d',$minus2);
        $jumlah2 = DB::table('tb_transaksis')->where('tgl',$hasil2)->count();

        $minus1 = strtotime("-1 days", $waktu);
        $hasil1 = date('Y-m-d',$minus1);
        $jumlah1 = DB::table('tb_transaksis')->where('tgl',$hasil1)->count();

        $jumlah = DB::table('tb_transaksis')->where('tgl',$date)->count(); 
    @endphp
                
    <script type="text/javascript">
        $(function() {

    Morris.Area({
        parseTime:false,
        element: 'morris-area-chart',
        data: [{
            period: '{{$hasil7}}',
            itouch: {{$jumlah7}}
        }, {
            period: '{{$hasil6}}',
            itouch: {{$jumlah6}}
        }, {
            period: '{{$hasil5}}',
            itouch: {{$jumlah5}}
        }, {
            period: '{{$hasil4}}',
            itouch: {{$jumlah4}}
        }, {
            period: '{{$hasil3}}',
            itouch: {{$jumlah3}}
        }, {
            period: '{{$hasil2}}',
            itouch: {{$jumlah2}}
        }, {
            period: '{{$hasil1}}',
            itouch: {{$jumlah1}}
        }, {
            period: '{{$date}}',
            itouch: {{$jumlah}}
        }],
        xkey: ['period'],
        ykeys: ['itouch'],
        labels: ['Jumlah'],
        pointSize: 2,
        hideHover: 'auto',
        resize: true
    });

    
    
});
    </script>
        @endsection