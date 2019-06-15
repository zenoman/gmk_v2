<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;

class pemasukanExport implements FromCollection, WithHeadings
{
    public function __construct(int $bulan,int $tahun)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }
    public function collection()
    {
    	return DB::table('tb_transaksis')
        ->select(DB::raw('tb_transaksis.tgl,tb_transaksis.faktur,tb_users.username,tb_transaksis.alamat_tujuan,tb_bank.nama_bank,tb_transaksis.ongkir,tb_transaksis.total_akhir'))
        ->leftjoin('tb_users','tb_users.id','=','tb_transaksis.iduser')
        ->leftjoin('tb_bank','tb_bank.id','=','tb_transaksis.pembayaran')
        ->whereMonth('tb_transaksis.tgl',$this->bulan)
        ->whereYear('tb_transaksis.tgl',$this->tahun)
        ->where('tb_transaksis.status','sukses')
        ->orwhere('tb_transaksis.status','diterima')
        ->orderby('tb_transaksis.faktur','desc')
        ->get();        
    }
    public function headings(): array
    {
        return [
            'tanggal',
            'Faktur',
            'Pembeli',
            'Alamat Tujuan',
            'Metode Bayar',
            'Ongkir',
            'Total'
        ];
    }
}
