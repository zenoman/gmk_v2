<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;

class pemasukanlain implements FromCollection, WithHeadings
{
    	public function __construct(int $bulan,int $tahun)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }
    public function collection()
    {
        return DB::table('tb_tambahstoks')
        ->select(DB::raw('tb_tambahstoks.tgl,tb_tambahstoks.kode_barang,tb_barangs.barang_jenis,tb_varian.varian,tb_tambahstoks.jumlah,tb_kodes.harga_barang,tb_tambahstoks.total,admins.username,tb_tambahstoks.keterangan'))
        ->leftjoin('admins','admins.id','=','tb_tambahstoks.idadmin')
        ->leftjoin('tb_barangs','tb_barangs.idbarang','=','tb_tambahstoks.idwarna')
        ->leftjoin('tb_kodes','tb_kodes.kode_barang','=','tb_tambahstoks.kode_barang')
        ->leftjoin('tb_varian','tb_varian.kode_v','=','tb_barangs.kode_v')
        ->where('tb_tambahstoks.aksi','kurangi')
        ->whereMonth('tb_tambahstoks.tgl',$this->bulan)
        ->whereYear('tb_tambahstoks.tgl',$this->tahun)
        ->orderby('tb_tambahstoks.id','desc')
        ->get();
    }
    public function headings(): array
    {
        return [
            'tanggal',
            'Kode',
            'Barang',
            'warna',
            'Jumlah',
            'Harga',
            'Total',
            'Pembuat',
            'Keterangan'
        ];
    }
}
