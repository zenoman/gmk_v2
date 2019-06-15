<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;

class detailtransaksilangsung implements FromCollection,WithHeadings
{
   public function __construct(int $bulan,int $tahun)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }
    public function collection()
    {
        return DB::table('tb_details')
        ->select(DB::raw('tb_details.tgl,admins.username,tb_details.faktur,tb_details.barang,tb_varian.varian,tb_details.harga,tb_details.jumlah,tb_details.diskon,tb_details.total'))
        ->leftjoin('admins','admins.id','=','tb_details.admin')
        ->leftjoin('tb_varian','tb_varian.kode_v','=','tb_details.kode_v')
        ->whereMonth('tb_details.tgl',$this->bulan)
        ->whereYear('tb_details.tgl',$this->tahun)
        ->where('tb_details.metode','langsung')
        ->orderby('tb_details.id','desc')
        ->get();
    }
    public function headings(): array
    {
        return [
            'tanggal',
            'pembuat',
            'faktur',
            'barang',
            'warna',
            'harga',
            'banyak',
            'diskon',
            'total'
        ];
    }
}