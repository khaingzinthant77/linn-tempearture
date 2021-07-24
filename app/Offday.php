<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offday extends Model
{
    protected $table='offday';
    protected $fillable =['emp_id','off_day_1','off_day_2','off_day_3','off_day_4','actionBy'];

      public function viewEmployee()
    {
        return $this->hasOne('App\Employee','id','emp_id');
    }
}
