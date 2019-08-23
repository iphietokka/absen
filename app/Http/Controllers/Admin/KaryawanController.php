<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Alert;
use DB;
use App\User;
use App\Employee;
use App\EmployeeLeaves;
use App\Company;
use App\CompanyData;
use App\JobTitle;
use App\LeaveGroup;
use App\LeaveType;
use App\Attendance;
use App\Schedules;
use App\Department;


class KaryawanController extends Controller
{
     public function __construct()
    {
        $this->title = 'karyawan';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = $this->title; 
        $data = Employee::join('company_data', 'employees.id', '=', 'company_data.reference')
        ->get();
        return view('admin.'.$title.'.index', compact('title','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = $this->title; 
        $employees = Employee::all();
        $company = Company::all();
        $department = Department::all();
        $jobtitle = JobTitle::all();
        $leavegroup = LeaveGroup::all();

         return view('admin.'.$title.'.create', compact('title','company', 'department', 'jobtitle', 'employees', 'leavegroup'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        
        $lastname = mb_strtoupper($request->last_name);
        $firstname = mb_strtoupper($request->first_name);
        $age = $request->age;
        $gender = mb_strtoupper($request->gender);
        $emailaddress = mb_strtolower($request->email);
        $civilstatus = mb_strtoupper($request->civil_status);
        $birthday = date("Y-m-d", strtotime($request->birthday));
        $birthplace = mb_strtoupper($request->birth_place);
        $homeaddress = mb_strtoupper($request->address);
        $company = mb_strtoupper($request->company);
        $department = mb_strtoupper($request->department);
        $jobposition = mb_strtoupper($request->job_position);
        $companyemail = mb_strtolower($request->company_email);
        $leaveprivilege = $request->leave_privilege;
        $idno = mb_strtoupper($request->id_no);
        $employmenttype = $request->employment_type;
        $employmentstatus = $request->employment_status;
        $startdate = date("Y-m-d", strtotime($request->start_date));
        $dateregularized = date("Y-m-d", strtotime($request->date_regularized));

       $is_idno_taken = CompanyData::where('id_no', $idno)->exists();
        if ($is_idno_taken == 1) {
            Alert::error('Nomor ID Telah Terpakai', 'Maaf');
            return Redirect::to('admin/'.$this->title);
        }

         if ($lastname == null || $firstname == null || $emailaddress == null)
          {
           
        return redirect('admin/'.$this->title)->with('error', 'Whoops! Please fill the form completely!');
        }

        $file = $request->file('image');
        if($file != null) {
            $name = $request->file('image')->getClientOriginalName();
            $destinationPath = public_path() . '/assets/faces/';
            $file->move($destinationPath, $name);
        } else {
            $name = '';
        }
        
       Employee::insert([
            [
                'last_name' => $lastname,
                'first_name' => $firstname,
                'age' => $age,
                'gender' => $gender,
                'email' => $emailaddress,
                'civil_status' => $civilstatus,
                'birthday' => $birthday,
                'birth_place' => $birthplace,
                'address' => $homeaddress,
                'employment_type' => $employmenttype,
                'employment_status' => $employmentstatus,
                'image' => $name,
            ],
        ]);

        $refId = DB::getPdo()->lastInsertId();
        CompanyData::insert([
            [
                'reference' => $refId,
                'company' => $company,
                'department' => $department,
                'job_position' => $jobposition,
                'company_email' => $companyemail,
                'leave_privilege' => $leaveprivilege,
                'id_no' => $idno,
                'start_date' => $startdate,
                'date_regularized' => $dateregularized,
            ],
        ]);
        Alert::success('Data Berhasil Disimpan', 'Selamat');
        return Redirect::to('admin/'.$this->title);
    }
  

    public function profile($id, Request $request)
    {
        $title = $this->title; 
        $p = Employee::where('id', $id)->first();
        $c = CompanyData::where('reference', $id)->first();
        $i = Employee::select('image')->where('id', $id)->value('image');
        $leavetype = LeaveType::all();
        $leavegroup = LeaveGroup::all();
        return view('admin.'.$title.'.view', compact('title','p', 'c', 'i', 'leavetype', 'leavegroup'));
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
        $company_details = CompanyData::where('id', $id)->first();
        $person_details = Employee::where('id', $id)->first();
        $company = Company::all();
        $department = Department::all();
        $jobtitle = JobTitle::all();
        $leavegroup = LeaveGroup::all();

        return view('admin.'.$title.'.edit', compact('title','company_details', 'person_details', 'company', 'department', 'jobtitle', 'leavegroup'));
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
        $lastname = mb_strtoupper($request->last_name);
        $firstname = mb_strtoupper($request->first_name);
        $age = $request->age;
        $gender = mb_strtoupper($request->gender);
        $emailaddress =  mb_strtolower($request->email);
        $civilstatus = mb_strtoupper($request->civil_status);
        $birthday = date("Y-m-d", strtotime($request->birthday));
        $birthplace = mb_strtoupper($request->birthplace);
        $homeaddress = mb_strtoupper($request->address);
        $company = mb_strtoupper($request->company);
        $department = mb_strtoupper($request->department);
        $jobposition = mb_strtoupper($request->job_position);
        $companyemail = mb_strtolower($request->company_email);
        $leaveprivilege = $request->leave_privilege;
        $idno = mb_strtoupper($request->id_no);
        $employmenttype = $request->employment_type;
        $employmentstatus = $request->employment_status;
        $startdate = date("Y-m-d", strtotime($request->start_date));
        $dateregularized = date("Y-m-d", strtotime($request->date_regularized));

        if ($lastname == null || $firstname == null || $emailaddress == null) {
            return redirect('admin.'.$title.'.edit.'.$id)->with('error', 'Whoops! Please fill the form completely!');
        }

        $file = $request->file('image');
        if ($file != null) {
            $name = $request->file('image')->getClientOriginalName();

            $destinationPath = public_path() . '/assets/faces/';
            $file->move($destinationPath, $name);
        } else {
            $name = Employee::where('id', $id)->value('image');
        }
        
        Employee::where('id', $id)->update([
            'last_name' => $lastname,
            'first_name' => $firstname,
            'age' => $age,
            'gender' => $gender,
            'email' => $emailaddress,
            'civil_status' => $civilstatus,
            'birthday' => $birthday,
            'birthplace' => $birthplace,
            'address' => $homeaddress,
            'employment_type' => $employmenttype,
            'employment_status' => $employmentstatus,
            'image' => $name,
        ]);

        CompanyData::where('reference', $id)->update([
            'company' => $company,
            'department' => $department,
            'job_position' => $jobposition,
            'company_email' => $companyemail,
            'leave_privilege' => $leaveprivilege,
            'id_no' => $idno,
            'start_date' => $startdate,
            'date_regularized' => $dateregularized,
        ]);
        
        return redirect('admin/'.$this->title)->with('success','Employee information has been updated!');
    }



        public function archive($id, Request $request)
    {
        

        $id = $request->id;
        Employee::where('id', $id)->update(['employment_status' => 'Archived']);
        User::where('reference', $id)->update(['status' => '0']);

        return redirect('admin/'.$this->title)->with('success','Employee information has been archived!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $id = $request->id;
        Employee::where('id', $id)->delete();
        CompanyData::where('reference', $id)->delete();
        Attendance::where('reference', $id)->delete();
        Schedules::where('reference', $id)->delete();
        EmployeeLeaves::where('reference', $id)->delete();
        User::where('reference', $id)->delete();

        return redirect('admin/'.$this->title)->with('success','Informasi Karyawan Telah Terhapus!');
    }
}
