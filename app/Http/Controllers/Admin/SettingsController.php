<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Alert;
use DB;
use Auth;
use Carbon\Carbon;
use App\Settings;
use App\Schedules;

class SettingsController extends Controller
{
     public function __construct()
    {
        $this->title = 'settings';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = $this->title; 
       $data = Settings::where('id', 1)->first();
        $ip = $request->ip();
        if ($data !== null) 
        {
            $ss = json_decode($data->db_object);
            if(!isset($ss->activated_at)) {
                $s = "1";
            } else {
                $s = $ss;
            }
        } else {
            $s = "1";
        }
        $s = "1";
        $ss = "1";
        return view('admin.'.$title.'.index', compact('title','data','clock_comment'));
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
    public function update(Request $request)
    {
         $country = $request->country;
        $timezone = $request->timezone;
        $clock_comment = $request->clock_comment;
        $iprestriction = $request->iprestriction;
        
        
        if ($country == null && $timezone == null && $clock_comment == null && $iprestriction == null) {
            return redirect('settings');
        }

        if ($timezone == null) {
            return redirect('settings')->with('error', 'Please select your timezone.');
        } else {
            $t = Settings::where('id', 1)->value('timezone');
            $path = base_path('.env');
            if(file_exists($path)) {
                file_put_contents($path, str_replace('APP_TIMEZONE='.$t, 'APP_TIMEZONE='.$timezone, file_get_contents($path)));
            }
        }

        Settings::where('id', 1)
        ->update([
                'country' => $country,
                'timezone' => $timezone,
                'clock_comment' => $clock_comment,
                'iprestriction' => $iprestriction,
        ]);
        
        return redirect('admin/'.$this->title)->with('success', 'Settings has been updated. Please try re-login for the new settings to take effect.');
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

     public function reverse(Request $request) 
    {
        $id = $request->id;
        $auth_id = \Auth::user()->id;

        if(!isset($id)) 
        {
            return response()->json([
                "error" => "Invalid request.",
            ]);
        }

        if(isset($id)) 
        {
            if($id != $auth_id) 
            {
                return response()->json([
                    "error" => "Invalid request. Wrong ID.",
                ]);
            } else {
                $data = Settings::where('id', 1)->value('db_object');
  
                Settings::where('id', 1)
                ->update([
                    "db_object" => "",
                ]);

                return response()->json([
                    "success" => "Your app is deactivated.",
                    "data" => $data,
                ]);
            }
        }
    }
}
