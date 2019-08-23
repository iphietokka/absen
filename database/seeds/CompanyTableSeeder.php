<?php

use Illuminate\Database\Seeder;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         \Illuminate\Support\Facades\DB::table('companies')->insert([


        [
            'company' => 'Bekaskaki.Corp',
           
        ],





    ]);
    }
}
