<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Level;
use DB;
use Alert;
class LevelController extends Controller
{
   function __construct()
    {
        $this->title = 'level';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $title = $this->title;
            // $jobtitle = JobTitle::with('dept')->get();
            $data = Level::all();
         // $layanan_kategori = layananKategori::pluck('nama_layanan_kategori','id');
        // dd($data);
        return view('Admin.'.$title.'.index',compact('title','data'));
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
         $this->validate($request, [
            'name' => 'required',
            'desc' => 'required',
           
            
        ]);
         $model = $request->all();

     
        Level::create($model);
       return redirect('admin/'.$this->title)->with('success','Level has been added!');
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
         $model = $request->all();
        $data = Level::find($model['id']); 

        if ($data->update($model)){                
            Alert::success('Data Berhasil Diupdate', 'Selamat');
        }else{
            Alert::error('Data Gagal Diupdate', 'Maaf');
        }
        return Redirect::to('admin/'.$this->title);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          $data = Level::find($id);
        if($data->delete()){
            Alert::success('Data Berhasil Dihapus', 'Selamat');
        }else{
            Alert::error('Data Gagal Dihapus', 'Maaf');
        }
        return Redirect::to('admin/'.$this->title);
    }

       public function getData(Request $request) 
    {
       
        $id = $request->id;
        $data = Level::where('id', $id)->get();
        foreach ($data as $d) {
            $id = $d->id;
            $name = $d->name;
            $desc = $d->desc;
        }
        return response()->json([
            "id" => $id,
            "name" => $name,
            "desc" => $desc,
        ]);
    }
}
