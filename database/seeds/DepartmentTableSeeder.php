<?php

use Illuminate\Database\Seeder;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         \Illuminate\Support\Facades\DB::table('departments')->insert([


        [
            'department' => 'MANAGEMENT',
           
        ],
        [
            'department' => 'CUSTOMER SERVICE',
           
        ],

		[
            'department' => 'HRD',
           
        ],

		[
            'department' => 'KEUANGAN',
           
        ],

		[
            'department' => 'KEPERSONALIAAN',
           
        ],






    ]);
    }
}
