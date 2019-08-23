<?php

use Illuminate\Database\Seeder;

class CompanyDataTableSeeder extends Seeder
{
/**
* Run the database seeds.
*
* @return void
*/
public function run()
{
	\Illuminate\Support\Facades\DB::table('company_data')->insert([


		[
			'reference' => '1',
			'company' => 'Bekaskaki.Corp',
			'department' => 'MANAGEMENT',
			'job_position' => 'DIREKSI',
			'company_email' => 'iradat@corp.com',
			'id_no' => '001111',
			'start_date' => '2019-06-27',
			'date_regularized' => '2019-06-26',
			'reason' => '',
			'leave_privilege' => '1',

		],

		[
			'reference' => '2',
			'company' => 'Bekaskaki.Corp',
			'department' => 'CUSTOMER SERVICE',
			'job_position' => 'MANAGER',
			'company_email' => 'sarah@corp.com',
			'id_no' => '001122',
			'start_date' => '2019-06-27',
			'date_regularized' => '2019-06-26',
			'reason' => '',
			'leave_privilege' => '1',
		],

		[
			'reference' => '3',
			'company' => 'Bekaskaki.Corp',
			'department' => 'HRD',
			'job_position' => 'MANAGER',
			'company_email' => 'amelia@corp.com',
			'id_no' => '001133',
			'start_date' => '2019-06-27',
			'date_regularized' => '2019-06-26',
			'reason' => '',
			'leave_privilege' => '1',
		],

		[
			'reference' => '4',
			'company' => 'Bekaskaki.Corp',
			'department' => 'KEUANGAN',
			'job_position' => 'MANAGER',
			'company_email' => 'anggi@corp.com',
			'id_no' => '001144',
			'start_date' => '2019-06-27',
			'date_regularized' => '2019-06-26',
			'reason' => '',
			'leave_privilege' => '1',
		],

		[
			'reference' => '5',
			'company' => 'Bekaskaki.Corp',
			'department' => 'KEPERSONALIAAN',
			'job_position' => 'MANAGER',
			'company_email' => 'keen@corp.com',
			'id_no' => '001155',
			'start_date' => '2019-06-27',
			'date_regularized' => '2019-06-26',
			'reason' => '',
			'leave_privilege' => '1',
		],




	]);
}
}
