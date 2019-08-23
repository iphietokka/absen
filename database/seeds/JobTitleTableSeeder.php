<?php

use Illuminate\Database\Seeder;

class JobTitleTableSeeder extends Seeder
{
/**
* Run the database seeds.
*
* @return void
*/
public function run()
{
	\Illuminate\Support\Facades\DB::table('job_titles')->insert([


		[
			'job_title' => 'MANAGER',
			'dept_code' => '1',

		],
		[
			'job_title' => 'MANAGER',
			'dept_code' => '2',           
		],

		[
			'job_title' => 'MANAGER',
			'dept_code' => '3',           
		],

		[
			'job_title' => 'MANAGER',
			'dept_code' => '4',           
		],

		[
			'job_title' => 'MANAGER',
			'dept_code' => '5',           
		],






	]);
}
}
