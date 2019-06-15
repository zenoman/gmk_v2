<?php
namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;

class omset implements FromCollection,WithHeadings
{
	public function collection()
    {
    	return DB::table('omset')
    	->select(
        	'pemasukan_online',
        	'pemasukan_offline',
        	'pemasukan_lain',
        	'pengeluaran',
        	'omset',
        	'bulan',
        	'tahun'
        )->get();;
    }

    public function headings(): array
    {
    	return[
        'Pemasukan online',
        'Pemasukan offline',
        'Pemasukan lain',
        'Pengeluaran',
        'Omset',
        'Bulan',
        'Tahun'
        ];
    }
}
