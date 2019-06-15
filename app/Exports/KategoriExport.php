<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class KategoriExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        return DB::table('tb_kategoris')->select('id', 'kategori')->get();;
    }
    public function headings(): array
    {
        return [
            'id kategori',
            'Nama Kategori',
        ];
    }
}
