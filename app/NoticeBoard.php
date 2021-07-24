<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NoticeBoard extends Model
{
    protected $table = 'notice_boards';
    protected $fillable = ['title','description','image','status','publish_date','notice_type','position_id','dept_id','branch_id','uploaded_by'];

    public function position()
    {
    	return $this->hasOne('App\Position','id','position_id');
    }

    public function department()
    {
        return $this->hasOne('App\Department','id','dept_id');
    }

    public function branch()
    {
    	return $this->hasOne('App\Branch','id','branch_id');
    }

    public function uploaded_by()
    {
    	return $this->hasOne('App\User','id','uploaded_by');
    }
}
