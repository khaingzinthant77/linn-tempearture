<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    protected $table='interview';
    protected $fillable =['emp_id','step_id','reason'];

      public function viewEmployee()
    {
    	return $this->hasOne('App\Cvform','id','emp_id');
    }
}
