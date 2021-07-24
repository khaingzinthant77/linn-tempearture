<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cancelreason extends Model
{
    protected $table='cancelreason';
    protected $fillable =['emp_id','fcancel_reason','scancel_reason'];

      public function viewEmployee()
    {
    	return $this->hasOne('App\Cvform','id','emp_id');
    }
}
