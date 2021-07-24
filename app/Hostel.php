<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hostel extends Model
{
    protected $table='hostel';
    protected $fillable =['name','full_address','photo','path'];
}
