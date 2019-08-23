<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Alert;
use DB;
use Carbon\Carbon;
use App\Attendance;
use App\Settings;
use App\CompanyData;
use App\Employee;
use App\Schedules;


class ClockController extends Controller
{
    function __construct()
    {
        $this->title = 'clock';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clock_comment = Settings::value('clock_comment');

        return view('clock', compact('clock_comment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         if ($request->id_no == NULL || $request->type == NULL ) {
            return response()->json([
                "error" => "Masukkan ID Anda."
            ]);
        }

        $idno = strtoupper($request->id_no);
        $type = $request->type;
        $date = date('Y-m-d');
        $time = date('h:i:s A');
        $comment = strtoupper($request->clock_comment);
        $ip = $request->ip();

        // clock-in comment feature
        $clock_comment = Settings::value('clock_comment');
        if ($clock_comment == 1) {
            if ($request->clock_comment == NULL ) {
                return response()->json([
                    "error" => "Please provide your comment!"
                ]);
            }
        }

        // ip resriction
        $iprestriction = Settings::value('iprestriction');
        if ($iprestriction != NULL) {
            $ips = explode(",", $iprestriction);
            if(in_array($ip, $ips) == false) {
                $msge = "Whoops! You are not allowed to Clock In or Out from your IP address ".$ip;
                return response()->json([
                    "error" => $msge,
                ]);
            }
        } 

        $employee_id = CompanyData::where('id_no', $idno)->value('reference');
        $emp = Employee::where('id', $employee_id)->first();
        $lastname = $emp->last_name;
        $firstname = $emp->first_name;
        $gender = $emp->gender;
        $civilstatus = $emp->civil_status;
        $employee = mb_strtoupper($lastname.', '.$firstname);

        if ($type == 'Masuk') {
            $has = Attendance::where([['id_no', $idno],['date', $date]])->exists();

            if ($has == 1) {
                $hti = Attendance::where([['id_no', $idno],['date', $date]])->value('time_in');
                $hti = date('h:i A', strtotime($hti));
                return response()->json([
                    "employee" => $employee,
                    "gender" => $gender,
                    "civil_status" => $civilstatus,
                    "error" => "Anda Sudah Absen Masuk Hari Ini at ".$hti,
                ]);

            } else {
                $last_in_notimeout = Attendance::where([['id_no', $idno],['time_out', NULL]])->count();

                if($last_in_notimeout >= 1)
                {
                    return response()->json([
                        "error" => "Please clock-out from your last Clock In."
                    ]);

                } else {

                    $sched_in_time = Schedules::where([['id_no', $idno], ['archive', 0]])->value('in_time');
                    if($sched_in_time == NULL){
                        $status_in = "Ok";
                    } else {
                        $sched_clock_in_time_24h = date("H.i", strtotime($sched_in_time));
                        $time_in_24h = date("H.i", strtotime($time));
                        if ($time_in_24h <= $sched_clock_in_time_24h) {
                            $status_in = 'In Time';
                        } else {
                            $status_in = 'Terlambat';
                        }
                    }

                    if($clock_comment == 1 && $comment != NULL) {
                       Attendance::insert([
                            [
                                'id_no' => $idno,
                                'reference' => $employee_id,
                                'date' => $date,
                                'employee' => $employee,
                                'time_in' => $date." ".$time,
                                'status_time_in' => $status_in,
                                'comment' => $comment,
                            ],
                        ]);
                    } else {
                        Attendance::insert([
                            [
                                'id_no' => $idno,
                                'reference' => $employee_id,
                                'date' => $date,
                                'employee' => $employee,
                                'time_in' => $date." ".$time,
                                'status_time_in' => $status_in,
                            ],
                        ]);
                    }

                    return response()->json([
                        "type" => $type,
                        "time" => $time,
                        "date" => $date,
                        "last_name" => $lastname,
                        "first_name" => $firstname,
                        "gender" => $gender,
                        "civil_status" => $civilstatus,
                        'total_hours' => NULL,
                    ]);
                }
            }
        }
  
        if ($type == 'Pulang') {
            $timeIN = Attendance::where([['id_no', $idno], ['time_out', NULL]])->value('time_in');
            $clockInDate = Attendance::where([['id_no', $idno],['time_out', NULL]])->value('date');

            $hasout = Attendance::where([['id_no', $idno],['date', $date]])->value('time_out');

            $timeOUT = date("Y-m-d h:i:s A", strtotime($date." ".$time));

            if($timeIN == NULL) {
                return response()->json([
                    "error" => "Please Clock In before Clocking Out."
                ]);
            } 

            if ($hasout != NULL) {
                $hto = Attendance::where([['id_no', $idno],['date', $date]])->value('time_out');
                $hto = date('h:i A', strtotime($hto));
                return response()->json([
                    "employee" => $employee,
                    "gender" => $gender,
                    "civil_status" => $civilstatus,
                    "error" => "You already Time Out today at ".$hto,
                ]);

            } else {

                $sched_out_time = Schedules::where([['id_no', $idno], ['archive', 0]])->value('out_time');
                if($sched_out_time == NULL) {
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

                Attendance::where([['id_no', $idno],['date', $clockInDate]])->update(array(
                    'time_out' => $timeOUT,
                    'total_hours' => $totalhour,
                    'status_time_out' => $status_out)
                );
                
                return response()->json([
                    "type" => $type,
                    "time" => $time,
                    "date" => $date,
                    "last_name" => $lastname,
                    "first_name" => $firstname,
                    "gender" => $gender,
                    "civil_status" => $civilstatus
                ]);
            }
        }
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
