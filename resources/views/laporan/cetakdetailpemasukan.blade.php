<!DOCTYPE html>
<html>
<head>
	<title>Cetak Detail Pemasukan</title>
</head>
<body onload="window.print()">
	<h4 align="center">
	Cetak Laporan Detail Pemasukan Bulan {{$bulan}} Tahun {{$tahun}}
	</h4>
	<table width="100%">
		<tr>
			<td><p>Tanggal : {{date('d-m-Y')}}</p></td>
			<td align="right">
				<p>Pencetak : {{Session::get('username')}}</p>
			</td>
		</tr>
	</table>
	
	<table width="100%" border="1">
                                <thead>
                                     <tr>
                                        <th>No</th>
                                        <th>tanggal</th>
                                        <th>Faktur</th>
                                        <th>Kode</th>
                                        <th>Pembeli</th>
                                        <th>Barang</th>
                                        <th>Warna</th>
                                        <th>Harga</th>
                                        <th>Diskon</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php 
                                    $i=1;
                                    @endphp
                                    @foreach($data as $row)
                                 <tr>
                                      <td>{{$i++}}</td>
                                      <td>{{$row->tgl}}</td>
                                      <td>{{$row->faktur}}</td>
                                      <td>{{$row->kode_barang}}</td>
                                      <td>{{$row->username}}</td>
                                      <td>{{$row->barang_jenis}}</td>
                                      <td>{{$row->varian}}</td>
                                      <td>
                                          {{"Rp ".number_format($row->harga,0,',','.')}} x {{$row->jumlah}} Pcs
                                      </td>
                                      <td>{{$row->diskon}} %</td>
                                      <td>
                                        {{"Rp ".number_format($row->total,0,',','.')}}
                                        </td>
                                  </tr>
                                  @endforeach
                                </tbody>
                            </table>
</body>
</html>