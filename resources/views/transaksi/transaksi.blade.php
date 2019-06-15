@extends('layout.master')
@section('css')
<link rel="stylesheet" href="{{asset('css/jquery-ui.min.css')}}">
@endsection
@section('content')
<div id="page-wrapper">
    <div class="row">
    <br>    
    </div>
    <div class="row">       
        <div class="col col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">             
                    <p>Transaksi</p>
                </div>                
                    <div class="panel-body">                    
                        <div class="col col-md-6">                      
                                <form method="post">                                                   
                                @csrf
                                        <div class="form-group">
                                            <label for="">Faktur transaksi</label>
                                            <input type="text" id="fk" class="form-control input-sm" name="faktur" id='kodeb' readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Tanggal</label>
                                            <input type="text" id="tgl" readonly class="form-control input-sm" name="faktur" id='kodeb'>
                                        </div>                            
                        </div>  
                        <div class="col col-md-6">
                            <div class="panel panel-success">
                                <div class="panel-body"> 
                                    <div class="col col-md-12">Total Awal: <input type="text" readonly id="t_awal" class="form-control input-sm"></div>
                                    <div class="col col-md-12">Total Diskon: <input type="text" readonly id="t_diskon" class="form-control input-sm"></div>
                                    <input type="hidden" readonly id="total" class="form-control input-sm">
                                    <div class="col col-md-12">
                                        <h3 style="color:red;">Tagihan Rp. <p id="tt"></p></h3> 
                                        <button class="btn btn-success btn-lg btn-block pull-right"><span class="fa fa-cart-plus fa-fw"></span> Bayar</button>
                                    </div>    
                                </div>
                            </div>
                        </div>        
                        <div class="col col-md-12">                            
                                <div class="col col-md-2">
                                    <div class="form-group">
                                        <label for="">Kode Barang</label>
                                        <input type="text" id="kode" class="form-control">
                                    </div>
                                </div> 
                                <div class="col col-md-2">
                                    <div class="form-group">
                                        <label for="">Barang</label>
                                        <input type="text" id="barang" name="barang" onkeydown="clearFill()" class="form-control">
                                    </div>
                                </div>    
                                <div class="col col-md-2">
                                    <div class="form-group">
                                        <label for="">Stok</label>
                                        <input type="text" id="stok" readonly class="form-control">
                                    </div>
                                </div> 
                                <div class="col col-md-2">
                                    <div class="form-group">
                                        <label for="">Harga Barang</label>
                                        <input type="text" id="harga" readonly placeholder="Rp." class="form-control">
                                    </div>
                                </div> 
                                <div class="col col-md-2">
                                    <div class="form-group">
                                        <label for="">Qty</label>
                                        <input type="number" id="qty" oninput="hitungQty()" class="form-control">
                                    </div>
                                </div> 
                                <div class="col col-md-2">
                                    <div class="form-group">
                                        <label for="">Total</label>
                                        <input type="text" id="tla" readonly placeholder="Rp." class="form-control">
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <div class="col col-md-12">
                                    <button type="button" onclick="saveBarang()" class="btn btn-primary btn-sm pull-right"><span class="fa fa-plus fa-fw"></span> Tambahkan</button>
                                    </div>                                    
                                </div>
                                
                            </form>                            
                            <div class="col col-md-12">
                                
                                    <table class="table table-responsive table-striped">
                                        <thead>
                                            <tr>
                                                <th>Kode Barang</th>
                                                <th>Barang</th>
                                                <th>Harga Rp.</th>
                                                <th>Jumlah</th>
                                                <th>Total Awal</th>
                                                <th>Diskon</th>
                                                <th>Total Akhir</th>
                                                <th>Opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                        </tbody>
                                    </table>
                                
                            </div>
                        </div>                          
                    </div>
            </div>
        </div>    
    </div>        
@endsection
@section('js')
<script src="{{asset('js/jquery-ui.min.js')}}"></script>
<script type="text/javascript">    
 $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        }
    });
        $(document).ready(function(){
            $('#tgl').val("<?php echo date("d-m-Y H:m:s") ?>");
            viewData();
            $('input:text').bind({
                
            });
            var kodeb;
            $('#barang').autocomplete({
                minLegth:3,
                autoFocus:true,                
                source:'autB',
                select: function(e, ui) {
                    //alert(ui.item.idbarang);
                    $('#kode').val(ui.item.kode);
                    $('#harga').val(ui.item.harga);
                    $('#stok').val(ui.item.stok);
                    $('#qty').val('1');                    
                    $('#tla').val(ui.item.harga);
                }
            });
        });
        function clearFill(){
            $('#kode').val("");
            $('#harga').val("");
            $('#stok').val("");
            $('#barang').val("");
            $('#tla').val("");
            $('#qty').val("");
        }
        function hitungQty(){
            var hg=document.getElementById('harga').value;	
            var qti=document.getElementById('qty').value;	
            var stk=document.getElementById('stok').value;
                        
                var result=hg*qti;
                $('#tla').val(result)
            
        }
        function viewData(){
            $.ajax({
                type:"GET",
                datatype:'json',
                url:'/showt',
                success:function(response){
                    var rows="";
                    $.each(response,function(key,value){
                        rows=rows+"<tr>";
                        rows=rows+"<td>"+value.kode_barang+"</td>";
                        rows=rows+"<td>"+value.barang+"</td>";
                        rows=rows+"<td>"+value.harga+"</td>";
                        rows=rows+"<td>"+value.jumlah+"</td>";
                        rows=rows+"<td>"+value.total_a+"</td>";
                        rows=rows+"<td>"+value.diskon+"</td>";
                        rows=rows+"<td>"+value.total+"</td>";   
                        rows=rows+"<td><button type='button' onclick='delBarang("+ value.id +")' class='btn btn-danger btn-sm'><span class='fa fa-trash fa-fw'></span></button></td>";
                        rows=rows+"</tr>";                          
                    });
                    $('tbody').html(rows);
                }
            });
        }
        
        function autoKode(){

        }
        function autoFaktur(){
            
        }
        function autoBarang(){

        }
        function saveBarang(){            
            var kode_barang=$('#kode').val();
            var barang=$('#barang').val();
            var harga= $('#harga').val();            
            var jumlah=$('#qty').val();                    
            var total=$('#tla').val();

            $.ajax({
                type:'POST',
                datatype:'json',
                url:'/jual',
                data:{kode_barang:kode_barang,barang:barang,harga:harga,jumlah:jumlah,total:total,_token:'{{csrf_token()}}'},
                success:function(){
                    clearFill();
                    viewData();
                }
            });

        }
        function delBarang(id){
                $.ajax({              
                    type:'POST',
                    data:{id:id,_token:'{{csrf_token()}}'},
                    datatype:'json',
                    url:'/hapus',
                    success:function(response){
                        viewData();                      
                    }
                });
        }
    </script>
@endsection
