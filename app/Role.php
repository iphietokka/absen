<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	protected $table = 'roles';
	public $timestamps = false;
	  protected $fillable = [
        'name','status'
    ];
    //
     public function user(){
    	return $this->belongsTo('App\User','role_id','id');
    }
}
