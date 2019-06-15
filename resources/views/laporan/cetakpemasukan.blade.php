<!DOCTYPE html>
<html>
<head>
	<title>Cetak Pemasukan</title>
</head>
<body onload="window.print()">
	<h4 align="center">
	Cetak Laporan Pemasukan Bulan {{$bulan}} Tahun {{$tahun}}
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
                                        <th>Pembeli</th>
                                        <th>Alamat Tujuan</th>
                                        <th>Metode Bayar</th>
                                        <th>Ongkir</th>
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
                                      <td>{{$row->username}}</td>
                                      <td>{{$row->alamat_tujuan}}</td>
                                      <td>{{$row->nama_bank}}</td>
                                      <td align="right">
                                          {{"Rp ".number_format($row->ongkir,0,',','.')}}
                                      </td>
                                      <td align="right">
                                        {{"Rp ".number_format($row->total_akhir,0,',','.')}}
                                        </td>
                                  </tr>
                                  @endforeach
                                </tbody>
                            </table>
                              @foreach($total as $tot)
                        <h4>Total : {{"Rp ".number_format($tot->totalnya,0,',','.')}}</h4>
                        @endforeach
</body>
</html>