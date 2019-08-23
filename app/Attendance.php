<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
	protected $table = 'employee_attendance';
    public $timestamps = false;
	protected $fillable = [
            'reference',
            'id_no',
            'employee',
            'date',
            'time_in',
            'time_out',
            'total_hours',
            'status_time_in',
            'status_time_out',
            'reason',
            'comment',

    ];
    //

 //    public function companydata(){
 //    return $this->belongsTo('App\CompanyData','id','reference');
 // }

 //   public function leavetype(){
 //    return $this->belongsTo(App\LeaveType::class);
 // }
}