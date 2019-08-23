<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use DateTimeZone;
use DateTime;
use Alert;
use DB;
use App\Schedules;
use App\Employee;
use App\EmployeeLeaves;
use App\Company;
use App\CompanyData;
use App\JobTitle;
use App\LeaveGroup;
use App\Department;
use App\Attendance;
use App\Report;

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->title = 'laporan';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = $this->title; 
       $lastviews = Report::all();
        return view('admin.'.$title.'.index', compact('title','lastviews'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
         $title = $this->title; 
        $today = date('M, d Y');
        Report::where('report_id', 1)->update(['last_viewed' => $today]);

        $empList = Employee::all();
        return view('admin.'.$title.'.list', compact('title','empList'));
    }

     public function absen(Request $request)
    {
         $title = $this->title; 
        $today = date('M, d Y');
        Report::where('report_id', 2)->update(array('last_viewed' => $today));

        $empAtten = Attendance::all();
        $employee = Employee::with('companydata')->where('employment_status', 'Active')->get();
        return view('admin.'.$title.'.absen', compact('title','empAtten', 'employee'));
    }

    public function getabsen(Request $request) {
       

        $id = $request->id;
        $datefrom = $request->date_from;
        $dateto = $request->date_to;
        
        if ($id == null AND $datefrom == null AND $dateto == null) {
            $data = Attendance::select('id_no', 'date', 'employee', 'time_in', 'time_out', 'total_hours')->get();
            return response()->json($data);
        }

        if($id !== null AND $datefrom == null AND $dateto == null ) {
            $data = Attendance::where('id_no', $id)->select('id_no', 'date', 'employee', 'time_in', 'time_out', 'total_hours')->get();
            return response()->json($data);

        } elseif ($id !== null AND $datefrom !== null AND $dateto !== null) {
            $data = Attendance::where('id_no', $id)->whereBetween('date', [$datefrom, $dateto])->select('id_no', 'date', 'employee', 'time_in', 'time_out', 'total_hours')->get();
            return response()->json($data);

        } elseif ($id == null AND $datefrom !== null AND $dateto !== null) {
            $data = Attendance::whereBetween('date', [$datefrom, $dateto])->select('id_no', 'date', 'employee', 'time_in', 'time_out', 'total_hours')->get();
            return response()->json($data);
        } 
    }


    public function cuti(Request $request)
    {
         $title = $this->title; 
       $today = date('M, d Y');
        Report::where('report_id', 3)->update(array('last_viewed' => $today));

       $employee = Employee::with('companydata')->where('employment_status', 'Active')->get();
        $empLeaves = EmployeeLeaves::all();
        return view('admin.'.$title.'.cuti', compact('title','empLeaves', 'employee'));
    }

    public function getcuti(Request $request) {
        

        $id = $request->id;
        $datefrom = $request->date_from;
        $dateto = $request->date_to;

        if ($id == null AND $datefrom == null AND $dateto == null) {
            $data = EmployeeLeaves::select('id_no', 'employee', 'type', 'leave_from', 'leave_to', 'status', 'reason')->get();
            return response()->json($data);
        }

        if($id !== null AND $datefrom == null AND $dateto == null ) {
            $data = EmployeeLeaves::where('id_no', $id)->select('id_no', 'employee', 'type', 'leave_from', 'leave_to', 'status', 'reason')->get();
            return response()->json($data);

        } elseif ($id !== null AND $datefrom !== null AND $dateto !== null) {
            $data = EmployeeLeaves::where('id_no', $id)->whereBetween('leavefrom', [$datefrom, $dateto])->select('id_no', 'employee', 'type', 'leave_from', 'leave_to', 'status', 'reason')->get();
            return response()->json($data);

        } elseif ($id == null AND $datefrom !== null AND $dateto !== null) {
            $data = EmployeeLeaves::whereBetween('leave_from', [$datefrom, $dateto])->select('id_no', 'employee', 'type', 'leave_from', 'leave_to', 'status', 'reason')->get();
            return response()->json($data);
        } 
    }


    public function jadwal(Request $request)
    {
         $title = $this->title; 
       $today = date('M, d Y');
        Report::where('report_id', 4)->update(array('last_viewed' => $today));

       $employee = Employee::with('companydata')->where('employment_status', 'Active')->get();
       $empSched = Schedules::orderBy('archive', 'ASC')->get();
        return view('admin.'.$title.'.jadwal', compact('title','empSched', 'employee'));
    }

    public function getjadwal(Request $request) {
        
        
        $id = $request->id;
        
        if ($id == null) {
            $data = Schedules::select('reference', 'employee', 'in_time', 'out_time', 'date_from', 'date_to', 'hours', 'restday', 'archive')->orderBy('archive', 'ASC')->get();
            return response()->json($data);
        }

        if($id !== null) {
            $data = Schedules::where('id_no', $id)->select('reference', 'employee', 'in_time', 'out_time', 'date_from', 'date_to', 'hours', 'restday', 'archive')->orderBy('archive', 'ASC')->get();
            return response()->json($data);
        } 
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
