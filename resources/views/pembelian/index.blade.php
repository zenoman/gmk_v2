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
<script type="text/javascript">
     function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
      
</script>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">List Pembelian</h1>

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
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            List Data Pembelian
                        </div>
                        <!-- /.panel-heading -->

                        <div class="panel-body">

                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Faktur</th>
                                        <th>Pembeli</th>
                                        <th>No. telp</th>
                                        <th>Tanggal</th>
                                        <th>Pembayaran</th>
                                        <th>Status</th>
                                        <th class="text-center">Aksi</th>
                                        <!--th>Level</th-->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;?>
                                    @foreach($pembelians as $row)
                                    <?php $no = $i++;?>
                                    <tr>
                                        <td>{{$no}}</td>
                                        <td>
                                            <a href="{{url('pembelian/'.$row->id.'/detail')}}" class="btn btn-primary btn-sm">
                                                <i class="fa fa-eye"></i>
                                                {{$row->faktur}}
                                            </a>
                                        </td>
                                        <td>{{$row->username}}</td>
                                        <td>{{$row->telp}}</td>
                                        <td>{{$row->tgl}}</td>
                                        <td>{{$row->nama_bank}}</td>
                                        <td>
                                            @if($row->status=='terkirim' || $row->status=='dibaca')
                                            <label class="label label-warning">
                                                Menunggu Persetujuan
                                            </label>
                                            @elseif($row->status=='diterima')
                                            <label class="label label-primary">
                                                Menunggu Pembayaran
                                            </label>
                                            @elseif($row->status=='ditolak')
                                            <label class="label label-danger">
                                                Di Tolak
                                            </label>
                                            @elseif($row->status=='sukses')
                                            <label class="label label-success">
                                                Transaksi Sukses
                                            </label>
                                            @else
                                            <label class="label label-default">
                                                Di Batalkan
                                            </label>
                                            @endif
                                        </td>
                                        <td>
                                            @if($row->status=='terkirim' || $row->status=='dibaca')
                                           
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal{{$row->id}}">
                                            Terima
                                            </button>
                                            <div class="modal fade" id="myModal{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" id="myModalLabel">Terima Pembelian</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6 text-left">
                                                    <table>
                                                        <tr>
                                                            <td><b>Pembeli</b></td>
                                                            <td>&nbsp;:&nbsp;</td>
                                                            <td>{{$row->username}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Tujuan</b></td>
                                                            <td>&nbsp;:&nbsp;</td>
                                                            <td>{{$row->alamat_tujuan}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>No.Telp</b></td>
                                                            <td>&nbsp;:&nbsp;</td>
                                                            <td>{{$row->telp}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Metode</b></td>
                                                            <td>&nbsp;:&nbsp;</td>
                                                            <td>{{$row->nama_bank}}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="col-md-6 col-sm-6 text-right">
                                                    {{$row->tgl}}
                                                    <h2><b>{{$row->faktur}}</b></h2>
                                                </div>
                                            </div>
                                            
                                <div class="table-responsive">
                                    @php
                                    $databarang = DB::table('tb_details')
                                                ->select(DB::raw('tb_details.*,tb_barangs.warna'))
                                                ->leftjoin('tb_barangs','tb_barangs.idbarang','=','tb_details.idwarna')
                                                ->where('tb_details.faktur',$row->faktur)
                                                ->get();
                                    @endphp
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                            Nama Barang</th>
                                            <th class="text-center">
                                            Ukuran</th>
                                            <th class="text-center">
                                            Jumlah</th>
                                            <th class="text-center">Harga</th>
                                            <th class="text-center">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($databarang as $brg)
                                        <tr>
                                            <td>
                                                {{$brg->barang}}
                                            </td>
                                            <td>
                                                {{$brg->warna}}
                                            </td>
                                            <td>
                                                {{$brg->jumlah}}
                                            </td>
                                            <td>
                                                {{"Rp ". number_format($brg->harga,0,',','.')}}
                                            </td>
                                            <td>
                                                {{"Rp ". number_format($brg->total,0,',','.')}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="4"><h3>Total</h3></td>
                                        <td colspan="1"><h3>
                                             {{"Rp ". number_format($row->total,0,',','.')}}
                                        </h3></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                         <p class="help-block text-left">NB: Total sudah termasuk diskon</p>
                                    </div>
                                    <div class="col-md-6 col-sm-6 text-right">
                                        <form action="pembelian" method="post" role="form">
                                        <div class="form-group">
                                            <label>Masukan Ongkir</label>
                                            <input type="text" name="ongkir" class="form-control" required value="0" onkeypress="return isNumberKey(event)">
                                            <p class="help-block text-right">Ongkir Harus Di isi / Masukan angka 0 </p>
                                            <input type="hidden" name="total" value="{{$row->total}}">
                                            <input type="hidden" name="admin" value="{{Session::get('iduser')}}">
                                            <input type="hidden" name="kode" value="{{$row->id}}">
                                            {{csrf_field()}}
                                            </div>
                                        <div class="form-group">
                                            <label>
                                                Masukan Potongan
                                            </label>
                                        <input 
                                        type="text" 
                                        name="potongan" 
                                        class="form-control" 
                                        value="0" 
                                        onkeypress="return isNumberKey(event)"
                                        required>
                                        <p class="help-block text-right">
                                        Potongan Harus Di isi / Masukan angka 0
                                        </p>
                                        </div>
                                    </div>
                                </div> 
                                                
                                                
                                        </div>
                                        <div class="modal-footer">

                                            <button type="submit" onclick="return confirm('Terima Transaksi ?')" class="btn btn-primary">Terima</button>
                                             </form>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>

                                            <!-- <a href="{{url('/pembelian/'.$row->id.'/tolak')}}" onclick="return confirm('Tolak Pembelian Ini ?')" class="btn btn-danger btn-sm">Tolak</a> -->
                            
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modaltolak{{$row->id}}">
                            Tolak
                            </button>
                            <div class="modal fade" id="modaltolak{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" id="myModalLabel">Tolak Pembelian</h4>
                                        </div>
                                        <div class="modal-body">
                                           <form action="/pembelian/tolak" role="form" method="post">
                                            <input type="hidden" value="{{$row->id}}" name="kode">
                                            <input type="hidden" value="{{Session::get('iduser')}}" name="iduser">
                                            <div class="form-group">
                                            <label>Keterangan</label>
                                            <textarea name="keterangan" class="form-control" rows="3" cols="75"></textarea>
                                            {{csrf_field()}}    
                                            </div><br><br>
                                            <button type="submit" class="btn btn-primary" onclick="return confirm('Tolak Pembelian Ini ?')">
                                                Tolak
                                            </button>
                                            </form>       
                                      </div>
                                    </div>
                                </div>
                            </div>
                                            @elseif($row->status=='diterima')
                                            <a href="{{url('/pembelian/'.$row->id.'/sukses')}}" onclick="return confirm('Anda Yakin Pembelian Ini Telah Sukses?')" class="btn btn-success btn-sm">Sukses</a>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modaltolak{{$row->id}}">
                            Tolak
                            </button>
                            <div class="modal fade" id="modaltolak{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" id="myModalLabel">Tolak Pembelian</h4>
                                        </div>
                                        <div class="modal-body">
                                           <form action="/pembelian/tolak" role="form" method="post">
                                            <input type="hidden" value="{{$row->id}}" name="kode">
                                            <input type="hidden" value="{{Session::get('iduser')}}" name="iduser">
                                            <div class="form-group">
                                            <label>Keterangan</label>
                                            <textarea name="keterangan" class="form-control" rows="3" cols="75"></textarea>
                                            {{csrf_field()}}    
                                            </div><br><br>
                                            <button type="submit" class="btn btn-primary" onclick="return confirm('Tolak Pembelian Ini ?')">
                                                Tolak
                                            </button>
                                            </form>       
                                      </div>
                                    </div>
                                </div>
                            </div>
                                            @elseif($row->status=='sukses')
                                            @if(Session::get('level')!='admin')
                                            <a href="{{url('/pembelian/'.$row->faktur.'/hapus')}}" onclick="return confirm('Anda Yakin Menghapus Transaksi Ini?')" class="btn btn-danger btn-sm">Hapus</a>
                                            @endif
                                            @elseif($row->status=='ditolak')
                                             @if(Session::get('level')!='admin')
                                            <a href="{{url('/pembelian/'.$row->faktur.'/hapus')}}" onclick="return confirm('Anda Yakin Menghapus Transaksi Ini?')" class="btn btn-danger btn-sm">Hapus</a>
                                            @endif
                                            @else                      @if(Session::get('level')!='admin')           
                                            <a href="{{url('/pembelian/'.$row->faktur.'/hapus')}}" onclick="return confirm('Anda Yakin Menghapus Transaksi Ini?')" class="btn btn-danger btn-sm">Hapus</a>
                                            @endif
                                            @endif                              
                                        </td>
                                    </tr>
                                   @endforeach
                                </tbody>
                            </table>
                            {{$pembelians->links()}}
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