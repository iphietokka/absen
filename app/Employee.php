<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
	protected $table = 'employees';

	protected $fillable = [
        'last_name',
        'age',
        'first_name',
        'gender',
        'email',
        'civil_status',
        'birthday',
        'address',
        'birth_place',
        'employment_status',
        'employment_type',
        'image',

    ];
    //

      public function companydata(){
        return $this->belongsTo('App\CompanyData','id','reference');
    }
}
