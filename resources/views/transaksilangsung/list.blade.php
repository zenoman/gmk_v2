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
                    <h1 class="page-header">List Data Transaksi Langsung</h1>

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
                            List Data Transaksi Langsung
                        </div>
                        <!-- /.panel-heading -->

                        <div class="panel-body">

                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                 <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Faktur</th>
                                        <th>Tanggal</th>
                                        <th>Pembuat</th>
                                        <th>Total</th>
                                        <th class="text-center">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php 
                                    $i=1;
                                    @endphp
                                    @foreach($data as $row)
                                  <tr>
                                      <td>{{$i++}}</td>
                                      <td>{{$row->faktur}}</td>
                                      <td>{{$row->tgl}}</td>
                                      <td>{{$row->username}}</td>
                                      <td align="right">
                                        {{"Rp ".number_format($row->total_akhir,0,',','.')}}
                                        </td>
                                    <td class="text-center">
                                    <button 
                                    class="btn btn-primary btn-sm tampil" 
                                    data-kode="{{$row->faktur}}"
                                    data-tgl="{{$row->tgl}}"
                                    data-user="{{$row->username}}"
                                    data-total="{{'Rp '.number_format($row->total_akhir,0,',','.')}}"
                                    data-potongan="{{'Rp '.number_format($row->potongan,0,',','.')}}"
                                    data-subtotal="{{'Rp '.number_format($row->total,0,',','.')}}">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                    
                                    </td>
                                  </tr>
                                  @endforeach
                                </tbody>
                            </table>
                            {{$data->links()}}
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
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title text-center" id="myModalLabel">Detail Transaksi Langsung</h4>
                                        </div>
                                        <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-8"><h4 id="fakturnya"></h4></div>
                                            <div class="col-md-4">
                                                <p class="text-right" id="tglnya"></p>
                                                <p class="text-right" id="usernya"></p>
                                            </div>
                                        </div>
                                        <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Banyak</th>
                                            <th class="text-center">Nama Barang</th>
                                            <th class="text-center">Warna</th>
                                            <th class="text-right">Harga</th>
                                            <th class="text-right">Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tubuhnya">
                                        
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="5" class="text-right"><strong>Subtotal</strong></td>
                                            <td class="text-right"><strong id="subtotal"></strong></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" class="text-right"><strong>Potongan</strong></td>
                                            <td class="text-right"><strong id="potongan"></strong></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" class="text-right"><strong>Total</strong></td>
                                            <td class="text-right"><strong id="totalnya"></strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                                        
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
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
            'paging':false
        });

    });
    $('.tampil').on('click', function(){
        $('#tubuhnya').html('<tr><td colspan="6"class="text-center"><span class="text-muted" >Loading...</span></td></tr>');
        var kode = $(this).data('kode');
        var tgl = $(this).data('tgl');
        var user = $(this).data('user');
        var total = $(this).data('total');
        var potongan = $(this).data('potongan');
        var subtotal = $(this).data('subtotal');
        $.ajax({
                type:'GET',
                dataType:'json',
                url: 'listtransaksilangsung/'+kode,
                success:function(data){
                var rows ='';
                var no=0;
                    $.each(data,function(key, value){
                        no +=1;
                        rows = rows + '<tr>';
                        rows = rows + '<td class="text-center">' +no+'</td>';
                        rows = rows + '<td class="text-center">' +value.jumlah+' Pcs </td>';
                        rows = rows + '<td class="text-center">'+value.barang+'</td>';
                        rows = rows + '<td class="text-center">'+value.varian+'</td>';
                        rows = rows + '<td class="text-right"> Rp. ' +rupiah(value.harga)+'</td>';
                        rows = rows + '<td class="text-right"> Rp. ' +rupiah(value.total)+'</td>';
                        rows = rows + '</tr>';
                });
                     $('#tubuhnya').html(rows);
                }
            });
       
        $('#fakturnya').html(kode);
        $('#tglnya').html('tanggal : '+tgl);
        $('#usernya').html('Pembuat : '+user);
        $('#totalnya').html(total);
        $('#potongan').html(potongan);
        $('#subtotal').html(subtotal);
        $('#myModal').modal('toggle');
    });
    //==================================================
        function rupiah(bilangan){
            var number_string = bilangan.toString(),
            sisa    = number_string.length % 3,
            rupiah  = number_string.substr(0, sisa),
            ribuan  = number_string.substr(sisa).match(/\d{3}/gi);
            
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
            return rupiah;
        }
    </script>
        @endsection