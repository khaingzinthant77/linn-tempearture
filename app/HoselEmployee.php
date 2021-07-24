<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HoselEmployee extends Model
{
    protected $table='hostel_employee';
    protected $fillable =['emp_id','hostel_id','room_id','start_date','full_address','name','branch_id','dep_id','position_id'];


    public function viewEmployee()
    {
    	return $this->hasOne('App\Employee','id','emp_id');
    }

     public function viewHostel()
    {
    	return $this->hasOne('App\Hostel','id','hostel_id');
    }

     public function viewRoom()
    {
    	return $this->hasOne('App\Room','id','room_id');
    }

     public function viewBranch()
    {
        return $this->hasOne('App\Branch','id','branch_id');
    }

     public function viewDepartment()
    {
        return $this->hasOne('App\Department','id','dep_id');
    }

       public function viewPosition()
    {
        return $this->hasOne('App\Position','id','position_id');
    }
}
