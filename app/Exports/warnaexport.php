<?php

namespace App\Exports;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class warnaexport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return DB::table('tb_varian')->select('kode_v', 'varian')->get();;
    }
    public function headings(): array
    {
        return [
            'Kode warna',
            'Warna',
        ];
    }
}
