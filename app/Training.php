<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    protected $table = 'trainings';
    protected $fillable = ['name','description','peroid','start_date','end_date','trainer_name','trainer_info'];
}
