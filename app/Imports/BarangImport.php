<?php

namespace App\Imports;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Session;

class BarangImport implements ToCollection, WithHeadingRow
{
    function olderkode(){
         $kode = DB::table('tb_kodes')->max('kode_barang');
         return $kode;
    }
    function kode(){
        $kode = DB::table('tb_kodes')->max('kode_barang');
        if($kode != NULL){
            $numkode = substr($kode, 3);
            $countkode = $numkode+1;
            $newkode = "BRG".sprintf("%05s", $countkode);
        }else{
            $newkode = "BRG00001";
        }

        return $newkode;
    }
  
      public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            if($row['varian']=='y'){
                     $kode = $this->kode();
                    DB::table('tb_kodes')->insert([
                    'kode_barang'=>$kode,
                    'barang'=>$row['nama_barang'],
                    'id_kategori'=>$row['id_kategori'],
                    'harga_barang' => $row['harga_barang'],
                    'harga_beli'=>$row['harga_beli'],
                    'deskripsi'=> $row['deskripsi'],
                    'diskon' => $row['diskon_barang'],
                    'harga_reseller'=>$row['harga_reseller'],
                    'tampil'=>'N'
                    ]);
                }else if($row['varian']=='n'){
                    $newkode = $this->olderkode();
                DB::table('tb_barangs')->insert([
                'kode'=> $newkode,
                'stok' => 0,
                'kode_v'=>$row['kode_warna'],
                'warna' => $row['ukuran'],
                'barang_jenis'=>$row['nama_barang']
                ]);
            $id = DB::getPdo()->lastInsertId();
            DB::table('tb_tambahstoks')
            ->insert([
                'idwarna'=>$id,
                'idadmin'=>Session::get('iduser'),
                'kode_barang'=>$newkode,
                'jumlah'=>$row['stok'],
                'tgl'=>date("Y-m-d"),
                'total'=>$row['harga_beli']*$row['stok'],
                'keterangan'=>'menambah pertama kali',
                'aksi'=>'tambah'
            ]);
            }
        }
    }
}
