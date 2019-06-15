<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;

class detailpemasukan implements FromCollection, WithHeadings
{
     public function __construct(int $bulan,int $tahun)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }
    public function collection()
    {
        return DB::table('tb_details')
        ->select(DB::raw('tb_details.tgl,tb_details.faktur,tb_details.kode_barang,tb_users.username,tb_barangs.barang_jenis,tb_varian.varian,tb_details.harga,tb_details.jumlah,tb_details.diskon,tb_details.total'))
        ->leftjoin('tb_users','tb_users.id','=','tb_details.iduser')
        ->leftjoin('tb_transaksis','tb_transaksis.faktur','=','tb_details.faktur')
        ->leftjoin('tb_barangs','tb_barangs.idbarang','=','tb_details.idwarna')
        ->leftjoin('tb_varian','tb_varian.kode_v','=','tb_barangs.kode_v')
        ->whereMonth('tb_details.tgl',$this->bulan)
        ->whereYear('tb_details.tgl',$this->tahun)
        ->where('tb_transaksis.status','=','sukses')
        ->orwhere('tb_transaksis.status','=','diterima')
        ->get();
    }
    public function headings(): array
    {
        return [
           'tanggal',
           'Faktur',
           'Kode',
           'Pembeli',
           'Barang',
           'Warna',
           'Harga',
           'jumlah',
           'Diskon',
           'Total'
        ];
    }
}
