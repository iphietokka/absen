<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Alert;
use DB;
use Carbon\Carbon;
use App\Attendance;
use App\Settings;
use App\Schedules;

class AbsensiController extends Controller
{
     public function __construct()
    {
        $this->title = 'absensi';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = $this->title;
        $data = Attendance::orderBy('date', 'desc')->get();
        $clock_comment = Settings::value('clock_comment');
        return view('admin.'.$title.'.index', compact('title','data','clock_comment'));
    }

     public function clock()
    {
        return view('clock');
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
        $a = Attendance::where('id', $id)->first();

        return view('admin.'.$title.'.edit', compact('id', 'a'));
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
        $idno = $request->id_no;
        $timeIN = date("Y-m-d h:i:s A", strtotime($request->timein_date." ".$request->time_in));
        $timeOUT = date("Y-m-d h:i:s A", strtotime($request->timeout_date." ".$request->time_out));
        $reason = $request->reason;

        if ($id == null || $idno == null || $timeIN == null || $timeOUT == null) {
            return redirect('attendance')->with('error', 'Whoops! Please fill the form completely!');
        }

        $sched_in_time = Schedules::where([
            ['id_no', '=', $idno],
            ['archive', '=', '0'],
        ])->value('in_time');

        if($sched_in_time == null){
            $status_in = "Ok";
        } else {
            $sched_clock_in_time_24h = date("H.i", strtotime($sched_in_time));
            $time_in_24h = date("H.i", strtotime($timeIN));
            if ($time_in_24h <= $sched_clock_in_time_24h) {
                $status_in = 'In Time';
            } else {
                $status_in = 'Terlambat';
            }
        }

        $sched_out_time = Schedules::where([
            ['id_no', '=', $idno],
            ['archive','=','0'],
        ])->value('out_time');

        if($sched_out_time == null) {
            $status_out = "Ok";
        } else {
            $sched_clock_out_time_24h = date("H.i", strtotime($sched_out_time));
            $time_out_24h = date("H.i", strtotime($timeOUT));
            if($time_out_24h >= $sched_clock_out_time_24h) {
                $status_out = 'On Time';
            } else {
                $status_out = 'Cepat Masuk';
            }
        }

        $time1 = Carbon::createFromFormat("Y-m-d h:i:s A", $timeIN);
        $time2 = Carbon::createFromFormat("Y-m-d h:i:s A", $timeOUT);
        $th = $time1->diffInHours($time2);
        $tm = floor(($time1->diffInMinutes($time2) - (60 * $th)));
        $totalhour = $th.".".$tm;

       Attendance::where('id', $id)->update([
            'time_in' => $timeIN,
            'time_out' => $timeOUT,
            'reason' => $reason,
            'total_hours' => $totalhour,
            'status_time_in' => $status_in,
            'status_time_out' => $status_out,
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

        $data = Attendance::find($id);
        $data->delete();


        return redirect('admin/'.$this->title)->with('success', 'Deleted!');
    }
}
