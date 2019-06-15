<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;

class transaksilangsung implements FromCollection,WithHeadings
{
   public function __construct(int $bulan,int $tahun)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }
    public function collection()
    {
        return DB::table('tb_transaksis')
        ->select(DB::raw('tb_transaksis.tgl,tb_transaksis.faktur,admins.username,tb_transaksis.total_akhir'))
        ->leftjoin('admins','admins.id','=','tb_transaksis.admin')
        ->whereMonth('tb_transaksis.tgl',$this->bulan)
        ->whereYear('tb_transaksis.tgl',$this->tahun)
        ->where('tb_transaksis.metode','langsung')
        ->orderby('tb_transaksis.id','desc')
        ->get();
    }
    public function headings(): array
    {
        return [
            'tanggal',
            'faktur',
            'pembuat',
            'total'
        ];
    }
}