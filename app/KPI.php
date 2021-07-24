<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KPI extends Model
{
    protected $table = 'kpi';
    protected $fillable = ['emp_id','knowledge','descipline','skill_set','team_work','social','motivation','total','month','year','comment'];

    public function employee()
    {
        return $this->hasOne('App\Employee','id','emp_id');
    }
}
