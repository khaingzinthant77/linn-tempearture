<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfficeReporter extends Model
{
    protected $table = 'office_reporters';
    protected $fillable = ['branch_id','dept_id','ro_id'];

    public function branch()
    {
    	return $this->hasOne('App\Branch','id','branch_id');
    }

    public function department()
    {
    	return $this->hasOne('App\Department','id','dept_id');
    }

    public function reporters()
    {
    	return $this->hasOne('App\Employee','id','ro_id');
    }
}
