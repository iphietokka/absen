<?php

namespace App\Http\Controllers\Karyawan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Schedules;
use App\Attendance;
use App\EmployeeLeaves;
use DB;

class DashboardController extends Controller
{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function index()
{
    $id = \Auth::user()->reference;


    $sm = date('Y/m/01');
    $em = date('Y/m/31');

    $cs = Schedules::where([
        ['reference', $id], 
        ['archive', '0']
    ])->first();

    $ps = Schedules::where([
        ['reference', $id],
        ['archive', '1'],
    ])->take(8)->get();

    $al = EmployeeLeaves::where([['reference', $id], ['status', 'Approved']])->count();
    $ald = EmployeeLeaves::where([['reference', $id], ['status', 'Approved']])->take(8)->get();
    $pl = EmployeeLeaves::where([['reference', $id], ['status', 'Declined']])->orWhere('status', 'Pending')->count();
    $a = Attendance::where('reference', $id)->latest('date')->take(4)->get();

    $la = Attendance::where([['reference', $id], ['status_time_in', 'Terlambat']])->whereBetween('date', [$sm, $em])->count();
// dd($la);

    $ed = Attendance::where([['reference', $id], ['status_time_out', 'Cepat Masuk']])->whereBetween('date', [$sm, $em])->count();

    return view('karyawan.dashboard', compact('cs', 'ps', 'al', 'pl', 'ald', 'a', 'la', 'ed'));
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
