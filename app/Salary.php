<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $table = 'salarys';
    protected $fillable = ['emp_id','name','department','branch','pay_date','year','salary_amt','bonus','month_total'];
    
    public function viewEmployee()
    {
        return $this->hasOne('App\Employee','id','emp_id');
    }
}
