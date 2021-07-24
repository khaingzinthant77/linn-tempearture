<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrainingAttendance extends Model
{
    protected $table = 'training_attendances';
    protected $fillable = ['training_id','emp_id','att_date','status','remark'];

    public function viewEmployee()
    {
        return $this->hasOne('App\Employee','id','emp_id');
    }

    public function viewTraining()
    {
        return $this->hasOne('App\Training','id','training_id');
    }
}
