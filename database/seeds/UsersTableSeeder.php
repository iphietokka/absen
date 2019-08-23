<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
/**
* Run the database seeds.
*
* @return void
*/
public function run()
{
    \Illuminate\Support\Facades\DB::table('users')->insert([


        [
            'id_no' => '001111',
            'reference' => '1',
            'name' => 'IRADAT,MUHAMMAD',
            'username' => 'admin',
            'role_id' => '1',
            'email' => 'admin@demo.com',
            'password' => bcrypt('123456'),
            'level_id' => '1',
            'status' => '1',
        ],

        [
            'id_no' => '001122',
            'reference' => '2',
            'name' => 'Novetri,SARAH',
            'username' => 'sarah',
            'role_id' => '2',
            'email' => 'sarah@demo.com',
            'password' => bcrypt('123456'),
            'level_id' => '2',
            'status' => '1',
        ],

        [
            'id_no' => '001133',
            'reference' => '3',
            'name' => 'DWI,AMELIA',
            'username' => 'amelia',
            'role_id' => '1',
            'email' => 'amelia@demo.com',
            'password' => bcrypt('123456'),
            'level_id' => '2',
            'status' => '1',
        ],

        [
            'id_no' => '001144',
            'reference' => '4',
            'name' => 'WARDHANI,ANGGI',
            'username' => 'anggi',
            'role_id' => '1',
            'email' => 'anggi@demo.com',
            'password' => bcrypt('123456'),
            'level_id' => '2',
            'status' => '1',
        ],

        [
            'id_no' => '001155',
            'reference' => '5',
            'name' => 'KEEN,ELIZABETH',
            'username' => 'keen',
            'role_id' => '1',
            'email' => 'keen@demo.com',
            'password' => bcrypt('123456'),
            'level_id' => '2',
            'status' => '1',
        ],




    ]);
}
}
