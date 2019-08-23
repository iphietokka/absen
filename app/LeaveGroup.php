<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaveGroup extends Model
{
    protected $table = 'leave_groups';
    public $timestamps = false;
	  protected $fillable = [
        'leave_group',
        'description',
        'leave_privileges',
        'status'
    ];

    public function leavetype(){
    	return $this->hasOne('App\LeaveType','id','leave_privileges');
    }
}
