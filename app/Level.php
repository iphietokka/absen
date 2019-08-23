<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
	protected $table = 'levels';

	  protected $fillable = [
        'name','desc'
    ];
    //

    public function user(){
    	return $this->belongsTo('App\User','level_id','id');
    }
}
