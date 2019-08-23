<?php

use Illuminate\Database\Seeder;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         \Illuminate\Support\Facades\DB::table('employees')->insert([


        [
            'first_name' => 'Muhammad',
            'last_name' => 'Iradat',
            'age' => '27',
            'gender' => 'Male',
            'email' => 'admin@demo.com',
            'civil_status' => 'SINGLE',
            'birthday' => '1989-06-27',
            'address' => 'Jalan Cik Ditiro 24/30',
            'birthplace' => 'Makassar',
            'employment_status' => 'Active',
            'employment_type' => 'Regular',
            'image' => '',
        ],

        [
             'first_name' => 'Sarah',
            'last_name' => 'Novetri',
            'age' => '1995',
            'gender' => 'Female',
            'email' => 'sarah@demo.com',
            'civil_status' => 'SINGLE',
            'birthday' => '1989-06-27',
            'address' => 'Jalan Cik Ditiro 24/30',
            'birthplace' => 'Makassar',
              'employment_status' => 'Active',
            'employment_type' => 'Regular',
            'image' => '',
        ],

         [
            'first_name' => 'AMELIA',
            'last_name' => 'DWI',
            'age' => '22',
            'gender' => 'Male',
            'email' => 'amelia@demo.com',
            'civil_status' => 'SINGLE',
            'birthday' => '1997-06-27',
            'address' => 'Jalan Cik Ditiro 24/30',
            'birthplace' => 'Makassar',
              'employment_status' => 'Active',
            'employment_type' => 'Regular',
            'image' => '',
        ],

         [
            'first_name' => 'ANGGI',
            'last_name' => 'WARDHANI',
            'age' => '24',
            'gender' => 'Female',
            'email' => 'anggi@demo.com',
            'civil_status' => 'SINGLE',
            'birthday' => '1996-06-27',
            'address' => 'Jalan Cik Ditiro 24/30',
            'birthplace' => 'Makassar',
              'employment_status' => 'Active',
            'employment_type' => 'Regular',
            'image' => '',
        ],

         [
             'first_name' => 'ELIZABETH',
            'last_name' => 'KEEN',
            'age' => '22',
            'gender' => 'Female',
            'email' => 'keen@demo.com',
            'civil_status' => 'SINGLE',
            'birthday' => '1998-06-27',
            'address' => 'Jalan Cik Ditiro 24/30',
            'birthplace' => 'Makassar',
              'employment_status' => 'Active',
            'employment_type' => 'Regular',
            'image' => '',
        ],




    ]);
    }
}
