<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Neighborhood extends Model
{
    protected $fillable = ['city_id','name','slug','status'];
    public $timestamps = false;

    public function city()
    {
    	return $this->belongsTo('App\Models\City')->withDefault(function ($data) {
			foreach($data->getFillable() as $dt){
				$data[$dt] = __('Deleted');
			}
		});
    }
}
