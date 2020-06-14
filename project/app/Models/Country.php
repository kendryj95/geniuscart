<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['country_code','country_name','slug','status'];

    public function city()
    {
    	return $this->hasMany('App\Models\City')->where('status','=',1);
    }
}
