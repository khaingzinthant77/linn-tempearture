<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobopening extends Model
{
    protected $table ='jobopening';
    protected $fillable =['dep_id','position_id','description','title','posted_date','last_date','close_date','photo'];

      public function viewDepartment()
    {
    	return $this->hasOne('App\Department','id','dep_id');
    }

      public function viewPosition()
    {
    	return $this->hasOne('App\Position','id','position_id');
    }
}
