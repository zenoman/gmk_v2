$(document).ready(function(){
  var statuspembeli = 'pb';

	carikode();
//============================================ubah status pembeli
$('#s_pembeli').on('change',function(e){
    statuspembeli = this.value;
  })
//===========================================cari kode
	function carikode(){
		$('#panelnya').loading('toggle');
			$.ajax({
			url:'/carikode',
			dataType:'json',
			success:function(data){
				noresi = data;
				$("#noresi").html(noresi);
				getdata();
			},complete:function(){
				
				$('#panelnya').loading('stop');
				$('#caribarang').focus();
			}
		});
		}

	//=============================================cari barang
	$('#caribarang').select2({
		placeholder: 'Cari barang',
		ajax:{
			url:'/caribarang',
			dataType:'json',
			delay:250,
			processResults: function (data){
				return {
					results : $.map(data, function (item){
						return {
							id: item.kode_barang,
							text: item.barang
						}
					})
				}
			},
			cache: true
		}
	});
	//=================================================
	$('#caribarang').on('select2:select',function(e){
		$('#panelnya').loading('toggle');
			var kode = $(this).val();
			$.ajax({
                type: 'GET',
                url: '/carihasilbarang/'+kode,
                success:function (data){
				return {
					results : $.map(data, function (item){
						$("#nama_barang").val(item.barang);
            if(statuspembeli=='pb'){
            $("#harga").val(rupiah(item.harga_barang));
            }else{
            $("#harga").val(rupiah(item.harga_reseller));
            }
						$("#diskon").val(item.diskon);
						carivariasi(item.kode_barang);
						//cariwarna(item.kode_barang);
					})}
				 
				},complete:function(){
				$('#carivarian').focus();
			}
            });
		});

	//=============================================

	function carivariasi(kode){
		$.ajax({
			url:'/carivariasi/'+kode,
			dataType:'json',
			success:function(data){
				$('#carivarian option').each(function() {
    				if ( $(this).val() != 'ph' ) {
       				 $(this).remove();
    			}});
    			$('#carivarian')
         				.append($("<option></option>")
                    	.attr("value",'pw')
                    	.attr("data-stok",'')
                    	.attr('selected','')
                    	.attr('disabled','')
                    	.attr('hidden','')
                    	.text('pilih warna'));
                $('#stok').val('');
				$('#jumlah').val('');
				return {
					results : $.map(data, function (item){
						$('#carivarian')
         				.append($("<option></option>")
                    	.attr("value",item.kode_v)
                    	.attr("data-kodenya",item.kode)
                    	.text(item.varian)); 
					
					})}
			},
              complete: function (data) {
                $('#panelnya').loading('stop');
                //$('#cariwarna').focus();
              }
		});
	}
	//===============================================
	$('#carivarian').on('change', function() {
  		var kodebarang = $(this).find(':selected').attr('data-kodenya');
  		var kodewarna = $(this).val();
  		cariwarna(kodebarang,kodewarna)
  	});
	//=============================================

	function cariwarna(kode,kodewarna){
		$('#panelnya').loading('toggle');
		$.ajax({
			url:'/cariwarna/'+kode+'/'+kodewarna,
			dataType:'json',
			success:function(data){
				$('#cariwarna option').each(function() {
    				if ( $(this).val() != 'ph' ) {
       				 $(this).remove();
    			}});
    			$('#cariwarna')
         				.append($("<option></option>")
                    	.attr("value",'ph')
                    	.attr("data-stok",'')
                    	.attr('selected','')
                    	.attr('disabled','')
                    	.attr('hidden','')
                    	.text('pilih ukuran')); 
				$('#stok').val('');
				$('#jumlah').val('');
				return {
					results : $.map(data, function (item){
						$('#cariwarna')
         				.append($("<option></option>")
                    	.attr("value",item.idbarang)
                    	.attr("data-stok",item.stok)
                    	.text(item.warna)); 
					
					})}
			},
              complete: function (data) {
                $('#panelnya').loading('stop');
                $('#cariwarna').focus();
              }
		});
	}

	//===============================================
	$('#cariwarna').on('change', function() {
  		var stok = $(this).find(':selected').attr('data-stok')
  		$('#stok').val(stok);
	});

	//===============================================
	$('#tambahbarang').click(function(){

		if($('#nama_barang').val()=='' || $('#stok').val()=='' || $('#jumlah').val()==''){
			$.notify({message: 'Maaf, Data harus di isi'},{type: 'danger'});
		}else{
			if(parseInt($('#jumlah').val()) > parseInt($('#stok').val())){
				$.notify({message: 'Maaf, Stok tidak cukup'},{type: 'danger'});	
			}else{
				$('#panelnya').loading('toggle');
				var barang = $("#caribarang").select2('data');
        var kode_barang = barang[0].id;
        var ukuran = $('#cariwarna option:selected').text();
        var hargabarang = $('#harga').val().replace('.','');
        var totalawal = parseInt(hargabarang) * parseInt($('#jumlah').val());
				var totaldiskon = parseInt($('#diskon').val())/100*parseInt(hargabarang) * parseInt($('#jumlah').val());
				var total = totalawal-totaldiskon;
				
				$.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/tambahdetail',
                    type: 'POST',
                    data:{
                    	'idwarna': $('#cariwarna').val(),
                    	'faktur': $('#noresi').html(),
    					'kodebarang': kode_barang,
    					'barang': $('#nama_barang').val(),
    					'harga': hargabarang,
    					'jumlah': $('#jumlah').val(),
    					'totalawal': totalawal,
    					'diskon': $('#diskon').val(),
    					'total': total,
    					'kode_v': $('#carivarian').val(),
              'ukuran' : ukuran
                    	},
                    success: function () {
                    	bersih();
                    	getdata();
                    },complete:function(){
                    	$('#panelnya').loading('stop');
                    }
                });
			}
		}
	});

	//==================================================
	function getdata(){
		var noresi = $('#noresi').html();
		$.ajax({
            type:'GET',
            dataType:'json',
            url: '/caridetailbarang/'+noresi,
            success:function(data){
                managerow(data);
            },error:function(){
            }
        });
	}
	//=================================================
	function managerow(data){
		var rows ='';
		var rows2 ='';
		var total=0;
		var no=0;
			$.each(data,function(key, value){
				no +=1;
                rows = rows + '<tr>';
                rows = rows + '<td class="text-center"><button type="button" class="btn btn-warning btn-sm" onclick="halo('+value.id+')"><i class="fa fa-trash"></i></button></td>';
                rows = rows + '<td class="text-center">' +value.barang+'</td>';
                rows = rows + '<td class="text-center">'+value.warna+'</td>';
                rows = rows + '<td class="text-center">'+value.varian+'</td>';
                rows = rows + '<td class="text-right"> Rp. ' +rupiah(value.harga)+'</td>';
                rows = rows + '<td class="text-center">' +value.jumlah+' Pcs </td>';
                rows = rows + '<td class="text-center">' +value.diskon+'% </td>';
                rows = rows + '<td class="text-right"> Rp. ' +rupiah(value.total)+'</td>';
                rows = rows + '</tr>';

                rows2 = rows2 + '<tr>';
                rows2 = rows2 + '<td align="center" style="border: 1px solid black;">' +no+'</td>';
                rows2 = rows2 + '<td align="center" style="border: 1px solid black;">' +value.jumlah+' Pcs </td>';
                rows2 = rows2 + '<td align="center" style="border: 1px solid black;">' +value.barang+'</td>';
                rows2 = rows2 + '<td align="right" style="border: 1px solid black;"> Rp. ' +rupiah(value.harga)+'</td>';
                rows2 = rows2 + '<td align="right" style="border: 1px solid black;"> Rp. ' +rupiah(value.total)+'</td>';
                rows2 = rows2 + '</tr>';
                total += value.total;

            });
            $('#datacetak').html(rows2);
            $('#datatotal').html('Rp. '+rupiah(total));
            $('#datapotongan').html('Rp. '+rupiah($('#potongan').val()));
            $('#datapotongan1').html('Rp. '+rupiah($('#potongan').val()));
            $('#datatotalakhir').html('Rp. '+rupiah(total - $('#potongan').val()));
            $('#datatotalakhir1').html('Rp. '+rupiah(total - $('#potongan').val()));
            $('#datacetak1').html(rows2);

            $('#datatotal1').html('Rp. '+rupiah(total));
            $("#tubuh").html(rows);
            $('#realtotal').val(total);
			      $('#totalnya').html('Rp. '+rupiah(total));
	}
  //==============================================================
  $('#potongan').change(function() {
    var potongan = $('#potongan').val();
    if (potongan==0) {
      var newtotal = $('#realtotal').val();
      $('#totalnya').html('Rp. '+rupiah(newtotal));
    }else{
      var total = $('#realtotal').val();
      var newtotal = total-potongan;
      $('#totalnya').html('Rp. '+rupiah(newtotal));
    }
  });
  
  //===============================================================
  $('#potongan').on("keydown", function(e){
    var code = e.which;
    if ( code == 13 || code == 9 ){
    var potongan = $('#potongan').val();
    
    if (potongan==0) {
      var newtotal = $('#realtotal').val();
      $('#totalnya').html('Rp. '+rupiah(newtotal));
      $('#datapotongan').html('Rp. '+rupiah(potongan));
      $('#datapotongan1').html('Rp. '+rupiah(potongan));
      $('#datatotalakhir').html('Rp. '+rupiah(newtotal));
      $('#datatotalakhir1').html('Rp. '+rupiah(newtotal));
            
    }else{
      var total = $('#realtotal').val();
      var newtotal = total-potongan;
      $('#totalnya').html('Rp. '+rupiah(newtotal));
      $('#datapotongan').html('Rp. '+rupiah(potongan));
      $('#datapotongan1').html('Rp. '+rupiah(potongan));
      $('#datatotalakhir').html('Rp. '+rupiah(newtotal));
      $('#datatotalakhir1').html('Rp. '+rupiah(newtotal));
      $('#totalnya').html('Rp. '+rupiah(newtotal));
    }}
  });
	
  //==================================================================
    function halo(id){
    var foo='bar';
    if(foo=='bar'){
     var isgood = confirm('hapus ? ');
     if(isgood == true){
     	$('#panelnya').loading('toggle');
           $.ajax({
                    type:'GET',
                    dataType:'json',
                    url: '/hapusdetailbarang/'+id,
                    success:function(){
                        
                        getdata();
                    },error:function(){
                       
                        getdata();
                    },complete:function(){
                    	$('#panelnya').loading('stop');
                    }
                });
     }   
    }
    }
    window.halo=halo;
	//=================================================
	function bersih(){
		$("#caribarang").val(null).trigger('change');
		$('#cariwarna option').each(function(){
    		if ( $(this).val() != 'ph' ) {
       		$(this).remove();
    		}});
    	
    	$('#cariwarna')
         		.append($("<option></option>")
                   .attr("value",'ph')
                   .attr("data-stok",'')
                   .attr('selected','')
                   .attr('disabled','')
                   .attr('hidden','')
                   .text('pilih ukuran')); 
		$('#carivarian option').each(function(){
    		if ( $(this).val() != 'ph' ) {
       		$(this).remove();
    		}});
    	
    	$('#carivarian')
         		.append($("<option></option>")
                   .attr("value",'ph')
                   .attr("data-stok",'')
                   .attr('selected','')
                   .attr('disabled','')
                   .attr('hidden','')
                   .text('pilih warna')); 
		$('#stok').val('');
		$('#jumlah').val('');
		$('#nama_barang').val('');
		$('#diskon').val('');
		$('#harga').val('');
		$('#potongan').val(0);
    $('#caribarang').focus();

	}

	//==================================================
		function rupiah(bilangan){
			var	number_string = bilangan.toString(),
			sisa 	= number_string.length % 3,
			rupiah 	= number_string.substr(0, sisa),
			ribuan 	= number_string.substr(sisa).match(/\d{3}/gi);
			
		if (ribuan) {
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}
			return rupiah;
		}

	//==================================================
	$('#btncetak').click(function(){
		if($('#realtotal').val()==0 || $('#realtotal').val()==''){
			$.notify({message: 'Maaf, tambahkan barang terlebih dahulu'},{type: 'danger'});
   		}else{
		var divToPrint=document.getElementById('hidden_div');
		var newWin=window.open('','Print-Window');
		newWin.document.open();
		newWin.document.write('<html><body onload="window.print();window.close()">'+divToPrint.innerHTML+'</body></html>');
		newWin.document.close();
		}
	});
	//========================================================
	$('#bersihbtn').click(function(){
		$("#caribarang").val(null).trigger('change');
		$('#cariwarna option').each(function(){
    		if ( $(this).val() != 'ph' ) {
       		$(this).remove();
    		}});
    	$('#cariwarna')
         		.append($("<option></option>")
                   .attr("value",'ph')
                   .attr("data-stok",'')
                   .attr('selected','')
                   .attr('disabled','')
                   .attr('hidden','')
                   .text('pilih warna')); 
		$('#stok').val('');
		$('#jumlah').val('');
		$('#nama_barang').val('');
		$('#diskon').val('');
		$('#harga').val('');
		$('#caribarang').focus();
	})
	//====================================================
	$('#btnsimpan').click(function(){
		if($('#realtotal').val()==0 || $('#realtotal').val()==''){
			$.notify({message: 'Maaf, tambahkan barang terlebih dahulu'},{type: 'danger'});
   		}else{
        var total = $('#realtotal').val() - $('#potongan').val();
			$('#panelnya').loading('toggle');
				$.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/simpantransaksi',
                    type: 'POST',
                    data:{
                    	'faktur': $('#noresi').html(),
                    	'total': $('#realtotal').val(),
                      'potongan':$('#potongan').val(),
                      'total_akhir':total
                    	},
                    success: function () {
                    	bersih();
                    	carikode();
                    },complete:function(){
                    	$('#panelnya').loading('stop');
                    }
                });
		}
	});
});