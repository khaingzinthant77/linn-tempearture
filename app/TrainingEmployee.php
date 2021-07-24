<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrainingEmployee extends Model
{
    protected $table = 'training_employees';
    protected $fillable = ['training_id','emp_id'];

    public function viewEmployee()
    {
        return $this->hasOne('App\Employee','id','emp_id');
    }

    public function viewTraining()
    {
        return $this->hasOne('App\Training','id','training_id');
    }
}
