<?php

namespace App\Exports;

use App\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KaryawanExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Employee::all();
    }

    public function headings(): array
    {
        return [
            '#',
            'First Name',
            'Last Name',
            'Age',
            'Gender',
            'Email',
            'Civil Status',
            'Birthday',
            'Address',
            'Birthplace',
            'Employment Status',
            'Employment Type'


        ];
    }
}
