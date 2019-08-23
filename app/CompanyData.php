<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyData extends Model
{
    protected $table = 'company_data';

	  protected $fillable = [
        'reference',
        'company',
        'department',
        'job_position',
        'company_email',
        'id_no',
        'start_date',
        'date_regularized',
        'reason',
        'leave_privilege',


    ];

     public function employees(){
        return $this->belongsTo('App\Employee','reference','id');
    }
}
