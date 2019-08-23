<?php

namespace App\Exports;

use App\Attendance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AbsensiExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Attendance::all();
    }
     public function headings(): array
    {
        return [
            '#',
            'Reference',
            'Nomor ID',
            'Tanggal',
            'Karyawan',
            'Masuk',
            'Pulang',
            'Total Jam',
            'Status Masuk',
            'Status Pulang',
            'Alasan',
            'Comment'


        ];
    }
}
