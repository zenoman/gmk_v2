<!DOCTYPE html>
<html>
<head>
	<title>cetak data cancel</title>
</head>
<body onload="window.print()">
	<h3 align="center">Cetak Data Cancel Bulan {{$databulan}} Tahun {{$datatahun}}</h3>
	<table border="1" width="100%">
		<tr align="center">
			<td><b>No</b></td>
			<td><b>Pembatal</b></td>
			<td><b>Tanggal</b></td>
			<td><b>Barang</b></td>
			<td><b>Jumlah</b></td>
			<td><b>Harga</b></td>
			<td><b>Subtotal</b></td>
		</tr>
		@php $i = 1; @endphp
		@foreach($data as $row)
		<tr>
			<td align="center">{{$i++}}</td>
			<td align="center">{{$row->username}}</td>
			<td align="center">{{$row->tgl}}</td>
			<td>{{$row->barang_jenis}}</td>
			<td align="center">{{$row->jumlah}} Pcs</td>
			<td align="right"> {{"Rp ".number_format($row->harga,0,',','.')}}</td>
			<td align="right"> {{"Rp ".number_format($row->total,0,',','.')}}</td>
		</tr>
		@endforeach
		@foreach($total as $tot)
		<tr>
			<td colspan="6" align="right"><b>Total</b></td>
			<td align="right"> {{"Rp ".number_format($tot->totalnya,0,',','.')}}</td>
		</tr>
		@endforeach
	</table>
</body>
</html>