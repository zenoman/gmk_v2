<!DOCTYPE html>
<html>
<head>
	<title>Cetak Transaksi Langsung</title>
</head>
<body onload="window.print()">
	<h4 align="center">
	Cetak Laporan Transaksi Langsung Bulan {{$bulan}} Tahun {{$tahun}}
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
                                        <th>Pembuat</th>
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
                                      <td>
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