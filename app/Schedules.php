<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedules extends Model
{
	protected $table = 'employee_schedules';
    public $timestamps = false;
	protected $fillable = [
            'reference',
            'id_no',
            'employee',
            'in_time',
            'out_time',
            'date_from',
            'date_to',
            'hours',
            'restday',
            'archive',

    ];
    //

   public function companydata(){
   return $this->belongsTo('App\CompanyData','id','reference');
     }
}