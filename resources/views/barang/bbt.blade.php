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
                    <h1 class="page-header">Barang Belum Tampil</h1>
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
                	
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            List Data Barang Yang Belum Ditampilkan Di Aplikasi
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
                                        <th>Harga Jual</th>
                                        @if(Session::get('level')!='admin')
                                        <th>Harga Beli</th>
                                        @endif
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
                                        
                                        @if(Session::get('level')!='admin')
                                        <td>
                                        {{"Rp ". number_format($row->harga_beli,0,',','.')}}
                                        </td>
                                        @endif
                                        <td>
                                            @if($row->diskon>0)
                                            {{$row->diskon." %"}}
                                            @else
                                            -
                                            @endif
                                        </td>
                                        <td>{{$row->total}}</td>
                                        <td class="text-center">
                                            @if(Session::get('level')!='admin')
                                            <a onclick="return confirm('Tampilkan Barang ?')" href="{{url('/barang/'.$row->id.'/tampilkan')}}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                                            @endif
                                            <a href="{{url('barang/'.$row->id.'/editbbt')}}" class="btn btn-success btn-sm"><i class="fa fa-wrench"></i></a>
                                            <a onclick="return confirm('Hapus Data ?')" href="{{url('barang/'.$row->id.'/hapus')}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                        </td>
                                        <td align="center" bgcolor="#FFFFFF"><input name="kodebarang[]" type="checkbox" id="checkbox[]" value="{{$row->id}}"></td>
                                   	</tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                            <div class="pull-right">
                            <input onclick="return confirm('Hapus Data Terpilih ?')" type="submit" name="submit" class="btn btn-block btn-danger" value="hapus data terpilih">    
                            </div>
                            <div class="pull-left">
                            <a href="{{url('/barang')}}" class="btn btn-danger">Kembali</a> 
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
            responsive: true
        });
    });
    </script>
        @endsection