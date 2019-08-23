<?php

namespace App\Http\Controllers\Karyawan;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Alert;
use DB;
use App\EmployeeLeaves;
use App\Employee;
use App\LeaveType;
use App\CompanyData;
use App\LeaveGroup;
use Auth;

class CutiController extends Controller
{
    function __construct()
    {
        $this->title = "cuti";
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = $this->title;
        $i = \Auth::user()->id_no;
        $ref = \Auth::user()->reference;

        $l = EmployeeLeaves::where('id_no', $i)->get();
        $lp = CompanyData::where('reference', $ref)->value('leave_privilege');
        $r = LeaveGroup::where('id', $lp)->value('leave_privileges');
        $rights = explode(",", $r);
        
        $lt = LeaveType::all();
        $lg = LeaveGroup::all();
        return view('karyawan.'.$title.'.index', compact('title','l', 'lt', 'lg', 'lp', 'rights'));
    }



     public function request(Request $request) 
    {
        $title = $this->title;
        if ($request->type == null || $request->type_id == null || $request->leave_from == null || $request->leave_to == null || $request->reason == null || $request->return_date == null) {
            return redirect('karyawan/'.$this->title)->with('error', 'Whoops! Please fill the form completely!');
        }

        $typeid = $request->type_id;
        $type = mb_strtoupper($request->type);
        $reason = mb_strtoupper($request->reason);
        $leavefrom = date("Y-m-d", strtotime($request->leave_from));
        $leaveto = date("Y-m-d", strtotime($request->leave_to));
        $returndate = date("Y-m-d", strtotime($request->return_date));

        $id = \Auth::user()->reference;
        $idno = \Auth::user()->id_no;
        $q = Employee::where('id', $id)->select('first_name', 'last_name')->first();
        
        EmployeeLeaves::insert([
            'reference' => $id,
            'id_no' => $idno,
            'employee' => $q->last_name.', '.$q->first_name,
            'type' => $type,
            'type_id' => $typeid,
            'leave_from' => $leavefrom,
            'leave_to' => $leaveto,
            'return_date' => $returndate,
            'reason' => $reason,
            'status' => 'Pending',
        ]);

        return redirect('karyawan/'.$this->title)->with('success', 'Leave request sent!');
    }

    public function get(Request $request) 
    {
        $id = \Auth::user()->reference;
        $datefrom = date("Y-m-d", strtotime($request->date_from));
        $dateto = date("Y-m-d", strtotime($request->date_to));

        if($datefrom == null || $dateto == null ) {
            $data = EmployeeLeaves::where('reference', $id)->get();

            return response()->json($data);
        } 
        
        if ($datefrom !== null AND $dateto !== null) {
            $data = EmployeeLeaves::where('reference', $id)
                                    ->whereDate('leave_from', '<=', $dateto)
                                    ->whereDate('leave_from', '>=', $datefrom)
                                    ->get();

            return response()->json($data);
        }
    }

    public function view(Request $request) 
    {
        $id = $request->id;
        $view = EmployeeLeaves::where('id', $id)->first();
        $view->leave_from = date('M d, Y', strtotime($view->leave_from));
        $view->leave_to = date('M d, Y', strtotime($view->leave_to));
        $view->return_date = date('M d, Y', strtotime($view->return_date));

        return response()->json($view);
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
        $lt = LeaveType::all();
        $type = $l->type;
        return view('karyawan.'.$title.'.edit', compact('id', 'l', 'lt', 'type','title'));
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
        $id = $request->id;
        $type = mb_strtoupper($request->type);
        $leavefrom = $request->leave_from;
        $leaveto = $request->leave_to;
        $returndate = $request->return_date;
        $reason = mb_strtoupper($request->reason);

        if ($id == null || $type == null || $leavefrom == null || $leaveto == null || $reason == null || $returndate == null) {
            return redirect('karyawan.'.$title.'.index')->with('error', 'Whoops! Please fill the form completely!');
        }

        EmployeeLeaves::where('id', $id)
        ->update([
                    'type' => $type,
                    'leave_from' => $leavefrom,
                    'leave_to' => $leaveto,
                    'reason' => $reason
                ]);

        return redirect('karyawan/'.$this->title)->with('success','Leave has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $data = EmployeeLeaves::find($id);
        $data->delete();
         

        return redirect('karyawan/'.$this->title)->with('success', 'Deleted!');
    }
}
