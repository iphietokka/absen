<?php

use Illuminate\Database\Seeder;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('levels')->insert([


            [
            	
                'name' => 'Admin',
                        'desc' => 'Administrator',
                      
           ],

             [
                    'name' => 'Karyawan',
                	'desc' => 'Pekerja',
                      
           ],

            

            
        ]);
    }
}
