<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table ='employee';
    protected $fillable =['user_id','emp_id','branch_id','dep_id','position_id','name','gender','marrical_status','father_name','phone_no','nrc_code','nrc_state','nrc_status','nrc','fullnrc','date_of_birth','join_date','join_month','address','city','township','qualification','salary','photo','race','religion','email','fPhone','experience','exp_salary','hostel','graduation','degree','level','course_title','exp_company','exp_position','exp_location','exp_date_from','exp_date_to','skills','proficiency','police_reco','ward_reco','cvfile','otherfile','hostel_location','room_no','home_no','hostel_sdate','active','employment_type','noti_token'];

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

    public function viewCode()
    {
        return $this->hasOne('App\NRCCode','id','nrc_code');
    }
    
    public function viewState()
    {
        return $this->hasOne('App\NRCState','id','nrc_state');
    }

    public function viewSalary()
    {
        return $this->hasMany('App\Salary','emp_id');
    }

     public function viewHostel()
    {
        return $this->hasOne('App\Hostel','id','home_no');
    }

     public function viewRoom()
    {
        return $this->hasOne('App\Room','id','room_no');
    }

    public function viewTemperature()
    {
        return $this->hasMany('App\Temperature','emp_id');
    }
    
}
