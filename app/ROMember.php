<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ROMember extends Model
{
    protected $table = 'r_o_members';
    protected $fillable = ['ro_id','repoter_id','member_id'];

    public function office_reporter()
    {
    	return $this->hasOne('App\OfficeReporter','id','ro_id');
    }

    public function members()
    {
    	return $this->hasOne('App\Employee','id','member_id');
    }
}
