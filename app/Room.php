<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'room';
    protected $fillable = ["hostel_id",'room_no'];

    public function viewHostel()
    {
    	return $this->hasOne('App\Hostel','id','hostel_id');
    }
}
