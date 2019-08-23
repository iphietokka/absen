<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       if (auth()->check() && Auth::user()->level_id == '1' )
            {
                return Redirect('/admin');

            }elseif (auth()->check() && Auth::user()->level_id == '2') 
            {
               return Redirect('/karyawan');
            }
           
            
        else
            {
                echo "halaman tidak ditemukan";
            }
    }
}
