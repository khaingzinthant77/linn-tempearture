<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignGroup extends Model
{
	protected $table='assign_groups';
    protected $fillable =['group','branch_id','department_id','emp_id'];

    public function employees(){
    	  return $this->hasMany('App\Employee', 'id','emp_id');
    }

}
