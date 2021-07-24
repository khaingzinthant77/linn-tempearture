<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
	protected $table='settings';
    protected $fillable =['title','description','logo','favicon','api_url','api_key','actual_timein'];

}
