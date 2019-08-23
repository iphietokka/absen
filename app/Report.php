<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
     protected $table = 'reports';
     public $timestamps = false;
	  protected $fillable = [
        'report_id',
        'last_viewed',
        'title',
    ];

  
}
