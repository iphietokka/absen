<?php

namespace App\Exports;

use App\EmployeeLeaves;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CutiExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return EmployeeLeaves::all();
    }

     public function headings(): array
    {
        return [
            '#',
            'Reference',
            'Nomor ID',
            'Karyawan',
            'Type ID',
            'Tipe',
            'Dari',
            'Sampai',
            'Kembali',
            'Alasan',
            'Status',
            'Comment'


        ];
    }
}
