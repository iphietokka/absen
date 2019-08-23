<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobTitle extends Model
{
     protected $table = 'job_titles';
      public $timestamps = false;
	  protected $fillable = [
        'job_title',
        'dept_code'
    ];

    public function dept()
    {
        return $this->hasOne('App\Department','id','dept_code');
    }
}
