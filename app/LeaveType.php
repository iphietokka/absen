<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    protected $table = 'leave_types';
    public $timestamps = false;
	  protected $fillable = [
        'leave_type',
        'limit',
        'per_calendar',
       
    ];
     public function leavegroup(){
    	return $this->belongsTo('App\LeaveGroup','leave_privileges','id');
    }
}
