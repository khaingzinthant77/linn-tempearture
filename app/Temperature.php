<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Temperature extends Model
{
    protected $table = 'temperature';
    protected $fillable = ['emp_id','name','department','branch','day','month','year','temp_date','temperture_no','remark'];
}
