<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ro extends Model
{
    protected $table='ro';
    protected $fillable =['group','branch_id','department_id','ro_id'];
    public function employees(){
    	  return $this->hasMany('App\Employee', 'id','ro_id');
    }
}
