<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cvform extends Model
{
     protected $table = "cvform";
	 protected $fillable = ['name','nrc_code','nrc_state','nrc_status','nrc','fullnrc','dob','edu','religion','gender','marrical_status','email','fName','fPhone','experience','job','department','exp_salary','hostel','applied_date','address','phone','photo','signature','status','city','township','graduation','degree','level','course_title','exp_company','exp_position','exp_location','exp_date_from','exp_date_to','skills','proficiency','police_reco','ward_reco','cvfile','otherfile','first_date','second_date'];

	  public function viewCode()
    {
        return $this->hasOne('App\NRCCode','id','nrc_code');
    }
    
    public function viewState()
    {
        return $this->hasOne('App\NRCState','id','nrc_state');
    }

      public function viewDepartment()
    {
        return $this->hasOne('App\Department','id','department');
    }

       public function viewPosition()
    {
        return $this->hasOne('App\Position','id','job');
    }
}
