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
                    <h1 class="page-header">Barang</h1>
                </div>
            </div>
            <div class="row">
                    <div class="col-lg-12">
                    @if (session('status'))
                    <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ session('status') }}
                    </div>
                    @elseif(session('statuserror'))
                    <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ session('statuserror') }}
                    </div>
                    @endif
                	
                    <a href="{{url('barang/create')}}" class="btn btn-primary"><i class="fa fa-pencil"></i> Tambah Data</a>

                     <a href="{{url('barang/importexcel')}}" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Import Excel</a>

                    <button class="btn btn-info" data-toggle="modal" data-target="#searchModal">
                        <i class="fa fa-search"></i> Cari Data
                    </button>
                    @if($barangbelum > 0)
                    <a href="{{url('/barang/belumtampil')}}" class="btn btn-warning">Barang belum tampil({{$barangbelum}})</a>
                    @endif
                    <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">Cari Data Spesifik Dari Semua Data</h4>
                                </div>
                                
                                <div class="modal-body">
                                    <form method="post" action="barang/cari">
                                        <div class="form-group">
                                            <input type="" name="cari" class="form-control" placeholder="cari berdasarkan nama barang" required>
                                        </div>
                                        {{csrf_field()}}
                                </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-info">
                                        <i class="fa fa-search"></i> Cari Data
                                        </button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                                        Close
                                        </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <br><br>   
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            List Data Barang
                        </div>
                        <div class="panel-body table-responsive">
                            <form method="post" action="{{url('/barang/hapusbanyak')}}">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Nama Barang</th>
                                        <th>Kategori</th>
                                        <th>Harga</th>
                                        <th>Diskon</th>
                                        <th>Stok</th>
                                        <th class="text-center">Aksi</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=0;?>
                                   	@foreach($barang as $row)
                                    <?php $i++; ?>
                                    <tr>
                                   		<td>{{$i}}</td>
                                   		<td>{{$row->kode_barang}}</td>
                                        <td>{{$row->barang}}</td>
                                        <td>{{$row->kategori}}</td>
                                        <td>
                                        {{"Rp ". number_format($row->harga_barang,0,',','.')}} / {{"Rp ". number_format($row->harga_reseller,0,',','.')}}
                                        </td>
                                        <td>
                                            @if($row->diskon>0)
                                            {{$row->diskon." %"}}
                                            @else
                                            -
                                            @endif
                                        </td>
                                        <td>{{$row->total}}</td>
                                        <td class="text-center">
                                            
                                            <a href="{{url('barang/'.$row->id.'/edit')}}" class="btn btn-success"><i class="fa fa-wrench"></i></a>
                                            <a onclick="return confirm('Hapus Data ?')" href="{{url('barang/'.$row->id.'/hapus')}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                        </td>
                                        <td align="center" bgcolor="#FFFFFF"><input name="kodebarang[]" type="checkbox" id="checkbox[]" value="{{$row->id}}"></td>
                                   	</tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                            <div class="pull-right">
                            <input onclick="return confirm('Hapus Data Terpilih ?')" type="submit" name="submit" class="btn btn-block btn-danger" value="hapus data terpilih">    
                            </div>
                            {{csrf_field()}}
                        </form>
                        {{ $barang->links() }}
                        </div>
                    </div>
                </div>
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
            "paging":false
        });
    });
    </script>
        @endsection