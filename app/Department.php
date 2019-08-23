<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
     protected $table = 'departments';
     public $timestamps = false;
	  protected $fillable = [
        'department'
    ];

    public function jobtitle(){
    	return $this->belongsTo('App\JobTitle','dept_code','id');
    }
}
