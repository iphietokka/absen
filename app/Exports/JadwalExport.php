<?php

namespace App\Exports;

use App\Schedules;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class JadwalExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Schedules::all();
    }

       public function headings(): array
    {
        return [
            '#',
            'Reference',
            'Nomor ID',
            'Karyawan',
            'Masuk',
            'Pulang',
            'Tanggal',
            'Tanggal',
            'Jam',
            'Hari Libur',
            'arsip'


        ];
    }
}
