<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendances';
    protected $fillable = ['emp_id','clock_in','clock_out','date','out_date','attendance_status','clockin_ip_address','colckout_ip_address','working_from','note','is_late','last_updated_by','reason'];

    public function employee()
    {
    	return $this->hasOne('App\Employee','id','emp_id');
    }
    public function last_updated_user()
    {
        return $this->hasOne('App\User','id','last_updated_by');
    }
}
