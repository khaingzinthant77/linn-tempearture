<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    protected $table = 'test_results';
    protected $fillable = ['training_id','emp_id','test_date','marks','remark'];

    public function viewEmployee()
    {
        return $this->hasOne('App\Employee','id','emp_id');
    }

    public function viewTraining()
    {
        return $this->hasOne('App\Training','id','training_id');
    }
}
