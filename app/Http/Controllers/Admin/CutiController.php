<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Alert;
use DB;
use App\Employee;
use App\CompanyData;
use App\EmployeeLeaves;
use App\LeaveType;

class CutiController extends Controller
{
     public function __construct()
    {
        $this->title = 'cuti';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = $this->title; 
        $employee = Employee::with('companydata')->get();
        $employeleave = EmployeeLeaves::all();
         $leavestype = LeaveType::all();
        return view('admin.'.$title.'.index', compact('title','employee','leavestype','employeleave'));
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
    public function edit($id,Request $request)
    {
        $title = $this->title; 
        $id = $request->id;
        $l = EmployeeLeaves::where('id', $id)->first();
        $l->leave_from = date('M d, Y', strtotime($l->leave_from));
        $l->leave_to = date('M d, Y', strtotime($l->leave_to));
        $l->return_date = date('M d, Y', strtotime($l->return_date));
        $leave_types = LeaveType::all();

        return view('admin.'.$title.'.edit', compact('id', 'l', 'leave_types'));
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
         if ($request->id == null || $request->status == null || $request->comment == null) {
            return redirect('leaves')->with('error', 'Whoops! Please fill the form completely!');
        }

        $id = $request->id;
        $status = $request->status;
        $comment = mb_strtoupper($request->comment);

       EmployeeLeaves::where('id', $id)
        ->update([
                    'status' => $status,
                    'comment' => $comment
        ]);

        return redirect('admin/'.$this->title)->with('success','Employee Attendance has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        table::leaves()->where('id', $id)->delete();

        return redirect('admin/'.$this->title)->with('success', 'Deleted!');
    }
}
