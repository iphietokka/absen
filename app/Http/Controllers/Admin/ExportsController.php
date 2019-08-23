<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Exports\KaryawanExport;
use App\Exports\AbsensiExport;
use App\Exports\CutiExport;
use App\Exports\JadwalExport;
use Maatwebsite\Excel\Facades\Excel;
use Storage;
use Alert;
use DB;
use App\Employee;
use App\Company;
use App\CompanyData;
use App\JobTitle;
use App\LeaveGroup;
use App\Department;
use App\Report;

class ExportsController extends Controller
{
    public function karyawan() 
	{
		return Excel::download(new KaryawanExport, 'karyawan.xlsx');
	}

	 public function absensi() 
	{
		return Excel::download(new AbsensiExport, 'absensi.xlsx');
	}

	public function cuti() 
	{
		return Excel::download(new CutiExport, 'cuti.xlsx');
	}

	public function jadwal() 
	{
		return Excel::download(new JadwalExport, 'jadwal.xlsx');
	}
}
