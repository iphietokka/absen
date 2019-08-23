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
use App\Schedules;


class JadwalController extends Controller
{
     public function __construct()
    {
        $this->title = 'jadwal';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = $this->title; 
        $employee = Employee::all();
        $schedule = Schedules::all();
        return view('admin.'.$title.'.index', compact('title','employee','schedule'));
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

        $id = $request->id;
        $employee = mb_strtoupper($request->employee);
        $intime = $request->in_time;
        $outime = $request->out_time;
        $datefrom = $request->date_from;
        $dateto = $request->date_to;
        $hours = $request->hours;
        $restday = ($request->restday != null) ? implode(', ', $request->restday) : null ;
        
        if ($employee == '' || $intime == '' || $outime == '' || $id == '') {
            return redirect('schedules')->with('error', 'Whoops! Please fill the form completely.');
        } 

        $ref = Schedules::where([['reference', $id],['archive', 0]])->exists();

        if ($ref == 1) {
            return redirect('schedules')->with('error', 'Oops! This employee has schedule already. Please arhive the present schedule to add new schedule.');
        }

        $emp_id = CompanyData::where('reference', $id)->value('id_no');
    
        Schedules::where('id', $id)->insert([
            'reference' => $id,
            'id_no' => $emp_id,
            'employee' => $employee,
            'in_time' => $intime,
            'out_time' => $outime,
            'date_from' => $datefrom,
            'date_to' => $dateto,
            'hours' => $hours,
            'restday' => $restday,
            'archive' => '0',
        ]);

        return redirect('admin/'.$this->title)->with('success', 'New Schedule Added!');
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
        $sc = Schedules::where('id', $id)->first();
        $rest = explode(', ', $sc->restday);
        return view('admin.'.$title.'.edit', compact('title','data','sc','rest'));
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
        $intime = $request->in_time;
        $outime = $request->out_time;
        $datefrom = $request->date_from; 
        $dateto = $request->date_to; 
        $hours = $request->hours;
        $restday = implode(', ', $request->restday);

        if ($id == null || $intime == null || $outime == null || $datefrom == null || $dateto == null || $restday == null) {
            return redirect('admin/'.$this->title)->with('error', 'Whoops! Please fill the form completely.');
        }

        Schedules::where('id', $id)
        ->update([
                'in_time' => $intime,
                'out_time' => $outime,
                'date_from' => $datefrom,
                'date_to' => $dateto,
                'hours' => $hours,
                'restday' => $restday,
        ]);

        return redirect('admin/'.$this->title)->with('success', 'Schedule has been updated!');
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
