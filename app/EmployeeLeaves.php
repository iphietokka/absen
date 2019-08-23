<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeLeaves extends Model
{
	protected $table = 'employee_leaves';
    public $timestamps = false;
	protected $fillable = [
            'reference',
            'id_no',
            'employee',
            'type_id',
            'type',
            'leave_from',
            'leave_to',
            'reason',
            'status',
            'comment',
            'archived',

    ];
    //

    public function companydata(){
    return $this->belongsTo('App\CompanyData','id','reference');
 }

   public function leavetype(){
    return $this->belongsTo(App\LeaveType::class);
 }
}