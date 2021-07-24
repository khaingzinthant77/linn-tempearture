<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Overtime extends Model
{
    protected $table='overtime';
    protected $fillable =['emp_id','apply_date','reason','actionBy','overtime_status','overtime_reason'];

      public function viewEmployee()
    {
        return $this->hasOne('App\Employee','id','emp_id');
    }
}
