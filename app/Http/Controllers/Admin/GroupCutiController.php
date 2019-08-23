<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\LeaveGroup;
use App\LeaveType;
use DB;
use Alert;

class GroupCutiController extends Controller
{

    function __construct()
    {
        $this->title = 'group-cuti';
    }
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function index()
{
    $title = $this->title;
    $leavegroup = LeaveGroup::all();
    $leavetype = LeaveType::with('leavegroup')->get();
// $layanan_kategori = layananKategori::pluck('nama_layanan_kategori','id');
// dd($data);
    return view('Admin.'.$title.'.index',compact('title','leavegroup','leavetype'));
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
    $model = $request->all();

    $leavegroup = strtoupper($request->leave_group); 
    $description = strtoupper($request->description);
    $status = $request->status;
    $leaveprivileges = implode(',', $request->leave_privileges);

    if(LeaveGroup::insert([
        ["leave_group" => $leavegroup, "description" => $description, "leave_privileges" => $leaveprivileges, "status" => $status]
    ])){
        Alert::success('Successfully Add', 'Success');
    }else{
        Alert::error('Something went wrong!', 'Oops...');
    }
    return Redirect::to('admin/'.$this->title);

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
    $title = $this->title;
        $lt = LeaveType::all();
        $lg = LeaveGroup::where("id", $id)->first();

      return view('Admin.'.$title.'.edit', compact('lg', 'lt'));
}

/**
* Update the specified resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function update(Request $request)
{
    $model = $request->all();
    $leavegroup = strtoupper($request->leave_group); 
    $description = strtoupper($request->description);
    $status = $request->status;
    $leaveprivileges = implode(',', $request->leave_privileges);
    $data = LeaveGroup::find($model['id']); 
    if($data->update([
        "leave_group" => $leavegroup,
        "description" => $description,
        "leave_privileges" => $leaveprivileges,
        "status" => $status
    ]))
    {            
        Alert::success('Data Berhasil Diupdate', 'Selamat');
    }else{
        Alert::error('Data Gagal Diupdate', 'Maaf');
    }
    return Redirect::to('admin/'.$this->title)->with('success', 'Group Cuti Terupdate!');
}

/**
* Remove the specified resource from storage.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function destroy($id)
{
    $data = LeaveGroup::find($id);
    if($data->delete()){
        Alert::success('Data Berhasil Dihapus', 'Selamat');
    }else{
        Alert::error('Data Gagal Dihapus', 'Maaf');
    }
    return Redirect::to('admin/'.$this->title);
}

public function get(Request $request) 
{
// $transaksi = TransaksiKamar::with('kamar','tamu')->find($id);
    $id = $request->id;
    $data = LeaveGroup::where('id', $id)->get();

    foreach ($data as $d) {
        $id = $d->id;
        $leave_group = $d->leave_group;
        $leave_privileges = $d->leave_privileges;
        $status = $d->status;
        $description = $d->description;
    }

    return response()->json([
        "id" => $id,
        "leave_group" => $leave_group,
        "leave_privileges" => $leave_privileges,
        "status" => $status,
        "description" => $description,
    ]);
}
}
