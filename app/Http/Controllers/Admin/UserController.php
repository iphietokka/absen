<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Alert;
use App\User;
use App\Level;
use App\Role;
use App\CompanyData;
use App\Employee;
use Auth;
use Hash;

class UserController extends Controller
{
     public function __construct()
    {
        $this->title = 'user';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $title = $this->title; 
        $data=User::with('levels','roles')->get();
        $level = Level::pluck('name','id');
        $role =  Role::pluck('name','id');
        $employees = Employee::all();
        // $data = User::where('id', '!=', Auth::id())->get();
        return view('admin.'.$title.'.index', compact('title','data','level','role','employees'));
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
        $ref = $request->ref;
        $name = $request->name;
        $username = $request->username;
        $email = $request->email;
        $role_id = $request->role_id;
        $level_id = $request->level_id;
        $password = $request->password;
        $password_confirmation = $request->password_confirmation;
        $status = $request->status;

        $idno = CompanyData::where('reference', $ref)->value('id_no');

        if(User::insert([
            [
                'reference' => $ref,
                'id_no' => $idno,
                'name' => $name,
                'username' => $username,
                'email' => $email,
                'role_id' => $role_id,
                'level_id' => $level_id,
                'password' => Hash::make($password),
                'status' => $status,
            ],
        ]))
        {
     Alert::success('Data Berhasil Disimpan', 'Selamat');
    }else{
     Alert::error('Data Gagal Disimpan', 'Maaf');
   }
     return Redirect::to('admin/'.$this->title);
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
        $u = User::where('id', $id)->first();
        $r = Role::pluck('name','id');
        $level = Level::pluck('name','id');
       
        return view('admin.'.$title.'.edit', compact('u', 'r','level'));
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
        
        $ref = $request->ref;
        $username = $request->username;
        $role_id = $request->role_id;
        $level_id = $request->level_id;
        $status = $request->status;
        $password = $request->password;
        $password_confirmation = $request->password_confirmation;

        if ($password !== null && $password_confirmation !== null) {
            if ($password != $password_confirmation) {
                 Alert::error('Data Gagal Diupdate', 'Maaf');
                return Redirect::to('admin/'.$this->title);
            }
        }

           if(
            User::where('reference', $ref)->update([
                'role_id' => $role_id,
                'level_id' => $level_id,
                'status' => $status,
                'username' =>$username,
                'password' => Hash::make($password),
            ])) 
           {
        Alert::success('Data Berhasil Diupdate', 'Selamat');
    }else{
        Alert::error('Data Gagal Update', 'Maaf');
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
         $data = User::find($id);
    if($data->delete()){
        Alert::success('Data Berhasil Dihapus', 'Selamat');
    }else{
        Alert::error('Data Gagal Dihapus', 'Maaf');
    }
    return Redirect::to('admin/'.$this->title);
    }

    public function update_profile(Request $request) 
    {
        $title = $this->title;
        $id = \Auth::user()->id;
        $myuser = User::where('id', $id)->first();
        $myrole = Role::where('id', $myuser->role_id)->value('name');

        return view('admin.'.$title.'.update-profile', compact('myuser', 'myrole'));
    }

    public function password_update () 
    {
        $title = $this->title;
        return view('admin.'.$title.'.password-update');
    }

    public function update_user(Request $request) 
    {
      $title = $this->title;
        $id = \Auth::id();
        $name = mb_strtoupper($request->name);
        $email = mb_strtolower($request->email);

        if($id == '' || $name == '' || $email =='') {
            return redirect('admin/'.$title.'/update-profile')->with('error', 'Whoops! Please fill the form completely!');
        }

        User::where('id', $id)->update([
            'name' => $name,
            'email' => $email,
        ]);

        return redirect('admin/'.$title.'/update-profile')->with('success', 'Berhasil Update!');
    }

    public function update_password(Request $request)
     {
        $title = $this->title;
        $id = \Auth::id();
        $p = \Auth::user()->password;
        $c_password = $request->currentpassword;
        $n_password = $request->newpassword;
        $c_p_password = $request->confirmpassword;

        if($c_password == '' || $n_password == '' || $c_p_password == '') {
            return redirect('admin/'.$title.'/password-update')->with('error', 'Whoops! Please fill the form completely!');
        }

        if($n_password != $c_p_password) {
            return redirect('admin/'.$title.'/password-update')->with('error', 'New password does not match!');
        }

        if(Hash::check($c_password, $p)) {
            User::where('id', $id)->update([
                'password' => Hash::make($n_password),
            ]);

            return redirect('admin/'.$title.'/password-update')->with('success', 'Updated!');
        } else {
            return redirect('admin/'.$title.'/password-update')->with('error', 'Oops! current password does not match.');
        }
    }
}
