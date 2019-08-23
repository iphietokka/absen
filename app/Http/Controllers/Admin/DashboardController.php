<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use DB;
use App\Attendance;
use App\CompanyData;
use App\Employee;
use App\EmployeeLeaves;

class DashboardController extends Controller
{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function index(Request $request)
{
    $datenow = date('Y/m/d');

    $sh = $request->sh;

    $is_online = Attendance::where('date', $datenow)->pluck('id_no');
    $is_online_arr = json_decode(json_encode($is_online), true);
    $is_online_now = count($is_online); 

    $emp_ids = CompanyData::pluck('id_no');
    $emp_ids_arr = json_decode(json_encode($emp_ids), true); 
    $is_offline_now = count(array_diff($emp_ids_arr, $is_online_arr));

    $emp_all_type = Employee::join('company_data', 'employees.id', '=', 'company_data.reference')
    ->where('employees.employment_status', 'Active')
    ->orderBy('company_data.start_date', 'desc')
    ->take(8)
    ->get();

    $emp_typeR = Employee::where('employment_type', 'Regular')
    ->where('employment_status', 'Active')
    ->count();

    $emp_typeT = Employee::where('employment_type', 'Trainee')
    ->where('employment_status', 'Active')
    ->count();

    $emp_allActive = Employee::where('employment_status', 'Active')
    ->count();

    $a = Attendance::latest('date')
    ->take(4)
    ->get();

    $emp_approved_leave = EmployeeLeaves::where('status', 'Approved')
    ->orderBy('leave_from', 'desc')
    ->take(8)
    ->get();

    $emp_leaves_approve = EmployeeLeaves::where('status', 'Approved')
    ->count();

    $emp_leaves_pending = EmployeeLeaves::where('status', 'Pending')
    ->count();

    $emp_leaves_all = EmployeeLeaves::where('status', 'Approved')
    ->orWhere('status', 'Pending')
    ->count();

    return view('admin.dashboard', compact(
        'emp_typeR', 
        'emp_typeT', 
        'emp_allActive', 
        'emp_leaves_pending', 
        'emp_leaves_approve', 
        'emp_leaves_all', 
        'emp_approved_leave', 
        'emp_all_type',
        'a', 
        'is_online_now', 
        'is_offline_now')
);

}

/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
public function create()
{
//
}

/**
* Store a newly created resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @return \Illuminate\Http\Response
*/
public function store(Request $request)
{
//
}

/**
* Display the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function show($id)
{
//
}

/**
* Show the form for editing the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function edit($id)
{
//
}

/**
* Update the specified resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function update(Request $request, $id)
{
//
}

/**
* Remove the specified resource from storage.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function destroy($id)
{
//
}
}
