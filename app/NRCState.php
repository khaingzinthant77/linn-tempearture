<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NRCState extends Model
{
    protected $table = 'nrcstate';
    protected $fillable = ["code_id",'name'];

    public function viewCode()
    {
    	return $this->hasOne('App\NRCCode','id','code_id');
    }
}
