<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
     protected $table = 'settings';
      public $timestamps = false;
	  protected $fillable = [
        'country',
        'timezone',
        'clock_comment',
        'iprestriction',
        'db_object'
    ];

    // public function dept()
    // {
    //     return $this->hasOne('App\Department','id','dept_code');
    // }
}