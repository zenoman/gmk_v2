@extends('layout.master')

@foreach($websettings as $webset)
@section('title',$webset->webName)
@section('favicon')
<link rel="shortcut icon" type="image" href="{{asset('img/setting/'.$webset->ico)}}">
@endsection
@endforeach
@section('content')

<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Import Excel</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                Langkah-langkah Upload Excel
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                           <ol>
                                               <li>Download file template upload,warna dan kategori di tab download template excel yang berada bawah ini, pastikan mendownload kedua file di bawah</li>
                                               <hr>
                                               <li>
                                                   Buka <b>3</b> file tersebut kemudian isi data sesuai aturan di bawah ini
                                               </li>
                                               <hr>
                                               <li>
                                                   isi <b>id_kategori</b> di file <b>"template.xlxs"</b> sesuai dengan <b>id kategori</b> di file <b>"kategori.xlsx"</b>, jangan isikan id lain selain id yang tercantum pada file <b>"kategori.xlsx"</b>. untuk lebih jelas lihat gambar di bawah ini
                                               </li><br>
                                               <img src="{{url('img/web/ta_kat.JPG')}}">&nbsp;&nbsp;&nbsp;
                                               <img src="{{url('img/web/war 1.JPG')}}">
                                               <br><br>
                                               <img src="{{url('img/web/ta1.JPG')}}" width="98%"><br><br>
                                              <!--  <p>
                                                  Kemudian isi <b>kode_warna</b> di file <b>"template.xlxs"</b> sesuai dengan <b>Kode Warna</b> di file <b>"Warna.xlsx"</b>, jangan isikan id lain selain id yang tercantum pada file <b>"Warna.xlsx"</b>. untuk lebih jelas lihat gambar di bawah ini
                                               </p> -->
                                               <hr>
                                               <li>
                                                   isi <b>nama_barang</b> dan <b>deskripsi</b> dengan format text, kemudian untuk <b>harga_barang</b>,<b>harga_reseller</b>,<b>harga_beli</b>,<b>diskon_barang</b> isi dengan format angka, ingat, pastikan <b>diskon_barang</b> tidak lebih dari 99. Kosongkan kode_warna, stok dan ukuran pada barang utama. Untuk lebih jelas lihat gambar di bawah
                                               </li><br>
                                               <img src="{{url('img/web/ta.JPG')}}" width="98%"><br><br>
                                               <li>
                                                   Selanjutnya varian, varian hanya dapat di isi dengan huruf <b>y</b> atau <b>n</b> dan pastikan huruf kecil, huruf <b>y</b> digunakan untuk barang utama sedangkan <b>n</b> digunakan untuk variasi ukuran barang utama, pastikan variasi barang memiliki data <b>kode_warna, nama_barang</b>, <b>harga_beli</b>, <b>stok</b>, <b>ukuran</b> dan <b>varian(n)</b> kosongkan data lain selain data tersebut. <b>nama_barang</b> pada varian adalah nama barang di tambah ukuran, ini bersifat wajib, sedangkan <b>kode_warna</b> berasal dari data warna pada file <b>"Warna.xlxs"</b>. untuk lebih jelas lihat contoh berikut
                                               </li><br>
                                               <img src="{{url('img/web/taa.JPG')}}" width="98%"><br><br>
                                               <div class="alert alert-warning">
                                                dari gambar di atas menunjukan bahwa barang <b>Kemeja mantul</b> memiliki variasi ukuran : L & S dengan warna hijau yang memiliki kode 04 dan warna merah muda dengan kode 07 kemudian <b>Kemeja Mantab</b> memiliki ukuran M & S dengan warna biru muda yang memiliki kode 05 dan warna hijau muda dengan kode 06.
                                               </div><br>
                                               <li>Kemudian save <b>template.xlsx</b> dan upload di tab paling bawah yaitu <b>upload file</b>, jangan lupa setelah proses upload selesai tambahkan gambar pada barang-barang tersebut </li><br>
                                               <div class="alert alert-danger">
                                                <b>NB</b> : Untuk mengurangi kesalahan saat import excel, pastikan data di excel tidak lebih dari 30 baris. 
                                               </div>
                                           </ol>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                                Download Template Excel
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse">
                                        <div class="panel-body">
                                          
                                            <a href="{{url('barang/eksportwarna')}}" class="btn btn-success">Download Data Warna</a>
                                            <a href="{{url('barang/eksportkategori')}}" class="btn btn-primary">Download Data Kategori</a>
                                            <a href="{{url('barang/download')}}" class="btn btn-info">Download Template Excel</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                                Upload File
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <form action="/barang/aksiimportexcel" role="form" method="POST" enctype="multipart/form-data">
                                       <div class="form-group">
                                            <label>File excel</label>
                                            <input type="file" name="file" required  accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                                              <p class="help-block">*File excel tidak boleh kosong</p>
                                        </div>
                                        {{csrf_field()}}
                                      <input class="btn btn-primary" type="submit" name="submit" value="simpan">
                                        
                                        
                                    </form> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                </div>
                <!-- /.col-lg-12 -->
                <div class="pull-right">
                    <a onclick="window.history.go(-1);" class="btn btn-danger">Kembali</a>    
                </div>
            </div>
        </div>
        
        @endsection

        @section('js')
             @endsection



