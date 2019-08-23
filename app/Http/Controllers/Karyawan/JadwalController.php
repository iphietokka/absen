<?php

namespace App\Http\Controllers\Karyawan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Alert;
use DB;
use App\Schedules;
use Auth;

class JadwalController extends Controller
{
    function __construct()
    {
        $this->title = "jadwal";
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
        $s = Schedules::where('id_no', $i)->get();
        return view('karyawan.'.$title.'.index', compact('a'));
    }


    public function get(Request $request) 
    {
        $id = \Auth::user()->id_no;
        $datefrom = $request->date_from;
        $dateto = $request->date_to;
        
        if($datefrom == null || $dateto == null ) {
            $data = Schedules::select('in_time', 'out_time', 'date_from', 'date_to', 'hours', 'restday', 'archive')
            ->where('id_no', $id)
            ->get();
            return response()->json($data);

        } elseif ($datefrom !== null AND $dateto !== null) {
            $data = Schedules::select('in_time', 'out_time', 'date_from', 'date_to', 'hours', 'restday', 'archive')
            ->where('id_no', $id)
            ->whereBetween('date_from', [$datefrom, $dateto])
            ->get();
            return response()->json($data);
        } 
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
