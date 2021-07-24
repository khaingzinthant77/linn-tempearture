<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table='department';
    protected $fillable =['name','in_time','out_time','dept_color','status'];


    public function employees(){
    	 return $this->hasMany('App\Employee','dep_id');
    }

     public function viewJobopening(){
    	 return $this->hasMany('App\Jobopening','dep_id');
    }

    public function groups(){
    	 return $this->hasMany('App\AssignGroup','department_id');
    }

    public function group(){
         return $this->hasMany('App\Ro','department_id');
    }
}
